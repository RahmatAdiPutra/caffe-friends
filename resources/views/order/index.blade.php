@extends('layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Order
      <small>Caffe Friends</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        @can ('Order.Create')
		<a class='btn btn-success' href="{{ url('/order/create') }}">Add Order</a>
		@endcan
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Data Order</h3>
                    </div>
                    @include('layouts.messages')
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
						<th>Name</th>
			<th>Table</th>
			<th>Date</th>
                          @can ('Order.Edit')
							<th>Edit</th>
							@endcan
							@can ('Order.Destroy')
							<th>Delete</th>
							@endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
		<tr>
			<td>{{ $loop->index + 1 }}</td>
			<td>{{ $order->member->name }}</td>
			<td>{{ $order->table }}</td>
			<td>{{ $order->created_at }}</td>
			@can ('Order.Edit')
			<td><a href="{{ url('/order/'.$order['id'].'/edit') }}"><span class="glyphicon glyphicon-edit"></span></a></td>
			@endcan
			@can ('Order.Destroy')
			<td>
				<form id="delete-form-{{ $order->id }}" method="POST" action="{{ url('/order/'.$order['id']) }}" style="display: none">
		            @method('DELETE')
		            @csrf
		        </form>
		        <a href="" onclick="
		        	if(confirm('Are you sure, You Want to delete {{ $order->member->name }}?')) {
		        		event.preventDefault();
		        		document.getElementById('delete-form-{{ $order->id }}').submit();
                    } else {
                    	event.preventDefault();
                    }"><span class="glyphicon glyphicon-trash"></span></a>
			</td>
			@endcan
		</tr>
		@endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>No</th>
						<th>Name</th>
			<th>Table</th>
			<th>Date</th>
                          @can ('Order.Edit')
							<th>Edit</th>
							@endcan
							@can ('Order.Destroy')
							<th>Delete</th>
							@endcan
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">

      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection