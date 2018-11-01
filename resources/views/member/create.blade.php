@extends('layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Member
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
	            <h3 class="box-title">Add Member</h3>
	          </div>

	          @include('layouts.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form method="POST" action="{{ url('/member') }}">
				@csrf
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Member Name</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Member Name" value="{{ old('name') }}">
	              </div>

	              <div class="form-group">
	                <label for="email">Email</label>
	                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
	              </div>


	              <div class="form-group">
	                <label for="password">Password</label>
	                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}">
	              </div>

	              <div class="form-group">
	              	<button type="submit" class="btn btn-primary">Save</button>
	              	<a href='{{ url('/member') }}' class="btn btn-warning">Back</a>
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