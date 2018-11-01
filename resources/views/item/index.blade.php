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
      Item
      <small>Caffe Friends</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        @can ('Item.Create')
		<a class='btn btn-success' href="{{ url('/item/create') }}">Add Item</a>
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
                      <h3 class="box-title">Data Item</h3>
                    </div>
                    @include('layouts.messages')
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
						<th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Description</th>
                          @can ('Item.Edit')
							<th>Edit</th>
							@endcan
							@can ('Item.Destroy')
							<th>Delete</th>
							@endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
		<tr>
			<td>{{ $loop->index + 1 }}</td>
			<td>{{ $item->name }}</td>
      <td>{{ $item->type }}</td>
      <td>{{ $item->price }}</td>
      <td>{{ $item->description }}</td>
			@can ('Item.Edit')
			<td><a href="{{ url('/item/'.$item['id'].'/edit') }}"><span class="glyphicon glyphicon-edit"></span></a></td>
			@endcan
			@can ('Item.Destroy')
			<td>
				<form id="delete-form-{{ $item->id }}" method="POST" action="{{ url('/item/'.$item['id']) }}" style="display: none">
		            @method('DELETE')
		            @csrf
		        </form>
		        <a href="" onclick="
		        	if(confirm('Are you sure, You Want to delete {{ $item->name }}?')) {
		        		event.preventDefault();
		        		document.getElementById('delete-form-{{ $item->id }}').submit();
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
            <th>Type</th>
            <th>Price</th>
            <th>Description</th>
                          @can ('Item.Edit')
							<th>Edit</th>
							@endcan
							@can ('Item.Destroy')
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