<!DOCTYPE html>
<html lang="en" data-ng-app="Application">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/all.css') }}" rel="stylesheet">

</head>
<body>

    @include('flash::message')
    @include('partials.nav')
	@yield('content')

	<!-- Scripts -->
   <script  type="text/javascript" src="{{ url('/js/all.js') }}"></script>
   <script src="{{url('/js/libs/ckeditor/ckeditor.js')}}"></script>
   <script  type="text/javascript" src="{{ url('/js/application.js') }}"></script>
</body>
</html>
