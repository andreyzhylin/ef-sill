<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderMainFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->integer('order_number');
			$table->integer('oracle_number');
			$table->string('client_name');
			$table->date('term_date');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn('order_number');
			$table->dropColumn('oracle_number');
			$table->dropColumn('client_name');
			$table->dropColumn('term_date');
		});
	}

}
