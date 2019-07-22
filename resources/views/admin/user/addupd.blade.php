@extends('admin.frame_form')

@if (!isset($user))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '会员')

@section('form_content')
	<tr>
		<td class="txt-right width-30p"><i>*</i>会员账号：</td>
		<td class="txt-left">
			@if (!isset($user))
				<input type="text" maxlength="25" placeholder="请输入小于25个字符" name="name" value="{{ old('name') ? old('name') : '' }}" required="required" />
				&nbsp;&nbsp;&nbsp;
				<span class="red">{{ $errors->first('name') }}</span>
			@else
				<input type="text" name="name" value="{{ $user->name }}" disabled="disabled" />
			@endif
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>手机号码：</td>
		<td class="txt-left">
			<input type="text" maxlength="11" placeholder="请输入正确的手机号码" name="mobile" value="{{ old('mobile') ? old('mobile') : (isset($user->mobile) ? $user->mobile : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('mobile') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">电子邮箱：</td>
		<td class="txt-left">
			<input type="text" placeholder="请输入正确的电子邮箱" name="email" value="{{ old('email') ? old('email') : (isset($user->email) ? $user->email : '') }}" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('email') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">备注：</td>
		<td class="txt-left">
			<input type="text" maxlength="50" placeholder="请输入小于50个字符" name="remark" value="{{ old('remark') ? old('remark') : (isset($user->remark) ? $user->remark : '') }}" style="width: 450px;" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('remark') }}</span>
		</td>
	</tr>
@stop