<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
	<title>Hello, world!</title>
	<style>
	body{
		background-color: #f9faff;
		margin: 0;
		font-family: "Open Sans",sans-serif;
		font-size: .9375rem;
		font-weight: 300;
		line-height: 1.9;
	}
	.installer{
		margin-top: 6rem;
	}
	.container{
		max-width: 470px;
	}
	label {
		display: inline-block;
		margin-bottom: -0.5rem;
		font-size: .875rem;
		font-weight: 600;
	}
	.card{
		display: block;
		background: #FFFFFF;
		box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.06);
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-transition: all 0.3s ease 0s;
		-moz-transition: all 0.3s ease 0s;
		-o-transition: all 0.3s ease 0s;
		transition: all 0.3s ease 0s;
		position: relative;
		border-color: transparent;
	}
	.card-header{
		background: transparent;
		border-color: transparent;
		font-weight: 400;
		font-size: 28px;
		color: #3B566E;
		letter-spacing: 1.75px;
		line-height: 38px;
	}
	</style>
</head>
<body>
	<div class="installer">
		<div class="container">
			@yield('content')
		</div>
	</div>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
