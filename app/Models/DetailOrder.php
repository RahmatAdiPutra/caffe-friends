<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model {
	protected $guarded = [];

	public function order() {
		return $this->belongsTo(Order::class);
	}

	public function detailItem() {
		return $this->belongsTo(DetailItem::class);
	}
}
