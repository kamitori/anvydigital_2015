<?php

class OptionGroupsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('option_groups')->delete();
        
		\DB::table('option_groups')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Print Finishes',
				'description' => 'The following print finishes are available.',
				'tab_id' => 2,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 15:16:54',
				'updated_at' => '2015-07-10 15:58:57',
			),
		));
	}

}
