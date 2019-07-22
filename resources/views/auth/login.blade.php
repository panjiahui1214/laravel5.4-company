@extends('home.frame')

@section('title', '会员登录')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/logio.css') }}">
@stop

@section('banner')

@stop

@section('content')
  <div class="logio-div logio-div-h">
    <form method="post" id="form_submit">
      {{ csrf_field() }}
      <div class="txt-center lgoio-href">
        <a href="{{ route('register') }}">没有账号？→点我去注册</a>
      </div>

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
              <i>*</i><label for="password" id="label_password">登录密码</label>：
            </td>
            <td>
              <input type="password" maxlength="16" placeholder="请输入您的登录密码" id="password" name="password" required="required" />
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
              <i>*</i><label for="captcha" id="label_captcha">验证码</label>：
            </td>
            <td>
              <input type="text" maxlength="5" placeholder="点图更换" id="captcha" name="captcha" required="required" class="width-90" />
              <img src="{{ captcha_src() }}" onclick="this.src='{{ captcha_src() }}?r='+Math.random()" class="width-120 margin-l5" style="cursor: pointer;" />
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
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
              <a href="{{ url('/forgetPassword') }}" class="blue right">忘记密码？</a>
            </td>
          </tr>
        </table>
      </div>
      
      <div>
        <img src="{{ asset('images/admin/login_bottom.jpg') }}">
      </div>

      <button id="btn_submit" type="text" class="logio-btn login-btn" value="登录"></button>
    </form>
  </div>
@stop

@section('javascript')
  <script src="{{ asset('js/val_user.js') }}"></script>
@stop