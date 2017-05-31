<?php

class OptionablesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('optionables')->delete();
        
		\DB::table('optionables')->insert(array (
			0 => 
			array (
				'id' => 1,
				'product_id' => 141,
				'optionable_id' => 1,
				'optionable_type' => 'ProductOptionGroup',
				'option' => NULL,
			),
			1 => 
			array (
				'id' => 2,
				'product_id' => 141,
				'optionable_id' => 1,
				'optionable_type' => 'ProductOption',
				'option' => NULL,
			),
			2 => 
			array (
				'id' => 7,
				'product_id' => 177,
				'optionable_id' => 1,
				'optionable_type' => 'ProductOptionGroup',
				'option' => NULL,
			),
			3 => 
			array (
				'id' => 8,
				'product_id' => 177,
				'optionable_id' => 1,
				'optionable_type' => 'ProductOption',
				'option' => NULL,
			),
		));
	}

}
