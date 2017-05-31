<?php
class JTQuotation extends JTSale {

    protected $collection = 'tb_quotation';

    public static $defaultField = [
            'deleted'   => 'bool',
            'options'   => 'array',
            'quotation_date' => 'date',
            'quotation_status'  => ['default' => 'In progress'],
            'quotation_type'    => ['default' => 'Quotation'],
            'job_id'        => 'string',
            'job_name'      => 'string',
            'job_number'    => 'string',
            'salesorder_number'     => 'string',
            'salesorder_name'       => 'string',
            'salesorder_number'  => 'string',
            'customer_po_no'    => 'string',
            'delivery_method'   => 'string',
    ];

    protected static function returnField()
    {
        return self::$defaultField;
    }

    protected static function getCode($field = 'code')
    {
        $code = self::where($field, 'not regexp', '/WT-/')
                    ->orderBy($field, 'desc')
                    ->pluck($field);
        return ++$code;
    }

    public static function add($arrEstimates, $arrOption)
    {
        $user = Auth::user()->get();
        $company_id = $user->company_id;
        $arrSave = [];
        $arrSave['code'] = self::getCode();
        $company = [];
        if( !empty($company_id) && strlen($company_id) == 24 ){
            $company = JTCompany::select('contact_default_id','contact_id','our_rep','our_rep_id','our_csr','our_csr_id','name','email','phone','addresses','addresses_default_key', 'sell_category','sell_category_id','pricing','discount', 'net_discount')
                                ->where('deleted', '=', false)
                                ->where('_id', '=', new MongoId($company_id))
                                ->first();
            if( is_object($company) )
                $company = $company->toArray();
            else
                $company = [];
        }
        self::getCompanyInfo($arrSave, $company);
        self::getTax($arrSave);
        $arrSave['email'] = $user->email;
        $arrSave['phone'] = $user->phone;
        $arrSave['contact_id'] = '';
        $arrSave['contact_name'] = $user->first_name. ' '. $user->last_name;
        $arrProducts = $arrOptions = [];

        foreach($arrEstimates as $key => $estimate) {
            if( !$estimate['options']['_id'] ) { continue; }
            $product = JTProduct::select('_id','code', 'name', 'sku', 'sell_price', 'oum', 'oum_depend', 'sell_by','pricebreaks', 'sellprices', 'unit_price','options', 'products_upload', 'product_desciption', 'is_custom_size')
                                ->where('_id', '=', new MongoId($estimate['options']['_id']))
                                ->where('deleted', '=', false)
                                // ->where('assemply_item', '=', 1)
                                ->first();
            $product = $product->toArray();
            $product['sizew']  = $estimate['options']['sizew'];
            $product['sizeh'] = $estimate['options']['sizeh'];
            $product['sizew_unit'] = $product['sizeh_unit'] = 'in';
            $product['quantity'] = $estimate['qty'];
            $product['details'] = isset($estimate['options']['note']) ? $estimate['options']['note'] : '';
            $fileQuantity = $estimate['options']['fileQuantity'];
            $productKey = count($arrProducts);
            $plusSellPrice = 0;

            $estimateOption = [];
            foreach($estimate['options']['options'] as $key => $option) {
                if (!isset($option['choose'])) continue;
                if (in_array($option['id'], ['5284a3ee222aad54140002fa','5284a42e222aad54140003c1']) ) {
                    $option['quantity'] = $fileQuantity;
                }
                $estimateOption[$key] = $option;
            }

            $arrProducts[$productKey] = [
                    'deleted' => false,
                    'products_name' => $product['name'],
                    'products_costing_name' => '',
                    'products_id' => new MongoId($product['_id']),
                    'option' => '',
                    'sizew' => $product['sizew'],
                    'sizew_unit' => 'in',
                    'sizeh' => $product['sizeh'],
                    'sizeh_unit' => 'in',
                    'receipts' => '',
                    'sell_by' => $product['sell_by'],
                    'sell_price' => $product['sell_price'],
                    'oum' => $product['oum'],
                    'unit_price' => $product['unit_price'],
                    'quantity' => $product['quantity'],
                    'adj_qty' => 0,
                    'sub_total' => 0,
                    'taxper' => $arrSave['taxval'],
                    'amount' => 0,
                    'sku' => isset($product['sku']) ? $product['sku'] : '',
                    'code' => $product['code'],
                    'is_custom_size' => isset($product['is_custom_size']) ? $product['is_custom_size'] : 0,
                    'custom_unit_price' => 0,
                    'tax' => 0,
                    'plus_sell_price' => 0,
                    'oum_depend' => $product['oum_depend'],
                    'area' => 0,
                    'perimeter' => 0,
                    'company_price_break' => false,
                    'vip' => 0,
                    'plus_unit_price' => 0,
                    'details'   => $product['details']
            ];
            //=============Cal-Bleed=============
            $lineBleed = JTProduct::calBleed($product, true);
            if( !empty($lineBleed) ){
                $product['bleed_sizew'] = $lineBleed['bleed_sizew'];
                $product['bleed_sizeh'] = $lineBleed['bleed_sizeh'];
            } else {
                $product['bleed_sizew'] = $product['bleed_sizeh'] = 0;
            }
            //=============End Cal-Bleed=========
            //=============Loop option bleed=============
            if( isset($product['options']) ) {
                foreach($product['options'] as $option){
                    if(isset($option['deleted']) && $option['deleted']) continue;
                    if( !isset($option['product_id']) || !is_object($option['product_id']) ) continue;
                    if (!isset($estimateOption[ (string) $option['product_id']]) ) continue;
                    if(isset($option['same_parent'])&&$option['same_parent']){
                            $option['_id'] = $option['product_id'];
                            $option['sizew'] = $product['sizew'];
                            $option['sizeh'] = $product['sizeh'];
                            $option['sizew_unit'] = $option['sizeh_unit'] = 'in';
                            $optionBleed = JTProduct::calBleed($option, true);
                            if( !empty($optionBleed) ) {
                                $product['bleed_sizew'] += $optionBleed['bleed_sizew'];
                                $product['bleed_sizeh'] += $optionBleed['bleed_sizeh'];
                            }
                    }
                }
            }
            //=============Loop option bleed=========
            //=============Check bleed=============
            if( isset($product['bleed_sizew']) && !$product['bleed_sizew'] ) unset($product['bleed_sizew']);
            if( isset($product['bleed_sizeh']) && !$product['bleed_sizeh'] ) unset($product['bleed_sizeh']);
            //=============End Check bleed=========
            if( isset($product['options']) ) {
                foreach($product['options'] as $option){
                    if(isset($option['deleted']) && $option['deleted']) continue;
                    if( !isset($option['product_id']) || !is_object($option['product_id']) ) continue;
                    $optionKey = count($arrOptions);
                    $tmpOpt = JTProduct::select('sku', 'code', 'name', 'sell_price','sell_by', 'pricebreaks', 'sellprices')
                                ->where('_id', '=', new MongoId( $option['product_id']  ))
                                ->where('deleted', '=', false)
                                ->first()
                                ->toArray();
                    $tmpOpt['price_break'] = JTProduct::priceBreak($tmpOpt, $company);
                    $option = array_merge($option, $tmpOpt);
                    unset($tmpOpt);
                    if( !isset($option['same_parent']) )
                        $option['same_parent'] = 0;
                    else
                        $option['same_parent'] = 1;
                    $option['sizew'] = $product['sizew'];
                    $option['sizeh'] = $product['sizeh'];
                    $option['sizew_unit'] = $product['sizew_unit'];
                    $option['quantity'] = 1;
                    $option['price_break'] = JTProduct::priceBreak($option, $company);
                    if( isset($estimateOption[ (string)$option['product_id'] ]) ){
                        $option = array_merge($option, $estimateOption[ (string)$option['product_id'] ]);
                    }
                    $calPriceBreak = true;
                    if( $option['same_parent'] ){
                        if( isset($product['bleed_sizew']) ) {
                            $option['bleed_sizew'] = $product['bleed_sizew'];
                        }
                        if( isset($product['bleed_sizeh']) ) {
                            $option['bleed_sizeh'] = $product['bleed_sizeh'];
                        }
                        $tmpOpt = $option;
                        $tmpOpt['quantity'] *= $product['quantity'];
                        JTProduct::calPrice($tmpOpt);
                        $option['sell_price'] = $tmpOpt['sell_price'];
                        unset($tmpOpt);
                        $calPriceBreak = false;
                    }
                    JTProduct::calPrice($option, $calPriceBreak);
                    // if( !$option['same_parent'] && isset($company['net_discount']) ){
                    //     $tmpPrice = $option['sell_price'];
                    //     JTProduct::netDiscount($option['sub_total'], $company['net_discount']);
                    //     JTProduct::netDiscount($option['sell_price'], $company['net_discount']);
                    //     $option['unit_price'] = $option['sell_price'];
                    // }
                    if(  isset($estimateOption[ (string)$option['product_id'] ]) ){
                        if( $option['same_parent'] ){
                            $plusSellPrice += $option['sub_total'];
                        }
                        $option['taxper'] = $arrSave['taxval'];
                        JTProduct::calTax($option);
                        JTProduct::calAmount($option);
                        $lineProductKey = count($arrProducts);
                        $arrProducts[$lineProductKey] = [
                                'deleted' => false,
                                'code' => $option['code'],
                                'sku' => $option['sku'],
                                'products_name' => $option['name'],
                                'product_name' => $option['name'],
                                'products_id' => new MongoId($option['_id']),
                                'product_id' => new MongoId($option['_id']),
                                'quantity' => $option['quantity'],
                                'sub_total' => $option['sub_total'],
                                'option_group' => isset($option['option_group']) ? $option['option_group'] : '',
                                'sizew' => $option['sizew'],
                                'sizew_unit' => 'in',
                                'sizeh' => $option['sizeh'],
                                'sizeh_unit' => 'in',
                                'sell_by' => $option['sell_by'],
                                'oum' => $option['oum'],
                                'same_parent' => $option['same_parent'],
                                'sell_price' => $option['sell_price'],
                                'taxper' => $arrSave['taxval'],
                                'tax' => $option['tax'],
                                'option_for' => $productKey,
                                'proids' => $option['_id'].'_'.$optionKey,
                                'adj_qty' => $option['adj_qty'],
                                'oum_depend' => $option['oum_depend'],
                                'plus_sell_price' => 0,
                                'plus_unit_price' => 0,
                                'unit_price' => $option['unit_price'],
                                'amount' => $option['amount'],
                                'area' => $option['area'],
                                'perimeter' => $option['perimeter'],
                                'company_price_break' => false,
                                'user_custom' => 0,
                                'hidden' => isset($option['hidden']) ? $option['hidden'] : 0,
                        ];
                        if( !$option['same_parent'] && isset($tmpPrice) ) {
                            $arrProducts[$lineProductKey]['custom_unit_price'] = $arrProducts[$lineProductKey]['sell_price'];
                            $arrProducts[$lineProductKey]['sell_price'] =
                                        $arrProducts[$lineProductKey]['unit_price'] = $tmpPrice;
                            unset($tmpPrice);
                        }
                    }
                    $arrOptions[$optionKey] = [
                                    'deleted'    => false,
                                    'product_id' => new MongoId($option['_id']),
                                    '_id' => new MongoId($option['_id']),
                                    'markup'     => 0,
                                    'margin'     => 0,
                                    'quantity'   => $option['quantity'],
                                    'option_group'   => isset($option['option_group']) ? $option['option_group'] : '',
                                    'require'    => isset($option['require']) ? $option['require'] : 0,
                                    'same_parent'    => $option['same_parent'],
                                    'unit_price'     => $option['unit_price'],
                                    'oum'    => $option['oum'],
                                    'product_name'   => $option['name'],
                                    'sku'    => $option['sku'],
                                    'code'   => $option['code'],
                                    'sizew'  => $option['sizew'],
                                    'sizew_unit'     => $option['sizew_unit'],
                                    'sizeh'  => $option['sizeh'],
                                    'sizeh_unit'     => $option['sizeh_unit'],
                                    'sell_by'    => $option['sell_by'],
                                    'discount'   => 0,
                                    'sub_total'  => $option['sub_total'],
                                    'this_line_no'   => $optionKey,
                                    'choice'    => isset($estimateOption[ (string)$option['product_id'] ]) ? 1 : 0,
                                    'user_custom'    => 0,
                                    'sell_price'     => $option['sell_price'],
                                    'parent_line_no' => $productKey

                    ];
                    if( isset($lineProductKey) ){
                        $arrOptions[$optionKey]['line_no'] = $lineProductKey;
                        unset($lineProductKey);
                    }
                }
            }
            //=============Check bleed=============
            if( isset($product['bleed_sizew']) && !$product['bleed_sizew'] ) unset($product['bleed_sizew']);
            if( isset($product['bleed_sizeh']) && !$product['bleed_sizeh'] ) unset($product['bleed_sizeh']);
            //=============End Check bleed=========
            pr($plusSellPrice);
            $product['plus_sell_price'] = $plusSellPrice;
            $product['price_break'] = JTProduct::priceBreak($product, $company);
            JTProduct::calPrice($product);
            if( isset($company['net_discount']) ){
                $tmpPrice = $product['sell_price'];
                JTProduct::netDiscount($product['sub_total'], $company['net_discount']);
                JTProduct::netDiscount($product['sell_price'], $company['net_discount']);
                $product['unit_price'] = $product['sell_price'];
            }
            $arrProducts[$productKey]['unit_price'] =
                        $arrProducts[$productKey]['sell_price'] = $product['sell_price'];
            if( isset($product['bleed']) ) {
                $arrProducts[$productKey]['bleed'] = true;
            }
            if( isset($tmpPrice) ) {
                $arrProducts[$productKey]['unit_price'] =
                        $arrProducts[$productKey]['sell_price'] = $tmpPrice;
                unset($tmpPrice);
            }
            $arrProducts[$productKey]['sub_total'] = $product['sub_total'];
            $arrProducts[$productKey]['plus_sell_price'] = $plusSellPrice;
            $arrProducts[$productKey]['adj_qty'] = $product['adj_qty'];
            $arrProducts[$productKey]['amount'] = $product['sub_total'];
            $arrProducts[$productKey]['perimeter'] = $product['perimeter'];
            $arrProducts[$productKey]['custom_unit_price'] = $product['sell_price'];
            $arrProducts[$productKey]['area'] = $product['area'];
            JTProduct::calTax($arrProducts[$productKey]);
            JTProduct::calAmount($arrProducts[$productKey]);
        }

        $arrSave['products'] = $arrProducts;
        $arrSave['options'] = $arrOptions;
        $arrSum = self::calSum($arrSave['products']);
        $arrSave = array_merge($arrSave, $arrSum);
        self::getDefault($arrSave);
        $arrSave['payment_due_date'] = new MongoDate($arrSave['quotation_date']->sec + 3600 * 24 * $arrSave['payment_terms']);
        $arrSave = array_merge($arrSave, $arrOption);
        if (isset($arrOption['payment_due_date'])) {
            if ($arrOption['payment_due_date']->sec > $arrSave['quotation_date']->sec) {
                $arrSave['payment_terms'] = (int)round(($arrOption['payment_due_date']->sec - $arrSave['quotation_date']->sec) / (3600*24));
            } else {
                $arrSave['payment_terms'] = 0;
                $arrSave['payment_due_date'] = $arrSave['quotation_date'];
            }
        }
        $arrSave['name'] = $arrSave['code'].' - '.$arrSave['company_name'];
        $arrSave['heading'] = 'Created from AnvyOnline';
        self::insert($arrSave);
        return [ '_id' => $arrSave['_id'] ];
    }
}
