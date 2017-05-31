<?php

class ProductsJtproductsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('products_jtproducts')->delete();
        
		\DB::table('products_jtproducts')->insert(array (
			0 => 
			array (
				'id' => 2,
				'product_id' => 143,
				'jt_id' => '5284a48e222aad5414000593',
				'layout_id' => '0',
			),
			1 => 
			array (
				'id' => 3,
				'product_id' => 143,
				'jt_id' => '5284a48e222aad541400058f',
				'layout_id' => '0',
			),
			2 => 
			array (
				'id' => 8,
				'product_id' => 139,
				'jt_id' => '5284a48e222aad54140005a1',
				'layout_id' => '0',
			),
			3 => 
			array (
				'id' => 9,
				'product_id' => 139,
				'jt_id' => '5284a48e222aad541400059f',
				'layout_id' => '0',
			),
			4 => 
			array (
				'id' => 10,
				'product_id' => 139,
				'jt_id' => '5284a48e222aad54140005a4',
				'layout_id' => '0',
			),
			5 => 
			array (
				'id' => 11,
				'product_id' => 139,
				'jt_id' => '5284a48e222aad541400059e',
				'layout_id' => '0',
			),
		));
	}

}
