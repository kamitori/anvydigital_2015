<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id')->unsigned()->default(0)->index();
			$table->integer('product_id')->unsigned()->index();
			$table->string('svg_file', 250);
			$table->float('sizeh', 10, 0);
			$table->float('sizew', 10, 0);
			$table->float('sell_price', 10, 0);
			$table->integer('quantity');
			$table->float('sum_sub_total', 10, 0);
			$table->float('discount', 10, 0);
			$table->float('tax', 10, 0);
			$table->float('sum_tax', 10, 0);
			$table->float('sum_amount', 10, 0);
			$table->text('option');
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
		Schema::drop('order_details');
	}

}
