@extends('platform-creator::master')
@section('content')
<div class="card">
	<div class="card-header">
		Welcome!
	</div>
	<div class="card-body">
		<p>Welcome! You have to set your purchase key for the license verification.</p>
		@if(session('error-message'))
		<div class="alert alert-danger" role="alert">
			{{session('error-message')}}
		</div>
		@endif
		<form action="{{route('installer::create')}}" method="POST">
			@csrf
			<div class="form-group">
				<label for="exampleInputEmail1">Purchase Code</label>
				<input type="text" name="purchase_code" class="form-control" placeholder="Purchase Code">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">App Name</label>
				<input type="text" name="app_name" class="form-control" placeholder="DB User">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">App Url</label>
				<input type="text" name="app_url" class="form-control" placeholder="DB User">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Host</label>
				<input type="text" name="host" class="form-control" placeholder="DB User">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">DB User</label>
				<input type="text" name="db_username" class="form-control" placeholder="DB User">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">DB Name</label>
				<input type="text" name="db_name" class="form-control" placeholder="DB Name">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">DB Password</label>
				<input type="text" name="db_password" class="form-control" placeholder="DB Password">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Admin Name</label>
				<input type="text" name="name" class="form-control" placeholder="Admin E-Mail">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Admin E-Mail</label>
				<input type="text" name="email" class="form-control" placeholder="Admin E-Mail">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Admin Password</label>
				<input type="text" name="password" class="form-control" placeholder="Admin Password">
			</div>
			<button type="submit" class="btn btn-primary">Install</button>
		</form>
	</div>
</div>
@stop
