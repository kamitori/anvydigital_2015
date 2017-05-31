<?php

class Menu extends BaseModel {

	protected $table = 'menus';

	protected $rules = array(
			'name' 		=> 'required',
			'parent_id' => 'integer',
			'order_no' 	=> 'integer',
			'active' 	=> 'integer',
		);

	public function productCategory()
	{
		return $this->hasOne('ProductCategory');
	}

	public function page()
	{
		return $this->hasOne('Page');
	}

	public static function get($arr = [])
	{
		if( isset($arr['parent']) ) {
			return self::getParent($arr);
		}
		if( isset($arr['header']) ) {
			return self::getFrontendHeader($arr);
		}
		if( isset($arr['product']) ) {
			return self::getFrontendProduct($arr);
		}
		if( isset($arr['footer']) ) {
			return self::getFrontendFooter($arr);
		}
		if( isset($arr['sidebar']) ) {
			return self::getSidebar();
		}
		return self::getMenu($arr);
	}

	public static function setMenu($menu)
	{
		$arrMenu = [];
		foreach($menu as $value){
			$arrMenu[$value['parent_id']][$value['id']] = $value;
		}
		return $arrMenu;
	}

	public static function getFrontendHeader()
	{
		$arrMenu = self::select('id', 'name', 'link', 'parent_id', 'column_no')
				->where('type', 'frontend')
				->where('group', 'header')
				->where('active', 1)
				->orderBy('parent_id','asc')
				->orderBy('order_no', 'asc')
				->orderBy('column_no', 'asc')
				->orderBy('name', 'asc')
				->get();
		if( $arrMenu->isEmpty() ) {
			return '';
		}
		$arrMenu = self::setMenu($arrMenu->toArray());
		$arrMenuMobile = self::renderHeaderMenuMobile($arrMenu);
		return [
			'default'=>'<ul class="nav nav-tabs menu-up">'.self::renderHeaderMenu($arrMenu).'</ul>',
			'mobile'=> $arrMenuMobile['mobile']
		];
		
	}

	public static function getFrontendProduct()
	{
		$arrMenu = self::select('id', 'name', 'link', 'parent_id', 'column_no')
				->with('productCategory')
				->where('type', 'frontend')
				->where('group', 'product')
				->where('active', 1)
				->orderBy('parent_id','asc')
				->orderBy('order_no', 'asc')
				->orderBy('column_no', 'asc')
				->orderBy('name', 'asc')
				->get();
		if( $arrMenu->isEmpty() ) {
			return '';
		}
		$arrMenu = self::setMenu($arrMenu->toArray());

		//render mobile menu
		$arrMenuMobile = self::renderProductMenuMobile($arrMenu);

		$arrMenu = self::renderProductMenu($arrMenu);
		return [
			'default' 	=> '<ul class="nav navbar-nav navbar-navmenu-decoration navbar-navigation no-print">'.$arrMenu['default'].'</ul>',
			'mobile' 	=> '<ul class="nav navbar-nav">'.$arrMenu['mobile'].'</ul>',
			'menumobile' 	=> $arrMenuMobile['mobile'],
		];
	}

	public static function getFrontendFooter()
	{
		$arrMenu = self::select('id', 'name', 'link', 'parent_id')
				->where('type', 'frontend')
				->where('group', 'footer')
				->where('active', 1)
				->orderBy('parent_id','asc')
				->orderBy('order_no', 'asc')
				->orderBy('name', 'asc')
				->get();
		if( $arrMenu->isEmpty() ) {
			return '';
		}
		$arrMenu = self::setMenu($arrMenu->toArray());
		return self::renderFooterMenu($arrMenu);
	}

	public static function getSidebar()
	{
		$arrMenu = self::select('id','name', 'icon_class', 'link', 'type', 'parent_id')
							->where('active', 1)
							->where('type', 'backend')
							->orderBy('parent_id','asc')
							->orderBy('order_no','asc')
							->orderBy('name','asc')
							->get();
		if( $arrMenu->isEmpty() ) {
			return '';
		}
		$arrMenu = self::setMenu($arrMenu->toArray());
		return self::renderSidebar($arrMenu);
	}

