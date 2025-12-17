@extends('layouts.default')
@section('content')
	<div class="row">
		<div class="large-4 columns">
			<img src="{{ asset('images/logota.jpg') }}" alt="">
		</div>
		<div class="large-8 columns mio">
			{{ Confide::makeLoginForm()->render() }}
		</div>
	</div>
@stop