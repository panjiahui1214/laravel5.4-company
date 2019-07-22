@extends('home.frame')

@section('title', $model_data->name.'_课程详情')
@section('keywords', $model_data->keywords)
@section('description', $model_data->description)

@section('img', $menu->img)
@section('curr_title', '课程详情')
@section('curr_ename', 'Course Details')
@section('menu', $menu->name)
@section('menu_href', $menu->href)
@section('menu_up', $menu_up->name)
@section('menu_up_href', $menu_up->href)


@section('content')
		<div class="active-detail">
			<p class="margin-b30 active-title">
				{{ $model_data->name }}
			</p>
			
			<table class="margin-b60">
				<tr>
					<td class="width-100">
						<span>可报人数：</span>
					</td>
					<td>
						@if ($num = $model_data->user_num)
							{{ $num }}人
						@else
							不限
						@endif
					</td>
				</tr>
				@if ($model_data->start_date && $model_data->end_date)
					<tr>
						<td>
							<span>开始日期：</span>
						</td>
						<td>{{ $model_data->start_date }}</td>
					</tr>
					<tr>
						<td>
							<span>结束日期：</span>
						</td>
						<td>{{ $model_data->end_date }}</td>
					</tr>
				@else
					<tr>
						<td>
							<span>课程日期：</span>
						</td>
						<td>长期开展</td>
					</tr>
				@endif
				<tr>
					<td valign="top">
						<span>上课地点：</span>
					</td>
					<td><pre>{{ $model_data->address }}</pre></td>
				</tr>
				<tr>
					<td valign="top">
						<span>课程介绍：</span>
					</td>
					<td>{!! $model_data->text !!}</td>
				</tr>
				@if (!$model_data->end_time || strtotime(date('Y-m-d', time())) < strtotime($model_data->end_time))
					<tr>
						<td colspan="2" class="txt-center padding-t30">
	                    	<a href="{{ '/course/'.$model_data->id.'/register' }}">
	                    		<span class="see-more3">
	                    			<i class="am-icon-angle-double-right"></i>
	                    			立即报名
	                    		</span>
	                    	</a>
						</td>
					</tr>
				@endif
			</table>

		</div>
@stop