@extends('home.user.frame')

@section('main')
	<form method="post" id="form_submit">
		{{ csrf_field() }}

		<table class="form-input" style="width: 336px !important;">
			<tr>
				<th></th>
				<th class="user-form-title">修改绑定手机</th>
			</tr>

			<tr>
				<td>
					<i>&nbsp;</i><label>原手机号码</label>：
				</td>
				<td>
					<input type="text" value="{{ $user->mobile }}" disabled="disabled" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">&nbsp;</td>
			</tr>

			<tr>
				<td>
					<i>*</i><label for="mobile" id="label_mobile">新手机号码</label>：
				</td>
				<td>
					<input type="text" maxlength="11" placeholder="请输入您的新手机号码" id="mobile" name="mobile"  value="{{ old('mobile') ? old('mobile') : '' }}" required="required" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red" id="error_mobile">
						@if ($errors->has('mobile'))
							{{ $errors->first('mobile') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td>
					<i>*</i><label for="captcha" id="label_captcha">验证码</label>：
				</td>
				<td>
					<input class="width-100" maxlength="6" type="text" placeholder="短信验证码" id="captcha" name="captcha" required="required" />
					<button id="btn_sendSms" type="button" class="right margin-t5">获取验证码</button>
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red" id="error_captcha">
						@if ($errors->has('captcha'))
							{{ $errors->first('captcha') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td></td>
				<td>
					<button id="btn_submit" type="text" value="修改手机">确定</button>
				</td>
			</tr>
		</table>

	</form>
@stop

@section('javascript')
  <script src="{{ asset('js/val_user.js') }}"></script>
@stop