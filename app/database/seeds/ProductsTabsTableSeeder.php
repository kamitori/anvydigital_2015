<?php

class ProductsTabsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('products_tabs')->delete();
        
		\DB::table('products_tabs')->insert(array (
			0 => 
			array (
				'id' => 6,
				'product_id' => 177,
				'tab_id' => 2,
			),
			1 => 
			array (
				'id' => 7,
				'product_id' => 179,
				'tab_id' => 8,
			),
		));
	}

}
