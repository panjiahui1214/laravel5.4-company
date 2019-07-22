@extends('home.user.frame')

@section('main')
	<form method="post" id="form_submit">
		{{ csrf_field() }}

		<table class="form-input" style="width: 320px !important;">
			<tr>
				<th></th>
				<th class="user-form-title">修改登录密码</th>
			</tr>
			
			<tr>
				<td class="width-100">
					<i>*</i><label for="name" id="label_old_password">原密码</label>：
				</td>
				<td>
					<input type="password" maxlength="16" placeholder="请输入现账号密码" id="old_password" name="old_password" value="{{ old('name') }}" required="required" autofocus="autofocus" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red" id="error_old_password">
						@if ($errors->has('old_password'))
							{{ $errors->first('old_password') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td>
					<i>*</i><label for="password" id="label_password">登录密码</label>：
				</td>
				<td>
					<input type="password" maxlength="16" placeholder="请设置您的新登录密码" id="password" name="password" required="required" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red" id="error_password">
						@if ($errors->has('password'))
							{{ $errors->first('password') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td>
					<i>*</i><label for="password2" id="label_password2">确认密码</label>：
				</td>
				<td>
					<input type="password" maxlength="16" placeholder="请再次输入新登录密码" id="password2" name="password_confirmation" required="required" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red" id="error_password2">
						&nbsp;
					</span>
				</td>
			</tr>
			
			<tr>
				<td></td>
				<td>
					<button id="btn_submit" type="text" value="修改密码">确定</button>
				</td>
			</tr>
        </table>

	</form>
@stop

@section('javascript')
  <script src="{{ asset('js/val_user.js') }}"></script>
@stop