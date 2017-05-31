<?php
class DesignController extends BaseController {

    public function index($productName)
    {
        $product = Product::where('short_name', 'like', '%'.$productName.'%')
                                        ->first();
        if( !is_object($product) ) {
            return App::abort(404);
        }
        if( $product->short_name !== $productName ) {
            return Redirect::to(URL.'/design/'.$product->short_name);
        }
        $product = array_merge([
                                'shapes' => [],
                                'wrap_option' => false
                            ], JTProduct::findJT($product));
        $this->layout->content = View::make('frontend.design.index')->with([
                                                                            'product'   => $product,
                                                                            'fonts'     => DesignFont::getFonts(),
                                                                            'filters'   => [],
                                                                            'systemBackgrounds' => Configure::getBackground(),
                                                                            'userBackgrounds' => Configure::getBackground(),
                                                                            'userImages' => Session::get('userImages', function(){
                                                                                                return [];
                                                                                            })
                                                                        ]);
    }

    public function putImageSession()
    {
        if( !Request::ajax() ) {
            return App::abort(404);
        }
        $arrReturn = ['status' => 'error'];
        if( Input::has('images') ) {
            $images = Input::get('images');
            $userImages = [];
            foreach($images as $image) {
                $userImages[$image] = $image;
            }
            $userImages = array_merge(Session::get('userImages', function(){
                                        return [];
                                    }), $userImages);
            Session::put('userImages', $userImages);
            $arrReturn = ['status' => 'ok'];
        }
        return $arrReturn;
    }