	public static function getMenu($arr)
	{
		$arrMenu = self::select('id','name','icon_class','link','type', 'parent_id','group', 'order_no', 'column_no', 'level', 'active');
		if( !isset($arr['active']) || $arr['active'] ) {
			$arrMenu->where('active', 1);
		}
		$arrMenu = $arrMenu->orderBy('parent_id','asc')
							->orderBy('order_no','asc')
							->orderBy('name','asc')
							->get();
		if( $arrMenu->isEmpty() ) {
			return '';
		}
		$arrMenu = self::setMenu($arrMenu->toArray());
	    $admin = Auth::admin()->get();
	    $permission = new Permission;
		$arrPermission = [
							'frontend' => [
								'view' => $permission->can($admin, 'menusfrontend_view_all'),
								'edit' => $permission->can($admin, 'menusfrontend_edit_all'),
								'delete' => $permission->can($admin, 'menusfrontend_delete_all'),
							],
							'backend' => [
								'view' => $permission->can($admin, 'menusbackend_view_all'),
								'edit' => $permission->can($admin, 'menusbackend_edit_all'),
								'delete' => $permission->can($admin, 'menusbackend_delete_all'),
							]
						];

		return self::renderMenu($arrMenu, $arrPermission);
	}

	public static function getParent($arrCondition = [])
	{
		$arrMenu = self::select('id', 'name', 'parent_id', 'level', 'type')
						->where('active', '=', 1)
						->where('level', '<', 5);
		if( isset($arrCondition['id']) ) {
			$arrMenu->where('id', '<>', $arrCondition['id']);
		}
		if( isset($arrCondition['type']) ) {
			$arrMenu->where('type', $type);
		}
		$arrMenu = $arrMenu->orderBy('order_no','asc')
						->orderBy('name','asc')
						->get();
		if( $arrMenu->isEmpty() ) {
			return '';
		}
		$arrMenu = self::setMenu($arrMenu->toArray());
		return self::renderParent($arrMenu);
	}

	private static function renderHeaderMenu(&$arrMenu, $parent_id = 0, $html = '')
	{
		if( isset($arrMenu[$parent_id]) ){
			if( !$parent_id ) {
				$count = count($arrMenu[$parent_id]);
			}
			foreach($arrMenu[$parent_id] as $k => $menu){
				$id = $menu['id'];
				if ( isset($arrMenu[$id]) ) {
					if( $parent_id ) {
						$html .= '<li class="dropdown-header">'. $menu['name'] .'</li>
								'. self::renderHeaderMenu($arrMenu, $id);
					} else {
						$html .= '<li class="dropdown">
									<a class="dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
	                					'. $menu['name'] .'
	                                    <span class="caret"></span>
		                            </a>
		                            <ul class="dropdown-menu">
		                            	'. self::renderHeaderMenu($arrMenu, $id) .'
		                            </ul>
								</li>';
					}
				} else {
					$html .= '<li>
	                            <a href="'. URL .'/'. trim($menu['link']) .'" style="cursor:pointer;">
	                            '. $menu['name'] .'
	                            </a>
	                        </li>';
				}
				if( !$parent_id && $count > $k + 1 ) {
					$html .= '<li class="divider-vertical"></li>';
				}
				unset($arrMenu[$parent_id][$k]);
			}
		}
		return $html;
	}

