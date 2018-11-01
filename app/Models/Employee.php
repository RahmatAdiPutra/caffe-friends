<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
	protected $guarded = [];
	protected $hidden = ['password'];

	public function position() {
		return $this->belongsTo(Position::class);
	}

	public function role() {
		return $this->belongsTo('App\Role');
	}

	public function detailItems() {
		return $this->hasMany(DetailItem::class);
	}

	public function approvOrders() {
		return $this->hasMany(ApprovOrder::class);
	}

	public function payouts() {
		return $this->hasMany(Payout::class);
	}
}
