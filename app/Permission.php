<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
	public function rolePermissions() {
		return $this->hasMany(RolePermission::class);
	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
	];
}
