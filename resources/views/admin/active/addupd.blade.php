@extends('admin.frame_form')

@if (!isset($active))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '活动')

@section('form_menu')
	<div class="btn-add">
		<a href="{{ route('active', ['tid' => $activesTheme->id]) }}">返回</a>
		<a>主题：{{ $activesTheme->name }}</a>
	</div>
@stop

@section('form_content')
	<tr>
		<td class="txt-right width-20p"><i>*</i>活动名称：</td>
		<td class="txt-left">
			<input type="text" style="width: 350px;" maxlength="50" placeholder="请输入小于50个字符" name="name" value="{{ old('name') ? old('name') : (isset($active->name) ? $active->name : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('name') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">可报人数：</td>
		<td class="txt-left">
			<input type="number" min="1" max="10000" name="user_num" value="{{ old('user_num') ? old('user_num') : (isset($active->user_num) ? $active->user_num : '') }}" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('user_num') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">活动开始时间：</td>
		<td class="txt-left">
			<input type="datetime-local" name="start_time" value="{{ old('start_time') ? old('start_time') : (isset($active->start_time) ? $active->start_time : '') }}" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('start_time') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">活动结束时间：</td>
		<td class="txt-left">
			<input type="datetime-local" name="end_time" value="{{ old('end_time') ? old('end_time') : (isset($active->end_time) ? $active->end_time : '') }}" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('end_time') }}</span>
		</td>
	</tr>				
	<tr>
		<td class="txt-right"><i>*</i>活动地点：</td>
		<td class="txt-left">
			<textarea rows="2" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="address" required="required">{{ old('address') ? old('address') : (isset($active->address) ? $active->address : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('address') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">
			<i>*</i>活动介绍：
			@include('admin.editor_remark')
		</td>
		<td class="txt-left">
			<script id="container" name="text" type="text/plain">
			    {!! old('text') ? old('text') : (isset($active->text) ? $active->text : '') !!}
			</script>
		</td>
	</tr>
@stop

@section('javascript')
	@include('UEditor::head')

	<!-- 实例化编辑器 -->
	<script type="text/javascript">
		var ue = UE.getEditor('container');
		ue.ready(function() {
			ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
		});
	</script>
@stop