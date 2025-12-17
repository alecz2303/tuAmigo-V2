<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
		@section('title')
			{{{ $title }}} :: Administration
		@show
	</title>

	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- This is the traditional favicon.
	 - size: 16x16 or 32x32
	 - transparency is OK
	 - see wikipedia for info on browser support: http://mky.be/favicon/ -->
	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('css/foundation.min.css')}}">
    <script src="{{asset('js/vendor/modernizr.js')}}"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/1.0.1/css/dataTables.responsive.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/colorbox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/foundation/dataTables.foundation.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.tablesTools.css')}}">

	<style>
	.tab-pane {
		padding-top: 20px;
	}
	</style>

	@yield('styles')

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->


</head>

<body>
	<!-- Container -->
	<div class="wrap">
	<div class="container">

		<!-- Notifications -->
		@include('notifications')
		<!-- ./ notifications -->

		<div class="page-header">
			<h3>
				{{ $title }}
				<div class="pull-right">
					<button class="button small close_popup"><span class="fa fa-arrow-circle-left"></span> Atras</button>
				</div>
			</h3>
			<hr>
		</div>

		<!-- Content -->
		@yield('content')
		<!-- ./ content -->

		<!-- Footer -->
		<footer class="clearfix">
			@yield('footer')
		</footer>
		<!-- ./ Footer -->

	</div>
	</div>
	<!-- ./ container -->

	<!-- Javascripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>
	<script src="{{asset('js/dataTables.tableTools.js')}}"></script>
    <script src="{{asset('js/jquery.colorbox.js')}}"></script>
    <script src="{{asset('js/foundation.min.js')}}"></script>
    <script src="{{asset('js/foundation/foundation.tooltip.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>

 <script type="text/javascript">
$(document).ready(function(){
	$('.close_popup').click(function(){
		if(parent.table)
			parent.table.ajax.reload();
		parent.jQuery.fn.colorbox.close();
		return false;
	});
	$('#deleteForm').submit(function(event) {
		var form = $(this);
		$.ajax({
		type: form.attr('method'),
		url: form.attr('action'),
		data: form.serialize()
		}).done(function() {
		parent.jQuery.colorbox.close();
		parent.table.ajax.reload();
		}).fail(function() {
		});
		event.preventDefault();
	});
});
</script>
<script>
	$(document).foundation();
</script>
    @yield('scripts')
</body>

</html>
