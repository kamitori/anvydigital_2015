<?php

class Home extends BaseModel{

	protected $table = 'homes';

	public static function getMetaInfo()
	{
		$arrData = [];
		if( Cache::has('meta_info') ) {
			$arrData = Cache::get('meta_info');
		} else {
			$arrMeta = ['title_site', 'meta_description', 'main_logo', 'favicon','key_word'];
			$configures = Configure::select('ckey', 'cvalue')->whereIn('ckey', ['title_site', 'meta_description', 'main_logo', 'favicon','key_word'])->get();
			foreach($configures as $configure) {
				$arrData[$configure['ckey']] = $configure['cvalue'];
			}
			foreach($arrMeta as $key) {
				if( !isset($arrData[$key]) ) $arrData[$key] = '';
			}
			Cache::forever('meta_info', $arrData);
		}

		return $arrData;
	}

	public static function getBanner()
	{
		$arrData = [
					'indicator' 	=> '',
					'bannerImage' 	=> '',
					'bannerText'	=> ''
				];
		if( Cache::has('banners') ) {
			$arrData = Cache::get('banners');
		} else {
			try {
				$banners = Banner::select('id', 'name', 'description', 'link')
									->with('images')
									->where('active', 1)
									->orderBy('order_no', 'asc')
									->get()
									->toArray();
			} catch(Exception $e) {
				return '';
			}
			foreach($banners as $key => $banner) {
				$image = '';
				if( !empty($banner['images']) ) {
					$image = reset($banner['images']);
					$image = URL.'/'.$image['path'];
				}
				// if( empty($image) ) {
				// 	continue;
				// }
				$arrData['indicator'] .= '<li data-banner-indicator="'. $key .'" id="indicator_'. $key .'" data-banner-title="'. $banner['name'] .'" data-banner-descr="'. $banner['description'] .'" class=""><a></a></li>';
				$arrData['bannerImage'] .= '<a href="'. $banner['link'].'" class="" data-attr-target="_self">
						                        <img src="'. $image .'" alt="'. $banner['name'] .'" />
						                    </a>';
				$arrData['bannerText'] .= '<div style="margin-top: 250px; padding-left: 120px; height: 150px;" id="bannertext_'. $key .'" class="bannerTextDiv">
							                    <p style="font-size:20px; margin-top: 20px; font-family: \'Myriad W01 Light\'; color:white; opacity: .5;" class="titleText">'. $banner['name'] .'</p>
							                    <p style="color: white; font-family: \'Wendy W01 LightLP\'; font-size:96px;  margin-top:-40px;">'. $banner['description'] .'</p>
							                </div>';
			}
		}
		Cache::forget('banners');
		return $arrData;
	}

	public static function getCategoryArray()
	{
		$categories = ProductCategory::select('id', 'name', 'short_name', 'home_description')
								->with('image')
								->where('on_home', 1)
								->where('active', 1)
								->orderBy('order_no', 'asc')
								->get();
		$arrData = [];
		if( !$categories->isEmpty() ) {
			foreach($categories as $category) {
				$image = '';
				if( is_object($category->image) && isset($category->image[0]) ) {
					$image = $category->image[0]->path;
				} else {
					$product = $category->lastestProduct();
					if( is_object($product) && isset($product->cover[0]) ) {
						$image = $product->cover[0]->path;
					}
				}
				$image = str_replace('assets/images/products', 'assets/images/products/thumbs', $image);
				$arrData[] = [
							'id' 	=> $category->id,
							'image' => $image,
							'name' 	=> $category->name,
							'description' => $category->home_description,
							'link'  => URL.'/'.$category->short_name
						];
			}
		}
		return $arrData;
	}

	public static function getCategory()
	{
		$html = '';
		if( Cache::has('homeCategory') ) {
			$html = Cache::get('homeCategory');
		} else {
			$categories = ProductCategory::select('id', 'name', 'short_name', 'home_description')
								->where('on_home', 1)
								->where('active', 1)
								->orderBy('order_no', 'asc')
								->get();
			foreach($categories as $category) {
				$product = $category->lastestProduct();
				$image = '';
				if(is_object($category->image) && isset($category->image[0]) ) {
					$image = $category->image[0]->path;
				} else {
					$product = $category->lastestProduct();
					if( is_object($product) && isset($product->cover[0]) ) {
						$image = $product->cover[0]->path;
					}
				}
				$image = str_replace('assets/images/products', 'assets/images/products/thumbs', $image);
				$html .= '<div class="item col-md-4">
							<a href="'. URL.'/'.$category->short_name .'" class="fadeout">
								<img src="'. $image .'" alt="'. $category->name .'" class="proimg" />
								<h2>'. $category->name .'</h2>
							</a>
							<span>'. $category->home_description .'</span>
						</div>';
			}
			Cache::forever('homeCategory', $html);
		}
		return $html;
	}

