@extends('admin.frame')

@section('content')
	<div class="btn-add">
		@yield('content_btn')
	</div>

	<div class="div-table">
		<table class="table-all table-blue">
            @yield('table_data')
        </table>
            
        <div class="render">
            @yield('render_data')
        </div>
	</div>
@stop