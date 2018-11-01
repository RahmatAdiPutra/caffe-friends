<?php

namespace App\Http\Controllers;

use App\Models\DetailItem;
use App\Models\Employee;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DetailItemController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:DetailItem.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$detailItems = DetailItem::all();
		return view('detailItem.index', compact('detailItems'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('DetailItem.Create')) {
			$items = Item::all('id', 'name');
			$employees = Employee::all('id', 'name');
			return view('detailItem.create', compact('items', 'employees'));
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, DetailItem $detailItem) {
		request()->validate([
			'available' => ['required'],
			'item_id' => ['required'],
			'employee_id' => ['required'],
		]);
		$detailItem->create(request(['available', 'item_id', 'employee_id']));
		return redirect('detailItem')->with('success', 'Detail Item has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\DetailItem  $detailItem
	 * @return \Illuminate\Http\Response
	 */
	public function show(DetailItem $detailItem) {
		return view('detailItem.show', compact('detailItem'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\DetailItem  $detailItem
	 * @return \Illuminate\Http\Response
	 */
	public function edit(DetailItem $detailItem) {
		if (Gate::allows('DetailItem.Edit')) {
			$items = Item::all('id', 'name');
			$employees = Employee::all('id', 'name');
			return view('detailItem.edit', compact('detailItem', 'items', 'employees'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\DetailItem  $detailItem
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, DetailItem $detailItem) {
		request()->validate([
			'available' => ['required'],
			'item_id' => ['required'],
			'employee_id' => ['required'],
		]);
		$detailItem->update(request(['available', 'item_id', 'employee_id']));
		return redirect('detailItem')->with('success', 'Detail Item has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\DetailItem  $detailItem
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(DetailItem $detailItem) {
		if (Gate::allows('DetailItem.Destroy')) {
			$detailItem->delete();
			return redirect('detailItem')->with('success', 'Detail Item has been deleted');
		}
		return back();
	}
}
