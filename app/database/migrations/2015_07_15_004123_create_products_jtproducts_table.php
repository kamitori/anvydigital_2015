<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsJtproductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products_jtproducts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->index();
			$table->string('jt_id', 24)->index();
			$table->string('layout_id')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products_jtproducts');
	}

}
