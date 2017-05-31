<?php

class HomesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('homes')->delete();
        
		\DB::table('homes')->insert(array (
			0 => 
			array (
				'id' => 2,
				'name' => 'Facebook',
				'description' => NULL,
				'image' => 'assets/images/social_icon/facebook.png',
				'link' => 'https://www.facebook.com/anvydigital',
				'type' => 'home-social',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 14:23:54',
				'updated_at' => '2015-07-15 10:45:02',
			),
			1 => 
			array (
				'id' => 6,
				'name' => 'Home Builders Signage',
				'description' => 'Enjoy year long savings on 20&times;16&quot; sizes of your favourite wall products.',
				'image' => 'assets/images/homes/thumbs.07-07-15.jpg',
				'link' => 'http://test.anvyonline.com/event-signage',
				'type' => 'home-link',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 14:28:31',
				'updated_at' => '2015-07-24 11:52:54',
			),
			2 => 
			array (
				'id' => 7,
				'name' => 'Oil Field Signage',
				'description' => 'From trade shows to training, find out where we&#039;ll be stopping off next.',
				'image' => 'assets/images/homes/even.07-07-15.jpg',
				'link' => '',
				'type' => 'home-link',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 14:29:44',
				'updated_at' => '2015-07-24 11:52:54',
			),
			3 => 
			array (
				'id' => 8,
				'name' => 'POP Signage',
				'description' => 'The Clarity Range&mdash;quality and style that&#039;s clear to see.',
				'image' => 'assets/images/homes/spotlight.07-07-15.jpg',
				'link' => '',
				'type' => 'home-link',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 14:32:26',
				'updated_at' => '2015-07-24 11:52:54',
			),
			4 => 
			array (
				'id' => 9,
				'name' => 'Museum Signage',
				'description' => 'Create products in a matter of clicks with our new online ordering system.',
				'image' => 'assets/images/homes/online-order.07-07-15.jpg',
				'link' => '',
				'type' => 'home-link',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 14:32:26',
				'updated_at' => '2015-07-24 11:52:54',
			),
			5 => 
			array (
				'id' => 10,
				'name' => 'Pinterest',
				'description' => NULL,
				'image' => 'assets/images/social_icon/pinterest.png',
				'link' => 'https://www.pinterest.com/anvydigital',
				'type' => 'home-social',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-11 10:23:51',
				'updated_at' => '2015-07-15 10:45:02',
			),
			6 => 
			array (
				'id' => 11,
				'name' => ' Twitter',
				'description' => NULL,
				'image' => 'assets/images/social_icon/twitter.png',
				'link' => 'https://twitter.com/anvydigital',
				'type' => 'home-social',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-11 10:23:51',
				'updated_at' => '2015-07-15 10:45:02',
			),
			7 => 
			array (
				'id' => 14,
				'name' => 'Youtube',
				'description' => NULL,
				'image' => 'assets/images/social_icon/youtube.png',
				'link' => 'https://www.youtube.com/user/anvydigitalimaging',
				'type' => 'home-social',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-15 10:38:49',
				'updated_at' => '2015-07-15 10:45:03',
			),
			8 => 
			array (
				'id' => 15,
				'name' => 'Google Plus',
				'description' => NULL,
				'image' => 'assets/images/social_icon/google.png',
				'link' => 'https://plus.google.com/104668029374636612782/posts',
				'type' => 'home-social',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-15 10:51:37',
				'updated_at' => '2015-07-15 10:51:37',
			),
			9 => 
			array (
				'id' => 16,
				'name' => 'LinkedIn',
				'description' => NULL,
				'image' => 'assets/images/social_icon/in.png',
				'link' => 'https://www.linkedin.com/company/anvy-digital',
				'type' => 'home-social',
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-15 10:51:37',
				'updated_at' => '2015-07-15 10:51:37',
			),
		));
	}

}
