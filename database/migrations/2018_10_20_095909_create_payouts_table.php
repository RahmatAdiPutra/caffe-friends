<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('payouts', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('approv_order_id');
			$table->unsignedInteger('employee_id');
			$table->timestamps();

			$table->foreign('approv_order_id')->references('id')->on('approv_orders')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('payouts');
	}
}
