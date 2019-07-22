@extends('admin.frame')

@section('content')
	<div class="div-table margin-t10">
		<table class="table-all table-blue form-submit">
			<tr>
				<th colspan="2" class="txt-left padding-lr20">查看资料</th>
			</tr>
			
			<tr>
				<td class="txt-right width-30p">会员账号：</td>
				<td class="txt-left">
					<input type="text" value="{{ $userName }}" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td class="txt-right">性别：</td>
				<td class="txt-left">
					<input type="hidden" value="{{ $sex = (isset($pro->sex) ? $pro->sex : '') }}" />
					<input type="radio" {{ ('M'==$sex) ? 'checked="checked"' : '' }} disabled="disabled" /> 男
					<input type="radio" {{ ('F'==$sex) ? 'checked="checked"' : '' }} disabled="disabled" /> 女
				</td>
			</tr>
			<tr>
				<td class="txt-right">生日：</td>
				<td class="txt-left">
					<input type="date" value="{{ $pro->birthday or '' }}" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td class="txt-right">居住地：</td>
				<td class="txt-left">
					<input type="text" value="{{ $pro->residence or '' }}" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td class="txt-right">教育程度：</td>
				<td class="txt-left">
					<input type="text" value="{{ $pro->education or '' }}" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td class="txt-right">就读学校：</td>
				<td class="txt-left">
					<input type="text" value="{{ $pro->school or '' }}" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td class="txt-right">就读班级：</td>
				<td class="txt-left">
					<input type="text" value="{{ $pro->class or '' }}" disabled="disabled" />
				</td>
			</tr>
		</table>
	</div>
@stop
				