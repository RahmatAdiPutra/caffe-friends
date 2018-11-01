@extends('layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Approv Order
	      <small>Caffe Friends</small>
	    </h1>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Edit Approv Order</h3>
	          </div>

	          @include('layouts.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form method="POST" action="{{ url('/approvOrder/'.$approvOrder['id']) }}">
				@method('PATCH')
		        @csrf
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">

	              <div class="form-group">
	                <label for="order_id">Order</label>
	                <select class="form-control" id="order_id" name="order_id">
						@foreach ($orders as $order)
						<option value="{{ $order->id }}" {{ ( $approvOrder->order_id == $order->id ) ? 'selected' : '' }}>{{ $order->id.' '.$order->member->name }}</option>
						@endforeach
					</select>
	              </div>

	              <div class="form-group">
	                <label for="employee_id">PIC</label>
	                <select class="form-control" id="employee_id" name="employee_id">
						@foreach ($employees as $employee)
						<option value="{{ $employee->id }}" {{ ( $approvOrder->employee_id == $employee->id ) ? 'selected' : '' }}>{{ $employee->name }}</option>
						@endforeach
					</select>
	              </div>

	              <div class="form-group">
	              	<button type="submit" class="btn btn-primary">Save</button>
	              	<a href='{{ url('/approvOrder') }}' class="btn btn-warning">Back</a>
	              </div>

	            </div>

				</div>

	          </form>
	        </div>
	        <!-- /.box -->


	      </div>
	      <!-- /.col-->
	    </div>
	    <!-- ./row -->
	  </section>
	  <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
@endsection