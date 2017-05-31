<?php

class ProductsOffersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('products_offers')->delete();
        
		\DB::table('products_offers')->insert(array (
			0 => 
			array (
				'id' => 1,
				'product_id' => 179,
				'offer_id' => 1,
				'description' => '',
			),
			1 => 
			array (
				'id' => 2,
				'product_id' => 178,
				'offer_id' => 1,
				'description' => '',
			),
		));
	}

}
