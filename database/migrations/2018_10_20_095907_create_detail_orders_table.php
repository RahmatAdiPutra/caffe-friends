<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOrdersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('detail_orders', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('quantity');
			$table->unsignedInteger('order_id');
			$table->unsignedInteger('detail_item_id');
			$table->timestamps();

			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('detail_item_id')->references('id')->on('detail_items')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('detail_orders');
	}
}
