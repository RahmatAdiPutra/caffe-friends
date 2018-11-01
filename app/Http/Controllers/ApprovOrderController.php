<?php

namespace App\Http\Controllers;

use App\Models\ApprovOrder;
use App\Models\Employee;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApprovOrderController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:ApprovOrder.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$approvOrders = ApprovOrder::all();
		return view('approvOrder.index', compact('approvOrders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('ApprovOrder.Create')) {
			$orders = Order::all();
			$employees = Employee::all();
			return view('approvOrder.create', compact('orders', 'employees'));
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, ApprovOrder $approvOrder) {
		request()->validate([
			'order_id' => ['required'],
			'employee_id' => ['required'],
		]);
		$approvOrder->create(request(['order_id', 'employee_id']));
		return redirect('approvOrder')->with('success', 'Approv order has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\ApprovOrder  $approvOrder
	 * @return \Illuminate\Http\Response
	 */
	public function show(ApprovOrder $approvOrder) {
		return view('approvOrder.show', compact('approvOrder'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\ApprovOrder  $approvOrder
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ApprovOrder $approvOrder) {
		if (Gate::allows('ApprovOrder.Edit')) {
			$orders = Order::all();
			$employees = Employee::all();
			return view('approvOrder.edit', compact('approvOrder', 'orders', 'employees'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\ApprovOrder  $approvOrder
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ApprovOrder $approvOrder) {
		request()->validate([
			'order_id' => ['required'],
			'employee_id' => ['required'],
		]);
		$approvOrder->update(request(['order_id', 'employee_id']));
		return redirect('approvOrder')->with('success', 'Approv order has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\ApprovOrder  $approvOrder
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ApprovOrder $approvOrder) {
		if (Gate::allows('ApprovOrder.Destroy')) {
			$approvOrder->delete();
			return redirect('approvOrder')->with('success', 'Approv order has been deleted');
		}
		return back();
	}
}
