@extends('errors.error')

@section('meta')
	<meta http-equiv="Refresh" content="10;{{ url('/') }}" />
@stop

@section('code', '404')

@section('text')
    <p>非常抱歉！您进入了错误的页面</p>
    <p>此页面将在5秒内跳转到博锐恩首页</p>
    <p>如果5秒后仍然停留在此页面，麻烦手动<a href="{{ url('/') }}">->点击此处</a>跳转博锐恩首页</p>
@stop