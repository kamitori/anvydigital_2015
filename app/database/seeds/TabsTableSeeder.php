<?php

class TabsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('tabs')->delete();
        
		\DB::table('tabs')->insert(array (
			0 => 
			array (
				'id' => 2,
				'name' => 'Print Finishes',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 15:26:30',
				'updated_at' => '2015-07-10 15:26:30',
			),
			1 => 
			array (
				'id' => 3,
				'name' => 'Mounting and Laminating',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 16:58:45',
				'updated_at' => '2015-07-10 16:58:45',
			),
			2 => 
			array (
				'id' => 4,
				'name' => 'Colour',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 16:59:53',
				'updated_at' => '2015-07-10 16:59:53',
			),
			3 => 
			array (
				'id' => 5,
				'name' => 'Designer Templates',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 17:00:26',
				'updated_at' => '2015-07-10 17:00:26',
			),
			4 => 
			array (
				'id' => 6,
				'name' => 'Covers',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 16:57:42',
				'updated_at' => '2015-07-10 16:57:42',
			),
			5 => 
			array (
				'id' => 7,
				'name' => 'Text Options',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 17:08:34',
				'updated_at' => '2015-07-10 17:08:34',
			),
			6 => 
			array (
				'id' => 8,
				'name' => 'Mounts',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-10 17:03:30',
				'updated_at' => '2015-07-10 17:03:30',
			),
			7 => 
			array (
				'id' => 9,
				'name' => 'Quick Upload & Order',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-11 09:22:42',
				'updated_at' => '2015-07-11 09:22:42',
			),
			8 => 
			array (
				'id' => 10,
				'name' => 'Orders',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-11 09:22:57',
				'updated_at' => '2015-07-11 09:22:57',
			),
		));
	}

}
