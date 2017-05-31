<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('short_name', 150)->index();
			$table->string('meta_title', 50)->nullable();
			$table->string('meta_description')->nullable();
			$table->text('description')->nullable();
			$table->text('home_description')->nullable();
			$table->string('color', 7)->nullable();
			$table->integer('order_no')->default(1);
			$table->integer('parent_id')->default(0)->index();
			$table->integer('menu_id')->default(0)->index();
			$table->boolean('on_home')->default(0);
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
		Schema::drop('categories');
	}

}
