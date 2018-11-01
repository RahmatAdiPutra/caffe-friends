<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Permission.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$permissions = Permission::all();
		return view('permission.index', compact('permissions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Permission.Create')) {
			return view('permission.create');
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Permission $permission) {
		request()->validate([
			'name' => ['required', 'min:5'],
		]);
		$permission->create(request(['name', 'description']));
		return redirect('permission')->with('success', 'Permission has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\permission  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function show(Permission $permission) {
		return view('permission.show', compact('permission'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\permission  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Permission $permission) {
		if (Gate::allows('Permission.Edit')) {
			return view('permission.edit', compact('permission'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\permission  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Permission $permission) {
		request()->validate([
			'name' => ['required', 'min:5'],
		]);
		$permission->update(request(['name', 'description']));
		return redirect('permission')->with('success', 'Permission has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\permission  $permission
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Permission $permission) {
		if (Gate::allows('Permission.Destroy')) {
			$permission->delete();
			return redirect('permission')->with('success', 'Permission has been deleted');
		}
		return back();
	}
}
