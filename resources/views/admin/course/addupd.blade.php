@extends('admin.frame_form')

@if (!isset($course))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '课程')

@section('enctype', 'multipart/form-data')

@section('form_content')
	<tr>
		<td class="txt-right width-20p"><i>*</i>课程名称：</td>
		<td class="txt-left">
			<input type="text" style="width: 350px;" maxlength="50" placeholder="请输入小于50个字符" name="name" value="{{ old('name') ? old('name') : (isset($course->name) ? $course->name : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('name') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">可报人数：</td>
		<td class="txt-left">
			<input type="number" min="1" max="10000" name="user_num" value="{{ old('user_num') ? old('user_num') : (isset($course->user_num) ? $course->user_num : '') }}" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('user_num') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">课程开始日期：</td>
		<td class="txt-left">
			<input type="date" name="start_date" value="{{ old('start_date') ? old('start_date') : (isset($course->start_date) ? $course->start_date : '') }}" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('start_date') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">课程结束日期：</td>
		<td class="txt-left">
			<input type="date" name="end_date" value="{{ old('end_date') ? old('end_date') : (isset($course->end_date) ? $course->end_date : '') }}" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('end_date') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>上课地点：</td>
		<td class="txt-left">
			<textarea rows="2" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="address" required="required">{{ old('address') ? old('address') : (isset($course->address) ? $course->address : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('address') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">
			<i>*</i>课程关键词：
			<br/><span class="red">(请用<strong>英文逗号</strong>分隔)</span>
		</td>
		<td class="txt-left">
			<textarea rows="2" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="keywords" required="required">{{ old('keywords') ? old('keywords') : (isset($course->keywords) ? $course->keywords : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('keywords') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>课程简介：</td>
		<td class="txt-left">
			<textarea rows="5" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="description" required="required">{{ old('description') ? old('description') : (isset($course->description) ? $course->description : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('description') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>所属菜单：</td>
		<td class="txt-left">
			@foreach ($menus as $menu)
				@if (isset($course) && in_array($menu->id, $course->belong))
					<input type="checkbox" id="menu{{ $loop->index }}" name="belong[]" value="{{ $menu->id }}" checked="checked" />
				@else
					<input type="checkbox" id="menu{{ $loop->index }}" name="belong[]" value="{{ $menu->id }}" />
				@endif

				<label for="menu{{ $loop->index }}">{{ $menu->name }}</label>
			@endforeach
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('belong') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">
			<i>*</i>课程介绍：
			@include('admin.editor_remark')
		</td>
		<td class="txt-left">
			<script id="container" name="text" type="text/plain">
			    {!! old('text') ? old('text') : (isset($course->text) ? $course->text : '') !!}
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