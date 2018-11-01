<?php

namespace App\Http\Controllers;

use App\Models\DetailItem;
use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DetailOrderController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:DetailOrder.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$detailOrders = DetailOrder::all();
		return view('detailOrder.index', compact('detailOrders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('DetailOrder.Create')) {
			$orders = Order::all();
			$detailItems = DetailItem::all();
			return view('detailOrder.create', compact('orders', 'detailItems'));
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, DetailOrder $detailOrder) {
		request()->validate([
			'quantity' => ['required'],
			'order_id' => ['required'],
			'detail_item_id' => ['required'],
		]);
		$detailOrder->create(request(['quantity', 'order_id', 'detail_item_id']));
		return redirect('detailOrder')->with('success', 'Detail order has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\DetailOrder  $detailOrder
	 * @return \Illuminate\Http\Response
	 */
	public function show(DetailOrder $detailOrder) {
		return view('detailOrder.show', compact('detailOrder'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\DetailOrder  $detailOrder
	 * @return \Illuminate\Http\Response
	 */
	public function edit(DetailOrder $detailOrder) {
		if (Gate::allows('DetailOrder.Edit')) {
			$orders = Order::all();
			$detailItems = DetailItem::all();
			return view('detailOrder.edit', compact('detailOrder', 'orders', 'detailItems'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\DetailOrder  $detailOrder
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, DetailOrder $detailOrder) {
		request()->validate([
			'quantity' => ['required'],
			'order_id' => ['required'],
			'detail_item_id' => ['required'],
		]);
		$detailOrder->update(request(['quantity', 'order_id', 'detail_item_id']));
		return redirect('detailOrder')->with('success', 'Detail order has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\DetailOrder  $detailOrder
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(DetailOrder $detailOrder) {
		if (Gate::allows('DetailOrder.Destroy')) {
			$detailOrder->delete();
			return redirect('detailOrder')->with('success', 'Detail order has been deleted');
		}
		return back();
	}
}
