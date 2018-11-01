<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PositionController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Position.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$positions = Position::all();
		return view('position.index', compact('positions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Position.Create')) {
			return view('position.create');
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Position $position) {
		request()->validate([
			'name' => ['required', 'min:5'],
		]);
		$position->create(request(['name']));
		return redirect('position')->with('success', 'Position has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Position  $position
	 * @return \Illuminate\Http\Response
	 */
	public function show(Position $position) {
		return view('position.show', compact('position'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Position  $position
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Position $position) {
		if (Gate::allows('Position.Edit')) {
			return view('position.edit', compact('position'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Position  $position
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Position $position) {
		request()->validate([
			'name' => ['required', 'min:5'],
		]);
		$position->update(request(['name']));
		return redirect('position')->with('success', 'Position has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Position  $position
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Position $position) {
		if (Gate::allows('Position.Destroy')) {
			$position->delete();
			return redirect('position')->with('success', 'Position has been deleted');
		}
		return back();
	}
}
