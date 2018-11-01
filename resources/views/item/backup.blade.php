@extends('layouts.app')
@section('title','Show Item')
@section('content')
<h1>{{ $item->name }}</h1>
<div>
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Item</th>
			<th>Available</th>
			<th>Date</th>
			<th>PIC</th>
		</tr>
		@if ($item->detailItems->count())
			@foreach ($item->detailItems as $detailItem)
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