    public function putImages()
    {
        if( !Request::ajax() ) {
            return App::abort(404);
        }
        $arrReturn = ['status' => 'error'];
        if( Input::has('images') ) {
            $imageUrl = 'assets/design-images/'.Session::get('userKey', function(){
                                                    $user = Auth::user()->get();
                                                    return md5(md5($user->id).md5($user->email));
                                                });
            $path = public_path( str_replace('/', DS, $imageUrl));
            if( !File::exists($path) ) {
                File::makeDirectory($path, 0775, true);
            }
            $images = Input::get('images');
            $arrImages = $userImages = [];
            foreach($images as $key => $image) {
                if( !Input::hasFile('images.'.$key.'.image') ) continue;
                $file = Input::file('images.'.$key.'.image');
                $fileName = Str::slug(str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName())).'.'.date('d-m-y').'.'.$file->getClientOriginalExtension();
                $file->move($path, $fileName);
                $arrImages = ['url' => $imageUrl.'/'.$fileName, 'key' => $image['id']];
                $userImages[$fileName] = $imageUrl.'/'.$fileName;
            }
            $userImages = array_merge(Session::get('userImages', function(){
                                        return [];
                                    }), $userImages);
            Session::put('userImages', $userImages);
            $arrReturn = ['status' => 'ok', 'images' => $arrImages];
        }
        return $arrReturn;
    }

    public function getImages()
    {
        if( !Request::ajax() ) {
            return App::abort(404);
        }
        $tags = Input::has('tags') ? Input::get('tags') : '';
        $image = MyImage::getOthers(['tags' => $tags]);
        $arrReturn = [];
        if( $image['total'] ) {
            try {
                $service = GoogleDrive::connect();
            } catch(Exception $e) {
                $service = false;
            }
            foreach($image['images'] as $image) {
                if( $image['store'] == 'google-drive' && $image['file_id'] ) {
                    if( !$service ) {
                        continue;
                    }
                    $key = md5('150x150jpg');
                    $file = GoogleDrive::getFile($image['file_id'], $service);
                    if( Cache::tags(['images', $image['id']])->has($key) ) {
                        $thumb = URL.'/thumb/'.$image['id'].'/600x450.jpg';
                    } else {
                        $thumb = URL.'/thumb/'.$image['id'].'/600x450.jpg?path='.urlencode($file->thumbnailLink);
                    }
                    $ext = $file->mimeType;
                    $link = $file->downloadUrl;
                } else {
                    $thumb = URL.'/thumb/'.$image['id'].'/150x150.jpg';
                    $link = URL.'/'.$image['path'];
                    $ext = 'image/'.substr($image['path'], strrpos($image['path'], '.') + 1);
                }
                $arrReturn[] = [
                                'id' => $image['id'],
                                'thumb' => $thumb,
                                'link'  => $link,
                                'ext'   => $ext,
                                'store' => $image['store'],
                            ];
            }
        }
        return $arrReturn;
    }

    public function putBackground()
    {
        if (!Request::ajax()) {
            return App::abort(404);
        }
        $arrReturn = ['status' => 'error'];
        if (Input::hasFile('background')) {
            $imageUrl = 'assets/design-images/'.Session::get('userKey', function () {
                $user = Auth::user()->get();
                return md5(md5($user->id).md5($user->email));
            }).'/backgrounds';
            $path = public_path(str_replace('/', DS, $imageUrl));
            if (!File::exists($path)) {
                File::makeDirectory($path, 0775, true);
            }
            $background = Input::file('background');
            $fileName = Str::slug(str_replace('.'.$background->getClientOriginalExtension(), '', $background->getClientOriginalName())).'.'.date('d-m-y').'.'.$background->getClientOriginalExtension();
            $background->move($path, $fileName);
            $arrReturn = ['status' => 'ok', 'url' => $imageUrl.'/'.$fileName];
        }
        return $arrReturn;
    }


    public function analyzeImage()
    {
        if (!Request::ajax()) {
            return App::abort(404);
        }
        $img = Input::get('img');
        $img = str_replace(URL.'/', '', $img);
        $img = str_replace(['/', '\\'], DS, $img);
        $img = public_path($img);
        list($width, $height) = getimagesize($img);
        $size = filesize($img) / (1024 * 1024);
        $size = round($size, 2);
        $f = $width/$height;
        $mp = round(($width*$height)/1000000, 1);
        if ($f<1) {
            $dimensions = array(
                                array(12,16),
                                array(16,21),
                                array(24,32),
                                array(30,40),
                                array(36,48),
                                array(48,64),
                                array(72,96),
                                );
        } elseif ($f>1) {
            $dimensions = array(
                                array(16,12),
                                array(21,16),
                                array(32,24),
                                array(40,30),
                                array(48,36),
                                array(64,48),
                                array(96,72),
                                );
        } elseif ($f==1) {
            $dimensions = array(
                                array(12,12),
                                array(16,16),
                                array(24,24),
                                array(30,30),
                                array(36,36),
                                array(48,48),
                                array(72,72),
                                );
        }
        foreach ($dimensions as $key => $inches) {
            $diagonal = sqrt($inches[0]*$inches[1]);
            $viewdis = 1.5*$diagonal;
            $ppineed = 3438/$viewdis;
            $ppi = ($width*$height)/($inches[0]*$inches[1]);
            $quantity = $ppi/$ppineed;
            $dimensions[$key][2] = $quantity;
            if ($quantity>95) {
                $dimensions[$key][3] = '<b style="color:#197600">AMAZING</b>';
            } elseif ($quantity>45) {
                $dimensions[$key][3] = '<b style="color:#206026">GOOD</b>';
            } elseif ($quantity>30) {
                $dimensions[$key][3] = '<b style="color:#244327">ACCEPTABLE</b>';
            } elseif ($quantity>22) {
                $dimensions[$key][3] = '<b style="color:#594a30">OK but...</b>';
            } elseif ($quantity>1.5) {
                $dimensions[$key][3] = '<b style="color:#8d5b04">FAIR, WILL NEED OPTIMIZATION</b>';
            } else {
                $dimensions[$key][3] = '<b style="color:#9f0000">DON\'T EVEN THINK ABOUT IT.</b>';
            }
        }
        return array('image' => $img,
                        'width' => $width,
                        'height' => $height,
                        'size' => $size,
                        'f' => $f,
                        'mp' => $mp,
                        'dimensions' => $dimensions,
                        'image' => Input::get('img')
                    );
    }

}