	private static function renderProductMenu(&$arrMenu, $parent_id = 0, $menuArray = [])
	{
		$menuArray = array_merge(['default' => '', 'mobile' => '', 'sitemap' => ''], $menuArray);
		if( isset($arrMenu[$parent_id]) ){
			foreach($arrMenu[$parent_id] as $k => $menu){
				$id = $menu['id'];
				$color = isset($menu['product_category']['color']) ? $menu['product_category']['color'] : '';
				$name = isset($menu['product_category']['name']) ? $menu['product_category']['name'] : $menu['name'];
				$short_name = isset($menu['product_category']['short_name']) ? $menu['product_category']['short_name'] : '';
				$url = !empty($short_name) ? URL.'/'.$short_name : '#';
				$description = isset($menu['product_category']['description']) ? strip_tags($menu['product_category']['description']) : '';
				if ( isset($arrMenu[$id]) ) {
					$column = self::renderProductColumn($arrMenu[$id], $short_name);
					$menuArray['default'] .= '<li class="dropdown dropdown-hover" data-main-menuimage="'.$color.'" data-main-imagetitle="'.$name.'" data-main-imgdescr="'.$description.'" >
								<a class="menu" href="#" style="cursor:pointer;">
                					'. $menu['name'] .'
                                    <b class="caret"></b>
	                            </a>
	                            <ul class="dropdown-menu dropdown-menu-large row">
	                            	<li>
	                            		<table class="submenu-hover">
	                            			<tbody>
	                            				<tr>
	                            					'. $column .'
	                            					<td class="colorboxmenu">
	                            						<div class="categoryDiv" style="background-color:'.$color.';">
	                            							<p class="categoryTitle">'.$name.'</p>
	                            							<p class="categoryDescr">'.$description.'</p>
	                            						</div>
	                            						<div class="submenuDiv" style="height: 270px; display: none;">
	                            							<img />
	                            							<p class="menuImageName"></p>
	                            							<p class="menuImageDescription"></p>
	                            						</div>
	                            					</td>
	                            				</tr>
	                            			</tbody>
	                            		</table>
	                            	</li>
	                            </ul>
							</li>';
					$menuArray['mobile'] .= '<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'. $menu['name'] .'<span class="caret"></span></a>
	                            <ul class="dropdown-menu">
	                            	'. str_replace(['<td>', '</td>'], '', $column) .'
	                            </ul>
							</li>';
					$menuArray['sitemap'] .= '<li><a href="'.$url.'" title="'.$menu['name'].'">'.$menu['name'].'</a>
												<ul>'.str_replace(['<td>', '</td>', '<br />'], '', $column).'</ul>
											</li>';
					unset($arrMenu[$id]);
				} else {
					if( !$parent_id ) {
						$menuArray['default'] .= '<li class="dropdown dropdown-hover" data-main-menuimage="'.$color.'" data-main-imagetitle="'.$name.'" data-main-imgdescr="'.e($menu['product_category']['description']).'" >
								<a class="menu" href="'.$url.'" title="'. $menu['name'] .'" style="cursor:pointer;">
                					'. $menu['name'] .'
	                            </a>
							</li>';
						$menuArray['mobile'] .= '<li><a href="'.$url.'">'. $menu['name'] .'</a></li>';
						$menuArray['sitemap'] .= '<li><a href="'.$url.'" title="'.$menu['name'].'">'. $menu['name'] .'</a></li>';
					}
				}
			}
		}
		return $menuArray;
	}

