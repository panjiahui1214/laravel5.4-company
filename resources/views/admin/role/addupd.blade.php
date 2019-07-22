@extends('admin.frame_form')

@if (!isset($role))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '角色')

@section('form_content')
	<tr>
		<td class="txt-right width-20p"><i>*</i>角色名称：</td>
		<td class="txt-left">
			<input type="text" maxlength="25" placeholder="请输入小于25个字符" name="name" value="{{ old('name') ? old('name') : (isset($role->name) ? $role->name : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('name') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>角色描述：</td>
		<td class="txt-left">
			<textarea rows="5" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="description" required="required">{{ old('description') ? old('description') : (isset($role->description) ? $role->description : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('description') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>拥有权限：</td>
		<td class="txt-left">
			@foreach ($menus as $menu)
				@if (isset($role) && in_array($menu->id, $role->menus_id))
					<input type="checkbox" id="menu{{ $loop->index }}" name="menus_id[]" value="{{ $menu->id }}" checked="checked" />
				@else
					<input type="checkbox" id="menu{{ $loop->index }}" name="menus_id[]" value="{{ $menu->id }}" />
				@endif

				<label for="menu{{ $loop->index }}">{{ $menu->name }}</label>	
			@endforeach
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('menu') }}</span>
		</td>
	</tr>
@stop