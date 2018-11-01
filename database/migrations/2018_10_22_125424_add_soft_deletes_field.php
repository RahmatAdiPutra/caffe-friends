<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesField extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('items', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('detail_items', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('detail_orders', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('employees', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('members', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('orders', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('payouts', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('positions', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('approv_orders', function (Blueprint $table) {
			$table->softDeletes();
		});
		Schema::table('users', function (Blueprint $table) {
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
	}
}
