<?php

namespace App\Http\Controllers;

use App\Mail\verifyAccount;
use App\Models\Employee;
use App\Models\Position;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class EmployeeController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Employee.*');
	}

	public function base() {
		return view('index');
	}

	public function home() {
		return view('employee.home');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$employees = Employee::all();
		return view('employee.index', compact('employees'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Employee.Create')) {
			$positions = Position::all('id', 'name');
			$roles = Role::all();
			return view('employee.create', compact('positions', 'roles'));
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Employee $employee) {
		request()->validate([
			'name' => ['required', 'min:5'],
			'email' => ['required', 'email'],
			'password' => ['required', 'min:5'],
			'position_id' => ['required'],
			'role_id' => ['required'],
		]);
		$user = $employee->create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => Hash::make(request('password')),
			'position_id' => request('position_id'),
			'role_id' => request('role_id'),
			'verify_token' => Str::random(40),
		]);
		$thisUser = Employee::findOrFail($user->id);
		$this->sendEmail($thisUser);
		return redirect('employee')->with('success', 'Employee has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function show(Employee $employee) {
		return view('employee.show', compact('employee'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Employee $employee) {
		if (Gate::allows('Employee.Edit')) {
			$positions = Position::all('id', 'name');
			$roles = Role::all();
			return view('employee.edit', compact('employee', 'positions', 'roles'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Employee $employee) {
		request()->validate([
			'name' => ['required', 'min:5'],
			'email' => ['required', 'email'],
			'position_id' => ['required'],
			'role_id' => ['required'],
		]);
		$employee->update(request(['name', 'email', 'position_id', 'role_id']));
		return redirect('employee')->with('success', 'Employee has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Employee  $employee
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Employee $employee) {
		if (Gate::allows('Employee.Destroy')) {
			$employee->delete();
			return redirect('employee')->with('success', 'Employee has been deleted');
		}
		return back();
	}

	public function showDetailItem(Employee $employee) {
		return view('employee.picDetailItem', compact('employee'));
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
		Mail::to($user['email'])->send(new verifyAccount($user));
	}
}
