@extends('layouts.default')

@section('content')

	

	<div id="output" style="margin: 10px;"></div>

	

@stop

@section('scripts')

<script src="{{asset('js/pivot/jquery-1.8.3.min.js')}}"></script>
        <script src="{{asset('js/pivot/jquery-ui-1.9.2.custom.min.js')}}"></script>

        <script type="text/javascript" src="{{ asset('js/pivot/pivot.js') }}"></script>

	<script type="text/javascript">
		$(function(){
      var derivers = $.pivotUtilities.derivers;
      $.getJSON("{{ URL::to('app/unidades/pruebadata') }}", function(mps) {
          $("#output").pivotUI(mps, {
              derivedAttributes: {
                  
                  
              }
          });
      });
   });
	</script>
@stop