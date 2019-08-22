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
				@if($errors->has('purchase_code'))
					{{$errors->first('purchase_code')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">App Name</label>
				<input type="text" name="app_name" class="form-control" placeholder="Application Name">
				@if($errors->has('app_name'))
					{{$errors->first('app_name')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">App Url</label>
				<input type="text" name="app_url" class="form-control" placeholder="Application URL">
				@if($errors->has('app_url'))
					{{$errors->first('app_url')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Host</label>
				<input type="text" name="host" value="localhost" class="form-control" placeholder="DB Host">
				@if($errors->has('host'))
					{{$errors->first('host')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">DB User</label>
				<input type="text" name="db_username" class="form-control" placeholder="DB User">
				@if($errors->has('db_username'))
					{{$errors->first('db_username')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">DB Name</label>
				<input type="text" name="db_name" class="form-control" placeholder="DB Name">
				@if($errors->has('db_name'))
					{{$errors->first('db_name')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">DB Password</label>
				<input type="text" name="db_password" class="form-control" placeholder="DB Password">
				@if($errors->has('db_password'))
					{{$errors->first('db_password')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Admin Name</label>
				<input type="text" name="name" class="form-control" placeholder="Admin E-Mail">
				@if($errors->has('name'))
					{{$errors->first('name')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Admin E-Mail</label>
				<input type="text" name="email" class="form-control" placeholder="Admin E-Mail">
				@if($errors->has('email'))
					{{$errors->first('email')}}
				@endif
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Admin Password</label>
				<input type="text" name="password" class="form-control" placeholder="Admin Password">
				@if($errors->has('password'))
					{{$errors->first('password')}}
				@endif
			</div>
			<button type="submit" class="btn btn-primary">Install</button>
		</form>
	</div>
</div>
@stop
