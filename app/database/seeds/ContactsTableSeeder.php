<?php

class ContactsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('contacts')->delete();
        
		\DB::table('contacts')->insert(array (
			0 => 
			array (
				'id' => 1,
				'contact_name' => 'Ton',
				'contact_phone' => NULL,
				'contact_email' => 'tonva@anvydigital.com',
				'contact_message' => 'test<br />
Please enter at least 20 characters.',
				'read' => 0,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-15 16:07:46',
				'updated_at' => '2015-07-15 16:07:46',
			),
		));
	}

}
