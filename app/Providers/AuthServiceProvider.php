<?php

namespace App\Providers;

use App\Employee;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		'App\Model' => 'App\Policies\ModelPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->registerPolicies();

		Gate::before(function ( ? Employee $user, $permissions, $data = null) {
			$allowed = false;

			// belum login
			if (!$user) {
				return false;
			}

			// TODO buat $user->role->permissions >> ARRAY permission apa aja yg bisa diakses

			// buang wildcard & escape regex
			$permissions = trim($permissions, '*');

			$permissionRegex = '/^' . preg_quote($permissions, '/') . '/';
			foreach ($user->role->permissions as $permissionCode) {
				if (preg_match($permissionRegex, $permissionCode->name)) {
					$allowed = true;
					break;
				}
			}
			// dd($permissions, $allowed, $user->role->permissions);
			return $allowed;
		});

		// Gate::define('admin', function ($user) {
		// 	foreach ($user->role as $role) {
		// 		if ($role->name == 'Admin') {
		// 			return true;
		// 		}
		// 	}
		// 	return false;
		// });

		// Gate::define('operator', function ($user) {
		// 	foreach ($user->role as $role) {
		// 		if ($role->name == 'Operator') {
		// 			return true;
		// 		}
		// 	}
		// 	return false;
		// });
	}
}
