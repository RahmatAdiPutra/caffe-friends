@extends('layouts.app')
@section('title','Show Employee')
@section('content')
<h1>Person in Charge</h1>
<ul>
	<li>
		<a href="{{ url('/employee/picDetailItem/'.$employee['id']) }}">Detail Items</a>
	</li>
</ul>
@endsection