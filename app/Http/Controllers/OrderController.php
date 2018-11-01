<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Order.*');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$orders = Order::all();
		return view('order.index', compact('orders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Order.Create')) {
			$members = Member::all('id', 'name');
			return view('order.create', compact('members'));
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Order $order) {
		request()->validate([
			'table' => ['required', 'min:1', 'max:2'],
			'member_id' => ['required'],
		]);
		$order->create(request(['table', 'member_id']));
		return redirect('order')->with('success', 'Order has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function show(Order $order) {
		return view('order.show', compact('order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Order $order) {
		if (Gate::allows('Order.Edit')) {
			$members = Member::all('id', 'name');
			return view('order.edit', compact('order', 'members'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Order $order) {
		request()->validate([
			'table' => ['required', 'min:1', 'max:2'],
			'member_id' => ['required'],
		]);
		$order->update(request(['table', 'member_id']));
		return redirect('order')->with('success', 'Order has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Order $order) {
		if (Gate::allows('Order.Destroy')) {
			$order->delete();
			return redirect('order')->with('success', 'Order has been deleted');
		}
		return back();
	}
}
