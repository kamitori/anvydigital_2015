<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('short_name', 150)->index();
			$table->float('sell_price', 10, 0)->default(0);
			$table->float('margin_up', 10, 0)->default(0);
			$table->string('working_time')->nullable();
			$table->text('short_description')->nullable();
			$table->text('description')->nullable();
			$table->text('specification')->nullable();
			$table->text('technical')->nullable();
			$table->string('meta_title', 50)->nullable();
			$table->string('meta_description')->nullable();
			$table->boolean('active')->default(1);
			$table->integer('order_no')->default(1);
			$table->integer('svg_layout_id')->default(0);
			$table->boolean('custom_size')->default(1);
			$table->text('pinterest')->nullable();
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
		Schema::drop('products');
	}

}