	private static function renderProductColumn($arrMenu, $categoryName = '')
	{
		$arrData = [];
		foreach($arrMenu as $menu) {
			if( !isset($arrData[$menu['column_no']]) ) {
				$arrData[$menu['column_no']] = '';
			}
			if( !empty($arrData[$menu['column_no']]) ) {
				$arrData[$menu['column_no']] .= '<span><br></span>';
			}
			$categoryId = isset($menu['product_category']['id']) ? $menu['product_category']['id'] : 0;
			$name = isset($menu['product_category']['name']) ? $menu['product_category']['name'] : $menu['name'];
			$short_name = isset($menu['product_category']['short_name']) ? $menu['product_category']['short_name'] : '';
			$arrData[$menu['column_no']] .= '<strong>'.$name.'</strong>';
			$products = Product::select('id', 'name', 'short_name', 'short_description')
									->with('cover')
									->whereRaw('(SELECT COUNT(*)
											FROM `categories` INNER JOIN `products_categories`
												ON `categories`.`id` = `products_categories`.`category_id`
											WHERE `products_categories`.`product_id` = `products`.`id`
											AND `categories`.`id` = '.$categoryId.') >= 1')
									->orderBy('order_no', 'asc')
									->get();
			if( !$products->isEmpty() ) {
				foreach($products as $product) {
					$image = is_object($product->cover) && isset($product->cover[0]) ? $product->cover[0]->path : '';
					if( !empty( $image ) ) {
						$image = URL.'/'.str_replace('assets/images/products', 'assets/images/products/thumbs', $image);
					}
					$url = URL.'/'.( !empty($categoryName) ? $categoryName.'/' : '').$product->short_name;
					$arrData[$menu['column_no']] .= '<li>
														<a href="'.$url.'" data-menu-image="'.$image.'" data-main-imagetitle="'.$product->name.'" data-main-imgdescr="'.$product->short_description.'">
														'.$product->name.'
														</a>
													</li>';
				}
			}
		}
		ksort($arrData);
		return '<td>'.implode('</td><td>', $arrData).'</td>';
	}

	//render menu for mobile
	private static function renderProductMenuMobile($arrMenu, $parent_id = 0, $menuArray = [])
	{
		$menuArray = array_merge(['default' => '', 'mobile' => '', 'sitemap' => ''], $menuArray);
		if( isset($arrMenu[$parent_id]) ){
			foreach($arrMenu[$parent_id] as $k => $menu){
				$id = $menu['id'];
				//$color = isset($menu['product_category']['color']) ? $menu['product_category']['color'] : '';
				$name = isset($menu['product_category']['name']) ? $menu['product_category']['name'] : $menu['name'];
				$short_name = isset($menu['product_category']['short_name']) ? $menu['product_category']['short_name'] : '';
				$url = !empty($short_name) ? URL.'/'.$short_name : '#';
				if ( isset($arrMenu[$id]) ) {
					$column = self::renderProductColumnMobile($arrMenu[$id], $short_name);
					$menuArray['mobile'] .= '<li data-toggle="collapse" data-target="#menu_product'.$id.'" class="collapsed">';
					$menuArray['mobile'] .= 	'<a><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> '. $menu['name'] .' <span class="arrow"></span></a>';
					$menuArray['mobile'] .= '</li>';
					$menuArray['mobile'] .= '<ul class="sub-menu collapse" id="menu_product'.$id.'">';
					$menuArray['mobile'] .= $column;
					$menuArray['mobile'] .= '</ul>';

					unset($arrMenu[$id]);
				} else {
					if( !$parent_id ) {
						$menuArray['mobile'] .= '<li>';
						$menuArray['mobile'] .= 	'<a href="/'.$url.'"><i class="fa fa-gift fa-lg"></i> '. $menu['name'] .' <span class="arrow"></span></a>';
						$menuArray['mobile'] .= '</li>';

					}
				}
			}
		}
		return $menuArray;
	}

