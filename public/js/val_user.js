/*
 * 会员/管理员表单验证
 * add by pjh 20180612
 */

(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* 
     * 函数作用：判断字段是否为空
     * 输入参数：1，id        输入字段id值
     * 输出参数：1，true      字段不为空
                 2，false     字段为空，进行错误提示
     */
    function valIfNull(id) {
        var obj = $('#'+id);
        var obj_error = $('#error_'+id);
        var obj_label = $('#label_'+id);

        if (!obj.val()) {
            obj_error.text('请输入'+$.trim(obj_label.text()));
            return false;
        }
        else {
            obj_error.html('&nbsp;');
            return true;
        }
    }

    /* 
     * 函数作用：判断字段长度是否符合要求
     * 输入参数：1，id        输入字段id值
                 2，min       输入字段要求最小长度
                 3，max       输入字段要求最大长度
                 4，noTrim    字段长度判断是否需要去空
     * 输出参数：1，true      字段长度符合要求
                 2，false     字段长度不符合要求，进行错误提示
     */
    function valLength(id, min=null, max=null, noTrim=null) {
        var obj = $('#'+id);
        var obj_error = $('#error_'+id);

        // 是否去空，主要为密码字段
        if (noTrim) {
            length = obj.val().length;
        }
        else {
            length = obj.val().trim().length;
        }
        
        if (min && min > length) {
            obj_error.text('长度需大于'+min+'个字符');
            return false;
        }
        else if (max && max < length) {
            obj_error.text('长度需小于'+max+'个字符');
            return false;
        }
        else {
            obj_error.html('&nbsp;');
            return true;
        }
    }

    /* 
     * 函数作用：判断字段格式是否符合要求
     * 输入参数：1，id        输入字段id值
                 2，format    字段要求格式
     * 输出参数：1，true      字段格式符合要求
                 2，false     字段格式不符合要求，进行错误提示
     */
    function valFormat(id, format) {
        var obj = $('#'+id);
        var obj_error = $('#error_'+id);
        var obj_label = $('#label_'+id);

        if (!format.test(obj.val())) {
            obj_error.text('请输入正确的'+$.trim(obj_label.text()));
            return false;
        }
        else {
            obj_error.html('&nbsp;');
            return true;
        }
    }

    /* 
     * 函数作用：判断两个字段值是否相等
     * 输入参数：1，id1       判断字段1的id值
                 2，id2       判断字段2的id值
     * 输出参数：1，true      两个字段值相等
                 2，false     两个字段值不相等，并对id2字段进行错误提示
     */
    function valEqual(id1, id2) {
        var obj_label = $('#label_'+id1);
        var obj_error = $('#error_'+id2);
        
        if ($('#'+id1).val() != $('#'+id2).val()) {
            obj_error.text('与'+$.trim(obj_label.text())+'不一致');
            return false;
        }
        else {
            obj_error.html('&nbsp;');
            return true;
        }
    }



    // 验证会员账号
    function validate_name(id_name) {
        if (!valIfNull(id_name))      return false;
        if (!valLength(id_name, '', 25))      return false;
        return true;
    }

    // 验证密码
    function validate_pwd(id_pwd) {
        if (!valIfNull(id_pwd))      return false;
        if (!valLength(id_pwd, 6, 16, true))      return false;
        return true;
    }
    
    // 图片验证码
    function validate_captcha(id_captcha) {
        if (!valIfNull(id_captcha))      return false;
        return true;
    }
    
    // 验证确认密码
    function validate_pwd2(id_pwd, id_pwd2) {
        if (!valIfNull(id_pwd2))      return false;
        if (!valEqual(id_pwd, id_pwd2))      return false;
        return true;
    }
    
    // 验证手机号码
    function validate_mobile(id_mobile) {
        if (!valIfNull(id_mobile))      return false;
        if (!valFormat(id_mobile, /^1[3-9][0-9]{9}$/))      return false;
        return true;
    }

    // 验证电子邮箱
    function validate_email(id_email) {
        if (!valIfNull(id_email))      return false;
        if (!valFormat(id_email, /^\w+_*@\w+.\w+$/))      return false;
        return true;
    }



    // 按钮60s倒计时效果
    function countDown(id_btn) {
        var seconds = 60;
        var obj_btn = $('#'+id_btn);
        setTime (obj_btn, seconds);
        
        function setTime (obj_btn) {
            if (0 == seconds) {
                obj_btn.removeAttr('disabled');
                obj_btn.html('获取验证码');
                seconds = 60;
                return true;
            }
            else {
                obj_btn.attr('disabled', true);
                obj_btn.html('重新获取('+seconds+'s)');
                seconds--;
            }

            setTimeout( function () {
                setTime(obj_btn)
            }, 1000)
        }
    }


    // 根据手机号码或会员账号发送短信
    function sendSmsByMobileOrName(id_btn, id_name=null, id_mobile=null, id_captcha, name_templete) {
        if (id_name) {
            if (!validate_name(id_name))      return false;
            var val_name = $('#'+id_name).val();
            var error_id = id_name;
        }
        if (id_mobile) {
            if (!validate_mobile(id_mobile))      return false;
            var val_mobile = $('#'+id_mobile).val();
            var error_id = id_mobile;
        }
             
        var url = "/ajax/sendSmsByMobileOrName";
        $.post( url, { name: val_name, mobile: val_mobile, templete: name_templete}, function(data) {
            if (data.error) {
                $('#error_'+error_id).text(data.error);
                return false;
            }
            else if ('success' == data.result) {
                countDown(id_btn);
                return true;
            }
            else {
                $('#error_'+id_captcha).text(data.result);
                return false;
            }
        });
        return true;
    }


    // 根据会员账号返回手机号码
    function getMobileFromName(id_name, id_mobile) {
        var url = "/ajax/getMobileFromName";
        var val_name = $('#'+id_name).val();
        
        $.ajax({
            url: url,
            type: "post",
            data: { name: val_name },
            success: function(mobile) {
                $('#'+id_mobile).val(mobile);
            },
            error: function (XMLHttpRequest) {
                if (404 == XMLHttpRequest.status) {
                    $('#error_'+id_name).text('会员账号不存在');
                    $('#'+id_mobile).val('');
                }
            }
        });
        return true;
    }



    var obj_btn_submit = $('#btn_submit');
    var obj_form_submit = $('#form_submit');
    var id_btn_sendSms = 'btn_sendSms';

    if ( '登录' == obj_btn_submit.val() ) {
        $('#name').blur( function() {
            if (!validate_name('name'))      return false;
        });
        $('#password').blur( function() {
            if (!validate_pwd('password'))      return false;
        });
        $('#captcha').blur( function() {
            if (!validate_captcha('captcha'))      return false;
        });

        // 登录提交
        obj_btn_submit.click( function() {
            if (!validate_name('name'))         return false;
            if (!validate_pwd('password'))      return false;
            if (!validate_captcha('captcha'))      return false;
            obj_form_submit.submit();
        });
    }
    else if ( '注册' == obj_btn_submit.val() ) {
        $('#name').blur( function() {
            if (!validate_name('name'))      return false;
        });
        $('#password').blur( function() {
            if (!validate_pwd('password'))      return false;
        });
        $('#password2').blur( function() {
            if (!validate_pwd2('password', 'password2'))      return false;
        });
        $('#mobile').blur( function() {
            if (!validate_mobile('mobile'))      return false;
        });
        $('#captcha').blur( function() {
            if (!validate_captcha('captcha'))      return false;
        });

        // 发送短信
        $('#'+id_btn_sendSms).click( function() {
            if (!sendSmsByMobileOrName('btn_sendSms', '', 'mobile', 'captcha', 'register'))
                return false;
        });

        // 注册提交
        obj_btn_submit.click( function() {
            if (!validate_name('name'))      return false;
            if (!validate_pwd('password'))      return false;
            if (!validate_pwd2('password', 'password2'))      return false;
            if (!validate_mobile('mobile'))      return false;
            if (!validate_captcha('captcha'))      return false;
            obj_form_submit.submit();
        });
    }
    else if ( '修改密码' == obj_btn_submit.val() ) {
        $('#old_password').blur( function() {
            if (!validate_pwd('old_password'))      return false;
        });
        $('#password').blur( function() {
            if (!validate_pwd('password'))      return false;
        });
        $('#password2').blur( function() {
            if (!validate_pwd2('password', 'password2'))      return false;
        });

        // 修改密码提交
        obj_btn_submit.click( function() {
            if (!validate_pwd('old_password'))      return false;
            if (!validate_pwd('password'))      return false;
            if (!validate_pwd2('password', 'password2'))      return false;
            obj_form_submit.submit();
        });
    }
    else if ( '修改手机' == obj_btn_submit.val() ) {
        $('#mobile').blur( function() {
            if (!validate_mobile('mobile'))      return false;
        });

        // 发送短信
        $('#'+id_btn_sendSms).click( function() {
            if (!sendSmsByMobileOrName('btn_sendSms', '', 'mobile', 'captcha', 'mobile'))
                return false;
        });

        // 修改手机提交
        obj_btn_submit.click( function() {
            if (!validate_mobile('mobile'))      return false;
        });
    }
    else if ( '修改邮箱' == obj_btn_submit.val() ) {
        $('#email').blur( function() {
            if (!validate_email('email'))      return false;
        });

        // 修改邮箱提交
        obj_btn_submit.click( function() {
            if (!validate_email('email'))      return false;
            obj_form_submit.submit();
        });
    }
    else if ( '重置密码' == obj_btn_submit.val() ) {
        $('#name').blur( function() {
            if (!validate_name('name'))      return false;
            if (!getMobileFromName('name', 'mobile'));      return false;
        });
        $('#password').blur( function() {
            if (!validate_pwd('password'))      return false;
        });
        $('#password2').blur( function() {
            if (!validate_pwd2('password', 'password2'))      return false;
        });
        $('#captcha').blur( function() {
            if (!validate_captcha('captcha'))      return false;
        });
        
        // 发送短信
        $('#'+id_btn_sendSms).click( function() {
            if (!sendSmsByMobileOrName('btn_sendSms', 'name', '', 'captcha', 'password'))
                return false;
        });   

        // 重置密码提交
        obj_btn_submit.click( function() {
            if (!validate_name('name'))      return false;
            if (!getMobileFromName('name', 'mobile'))      return false;
            if (!valIfNull('mobile'))      return false;
            if (!validate_captcha('captcha'))      return false;
            if (!validate_pwd('password'))      return false;
            if (!validate_pwd2('password', 'password2'))      return false;
            obj_form_submit.submit();
        });
    }

})(jQuery);