@extends('layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
	      Role
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
	            <h3 class="box-title">Edit Role</h3>
	          </div>

	          @include('layouts.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form method="POST" action="{{ route('role.update', $role->id) }}">
				@method('PATCH')
		        @csrf
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Role Title</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Role Title" value="{{ empty(old('name')) ? $role->name : old('name') }}">
	              </div>

	              <div class="form-group">
	                <label for="permission_id">Permission</label>
	                @foreach ($permissions as $permission)
	                <div class="checkbox">
					<input type="checkbox" id="permission_id" name="permission_id[]" value="{{ $permission->id }}"
						@foreach ($role->permissions as $rolePermission)
							@if ($rolePermission->id == $permission->id)
								checked
							@endif
						@endforeach>{{ $permission->name }}
					</div>
					@endforeach
	              </div>

	              <div class="form-group">
	              	<button type="submit" class="btn btn-primary">Save</button>
	              	<a href='{{ url('/role') }}' class="btn btn-warning">Back</a>
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