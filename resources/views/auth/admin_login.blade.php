<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>管理中心 - 皮卡丘科技</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1.0, user-scalable=0,user-scalable=no">
  <meta name="format-detection" content="telephone=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>  
  <link rel="alternate icon" type="images/png" href="{{ asset('images/bre_icon.png') }}">
  <link rel="stylesheet" href="{{ asset('css/amazeui.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/logio.css') }}">
</head>

<body>
  @include('message')

  <div class="logio-div logio-div-h">
    <form method="post">
      {{ csrf_field() }}

      <div>
        <img src="{{ asset('images/admin/login_top.jpg') }}">
      </div>
      <div class="logio-center form-input">
        <table>
          <tr>
            <td class="width-100">
              <i>*</i><label for="name" id="label_name">管理员</label>：
            </td>
            <td>
              <input type="text" maxlength="25" placeholder="请输入您的管理员账号" id="name" name="name" value="{{ old('name') }}" required="required" autofocus="autofocus" />
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
              <i>*</i><label for="password" id="label_password">密码</label>：
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
        </table>
      </div>
      <div>
        <img src="{{ asset('images/admin/login_bottom.jpg') }}">
      </div>

      <button id="btn_submit" type="submit" class="logio-btn login-btn" value="登录"></button>
    </form>
  </div>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/val_user.js') }}"></script>
</body>
</html>