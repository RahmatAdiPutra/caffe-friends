@extends('layouts.app')

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
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Edit Order</h3>
	          </div>

	          @include('layouts.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form method="POST" action="{{ url('/order/'.$order['id']) }}">
				@method('PATCH')
		        @csrf
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
				  <div class="form-group">
	                <label for="member_id">Member</label>
	                <select class="form-control" id="member_id" name="member_id">
						@foreach ($members as $member)
						<option value="{{ $member->id }}" {{ ( $order->member_id == $member->id ) ? 'selected' : '' }}>{{ $member->name }}</option>
						@endforeach
					</select>
	              </div>

	              <div class="form-group">
	                <label for="table">Table</label>
	                <input type="text" class="form-control" id="table" name="table" placeholder="Table" value="{{ empty(old('table')) ? $order->table : old('table') }}">
	              </div>

	              <div class="form-group">
	              	<button type="submit" class="btn btn-primary">Save</button>
	              	<a href='{{ url('/order') }}' class="btn btn-warning">Back</a>
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