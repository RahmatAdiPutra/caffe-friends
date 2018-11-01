<?php

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Mail\verifyEmail;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class RegisterController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Register Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles the registration of new users as well as their
		    | validation and creation. By default this controller uses a trait to
		    | provide this functionality without requiring any additional code.
		    |
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
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
		$this->middleware('guest:employee');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data) {
		$user = Employee::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'verify_token' => Str::random(40),
		]);
		$thisUser = Employee::findOrFail($user->id);
		$this->sendEmail($thisUser);
		return $user;
	}

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm() {
		return view('employee.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request) {
		$this->validator($request->all())->validate();

		event(new Registered($user = $this->create($request->all())));

		// $this->guard()->login($user);
		return redirect(route('employee.login'))->with('success', 'Registered! Now verify your email to active your account');

		return $this->registered($request, $user)
		?: redirect($this->redirectPath());
	}

	/**
	 * Get the guard to be used during registration.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard() {
		return Auth::guard('employee');
	}

	public function sendEmailDone($email, $verifyToken) {
		$user = Employee::where(['email' => $email, 'verify_token' => $verifyToken])->first();
		if ($user) {
			Employee::where(['email' => $email, 'verify_token' => $verifyToken])->update(['email_verified_at' => Carbon::now()->toDateTimeString(), 'status' => '1', 'verify_token' => NULL]);
			return redirect(route('employee.login'))->with('success', 'Success verified !!! Now you can login');
		} else {
			return redirect('base');
		}
	}

	public function sendEmail($user) {
		Mail::to($user['email'])->send(new verifyEmail($user));
	}

	public function verify() {
		return view('employee.verify');
	}
}
