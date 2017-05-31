<?php

class AdminsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('admins')->delete();
        
		\DB::table('admins')->insert(array (
			0 => 
			array (
				'id' => 1,
				'first_name' => 'kei',
				'last_name' => '',
				'email' => 'hth.tung90@gmail.com',
				'password' => '$2y$10$BmaQ3kXgtNOggigyrDwDk.SoIapGVj6uzxA4lgkcF56Pq8DTYlg92',
				'role_id' => 1,
				'remember_token' => 'J5thgFZGjVM9XMqs723bNhX3uNeuB8Ftrf1saI8hxTsSzT1gOwVlMmv6NAlU',
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 1,
				'created_at' => '2015-04-17 10:26:56',
				'updated_at' => '2015-07-24 02:10:40',
			),
			1 => 
			array (
				'id' => 2,
				'first_name' => 'vu',
				'last_name' => '',
				'email' => 'vu.nguyen@gmail.com',
				'password' => '$2y$10$C8mW/HHqKj.XDCa29FwxROYoDKA6YNS8ssp.yHw1iebhv9Gl3HOCi',
				'role_id' => 1,
				'remember_token' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 1,
				'created_at' => '2015-04-17 10:26:56',
				'updated_at' => '2015-07-24 02:10:50',
			),
			2 => 
			array (
				'id' => 3,
				'first_name' => 'John',
				'last_name' => 'Phan',
				'email' => 'john@anvydigital.com',
				'password' => '$2y$10$/PK5UHZpnR9LO3vsz3OeyOQQF/2e0Vh5xAqCgilUe1/uVkiDAvOH.',
				'role_id' => 1,
				'remember_token' => '8TTzwf9rhyKQnramEc0TDy9in9UFBttzs31OWxSJde5jpGBRp2989YPyrqZ5',
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-24 10:07:48',
				'updated_at' => '2015-07-24 02:11:01',
			),
		));
	}

}
