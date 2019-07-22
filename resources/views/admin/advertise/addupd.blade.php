@extends('admin.frame_form')

@if (!isset($advertise))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '广告位')

@section('enctype', 'multipart/form-data')

@section('form_menu')
	<div class="btn-add">
		<a href="{{ route('adv', ['tpid' => $advertiseType->id]) }}">返回</a>
		<a>种类：{{ $advertiseType->name }}</a>
	</div>
@stop

@section('form_content')
	<tr>
		<td class="txt-right width-30p"><i>*</i>广告位中文名称：</td>
		<td class="txt-left">
			<input type="text" maxlength="50" placeholder="请输入小于50个字符" name="name" value="{{ old('name') ? old('name') : (isset($advertise->name) ? $advertise->name : '') }}" required="required" />
				&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('name') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>排序：</td>
		<td class="txt-left">
			<input type="number" min="1" max="50" name="sort" value="{{ old('sort') ? old('sort') : (isset($advertise->sort) ? $advertise->sort : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('sort') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">
			<i>*</i>广告位图片：
			@if ($advertiseType->width && $advertiseType->height)
				<p class="red">({{ $advertiseType->width }} x {{ $advertiseType->height }})&nbsp;</p>
			@endif
		</td>
		<td class="txt-left">
			@if (isset($advertise))
				<img src="{{ asset($advertise->image) }}" style="width: 500px;" />
				</br></br>
				@include('admin.upload_image', ['action' => '更换', 'name' => 'image'])
			@else
				@include('admin.upload_image', ['action' => '上传', 'name' => 'image'])
			@endif
		</td>
	</tr>
	<tr>
		<td class="txt-right">图片链接：</td>
		<td class="txt-left">
			<textarea rows="2" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="href" >{{ old('href') ? old('href') : (isset($advertise->href) ? $advertise->href : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('href') }}</span>
		</td>
	</tr>
@stop