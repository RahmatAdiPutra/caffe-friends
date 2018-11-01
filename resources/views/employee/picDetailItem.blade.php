@extends('layouts.app')
@section('title','Show PIC Detail Items')
@section('content')
<h1>Person in Charge {{ $employee->name }}</h1>
<div>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Item</th>
			<th>Available</th>
			<th>Date</th>
			<th>PIC</th>
		</tr>
		@if ($employee->detailItems->count())
			@foreach ($employee->detailItems as $detailItem)
			<tr>
				<td>{{ $detailItem->id }}</td>
				<td>{{ $detailItem->item->name }}</td>
				<td>{{ $detailItem->available }}</td>
				<td>{{ $detailItem->created_at }}</td>
				<td>{{ $detailItem->employee->name }}</td>
			</tr>
			@endforeach
		@endif
	</table>
</div>
@endsection