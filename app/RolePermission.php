<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model {
	public function permission() {
		return $this->belongsTo(Permission::class);
	}
	public function role() {
		return $this->belongsTo(Role::class);
	}
}
