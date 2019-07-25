@extends('admin.frame_form')

@if (!isset($product))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '产品')

@section('enctype', 'multipart/form-data')

@section('form_content')
	<tr>
		<td class="txt-right width-20p"><i>*</i>产品名称：</td>
		<td class="txt-left">
			<input type="text" style="width: 350px;" maxlength="50" placeholder="请输入小于50个字符" name="name" value="{{ old('name') ? old('name') : (isset($product->name) ? $product->name : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('name') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>排序：</td>
		<td class="txt-left">
			<input type="number" min="1" max="50" name="sort" value="{{ old('sort') ? old('sort') : (isset($product->sort) ? $product->sort : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('sort') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>产品介绍：</td>
		<td class="txt-left">
			<textarea rows="5" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="txt" required="required">{{ old('txt') ? old('txt') : (isset($product->txt) ? $product->txt : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('txt') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>产品图片：</td>
		<td class="txt-left">
			@if (!isset($product))
				@include('admin.upload_image', ['action' => '上传', 'name' => 'image'])
			@else
				<img src="{{ asset($article->cover) }}" style="width: 198px; height: 148px;" />
				</br></br>
				@include('admin.upload_image', ['action' => '更换', 'name' => 'image'])
			@endif
		</td>
	</tr>
	<tr>
		<td class="txt-right">购买地址：</td>
		<td class="txt-left">
			<textarea rows="2" cols="60" maxlength="100" placeholder="请输入小于100个字符" name="href">{{ old('href') ? old('href') : (isset($product->href) ? $product->href : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('href') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>所属菜单：</td>
		<td class="txt-left">
			@foreach ($menus as $menu)
				@if (isset($product) && in_array($menu->id, $product->belong))
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
@stop