	public static function getHomeLink()
	{
		$html = '';
		if( Cache::has('homeLink') ) {
			$html = Cache::get('homeLink');
		} else {
			$homes = self::select('id', 'name', 'description', 'link', 'image')
								->where('type', 'home-link')
								->orderBy('id')
								->get();
			foreach($homes as $home) {
				if( empty($home->image) ) {
					$home->image = 'assets/images/noimage/247x185.gif';
				}
				$home->image = URL.'/'.$home->image;
				$html .= '<div class="item margin-top col-md-3 col-sm-6">
							<a href="'. $home->link .'" class="fadeout">
								<img src="'. $home->image .'" alt="'. $home->name .'" class="proimg" />
								<h2>'. $home->name .'</h2>
							</a>
							<span>'. nl2br($home->description) .'</span>
						</div>';
			}
			Cache::forever('homeLink', $html);
		}
		return $html;
	}

	public static function getHomeSocial()
	{
		$html = '';
		if( Cache::has('homeSocial') ) {
			$html = Cache::get('homeSocial');
		} else {
			$homes = self::select('id', 'link', 'image')
								->where('type', 'home-social')
								->orderBy('id', 'asc')
								->get();
			foreach($homes as $home) {
				$home->image = URL.'/'.$home->image;
				$html .= '<a href="'. $home->link .'" class="fadeout" target="_blank">
							<img src="'. $home->image .'" alt="" class="iconimg">
						</a>';
			}
			Cache::forever('homeSocial', $html);
		}
		return $html;
	}

	public static function getFooterSocial()
	{
		$html = '';
		if( Cache::has('footerSocial') ) {
			$html = Cache::get('footerSocial');
		} else {
			$socials = self::select('id', 'link', 'image', 'name')
								->where('type', 'home-social')
								->orderBy('id', 'asc')
								->get();
			foreach($socials as $social) {
				$social->image = URL.'/'.$social->image;
				$html .= '<div class="fadeout fsoc">
							<a href="'. $social->link .'" class="fadeout" target="_blank">
								<img src="'. $social->image .'" alt="" class="iconimg">
							</a><br />
							'. $social->name .'
						</div>';
			}
			Cache::forever('footerSocial', $html);
		}
		return $html;
	}

	public function offer()
	{
		return $this->hasOne('ProductOffer', 'home_id');
	}

	public function afterSave($home)
	{
		$home->offer()->update([
				'image' => $home->image,
				'home_description' => $home->description,
				'name'	=> $home->name
			]);
	}

	public function beforeDelete($home)
	{
		$home->offer()->update([
				'home_id' => 0
			]);
	}

	public static function getSitemap()
	{
		return Cache::rememberForever('sitemap', function() {
			$arrSitemap = ProductCategory::select('id', 'name', 'short_name', 'parent_id')
											->where('active', 1)
											->orderBy('name','asc')
											->get();
			if( $arrSitemap->isEmpty() ) {
				return '';
			}
			$arrSitemap = Menu::setMenu($arrSitemap->toArray());
			return '<ul class="siteMap">'. self::renderSitemap($arrSitemap) .'</ul>';
		});
	}

	public static function renderSitemap(&$arrSitemap, $parent_id = 0, $sitemap = '')
	{
		if( isset($arrSitemap[$parent_id]) ){
			foreach($arrSitemap[$parent_id] as $k => $category){
				$id = $category['id'];
				$url = URL.'/'.$category['short_name'];
				if ( isset($arrSitemap[$id]) ) {
					$sitemap .= '<li><a href="'.$url.'" title="'.$category['name'].'">'.$category['name'].'</a>
												<ul>'. self::renderProductSitemap($arrSitemap[$id], $category['short_name']) .'</ul>
											</li>';
					unset($arrSitemap[$id]);
				} else {
					if( !$parent_id ) {
						$sitemap .= '<li><a href="'.$url.'" title="'.$category['name'].'">'. $category['name'] .'</a></li>';
					}
				}
			}
		}
		return $sitemap;
	}

	public static function renderProductSitemap($arrSitemap, $categoryName = '')
	{
		$productSitemap = '';
		foreach($arrSitemap as $sitemap) {
			$categoryId = isset($sitemap['id']) ? $sitemap['id'] : 0;
			$url = URL.'/'.$sitemap['short_name'];
			$productSitemap .= '<li><a href="'.$url.'" title="'.$sitemap['name'].'">'.$sitemap['name'].'</a>';
			$products = Product::select('id', 'name', 'short_name', 'short_description')
									->whereRaw('(SELECT COUNT(*)
											FROM `categories` INNER JOIN `products_categories`
												ON `categories`.`id` = `products_categories`.`category_id`
											WHERE `products_categories`.`product_id` = `products`.`id`
											AND `categories`.`id` = '.$categoryId.') >= 1')
									->orderBy('order_no', 'asc')
									->get();
			if( !$products->isEmpty() ) {
				$productSitemap .= '<ul>';
				foreach($products as $product) {
					$url = URL.'/'.( !empty($categoryName) ? $categoryName.'/' : '').$product->short_name;
					$productSitemap .= '<li>
											<a href="'.$url.'" >'.$product->name.'</a>
										</li>';
				}
				$productSitemap .= '</ul>';
			}
			$productSitemap .= '</li>';
		}
		return $productSitemap;
	}
}
