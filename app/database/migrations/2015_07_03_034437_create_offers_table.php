<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('image', 250)->nullable();
			$table->string('short_name', 150)->index();
			$table->text('home_description')->nullable();
			$table->text('description')->nullable();
			$table->string('meta_title', 50)->nullable();
			$table->string('meta_description')->nullable();
			$table->integer('menu_id')->default(0)->index();
			$table->integer('home_id')->default(0)->index();
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
		Schema::drop('offers');
	}

}