	//render menu for mobile
	private static function renderHeaderMenuMobile($arrMenu, $parent_id = 0, $menuArray = [])
	{
		$menuArray = array_merge(['default' => '', 'mobile' => '', 'sitemap' => ''], $menuArray);
		if( isset($arrMenu[$parent_id]) ){
			foreach($arrMenu[$parent_id] as $k => $menu){
				$id = $menu['id'];
				//$color = isset($menu['product_category']['color']) ? $menu['product_category']['color'] : '';
				$name = isset($menu['product_category']['name']) ? $menu['product_category']['name'] : $menu['name'];
				$short_name = isset($menu['product_category']['short_name']) ? $menu['product_category']['short_name'] : '';
				$url = $menu['link'];
				if ( isset($arrMenu[$id]) ) {
					$column = self::renderHeaderColumnMobile($arrMenu[$id], $short_name);
					$menuArray['mobile'] .= '<li data-toggle="collapse" data-target="#menu_header'.$id.'" class="collapsed">';
					$menuArray['mobile'] .= 	'<a><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> '. $menu['name'] .' <span class="arrow"></span></a>';
					$menuArray['mobile'] .= '</li>';
					$menuArray['mobile'] .= '<ul class="sub-menu collapse" id="menu_header'.$id.'">';
					$menuArray['mobile'] .= $column;
					$menuArray['mobile'] .= '</ul>';

					unset($arrMenu[$id]);
				} else {
					if( !$parent_id ) {
						$menuArray['mobile'] .= '<li>';
						$menuArray['mobile'] .= 	'<a href="/'.$url.'"><i class="fa fa-angle-double-right fa-lg" style="color:#000"></i> '. $menu['name'] .'</a>';
						$menuArray['mobile'] .= '</li>';

					}
				}
			}
		}
		return $menuArray;
	}
	private static function renderHeaderColumnMobile($arrMenu, $categoryName = '')
	{

		$arrData = [];
		foreach($arrMenu as $menu) {
			if( !isset($arrData[$menu['column_no']]) ) {
				$arrData[$menu['column_no']] = '';
			}
			$categoryId = isset($menu['product_category']['id']) ? $menu['product_category']['id'] : 0;
			$name = isset($menu['product_category']['name']) ? $menu['product_category']['name'] : $menu['name'];
			$short_name = isset($menu['product_category']['short_name']) ? $menu['product_category']['short_name'] : '';
			$arrData[$menu['column_no']] .= '<li><a href="/'.$menu['link'].'">'.$name.'</a></li>';
		}
		ksort($arrData);
		return implode($arrData);
	}


	private static function renderProductColumnMobile($arrMenu, $categoryName = '')
	{
		$arrData = [];
		foreach($arrMenu as $menu) {
			if( !isset($arrData[$menu['column_no']]) ) {
				$arrData[$menu['column_no']] = '';
			}
			$categoryId = isset($menu['product_category']['id']) ? $menu['product_category']['id'] : 0;
			$name = isset($menu['product_category']['name']) ? $menu['product_category']['name'] : $menu['name'];
			$short_name = isset($menu['product_category']['short_name']) ? $menu['product_category']['short_name'] : '';
			$arrData[$menu['column_no']] .= '<strong>'.$name.'</strong>';
			$products = Product::select('id', 'name', 'short_name', 'short_description')
									->with('cover')
									->whereRaw('(SELECT COUNT(*)
											FROM `categories` INNER JOIN `products_categories`
												ON `categories`.`id` = `products_categories`.`category_id`
											WHERE `products_categories`.`product_id` = `products`.`id`
											AND `categories`.`id` = '.$categoryId.') >= 1')
									->orderBy('order_no', 'asc')
									->get();
			if( !$products->isEmpty() ) {
				foreach($products as $product) {
					$url = URL.'/'.( !empty($categoryName) ? $categoryName.'/' : '').$product->short_name;
					$arrData[$menu['column_no']] .= '<li><a href="'.$url.'">'.$product->name.'</a></li>';
				}
			}
		}
		ksort($arrData);
		return implode($arrData);
	}

	private static function renderFooterMenu(&$arrMenu, $parent_id = 0, $html = '')
	{
		if( isset($arrMenu[$parent_id]) ){
			$i = 1;
			foreach($arrMenu[$parent_id] as $k => $menu){
				$id = $menu['id'];
				if ( isset($arrMenu[$id]) ) {
					$html .= '<div class="col-md-3 col-sm-6 col-xs-12 group_menu_footer">
								<h3>'. $menu['name'] .'</h3>
								'. self::renderFooterMenu($arrMenu, $id) .'
							</div>';
				} else {
					if( $parent_id ) {
						$html .= '<a class="col-xs-6 col-md-12 menu_footer" href="'. URL.'/'. $menu['link'] .'" title="'. $menu['name'] .'" >'. $menu['name'] .'</a>';
					} else {
						$html .= '<div class="col-md-3 col-sm-6 col-xs-12">
									<h3><a href="'. URL.'/'. $menu['link'].'">'. $menu['name'] .'</a></h3>
								</div>';
					}
				}
				unset($arrMenu[$parent_id][$k]);
				$i++;
			}

		}
		return $html;
	}

