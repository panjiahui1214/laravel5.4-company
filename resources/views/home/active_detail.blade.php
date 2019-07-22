@extends('home.frame')

@section('title', $model_data->name.'_活动详情')
@section('keywords', $model_data->name)
@section('description', $model_data->name)

@section('img', $menu->img)
@section('curr_title', '活动详情')
@section('curr_ename', 'Activity Detail')
@section('menu', $menu->name)
@section('menu_href', $menu->href)
@section('menu_up', $menu_up->name)
@section('menu_up_href', $menu_up->href)

@section('content')
		<div class="active-detail">
			<p class="margin-b30 active-title">
				{{ $model_data->name }}——{{ $model_data->theme->name }}
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
				@if ($model_data->start_time && $model_data->end_time)
					<tr>
						<td>
							<span>开始时间：</span>
						</td>
						<td>{{ $model_data->start_time }}</td>
					</tr>
					<tr>
						<td>
							<span>结束时间：</span>
						</td>
						<td>{{ $model_data->end_time }}</td>
					</tr>
				@else
					<tr>
						<td>
							<span>活动时间：</span>
						</td>
						<td>长期有效</td>
					</tr>
				@endif
				<tr>
					<td valign="top">
						<span>活动地点：</span>
					</td>
					<td><pre>{{ $model_data->address }}</pre></td>
				</tr>
				<tr>
					<td valign="top">
						<span>活动介绍：</span>
					</td>
					<td>{!! $model_data->text !!}</td>
				</tr>
				@if ( !$model_data->end_time || strtotime( date('Y-m-d H:i:s', time() ) ) < strtotime( $model_data->end_time ) )
					<tr>
						<td colspan="2" class="txt-center padding-t30">
	                    	<a href="{{ '/active/'.$model_data->id.'/register' }}">
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