<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" type="image/png" href="{{ asset('img/logo.png')}}" />

	
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<title>@yield('title', 'Nueva Casa Maya')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/base.css') }}">
	<link rel="stylesheet" media="scren and (min-width:100px) and (max-width:500px)" type="text/css" href="{{ asset('css/movil.css') }}">
	<link rel="stylesheet" media="screen and (min-width:500px) and (max-width:800px)" type="text/css" href="{{ asset('css/tablet.css') }}">
	<link rel="stylesheet" media="screen and (min-width:800px) and (max-width: 1500px)" type="text/css" href="{{ asset('css/pc.css') }}">
	
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery.tablesorter.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/efectos.js') }}"></script>
	@yield('autocomplete')

</body>
	
</head>
</head>
<body>
	@include('header')
	<section id="principal">
		@yield('contenido')
	</section>
	@yield('aside')
	@include('footer')
</body>
</html>