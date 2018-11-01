<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovOrder extends Model {
	protected $guarded = [];

	public function employee() {
		return $this->belongsTo(Employee::class);
	}

	public function order() {
		return $this->belongsTo(Order::class);
	}

	public function payouts() {
		return $this->hasMany(Payout::class);
	}
}
