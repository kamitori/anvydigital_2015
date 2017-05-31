<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLayoutDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('layout_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->float('width')->default(0.00);
			$table->float('height')->default(0.00);
			$table->float('coor_x')->default(0.00);
			$table->float('coor_y')->default(0.00);
			$table->text('d')->nullable();
			$table->string('type', 20)->default('path');
			$table->boolean('empty')->default(0);
			$table->integer('order_no')->default(1);
			$table->integer('layout_id')->default(0)->index();
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
		Schema::drop('layout_details');
	}

}
