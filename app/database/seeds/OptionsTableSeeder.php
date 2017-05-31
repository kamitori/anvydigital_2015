<?php

class OptionsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('options')->delete();
        
		\DB::table('options')->insert(array (
			0 => 
			array (
				'id' => 1,
				'name' => 'Lustre',
				'description' => 'Standard finish photographic print.',
				'option_group_id' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 15:17:40',
				'updated_at' => '2015-07-10 16:00:19',
			),
		));
	}

}
