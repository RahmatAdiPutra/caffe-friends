<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payout extends Model {
	protected $guarded = [];

	public function employee() {
		return $this->belongsTo(Employee::class);
	}

	public function approvOrder() {
		return $this->belongsTo(ApprovOrder::class);
	}
}
