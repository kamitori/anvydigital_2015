<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
class DBCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:command';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'DB commands.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		if( $this->input->getOption('image-tags') ) {
			$this->imageTags();
		}
		if( $this->input->getOption('transfer') ) {
			$this->transfer();
		}
		if( $this->input->getOption('reset-thumbs') ) {
			$this->resetThumbs();
		}
		if( $this->input->getOption('product-pinterest') ) {
			$this->productPinterest();
		}
		if( $this->input->getOption('convert-contacts') ) {
			$this->convertContacts();
		}
		if( $this->input->getOption('convert-employees') ) {
			$this->convertEmployees();
		}
	}

	private function imageTags()
	{
		$data = DB::select(DB::raw('select name from mysql.proc where name = "imageTags" and db="'.DB::connection()->getDatabaseName().'"'));
		if( empty($data) ) {
			DB::unprepared('
				            CREATE PROCEDURE imageTags()
				            BEGIN
				                CREATE TEMPORARY TABLE temp (val CHAR(255));
				                SET @S1 = CONCAT("INSERT INTO temp (val) VALUES (\'",REPLACE((SELECT GROUP_CONCAT( DISTINCT  `option`) AS data FROM `imageables` WHERE `imageables`.`imageable_type` = "Other"), ",", "\'),(\'"),"\');");
				                PREPARE stmt1 FROM @s1;
				                EXECUTE stmt1;
				                SELECT DISTINCT(val) FROM temp;
				            END;
				        ');
		}
		DB::statement('ALTER TABLE imageables ENGINE="MyISAM";');
		DB::statement('ALTER TABLE imageables ADD FULLTEXT tag(`option`);');
	}

	private function transfer()
	{
		$faker = Faker\Factory::create();
		$connection = DS == '\\' ? DB::connection('anvydigital.local') : DB::connection('anvydigital.com');
		$imageFolder =  $this->ask('Enter Anvydigital image\'s absolute path: ');
		if( !File::exists($imageFolder) ) {
			return $this->error('The path "'.$imageFolder.'" was not existed.');
		} else {
			$error = false;
			if( !File::exists($imageFolder.DS.'ads'.DS.'banners') ) {
				$error = true;
				$this->error('"'.$imageFolder.DS.'ads'.DS.'banners'.'" must be existed.');
			}
			if( !File::exists($imageFolder.DS.'assets'.DS.'ideas') ) {
				$error = true;
				$this->error('"'.$imageFolder.DS.'assets'.DS.'ideas'.'" must be existed.');
			}
			if( !File::exists($imageFolder.DS.'assets'.DS.'products') ) {
				$error = true;
				$this->error('"'.$imageFolder.DS.'assets'.DS.'products'.'" must be existed.');
			}
			if( $error ) {
				return false;
			}
		}
		DB::statement('TRUNCATE images;');
		DB::statement('TRUNCATE imageables;');
		DB::statement('TRUNCATE products_categories;');
		$imageSQL = [];
		$images = [];
		if( !File::exists(public_path('assets'.DS.'images'.DS.'banners')) ) {
			File::makeDirectory(public_path('assets'.DS.'images'.DS.'banners'), 0755, true);
		}
		if( !File::exists(public_path('assets'.DS.'images'.DS.'products')) ) {
			File::makeDirectory(public_path('assets'.DS.'images'.DS.'products'), 0755, true);
		}
		$productsCategories = [];
		//BANNER=============================================================
		DB::statement('TRUNCATE banners;');
		$bannerSQL = [];
		$banners = $connection->table('upt_banners')
					->get();
		foreach($banners as $banner) {
			if( !empty($banner->image) && File::exists($imageFolder.DS.'ads'.DS.'banners'.DS.$banner->image) ) {
				$images[] = [
							'from'  => $imageFolder.DS.'ads'.DS.'banners',
							'to' 	=> public_path('assets'.DS.'images'.DS.'banners'),
							'name'	=> $banner->image,
							'width' => 960
						];
            	$imageId = MyImage::insertGetId([
                    'path' => 'assets/images/banners/'.$banner->image,
                ]);
                $imageSQL[] = "({$imageId}, {$banner->id}, 'Banner', '')";

			}
			$bannerSQL[] = "({$banner->id}, '{$banner->name}', {$banner->orderno}, {$banner->publish})";
		}
		if( !empty($bannerSQL) ) {
			DB::statement( 'INSERT INTO `banners`(`id`, `name`, `order_no`, `active`) VALUES '.implode(', ', $bannerSQL) );
		}
		$this->info(count($bannerSQL).' banner(s) inserted.');
		//CATEGORY============================================================
		DB::statement('TRUNCATE categories;');
		$categorySQL = [];
		$categories = $connection->table('upt_category')
					->get();
		foreach($categories as $category) {
			$categorySQL[] = "({$category->id}, '{$category->name}', '{$category->short_name}', '{$category->description}', {$category->orderno}, {$category->publish})";
		}
		if( !empty($categorySQL) ) {
			DB::statement('INSERT INTO `categories`(`id`, `name`, `short_name`, `description`, `order_no`, `active`) VALUES '.implode(', ', $categorySQL));
		}
		$this->info(count($categorySQL).' category(caterogies) inserted.');
		//PRODUCT============================================================
		DB::statement('TRUNCATE products;');
		$productSQL = [];
		$products = $connection->table('upt_products')
					->get();
		foreach($products as $key => $product) {
			if( !empty($product->image) && File::exists($imageFolder.DS.'assets'.DS.'products'.DS.$product->image) ) {
				$images[] = [
							'from'  => $imageFolder.DS.'assets'.DS.'products',
							'to' 	=> public_path('assets'.DS.'images'.DS.'products'),
							'name'	=> $product->image,
							'width' => 960,
							'thumb' => true
						];
            	$imageId = MyImage::insertGetId([
                    'path' => 'assets/images/products/'.$product->image,
                ]);
                $imageSQL[] = "({$imageId}, {$product->id}, 'Product', '{\"cover\":1}')";
			}
			if( $product->cat_id ) {
				$productsCategories[] = "({$product->id}, {$product->cat_id})";
			}
			$productSQL[] = "({$product->id}, '".$faker->uuid."', '{$product->title}', '{$product->short_title}', '{$product->meta_description}', '$product->description')";
		}
		if( !empty($productSQL) ) {
			DB::statement('INSERT INTO `products`(`id`, `sku`, `name`, `short_name`, `meta_description`, `description`) VALUES '.implode(', ', $productSQL));
		}
		$this->info(count($productSQL).' product(s) inserted.');
		$ideas = $connection->table('upt_ideas')
					->get();
		foreach($ideas as $idea) {
			if( !empty($idea->image) && File::exists($imageFolder.DS.'assets'.DS.'ideas'.DS.$idea->image) ) {
				$images[] = [
							'from'  => $imageFolder.DS.'assets'.DS.'ideas',
							'to' 	=> public_path('assets'.DS.'images'.DS.'products'),
							'name'	=> $idea->image,
							'width' => 960,
							'thumb' => true
						];
            	$imageId = MyImage::insertGetId([
                    'path' => 'assets/images/products/'.$idea->image,
                ]);
                $imageSQL[] = "({$imageId}, {$idea->pro_id}, 'Product', '{\"overview\":1}')";
			}
		}
		if( !empty($productsCategories) ) {
			DB::statement('INSERT INTO `products_categories`(`product_id`, `category_id`) VALUES '.implode(', ', $productsCategories));
		}
		if( !empty($imageSQL) ) {
			DB::statement('INSERT INTO `imageables`(`image_id`, `imageable_id`, `imageable_type`, `option`) VALUES '.implode(', ', $imageSQL));
		}
		foreach($images as $image) {
			File::copy($image['from'].DS.$image['name'], $image['to'].DS.$image['name']);
            $this->call('image:process', ['--type' => 'resize', '--path' => $image['to'], '--name' => $image['name'], '--width' => $image['width']]);
            if( isset($image['thumb']) ) {
            	$this->call('image:process', ['--type' => 'thumb', '--path' => $image['to'], '--name' => $image['name']]);
            }
		}
		$this->info(count($imageSQL).' image(s) inserted.');
	}

	private function resetThumbs()
	{
		$path = public_path('assets'.DS.'images'.DS.'products');
		if( !File::exists($path) ) {
			return $this->error('Path "'.$path.'"" does not exist.');
		}
		$images = glob($path.DS.'*.{gif,jpg,jpeg,png}', GLOB_BRACE);
		foreach($images as $image) {
			$image = str_replace($path.DS, '', $image);
            $this->call('image:process', ['--type' => 'thumb', '--path' => $path, '--name' => $image]);
		}
		$this->info(count($images).' image(s) reset.');
	}

	private function productPinterest()
	{
		DB::statement('ALTER TABLE `products` ADD `pinterest` TEXT NULL;');
	}

	private function convertContacts()
	{
		try {
			$jtContacts = JTContact::raw(function($collection){
			    return $collection->aggregate([
			                                [
			                                    '$match' => [
			                                        'inactive'      => ['$ne' => 1],
			                                        'is_employee'   => ['$ne' => 1],
			                                        'email'         => [
			                                            '$exists'   => true,
			                                            '$nin'      => ['', null]
			                                        ],
			                                        'deleted' 		=> false,
			                                    ],
			                                ],
			                                [
			                                    '$group' => [
			                                        '_id'        => ['email' => '$email'],
			                                        'email'      => ['$last' => '$email'],
			                                        'first_name' => ['$last' => '$first_name'],
			                                        'last_name'  => ['$last' => '$last_name'],
			                                        'company_id' => ['$last' => '$company_id'],
			                                        'jt_id'      => ['$last' => '$_id'],
			                                    ]
			                                ]
			                            ]);
			});
			$jtContacts = $jtContacts['result'];
		} catch(Exception $e) {
			$jtContacts = [];
		}
		$this->info( count($jtContacts). ' contact(s) found.');
		$password = Hash::make('anvy');
		$now = date('Y-m-d H:i:s');

		$arrInsert = [];

		try {
			$users = User::select('email')
                        ->get()
                        ->keyBy('email')
                        ->toArray();
			$users = array_change_key_case($users);
		} catch(Exception $e) {
			$users = [];
		}
		$found = $count = 0;
		$arrEmail = [];
		foreach($jtContacts as $contact) {
			$contact['email'] = trim(strtolower($contact['email']));
			if( isset($arrEmail[ $contact['email'] ]) ) {
				continue;
			}
			if( isset($users[ $contact['email'] ]) ) {
				$found++;
				continue;
			}
			if (!filter_var($contact['email'], FILTER_VALIDATE_EMAIL)) {
				continue;
			}
			$count++;
			$arrEmail[ $contact['email'] ] = 1;
			$contact = array_merge([
									'first_name' => '',
									'last_name'	 => '',
									'company_id' => ''
								], $contact);
			$contact['_id'] = (string)$contact['jt_id'];

			$arrInsert[] = [
							'first_name' 	=> $contact['first_name'],
							'last_name' 	=> $contact['last_name'],
							'email' 		=> $contact['email'],
							'password' 		=> $password,
							'company_id' 	=> (string)$contact['company_id'],
							'jt_id' 		=> (string)$contact['_id'],
							'created_at' 	=> $now,
							'updated_at' 	=> $now,
						];
		}
		if( !empty($arrInsert) ) {
			User::insert($arrInsert);
		}
		$this->info( $count. ' contact(s) valid.');
		$this->info( $found. ' user(s) existed.');
		$this->info( count($arrInsert). ' user(s) inserted.');
	}

	private function convertEmployees()
	{
		try {
			$jtEmployees = JTContact::raw(function($collection){
			    return $collection->aggregate([
			                                [
			                                    '$match' => [
			                                        'inactive'      => ['$ne' => 1],
			                                        'is_employee'   => 1,
			                                        'email'         => [
			                                            '$exists'   => true,
			                                            '$nin'      => ['', null]
			                                        ],
			                                        'deleted' 		=> false,
			                                    ],
			                                ],
			                                [
			                                    '$group' => [
			                                        '_id'        => ['email' => '$email'],
			                                        'email'      => ['$last' => '$email'],
			                                        'first_name' => ['$last' => '$first_name'],
			                                        'last_name'  => ['$last' => '$last_name'],
			                                        'jt_id'      => ['$last' => '$_id'],
			                                    ]
			                                ]
			                            ]);
			});
			$jtEmployees = $jtEmployees['result'];
		} catch(Exception $e) {
			$jtEmployees = [];
		}

		$this->info( count($jtEmployees). ' employee(s) found.');
		$password = Hash::make('anvy');
		$now = date('Y-m-d H:i:s');

		$arrInsert = [];

		try {
			$admins = Admin::select('email')
                        ->get()
                        ->keyBy('email')
                        ->toArray();
			$admins = array_change_key_case($admins);
		} catch(Exception $e) {
			$admins = [];
		}
		$found = $count = 0;
		$arrEmail = [];
		foreach($jtEmployees as $employee) {
			$employee['email'] = trim(strtolower($employee['email']));
			if( isset($arrEmail[ $employee['email'] ]) ) {
				continue;
			}
			if( isset($admins[ $employee['email'] ]) ) {
				$found++;
				continue;
			}
			if (!filter_var($employee['email'], FILTER_VALIDATE_EMAIL)) {
				continue;
			}
			$count++;
			$arrEmail[ $employee['email'] ] = 1;
			$employee = array_merge([
									'first_name' => '',
									'last_name'	 => '',
								], $employee);
			$employee['_id'] = (string)$employee['jt_id'];

			$arrInsert[] = [
							'first_name' 	=> $employee['first_name'],
							'last_name' 	=> $employee['last_name'],
							'email' 		=> $employee['email'],
							'password' 		=> $password,
							'created_at' 	=> $now,
							'updated_at' 	=> $now,
						];
		}
		if( !empty($arrInsert) ) {
			Admin::insert($arrInsert);
		}
		$this->info( $count. ' employee(s) valid.');
		$this->info( $found. ' admin(s) existed.');
		$this->info( count($arrInsert). ' admin(s) inserted.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('image-tags', null, InputOption::VALUE_NONE, 'Set tags search for "images" table.', null),
			array('transfer', null, InputOption::VALUE_NONE, 'Tranfer some tables and images from anvyonline to new one.', null),
			array('reset-thumbs', null, InputOption::VALUE_NONE, 'Reset thumbnail images of products.', null),
			array('product-pinterest', null, InputOption::VALUE_NONE, 'Set pinterest field for "products" table.', null),
			array('convert-contacts', null, InputOption::VALUE_NONE, 'Convert collection contact to table user.', null),
			array('convert-employees', null, InputOption::VALUE_NONE, 'Convert collection contact[employee] to table admin.', null),
		);
	}

}
