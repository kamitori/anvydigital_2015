<?php

class ProductsCategoriesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('products_categories')->delete();
        
		\DB::table('products_categories')->insert(array (
			0 => 
			array (
				'id' => 48,
				'product_id' => 179,
				'category_id' => 11,
			),
			1 => 
			array (
				'id' => 49,
				'product_id' => 179,
				'category_id' => 9,
			),
			2 => 
			array (
				'id' => 50,
				'product_id' => 141,
				'category_id' => 9,
			),
			3 => 
			array (
				'id' => 51,
				'product_id' => 142,
				'category_id' => 9,
			),
			4 => 
			array (
				'id' => 52,
				'product_id' => 127,
				'category_id' => 10,
			),
			5 => 
			array (
				'id' => 53,
				'product_id' => 143,
				'category_id' => 6,
			),
			6 => 
			array (
				'id' => 54,
				'product_id' => 177,
				'category_id' => 6,
			),
			7 => 
			array (
				'id' => 55,
				'product_id' => 148,
				'category_id' => 7,
			),
			8 => 
			array (
				'id' => 56,
				'product_id' => 148,
				'category_id' => 13,
			),
			9 => 
			array (
				'id' => 57,
				'product_id' => 154,
				'category_id' => 7,
			),
			10 => 
			array (
				'id' => 58,
				'product_id' => 154,
				'category_id' => 13,
			),
			11 => 
			array (
				'id' => 59,
				'product_id' => 146,
				'category_id' => 7,
			),
			12 => 
			array (
				'id' => 60,
				'product_id' => 146,
				'category_id' => 13,
			),
			13 => 
			array (
				'id' => 61,
				'product_id' => 147,
				'category_id' => 7,
			),
			14 => 
			array (
				'id' => 62,
				'product_id' => 147,
				'category_id' => 14,
			),
			15 => 
			array (
				'id' => 63,
				'product_id' => 139,
				'category_id' => 8,
			),
			16 => 
			array (
				'id' => 65,
				'product_id' => 140,
				'category_id' => 8,
			),
			17 => 
			array (
				'id' => 66,
				'product_id' => 145,
				'category_id' => 9,
			),
			18 => 
			array (
				'id' => 67,
				'product_id' => 128,
				'category_id' => 10,
			),
			19 => 
			array (
				'id' => 68,
				'product_id' => 130,
				'category_id' => 10,
			),
			20 => 
			array (
				'id' => 69,
				'product_id' => 129,
				'category_id' => 10,
			),
			21 => 
			array (
				'id' => 70,
				'product_id' => 131,
				'category_id' => 10,
			),
			22 => 
			array (
				'id' => 71,
				'product_id' => 176,
				'category_id' => 10,
			),
			23 => 
			array (
				'id' => 72,
				'product_id' => 132,
				'category_id' => 10,
			),
			24 => 
			array (
				'id' => 73,
				'product_id' => 149,
				'category_id' => 12,
			),
			25 => 
			array (
				'id' => 74,
				'product_id' => 151,
				'category_id' => 12,
			),
			26 => 
			array (
				'id' => 76,
				'product_id' => 179,
				'category_id' => 12,
			),
			27 => 
			array (
				'id' => 77,
				'product_id' => 152,
				'category_id' => 12,
			),
			28 => 
			array (
				'id' => 78,
				'product_id' => 154,
				'category_id' => 12,
			),
			29 => 
			array (
				'id' => 79,
				'product_id' => 127,
				'category_id' => 15,
			),
			30 => 
			array (
				'id' => 80,
				'product_id' => 178,
				'category_id' => 1,
			),
			31 => 
			array (
				'id' => 82,
				'product_id' => 179,
				'category_id' => 16,
			),
			32 => 
			array (
				'id' => 83,
				'product_id' => 178,
				'category_id' => 16,
			),
		));
	}

}
