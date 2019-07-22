@extends('home.frame')

@section('title', $model_data->title.'_'.$menu->name)
@section('keywords', $model_data->keywords)
@section('description', $model_data->txt)

@section('img', $menu->img)
@section('curr_title', $menu->name)
@section('curr_ename', $menu->ename2)
@section('menu', $menu->name)
@section('menu_href', $menu->href)
@section('menu_up', $menu_up->name)
@section('menu_up_href', $menu_up->href)

@section('content')
	<div class="am-container-1 margin-t30">
		<div class="words-title">
			<span>{{ $model_data->title }}</span>
			<p>{{ $model_data->created_at }}</p>
		</div>
	</div>
			
	<div class="solution-inform">
		<div class="solution-inform-content-all">
			<div class="solution-inform-content">
				{!! $model_data->text !!}
			</div>
		</div>
	</div>
@stop