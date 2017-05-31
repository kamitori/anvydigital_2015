<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->default(0)->index();
			$table->integer('billing_address_id');
			$table->integer('shipping_address_id');
			$table->string('status', 35);
			$table->float('sum_sub_total', 10, 0);
			$table->float('discount', 10, 0);
			$table->float('tax', 10, 0);
			$table->float('sum_tax', 10, 0);
			$table->float('sum_amount', 10, 0);
			$table->text('note')->nullable();
			$table->integer('created_by')->unsigned()->default(0);
			$table->integer('updated_by')->unsigned()->default(0);
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
		Schema::drop('orders');
	}

}
