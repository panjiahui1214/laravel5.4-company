@extends('admin.frame_form')

@if (!isset($activesTheme))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '活动主题')

@section('form_content')
	<tr>
		<td class="txt-right width-30p"><i>*</i>活动主题名称：</td>
		<td class="txt-left">
			<input type="text" maxlength="25" placeholder="请输入小于25个字符" name="name" value="{{ old('name') ? old('name') : (isset($activesTheme->name) ? $activesTheme->name : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('name') }}</span>
		</td>
	</tr>
@stop