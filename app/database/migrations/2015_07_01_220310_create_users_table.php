<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 30);
			$table->string('last_name', 30);
			$table->string('email', 150)->unique();
			$table->text('password');
			$table->boolean('subscribe')->default(0);
			$table->dateTime('subscribe_at')->nullable();
			$table->string('phone', 30)->nullable();
			$table->text('company_name')->nullable();
			$table->string('company_id', 24)->nullable();
			$table->string('jt_id', 24)->nullable();
			$table->string('remember_token', 60)->nullable();
			$table->boolean('active')->default(1);
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
		Schema::drop('users');
	}

}
