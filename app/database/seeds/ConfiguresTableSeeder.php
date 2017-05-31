<?php

class ConfiguresTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('configures')->delete();
        
		\DB::table('configures')->insert(array (
			0 => 
			array (
				'id' => 1,
				'cname' => 'Title Site',
				'ckey' => 'title_site',
				'cvalue' => 'Digital Printing and Wide Format Printing',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-07-15 09:01:20',
			),
			1 => 
			array (
				'id' => 2,
				'cname' => 'Meta Description',
				'ckey' => 'meta_description',
				'cvalue' => 'Specialty digital printer, we focus on unique display graphic solution.',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-07-15 09:01:27',
			),
			2 => 
			array (
				'id' => 3,
				'cname' => 'Main Logo',
				'ckey' => 'main_logo',
				'cvalue' => 'assets/images/logos/logo.14-07-15.png',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-07-15 08:56:14',
			),
			3 => 
			array (
				'id' => 4,
				'cname' => 'VI Format',
				'ckey' => 'vi_format',
				'cvalue' => '2',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 3,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-21 09:24:48',
			),
			4 => 
			array (
				'id' => 5,
				'cname' => 'Instagram App ID',
				'ckey' => 'instagram_app_id',
				'cvalue' => 'f6b31259ea3d4f8489da2e137cec4c34',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-17 10:27:04',
			),
			5 => 
			array (
				'id' => 6,
				'cname' => 'Skydrive App ID',
				'ckey' => 'skydrive_app_id',
				'cvalue' => '0000000040149c21',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-17 10:27:04',
			),
			6 => 
			array (
				'id' => 7,
				'cname' => 'Google Drive App ID',
				'ckey' => 'googledrive_app_id',
				'cvalue' => '542866151209-h64bq9qnogf0e51b7rir1cuni1pnlc8j.apps.googleusercontent.com',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-17 10:27:04',
			),
			7 => 
			array (
				'id' => 8,
				'cname' => 'Dropbox App ID',
				'ckey' => 'dropbox_app_id',
				'cvalue' => '4h5nj85dysuxe3s',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-17 10:27:04',
			),
			8 => 
			array (
				'id' => 9,
				'cname' => 'Flickr App Secret',
				'ckey' => 'flickr_app_secret',
				'cvalue' => '58db44a1386f0b4e',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-17 10:27:04',
			),
			9 => 
			array (
				'id' => 10,
				'cname' => 'Flickr App ID',
				'ckey' => 'flickr_app_id',
				'cvalue' => '24fdd4da6151132517c7d4572c29d1f0',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-17 10:27:04',
			),
			10 => 
			array (
				'id' => 11,
				'cname' => 'Facebook APP ID',
				'ckey' => 'facebook_app_id',
				'cvalue' => '1601264390104375',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-04-17 10:27:04',
				'updated_at' => '2015-04-17 10:27:04',
			),
			11 => 
			array (
				'id' => 12,
				'cname' => 'Google Drive Email',
				'ckey' => 'google_drive_email',
				'cvalue' => '590750925671-qkiep6bvosvpmeespk2sjls8177bsbe9@developer.gserviceaccount.com',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-05-31 00:54:43',
				'updated_at' => '2015-05-31 00:54:43',
			),
			12 => 
			array (
				'id' => 13,
				'cname' => 'Google Drive Key File',
				'ckey' => 'google_drive_key_file',
				'cvalue' => '/var/www/vi/app/files/google_drive_key_file.p12',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-05-31 00:56:36',
				'updated_at' => '2015-05-31 00:56:36',
			),
			13 => 
			array (
				'id' => 14,
				'cname' => 'System Margin',
				'ckey' => 'margin',
				'cvalue' => '20',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-06-02 23:00:03',
				'updated_at' => '2015-06-02 23:06:47',
			),
			14 => 
			array (
				'id' => 15,
				'cname' => 'Background 1',
				'ckey' => 'background',
				'cvalue' => 'http://vi.anvyonline.com/assets/images/background-1b6c4998efbc1045452e47dc9e15dd99.jpg',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-06-16 04:13:04',
				'updated_at' => '2015-06-16 04:13:04',
			),
			15 => 
			array (
				'id' => 16,
				'cname' => 'Background 2',
				'ckey' => 'background',
				'cvalue' => 'http://vi.anvyonline.com/assets/images/background-f6884f3c1217a3d2c1aa33eff175681f.jpg',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-06-16 04:13:39',
				'updated_at' => '2015-06-16 04:13:39',
			),
			16 => 
			array (
				'id' => 17,
				'cname' => 'Google Analytic ID',
				'ckey' => 'google_analytic_id',
				'cvalue' => 'UA-62240241-2',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-06-24 01:06:02',
				'updated_at' => '2015-06-24 01:06:02',
			),
			17 => 
			array (
				'id' => 18,
				'cname' => '',
				'ckey' => 'home_header_title',
				'cvalue' => 'Large Format Specialty Printer',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 15:53:08',
				'updated_at' => '2015-07-23 22:47:33',
			),
			18 => 
			array (
				'id' => 19,
				'cname' => '',
				'ckey' => 'home_header_description',
				'cvalue' => 'Welcome to Anvy Digital Imaging Inc.',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 15:53:08',
				'updated_at' => '2015-07-24 11:52:54',
			),
			19 => 
			array (
				'id' => 20,
				'cname' => '',
				'ckey' => 'home_main_title',
				'cvalue' => 'Create something beautiful',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 15:53:09',
				'updated_at' => '2015-07-07 16:02:01',
			),
			20 => 
			array (
				'id' => 21,
				'cname' => '',
				'ckey' => 'home_main_description',
				'cvalue' => 'Give cherished moments the love and attention they deserve',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 15:53:09',
				'updated_at' => '2015-07-07 16:02:01',
			),
			21 => 
			array (
				'id' => 22,
				'cname' => '',
				'ckey' => 'home_footer_title',
				'cvalue' => 'Let&#039;s be friends!',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 15:53:09',
				'updated_at' => '2015-07-07 16:02:01',
			),
			22 => 
			array (
				'id' => 23,
				'cname' => '',
				'ckey' => 'home_footer_description',
				'cvalue' => 'For exclusive offers, up to the minute news and more',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-07 15:53:09',
				'updated_at' => '2015-07-07 16:02:01',
			),
			23 => 
			array (
				'id' => 24,
				'cname' => 'Google Map Link',
				'ckey' => 'google_map_link',
				'cvalue' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5015.090301114683!2d-113.98509010154422!3d51.061485941854784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x9c66042789ce65f4!2sAnvy+Digital+Imaging!5e0!3m2!1sen!2sca!4v1414011757410',
				'cdescription' => NULL,
				'active' => 1,
				'created_by' => 0,
				'updated_by' => 0,
				'created_at' => '2015-07-13 13:42:44',
				'updated_at' => '2015-07-13 13:42:44',
			),
		));
	}

}
