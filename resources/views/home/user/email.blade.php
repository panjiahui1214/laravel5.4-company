@extends('home.user.frame')

@section('main')
	<form method="post" id="form_submit">
		{{ csrf_field() }}

		<table class="form-input">
			<tr>
				<th></th>
				@if ($user->email)
					<th class="user-form-title">修改绑定邮箱</th>
				@else
					<th class="user-form-title">绑定邮箱</th>
				@endif
			</tr>

			@if ($user->email)
				<tr>
					<td>
						<i>&nbsp;</i><label>原电子邮箱</label>：
					</td>
					<td>
						<input type="text" value="{{ $user->email }}" disabled="disabled" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td class="padding-b10">&nbsp;</td>
				</tr>
			@endif

			<tr>
				<td>
					<i>*</i><label for="email" id="label_email">
						@if ($user->email)
							{{ $email_text = '新电子邮箱' }}
						@else
							{{ $email_text = '电子邮箱' }}
						@endif
					</label>：
				</td>
				<td>
					<input type="email" placeholder="请输入您的{{ $email_text }}" id="email" name="email" value="{{ old('email') ? old('email') : '' }}" required="required" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td class="padding-b10">
					<span class="red" id="error_email">
						@if ($errors->has('email'))
							{{ $errors->first('email') }}
						@endif
						&nbsp;
					</span>
				</td>
			</tr>

			<tr>
				<td></td>
				<td>
					<button id="btn_submit" type="text" value="修改邮箱">确定</button>
				</td>
			</tr>
		</table>

	</form>
@stop

@section('javascript')
  <script src="{{ asset('js/val_user.js') }}"></script>
@stop