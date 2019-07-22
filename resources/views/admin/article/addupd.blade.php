@extends('admin.frame_form')

@if (!isset($article))
	@section('action', '添加')
@else
	@section('action', '编辑')
@endif

@section('who', '文章')

@section('enctype', 'multipart/form-data')

@section('form_content')
	<tr>
		<td class="txt-right width-20p"><i>*</i>文章标题：</td>
		<td class="txt-left">
			<input type="text" style="width: 350px;" maxlength="50" placeholder="请输入小于50个字符" name="title" value="{{ old('title') ? old('title') : (isset($article->title) ? $article->title : '') }}" required="required" />
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('title') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>文章封面：</td>
		<td class="txt-left">
			@if (!isset($article))
				@include('admin.upload_image', ['action' => '上传', 'name' => 'cover'])
			@else
				<img src="{{ asset($article->cover) }}" style="width: 198px; height: 148px;" />
				</br></br>
				@include('admin.upload_image', ['action' => '更换', 'name' => 'cover'])
			@endif
		</td>
	</tr>
	<tr>
		<td class="txt-right">
			<i>*</i>文章关键词：
			<br/><span class="red">(请用<strong>英文逗号</strong>分隔)</span>
		</td>
		<td class="txt-left">
			<textarea rows="2" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="keywords" required="required">{{ old('keywords') ? old('keywords') : (isset($article->keywords) ? $article->keywords : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('keywords') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>文章简介：</td>
		<td class="txt-left">
			<textarea rows="5" cols="60" maxlength="255" placeholder="请输入小于255个字符" name="txt" required="required">{{ old('txt') ? old('txt') : (isset($article->txt) ? $article->txt : '') }}</textarea>
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('txt') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right"><i>*</i>所属菜单：</td>
		<td class="txt-left">
			@foreach ($menus as $menu)
				@if (isset($article) && in_array($menu->id, $article->belong))
					<input type="checkbox" id="menu{{ $loop->index }}" name="belong[]" value="{{ $menu->id }}" checked="checked" />
				@else
					<input type="checkbox" id="menu{{ $loop->index }}" name="belong[]" value="{{ $menu->id }}" />
				@endif

				<label for="menu{{ $loop->index }}">{{ $menu->name }}</label>
			@endforeach
			&nbsp;&nbsp;&nbsp;
			<span class="red">{{ $errors->first('menu') }}</span>
		</td>
	</tr>
	<tr>
		<td class="txt-right">
			<i>*</i>文章内容：
			@include('admin.editor_remark')
		</td>
		<td class="txt-left">
			<script id="container" name="text" type="text/plain">
			    {!! old('text') ? old('text') : (isset($article->text) ? $article->text : '') !!}
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