	private static function renderSidebar($arrMenu, $parent_id = 0, $html = '')
	{
		if( isset($arrMenu[$parent_id]) ){
			foreach($arrMenu[$parent_id] as $k => $menu){
				$id = $menu['id'];
				if ( isset($arrMenu[$id]) ) {
					$html .= '<li>
								<a href="javascript:void(0)">
									<i class="'.$menu['icon_class'].'"></i>
									<span class="title">'.$menu['name'].'</span>
									<span class="arrow "></span>
								</a>
								<ul class="sub-menu">
								'. self::renderSidebar($arrMenu, $id) .'
								</ul>
							</li>';
				} else {
					$html .= '<li>
								<a href="'.URL.'/'.$menu['link'].'">
									<i class="'.$menu['icon_class'].'"></i>
									<span class="title">'.$menu['name'].'</span>
								</a>
							</li>';;
				}
				unset($arrMenu[$parent_id][$k]);
			}
		}
		return $html;
	}

	private static function renderMenu(&$arrMenu, $arrPermission, $parent_id = 0, $arrHTML = array())
	{
		if( isset($arrMenu[$parent_id]) ){
			foreach($arrMenu[$parent_id] as $k => $menu){
				if( !$arrPermission[$menu['type']]['view'] ) {
					continue;
				}
				$key = $menu['type'];
				if( !empty($menu['group']) ) {
					$key .= '-'.$menu['group'];
				}
				if( !isset($arrHTML[$key]) ) {
					$arrHTML[$key] = '';
				}
				$id = $menu['id'];
				$style = $disable = $delete = '';
				if( !$menu['active'] ) {
					$style = 'style="background-color: #ccc"';
				}
				if( $arrPermission[$menu['type']]['delete'] ) {
					$delete = '<span class="pull-right">
		                            <a data-function="delete" href="javascript:void(0)"  onclick="deleteMenu('. $menu['id'] .')">
		                                <i class="fa fa-times"></i>
		                            </a>
		                        </span>';
				}
				if( !$arrPermission[$menu['type']]['edit'] ) {
					$disable = 'disabled-link';
				}
				$arrHTML[$key] .= '<li class="dd-item dd3-item" data-id="'. $menu['id'] .'">
									<div class="dd-handle dd3-handle">
									</div>
									<div class="dd3-content '. $disable .'" '. $style .'data-id="'.$menu['id'].'">
										'. $menu['name'] .'
										<input type="hidden" id="menu-'. $menu['id'] .'" value="' .e(json_encode($menu)) .'" />
										'. $delete .'
									</div>';
				if ( isset($arrMenu[$id]) ) {
					$data = self::renderMenu($arrMenu,  $arrPermission, $id);
					$arrHTML[$key] .=   '<ol class="dd-list">
										'. $data[$key] .'
										</ol>';
				}
				$arrHTML[$key] .= '</li>';
				unset($arrMenu[$parent_id][$k]);
			}
		}
		return $arrHTML;
	}

	private static function renderParent($arrMenu, $parent_id = 0, $arrHTML = array())
	{
		if( isset($arrMenu[$parent_id]) ){
			foreach($arrMenu[$parent_id] as $k => $menu) {
				$type = $menu['type'];
				if( !isset($arrHTML[$type]) ) {
					$arrHTML[$type] = [];
				}
				$prefix = '';
				if( $parent_id ) {
					for($i = 1; $i < $menu['level']; $i++) {
						$prefix .= '--';
					}
				}
				$id = $menu['id'];
				if( isset($arrMenu[$id]) ) {
					$arrHTML[$type][] = '<option value="'. $menu['id'] .'">'. $prefix.$menu['name'] .'</option>';
					$arrHTML = self::renderParent($arrMenu, $id, $arrHTML);
				} else {
					$arrHTML[$type][] = '<option value="'. $menu['id'] .'">'. $prefix.$menu['name'] .'</option>';
				}
			}
		}
		return $arrHTML;
	}

