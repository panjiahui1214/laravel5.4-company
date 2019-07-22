@extends('home.user.frame')

@section('main')
	<form method="post">
		{{ csrf_field() }}

		<table class="form-input" style="width: 320px !important;">
			<tr>
				<th></th>
				<th class="user-form-title">更改个人资料</th>
			</tr>

			<tr>
				<td class="width-100">
					<i>&nbsp;</i><label>会员账号</label>：
				</td>
				<td>
					<input type="text" id="name" value="{{ Auth::user()->name }}" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;</td>
			</tr>

			<tr>
				<td class="width-100">
					<i>&nbsp;</i><label for="sex">性别</label>：
				</td>
				<td>
					<input type="hidden" value="{{ $sex = ( old('sex') ? old('sex') : (isset($pro) ? $pro->sex : '') ) }}">
					<input type="radio" name="sex" value="M" {{ ('M'==$sex) ? 'checked="checked"' : '' }}> 男
					<input type="radio" name="sex" value="F" {{ ('F'==$sex) ? 'checked="checked"' : '' }}> 女
				</td>
			</tr>
			<tr>
				<td></td>
				<td>&nbsp;</td>
			</tr>

			<tr>
				<td>
					<i>&nbsp;</i><label for="birthday">生日</label>：
				</td>
				<td>
					<input type="date" name="birthday" value="{{ old('birthday') ? old('birthday') : (isset($pro) ? $pro->birthday : '') }}" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red">
						@if ($errors->has('birthday'))
							{{ $errors->first('birthday') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td>
					<i>&nbsp;</i><label for="residence">居住地</label>：
				</td>
				<td>
					<input type="text" maxlength="50" id="residence" name="residence" value="{{ old('residence') ? old('residence') : (isset($pro) ? $pro->residence : '') }}" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red">
						@if ($errors->has('residence'))
							{{ $errors->first('residence') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td>
					<i>&nbsp;</i><label>教育程度</label>：
				</td>
				<td>
					<select name="education" style="width: 220px;">
						<option value = "">请选择</option>
						@foreach ($education as $edu)
							<option value="{{ $edu }}" {{ (isset($pro) && $edu==$pro->education) ? 'selected="selected"' : '' }}>{{ $edu }}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">&nbsp;</td>
			</tr>

			<tr>
				<td>
					<i>&nbsp;</i><label for="school">就读学校</label>：
				</td>
				<td>
					<input type="text" maxlength="50" id="school" name="school" value="{{ old('school') ? old('school') : (isset($pro) ? $pro->school : '') }}" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red">
						@if ($errors->has('school'))
							{{ $errors->first('school') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td>
					<i>&nbsp;</i><label for="class">就读班级</label>：
				</td>
				<td>
					<input type="text" maxlength="20" id="class" name="class" value="{{ old('class') ? old('class') : (isset($pro) ? $pro->class : '') }}" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red">
						@if ($errors->has('class'))
							{{ $errors->first('class') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td></td>
				<td>
					<button id="btn_submit" type="text" value="更改资料">确定</button>
				</td>
			</tr>
		</table>

	</form>
@stop

@section('javascript')
  <script src="{{ asset('js/val_user.js') }}"></script>
@stop