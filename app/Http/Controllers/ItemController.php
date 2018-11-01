<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ItemController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Item.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$items = Item::all();
		return view('item.index', compact('items'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Item.Create')) {
			return view('item.create');
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Item $item) {
		request()->validate([
			'name' => ['required', 'min:5'],
			'type' => ['required'],
			'price' => ['required'],
			'description' => ['required', 'min:5'],
		]);
		$item->create(request(['name', 'type', 'price', 'description']));
		return redirect('item')->with('success', 'Item has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Item  $item
	 * @return \Illuminate\Http\Response
	 */
	public function show(Item $item) {
		return view('item.show', compact('item'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Item  $item
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Item $item) {
		if (Gate::allows('Item.Edit')) {
			return view('item.edit', compact('item'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Item  $item
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Item $item) {
		request()->validate([
			'name' => ['required', 'min:5'],
			'type' => ['required'],
			'price' => ['required'],
			'description' => ['required', 'min:5'],
		]);
		$item->update(request(['name', 'type', 'price', 'description']));
		return redirect('item')->with('success', 'Item has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Item  $item
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Item $item) {
		if (Gate::allows('Item.Destroy')) {
			$item->delete();
			return redirect('item')->with('success', 'Item has been deleted');
		}
		return back();
	}
}
