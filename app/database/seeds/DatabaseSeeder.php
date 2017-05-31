<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		Cache::flush();
		$this->call('AdminsTableSeeder');
		$this->call('ConfiguresTableSeeder');
		$this->call('MenusTableSeeder');
		$this->call('RolesTableSeeder');
		$this->call('PermissionsTableSeeder');
		$this->call('AssignedRolesTableSeeder');
		$this->call('PermissionRoleTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('BannersTableSeeder');
		$this->call('ImagesTableSeeder');
		$this->call('ImageablesTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('ProductsCategoriesTableSeeder');
		$this->call('HomesTableSeeder');
		$this->call('ProductsTabsTableSeeder');
		$this->call('OptionsTableSeeder');
		$this->call('OptionGroupsTableSeeder');
		$this->call('OptionablesTableSeeder');
		$this->call('TabsTableSeeder');
		$this->call('PagesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('ContactsTableSeeder');
		$this->call('ProductsJtproductsTableSeeder');
		$this->call('AddressesTableSeeder');
		$this->call('LayoutsTableSeeder');
		$this->call('LayoutDetailsTableSeeder');
		$this->call('NotificationsTableSeeder');
		$this->call('OffersTableSeeder');
		$this->call('OrdersTableSeeder');
		$this->call('OrderDetailsTableSeeder');
		$this->call('ProductsOffersTableSeeder');
	}

}
