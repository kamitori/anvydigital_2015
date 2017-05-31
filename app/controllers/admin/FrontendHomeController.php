<?php
class FrontendHomeController extends AdminController {

	public function index()
	{
		$arrData = [
					'configure'  => Configure::getHome(),
					'categories' => Home::getCategoryArray(),
					'homes'		 => [],
					'socials'	 => [],
				];
		$homes = Home::select('id', 'name', 'description', 'link', 'image', 'type')
						->orderBy('id', 'asc')
						->get();
		if( !$homes->isEmpty() ){
			$homes = $homes->toArray();
			$arrKey = ['home-link' => 'homes', 'home-social' => 'socials'];
			foreach($homes as $home) {
				$arrData[ $arrKey[ $home['type'] ] ][] = $home;
			}
		}
		$this->layout->title = 'Frontend Home';
		$this->layout->content = View::make('admin.frontendhome-all')->with($arrData);
	}

	public function updateHome()
	{
		$arrPost = Input::all();
		if( isset($arrPost['homes']) ) {
			$path = public_path('assets'.DS.'images'.DS.'homes');
			if( !File::exists($path) ) {
				File::makeDirectory($path, 0755, true);
			}
			foreach(['homes' => ['cacheKey' => 'homeLink', 'dbType' => 'home-link'], 'socials' => ['cacheKey' =>['homeSocial', 'footerSocial'], 'dbType' => 'home-social']] as $postKey => $data) {
				if( !isset($arrPost[$postKey]) ) {
					continue;
				}
				foreach($arrPost[$postKey] as $key => $home) {
					if( isset($home['id']) ) {
						$h = Home::find((int)$home['id']);
						if( isset($home['delete']) && $home['delete'] ) {
							if( $h ) {
								$h->delete();
							}
							continue;
						}
					} else {
						$h = new Home;
					}
					if( Input::hasFile($postKey.'.'.$key.'.image') ) {
						$file = Input::file('homes.'.$key.'.image');
						$fileName = Str::slug(str_replace('.'.$file->getClientOriginalExtension(), '', $file->getClientOriginalName())).'.'.date('d-m-y').'.'.$file->getClientOriginalExtension();
						$file->move($path, $fileName);
	            		BackgroundProcess::resize(450, $path, $fileName);
	            		$image = 'assets/images/homes/'.$fileName;
					} else if( isset($home['image']) ) {
						$image = $home['image'];
					}
					$h->link = $home['link'];
					if( isset($home['name']) ) {
						$h->name = e($home['name']);
					}
					if( isset($home['description']) ) {
						$h->description = e($home['description']);
					}
					if( isset($image) ) {
						$h->image = $image;
						unset($image);
					}
					$h->type = $data['dbType'];
					$h->save();
				}
				if( is_array($data['cacheKey']) ) {
					foreach($data['cacheKey'] as $k) {
						Cache::forget($k);
					}
				} else {
					Cache::forget($data['cacheKey']);
				}
			}
		}
		if( isset($arrPost['home']) ) {
			foreach($arrPost['home'] as $key => $value) {
				$configure = Configure::firstOrNew(['ckey'=> 'home_'.$key]);
				$configure->ckey = 'home_'.$key;
				$configure->cvalue = e($value);
				$configure->save();
			}
			Cache::forget('home');
		}
		if( isset($arrPost['categories']) ) {
			foreach($arrPost['categories'] as $category) {
				if( isset($category['delete']) && $category['delete'] ) {
					ProductCategory::where('id', $category['id'])
										->update(['on_home' => 0]);
				} else {
					ProductCategory::where('id', $category['id'])
										->update([
											'on_home' => 1,
											'home_description' => e($category['description'])
											]);
				}
			}
			Cache::forget('homeCategory');
		}
		return Redirect::to(URL.'/admin/frontend-home')->with('flash_success', 'Frontend Home has been saved.');
	}
}