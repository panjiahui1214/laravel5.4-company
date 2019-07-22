@extends('home.frame')

@section('title', '忘记密码')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/logio.css') }}">
@stop

@section('banner')

@stop

@section('content')
  <div class="logio-div logio-div-h">
    <form method="post" id="form_submit">
      {{ csrf_field() }}

      <div>
        <img src="{{ asset('images/admin/login_top.jpg') }}">
      </div>
      <div class="logio-center form-input">
        <table>
          <tr>
            <td class="width-100">
              <i>*</i><label for="name" id="label_name">会员账号</label>：
            </td>
            <td>
              <input type="text" maxlength="25" placeholder="请输入您的会员账号" id="name" name="name" value="{{ old('name') }}" required="required" autofocus="autofocus" />
            </td>
          </tr>
          <tr>
            <td></td>
            <td class="padding-b10">
              <span class="red" id="error_name">
                @if ($errors->has('name'))
                  {{ $errors->first('name') }}
                @endif
                &nbsp;
              </span>
            </td>
          </tr>

          <tr>
            <td>
              <i>*</i><label for="mobile" id="label_mobile">手机号码</label>：
            </td>
            <td>
              <input type="text" placeholder="根据会员账号返回" id="mobile" name="mobile" disabled="disabled" />
            </td>
          </tr>
          <tr>
            <td></td>
            <td class="padding-b10">&nbsp;</td>
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
            <td>
              <i>*</i><label for="password" id="label_password">登录密码</label>：
            </td>
            <td>
              <input type="password" maxlength="16" placeholder="请设置您的登录密码" id="password" name="password" required="required" />
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
              <input type="password" maxlength="16" placeholder="请再次输入登录密码" id="password2" name="password_confirmation" required="required" />
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
        </table>
      </div>
      <div>
        <img src="{{ asset('images/admin/login_bottom.jpg') }}">
      </div>

      <button id="btn_submit" type="text" class="logio-btn forget-btn" value="重置密码"></button>
    </form>
  </div>
@stop

@section('javascript')
  <script src="{{ asset('js/val_user.js') }}"></script>
@stop