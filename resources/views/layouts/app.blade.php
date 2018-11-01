<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.head')
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">
	@include('layouts.header')
	@include('layouts.sidebar')
	@yield('main-content')
	@include('layouts.footer')
</div>
</body>
</html>