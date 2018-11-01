<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {
	protected $guarded = [];

	public function member() {
		return $this->belongsTo(Member::class);
	}

	public function detailOrders() {
		return $this->hasMany(DetailOrder::class);
	}

	public function approvOrders() {
		return $this->hasMany(ApprovOrder::class);
	}
}
