<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:employee');
		$this->middleware('can:Member.*');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$members = Member::all();
		return view('member.index', compact('members'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		if (Gate::allows('Member.Create')) {
			return view('member.create');
		}
		return back();
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, Member $member) {
		request()->validate([
			'name' => ['required', 'min:5'],
			'email' => ['required', 'email'],
			'password' => ['required', 'min:5'],
		]);
		$member->create([
			'name' => request('name'),
			'email' => request('email'),
			'password' => Hash::make(request('password')),
		]);
		return redirect('member')->with('success', 'Member has been added');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Member  $member
	 * @return \Illuminate\Http\Response
	 */
	public function show(Member $member) {
		return view('member.show', compact('member'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Member  $member
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Member $member) {
		if (Gate::allows('Member.Edit')) {
			return view('member.edit', compact('member'));
		}
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Member  $member
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Member $member) {
		request()->validate([
			'name' => ['required', 'min:5'],
			'email' => ['required', 'email'],
		]);
		$member->update(request(['name', 'email']));
		return redirect('member')->with('success', 'Member has been updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Member  $member
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Member $member) {
		if (Gate::allows('Member.Destroy')) {
			$member->delete();
			return redirect('member')->with('success', 'Member has been deleted');
		}
		return back();
	}
}