	public static function getCache($arrCondition = [])
	{
		if( isset($arrCondition['header']) ) {
			$cacheManager = Cache::tags('menus', 'header');
		} else if( isset($arrCondition['footer']) ) {
			$cacheManager = Cache::tags('menus', 'footer');
		} else if( isset($arrCondition['product']) ) {
			$cacheManager = Cache::tags('menus', 'product');
		} else if( isset($arrCondition['mobileproduct']) ) {
			$cacheManager = Cache::tags('menus', 'mobileproduct');
		} else if( isset($arrCondition['backend']) ) {
			$cacheManager = Cache::tags('menus', 'backend');
		} else {
			$cacheManager = Cache::tags('menus', md5(serialize($arrCondition)));
		}
		if( $cacheManager->has('menu') ) {
			$cache = $cacheManager->get('menu');
		} else {
			$cache = Menu::get($arrCondition);
			$cacheManager->forever('menu', $cache);
		}
		return $cache;
	}

	public static function updateMenu($page, $action, $prefixLink = '', $group = 'header')
   	{
		if( $action == 'add' ) {
			if( $page->menu_id ) {
				$menu = Menu::find($page->menu_id);
				if( !is_object($menu) ) {
					$page->menu_id = 0;
				}
			}

			if( !$page->menu_id ) {
				$menu = new Menu;
				$menu->name = $page->name;
				$menu->icon_class = '';
				$menu->parent_id = 0;
				$menu->type = 'frontend';
				$menu->group = $group;
				$menu->order_no = 1;
				$menu->level = 1;
				$menu->active = 1;
			}

			if( $page instanceof ProductCategory ) {
				if(  $page->parent_id ) {
					$menu->parent_id = (int)ProductCategory::where('id', $page->parent_id)->pluck('menu_id');
				}
			} else if( $page instanceof ProductOffer ) {
				$menu->parent_id = (int)self::where('name', 'Special offers')->pluck('id');
			}
			$menu->active = $page->active;
			$menu->link = $prefixLink . $page->short_name;
			$menu->save();
			$page->menu_id = $menu->id;
		} else if( $action == 'delete' ) {
			if( $page->menu_id ) {
				self::destroy($page->menu_id);
				$page->menu_id = 0;
			}
		}
		return $page;
   	}

	public static function updateRecursiveChildOrder($arrMenu, $parentID, $i)
	{
		if( $parentID )
			$parentID = $parentID;
		foreach($arrMenu as $key => $value){
			if( isset($value->children) ) {
				self::updateRecursiveChildOrder($value->children, $value->id, $i+1);
			}
			Menu::where('id', $value->id)
						->update([
								'parent_id' => 	$parentID,
								'order_no' 	=>	($key+1),
								'level' 	=>	$i,
							]);
		}
	}

	public static function updateRecursive($parentID, $arrData)
	{
		$arrMenu = Menu::select('id')
							->where('parent_id', $parentID)
							->get();
		if( !$arrMenu->isEmpty() ) {
			foreach($arrMenu as $menu) {
				self::updateRecursive($menu->id, $arrData);
			}
		}
		Menu::where('parent_id', $parentID)
				->update($arrData);
	}

	public static function clearCache()
	{
		Cache::tags('menus')->flush();
	}

	public function afterSave($menu)
	{
		ProductCategory::where('menu_id', $menu->id)->update(['active' => $menu->active]);
		return Cache::tags('menus')->flush();
	}

	public function beforeDelete($menu)
	{
		$menu->productCategory()->update(['menu_id' => 0]);
		$menu->page()->update(['menu_id' => 0]);
		Cache::tags('menus')->flush();
	}

}
