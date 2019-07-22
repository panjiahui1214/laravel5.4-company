@extends('admin.frame_form')

@if (!isset($admin))
	@section('action', '添加')
@else
	@section('action', '修改')
@endif

@if (isset($roles))
	@section('who', '管理员角色')
@else
	@section('who', '管理员密码')
@endif

@section('form_content')
	<tr>
		<td class="txt-right width-30p"><i>*</i>管理员账号：</td>
		<td class="txt-left">
			@if (!isset($admin))
				<input type="text" maxlength="25" placeholder="请输入小于25个字符" name="name" value="{{ old('name') ? old('name') : '' }}" required="required" />
				&nbsp;&nbsp;&nbsp;
				<span class="red">{{ $errors->first('name') }}</span>
			@else
				<input type="text" name="name" value="{{ $admin->name }}" disabled="disabled" />
			@endif
		</td>
	</tr>

	@if (!isset($admin) || isset($roles))
		<tr>
			<td class="txt-right"><i>*</i>对应角色：</td>
			<td class="txt-left">
				<select name="rid" style="width: 153px;" required="required">
					<option value = "">请选择</option>
					@foreach ($roles as $role)
						<option value="{{ $role->id }}">{{ $role->name }}</option>
					@endforeach
				</select>
			</td>
		</tr>
	@endif

	@if (!isset($admin) || !isset($roles))
	<tr>
		<td class="txt-right"><i>*</i>密码：</td>
		<td class="txt-left">
			<input type="password" maxlength="16" placeholder="请输入6-16个字符" name="password" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('password') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>确认密码：</td>
		<td class="txt-left">
			<input type="password" maxlength="16" placeholder="请再次输入密码" name="password_confirmation" required="required" />
		</td>
	</tr>
	@endif
@stop