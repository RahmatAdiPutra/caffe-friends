<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model {
	protected $guarded = [];
	protected $hidden = ['password'];

	public function orders() {
		return $this->hasMany(Order::class);
	}
}
