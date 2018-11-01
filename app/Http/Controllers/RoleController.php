<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Role.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$roles = Role::all();
		return view('role.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Role.Create')) {
			$permissions = Permission::all();
			return view('role.create', compact('permissions'));
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Role $role) {
		request()->validate([
			'name' => ['required', 'min:5'],
		]);
		$role->name = $request->name;
		$role->save();
		$role->permissions()->sync($request->permission_id);
		return redirect('role')->with('success', 'Role has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Role $role) {
		return view('role.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Role $role) {
		if (Gate::allows('Role.Edit')) {
			$role->with('permissions')->where('id', $role->id)->first();
			$permissions = Permission::all();
			return view('role.edit', compact('role', 'permissions'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Role $role) {
		request()->validate([
			'name' => ['required', 'min:5'],
		]);
		$role->id;
		$role->name = $request->name;
		$role->permissions()->sync($request->permission_id);
		$role->save();
		return redirect('role')->with('success', 'Role has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Role $role) {
		if (Gate::allows('Role.Destroy')) {
			$role->delete();
			return redirect('role')->with('success', 'Role has been deleted');
		}
		return back();
	}
}
