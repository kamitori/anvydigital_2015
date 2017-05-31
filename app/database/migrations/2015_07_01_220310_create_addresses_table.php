<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('company', 150);
			$table->text('address1');
			$table->text('address2');
			$table->string('city', 150);
			$table->string('country_id', 5)->index();
			$table->string('province_id', 5)->index();
			$table->integer('user_id')->default(0)->index();
			$table->text('type');
			$table->string('zipcode', 20);
			$table->string('phone', 20);
			$table->boolean('default')->default(0);
			$table->integer('created_by')->default(0);
			$table->integer('updated_by')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}
