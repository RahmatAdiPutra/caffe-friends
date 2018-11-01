@extends('layouts.app')
@section('title','Show Position')
@section('content')
<h1>{{ $position->name }}</h1>
<div>
	<table border="1">
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Position</th>
			<th>Email</th>
		</tr>
		@if ($position->employees->count())
			@foreach ($position->employees as $employee)
			<tr>
				<td>{{ $loop->index + 1 }}</td>
				<td>{{ $employee->name }}</td>
				<td>{{ $employee->position->name }}</td>
				<td>{{ $employee->email }}</td>
			</tr>
			@endforeach
		@endif
	</table>
</div>
@endsection