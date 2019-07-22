@extends('admin.frame_form')

@section('action', '编辑')

@section('who', '公司信息')

@section('enctype', 'multipart/form-data')

@section('form_content')
	<tr>
		<td class="txt-right width-30p">信息中文名称：</td>
		<td class="txt-left">
			<input type="text" name="name" value="{{ $company->name }}" disabled="disabled" />
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>信息值：</td>
		<td class="txt-left">
			<input type="text" style="width: 350px;" maxlength="50" placeholder="请输入小于50个字符" name="value" value="{{ old('value') ? old('value') : $company->value }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('value') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">
			信息图片：
			@if ($company->width && $company->height)
				<p class="red">({{ $company->width }} x {{ $company->height }})&nbsp;</p>
			@endif
		</td>
		<td class="txt-left">
			@if ($company->image)
				<img src="{{ asset($company->image) }}" style="width: {{ $company->width }}px; height: {{ $company->height }};" />
				</br></br>

				@include('admin.upload_image', ['action' => '更换', 'name' => 'image'])
			@else
				@include('admin.upload_image', ['action' => '上传', 'name' => 'image'])
			@endif
		</td>
	</tr>
@stop