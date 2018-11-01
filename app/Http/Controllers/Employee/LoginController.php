<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Login Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles authenticating users for the application and
		    | redirecting them to your home screen. The controller uses a trait
		    | to conveniently provide its functionality to your applications.
		    |
	*/

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/base';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest:employee')->except('logout');
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request) {
		//return $request->only($this->username(), 'password');
		return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => '1'];
	}

	/**
	 * Send the response after the user was authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	protected function sendLoginResponse(Request $request) {
		$request->session()->regenerate();

		$this->clearLoginAttempts($request);

		// foreach ($this->guard()->user()->role as $role) {
		// 	if ($role->name == 'Admin') {
		// 		return redirect('/base');
		// 	} elseif ($role->name == 'Operator') {
		// 		return redirect('/base');
		// 	}
		// }
		// if ($this->guard()->user()->role->name == 'Admin') {
		// 	return redirect('/base');
		// } elseif ($this->guard()->user()->role->name == 'Operator') {
		// 	return redirect('/base');
		// }
		return redirect('/base');
	}

	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm() {
		return view('employee.login');
	}

	/**
	 * Log the user out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request) {
		$this->guard()->logout();

		$request->session()->invalidate();

		return $this->loggedOut($request) ?: redirect('/employee-login');
	}

	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard() {
		return Auth::guard('employee');
	}
}
