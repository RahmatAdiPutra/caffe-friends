@extends('layouts.app')

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
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Add Item</h3>
	          </div>

	          @include('layouts.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form method="POST" action="{{ url('/item/'.$item['id']) }}">
				@method('PATCH')
		        @csrf
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Item Name</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Item Name" value="{{ empty(old('name')) ? $item->name : old('name') }}">
	              </div>

	              <div class="form-group">
	                <label for="type">Type</label>
	                <select class="form-control" id="type" name="type">
						<option value="Food" {{ ( 'Food' == $item->type ) ? 'selected' : '' }}>Food</option>
						<option value="Drink" {{ ( 'Drink' == $item->type ) ? 'selected' : '' }}>Drink</option>
						<option value="Snacks" {{ ( 'Snacks' == $item->type ) ? 'selected' : '' }}>Snacks</option>
					</select>
	              </div>

	              <div class="form-group">
	                <label for="price">Price</label>
	                <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="{{ empty(old('price')) ? $item->price : old('price') }}">
	              </div>

	              <div class="form-group">
	              	<label for="description" >Description</label>
	                <textarea class="form-control" rows="3" id="description" name="description" placeholder="Description ...">{{ empty(old('description')) ? $item->description : old('description') }}</textarea>
	              </div>

	              <div class="form-group">
	              	<button type="submit" class="btn btn-primary">Save</button>
	              	<a href='{{ url('/item') }}' class="btn btn-warning">Back</a>
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