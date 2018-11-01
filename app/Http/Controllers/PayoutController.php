<?php

namespace App\Http\Controllers;

use App\Models\ApprovOrder;
use App\Models\Employee;
use App\Models\Payout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PayoutController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Payout.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$payouts = Payout::all();
		return view('payout.index', compact('payouts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Payout.Create')) {
			$approvOrders = ApprovOrder::all();
			$employees = Employee::all();
			return view('payout.create', compact('approvOrders', 'employees'));
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Payout $payout) {
		request()->validate([
			'approv_order_id' => ['required'],
			'employee_id' => ['required'],
		]);
		$payout->create(request(['approv_order_id', 'employee_id']));
		return redirect('payout')->with('success', 'Payout has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Payout  $payout
	 * @return \Illuminate\Http\Response
	 */
	public function show(Payout $payout) {
		return view('payout.show', compact('payout'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Payout  $payout
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Payout $payout) {
		if (Gate::allows('Payout.Edit')) {
			$approvOrders = ApprovOrder::all();
			$employees = Employee::all();
			return view('payout.edit', compact('payout', 'approvOrders', 'employees'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Payout  $payout
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Payout $payout) {
		request()->validate([
			'approv_order_id' => ['required'],
			'employee_id' => ['required'],
		]);
		$payout->update(request(['approv_order_id', 'employee_id']));
		return redirect('payout')->with('success', 'Payout has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Payout  $payout
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Payout $payout) {
		if (Gate::allows('Payout.Destroy')) {
			$payout->delete();
			return redirect('payout')->with('success', 'Payout has been deleted');
		}
		return back();
	}
}
