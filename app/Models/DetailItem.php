<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailItem extends Model {
	protected $guarded = [];

	public function item() {
		return $this->belongsTo(Item::class);
	}

	public function employee() {
		return $this->belongsTo(Employee::class);
	}

	public function detailOrders() {
		return $this->hasMany(DetailOrder::class);
	}
}
