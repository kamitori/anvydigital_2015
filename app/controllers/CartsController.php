<?php
class CartsController extends BaseController {

    public function index()
    {
        try {
            Session::put('cartView', 1);
            $cartItems = Cart::content()->toArray();
        } catch (Exception $e) {
            $cartItems = [];
        }
        $this->layout->content = View::make('frontend.carts.index')->with([
                                                                        'cartItems' => $cartItems,
                                                                        'cartTotal' => $this->getCartTotal($cartItems),
                                                                        'methods'   => JTSetting::getDeliveryMethod(),
                                                                        'arrProvinces' => JTSetting::getAllProvinceByCountry('CA'),
                                                                        'arrCountries'  => JTSetting::getAllCountry()
                                                                    ]);
    }

    private function getCartTotal($cartItems = [])
    {
        if (empty($cartItems)) {
            try {
                $cartItems = Cart::content()->toArray();
            } catch (Exception $e) {
                $cartItems = [];
            }
        } elseif (is_object($cartItems)) {
            $cartItems = $cartItems->toArray();
        }
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['options']['sub_total'];
        }
        return $total;
    }

    public function add()
    {
        if (!Request::ajax()) {
            return App::abort(404);
        }

        $id     = Input::get('_id'); //MongoId
        $quantity = (int)Input::get('quantity');
        $sizew  = (float)Input::get('sizew');
        $sizeh  = (float)Input::get('sizeh');
        $note   = Input::get('note');
        $svg    = Input::has('svg') ? Input::get('svg') : '';
        $imageContent   = Input::has('imageContent') ? Input::get('imageContent') : '';

        $fileQuantity = Input::get('file_qty');
        $options = Input::has('options') ? Input::get('options') : [];
        if (is_string($options)) {
            parse_str($options, $options);
        }
        $data = JTProduct::getPrice([
                                    '_id'   => $id,
                                    'sizew' => $sizew,
                                    'sizeh' => $sizeh,
                                    'fileQuantity' => $fileQuantity,
                                    'quantity'  => $quantity,
                                    'companyId' => Auth::user()->get()->company_id,
                                    'options'   => $options,
                                    'fields'    => ['name']
                                ]);

        $sellPrice  = $data['sell_price'];
        $subTotal   = $data['sub_total'];
        $cartOptions = [
                        '_id'   => $id,
                        'sizew' => $sizew,
                        'sizeh' => $sizeh,
                        'fileQuantity' => $fileQuantity,
                        'options'   => $options,
                        'sub_total' => $subTotal,
                        'note'  => $note,
                        'image' => '',
                        'svg'   => '',
                        'file'  => ''
                    ];

        if (!empty($imageContent) && !empty($svg)) {
            $imageUrl = 'assets/design-images/'.Session::get('userKey', function () {
                                                    $user = Auth::user()->get();
                                                    return md5(md5($user->id));
            });
            $imagePath = public_path(str_replace('/', DS, $imageUrl));
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0775, true);
            }
            $imageName = $id.'-'.md5(time()).'.png';
            File::put($imagePath.DS.$imageName, $imageContent);
            if (!File::exists($imagePath.DS.'svg')) {
                File::makeDirectory($imagePath.DS.'svg', 0775, true);
            }
            $svgPath = $imagePath.DS.'svg'.DS.$id.'-'.md5(time()).'.svg';
            File::put($svgPath, $svg);

            $cartOptions['image'] = URL.'/'.$imageUrl.'/'.$imageName;
        }
        $size = ($sizew ? $sizew.'x' : '').($sizeh ? $sizeh : '');
        $data['name'] .= !empty($size) ? ' ('.$size.')' : '';
        $cartId = md5($id.serialize($options).$cartOptions['image']);
        $item = Cart::search(['id' => $cartId]);
        if (empty($item)) {
            Cart::add($cartId, $data['name'], $quantity, $sellPrice, $cartOptions);
            $message = 'has been added.';
        } else {
            $itemId = reset($item);
            Cart::update($itemId, [
                                    'id' => $cartId, 'name' => $data['name'], 'qty' => $quantity,
                                    'price' => $sellPrice, 'options' => $cartOptions]);
            $message = 'has been update.';
        }
        return ['status' => 'ok', 'cart_quantity' => Cart::count(), 'message' => '<b>'. $data['name'].'</b> '.$message];
    }

    public function update()
    {
        if( !Request::ajax() ) {
            return App::abort(404);
        }
        $itemId = Input::has('itemId') ? Input::get('itemId') : '';
        $quantity = Input::has('quantity') ? (int)Input::get('quantity') : 1;
        if( $item = Cart::get($itemId) ) {
            $cartOptions = $item['options'];
            $id     = $cartOptions['_id'];
            $sizew  = $cartOptions['sizew'];
            $sizeh  = $cartOptions['sizeh'];
            $fileQuantity = $cartOptions['fileQuantity'];
            $options = $cartOptions['options'];
            $data = JTProduct::getPrice([
                                        '_id'   => $id,
                                        'sizew' => $sizew,
                                        'sizeh' => $sizeh,
                                        'fileQuantity' => $fileQuantity,
                                        'quantity'  => $quantity,
                                        'companyId' => Auth::user()->get()->company_id,
                                        'options'   => $options,
                                    ]);
            $cartOptions['sub_total'] = $data['sub_total'];
            Cart::update($item['rowid'], ['quantity' => $quantity, 'qty' => $quantity, 'price' => $data['sell_price'], 'options' => $cartOptions]);
            return [
                    'status'        => 'ok',
                    'message'       => '<b>'. $item['name'] .'</b> has been updated successful.',
                    'sell_price'    => number_format($data['sell_price'], 2),
                    'sub_total'     => number_format($data['sub_total'], 2),
                    'cart_quantity' => Cart::count(),
                    'cart_total'    => number_format($this->getCartTotal(), 2)
                ];
        }
        return ['status' => 'error', 'message' => 'Item did not exist.'];
    }

    public function upload()
    {
        if (!Request::ajax()) {
            return App::abort(404);
        }
        $itemId = Input::has('itemId') ? Input::get('itemId') : '';
        if ($item = Cart::get($itemId)) {
            if (Input::hasFile('file')) {
                $filePath = 'assets'.DS.'design-images'.DS.Session::get('userKey', function () {
                                                        $user = Auth::user()->get();
                                                        return md5(md5($user->id));
                });
                $filePath = public_path($filePath.DS.'files');
                if (!File::exists($filePath)) {
                    File::makeDirectory($filePath, 0775, true);
                }
                $file = Input::file('file');
                $fileName = Str::slug(str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName())).'.'.date('d-m-y').'.'.$file->getClientOriginalExtension();
                try {
                    $file->move($filePath, $fileName);
                    $cartOptions = $item['options'];
                    if (isset($cartOptions['file']) && File::exists($cartOptions['file'])) {
                        File::delete($cartOptions['file']);
                    }
                    $cartOptions['file'] = $filePath.DS.$fileName;
                    Cart::update($item['rowid'], ['options' => $cartOptions]);
                    return [
                        'status'        => 'ok',
                        'message'       => '<b>'. $item['name'] .'</b> has been updated successful.',
                        'name'          => $fileName,
                    ];
                } catch (Exception $e) {
                    return ['status' => 'error', 'message' => $e->getMessage()];
                }
            }
            return ['status' => 'error', 'message' => 'File must be spectified.'];
        }
        return ['status' => 'error', 'message' => 'Item did not exist.'];
    }

    public function delete()
    {
        if( !Request::ajax() ) {
            return App::abort(404);
        }
        $itemId = Input::has('itemId') ? Input::get('itemId') : '';

        if( $item = Cart::get($itemId) ) {
            Cart::remove($itemId);
            return ['status' => 'ok', 'message' => '<b>'. $item['name'] .'</b> has been deleted successfully.', 'cart_quantity' => Cart::count(), 'cart_total' => number_format($this->getCartTotal(), 2)];
        }
        return ['status' => 'error', 'message' => 'Item did not exist.'];
    }

    public function order()
    {
        ignore_user_abort(true);
        try {
            $cartItems = Cart::content()->toArray();
        } catch (Exception $e) {
            $cartItems = [];
        }
        $poNumber = Input::has('po_number') ? Input::get('po_number') : '';
        $delivery_method = Input::has('delivery_method') ? Input::get('delivery_method') : '';
        $due_date = new MongoDate(Input::has('due_date') ? strtotime(date('m/d/Y', strtotime(Input::get('due_date')))) : time());
        $shippingAddress =[ 0 => [
            'deleted'   => false,
            'shipping_address_1' => Input::has('address_1') ? Input::get('address_1') : '',
            'shipping_address_2' => Input::has('address_2') ? Input::get('address_2') : '',
            'shipping_address_3' => Input::has('address_3') ? Input::get('address_3') : '',
            'shipping_town_city' => Input::has('town_city') ? Input::get('town_city') : '',
            'shipping_zip_postcode' => Input::has('zip_postcode') ? Input::get('zip_postcode') : '',
            'shipping_province_state_id' => Input::has('province_state') ? Input::get('province_state') : '',
            'shipping_country_id' => Input::has('country') ? Input::get('country') : '',
        ]];
        $shippingAddress[0]['shipping_province_state'] = JTProvince::where('deleted', false)
                                                                    ->where('key', $shippingAddress[0]['shipping_province_state_id'])
                                                                    ->remember(1800)
                                                                    ->pluck('name');
        $shippingAddress[0]['shipping_country'] = JTCountry::where('deleted', false)
                                                            ->where('value', $shippingAddress[0]['shipping_country_id'])
                                                            ->remember(1800)
                                                            ->pluck('name');
        $shippingAddress['country'] = '';
        JTQuotation::add($cartItems, [
            'customer_po_no' => $poNumber,
            'delivery_method' => $delivery_method,
            'payment_due_date'  => $due_date,
            'shipping_address'  => $shippingAddress
        ]);
        Cart::destroy();
        return Redirect::to(URL.'/')->with('flash_success', 'Your request has been sent. We will contact you ASAP.');
    }
}