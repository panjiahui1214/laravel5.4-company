/*
 * 前台专用
 * add by pjh 20180118
 */

(function($){
    /*
     * 函数作用：当li标签的href与当前href第一个斜杠内容相同时，则给予li标签css活动样式
     * 输入参数：1，菜单id值
     *          2，css活动样式名称
     */
    function menuHasActive(nav, css) {
        var navLi = $('#'+nav+' li')
        var winUrl = window.location.pathname;
        //var urlPart  = winUrl.substring(winUrl.lastIndexOf("\/") + 1); // 获取url地址中最后一个斜杠后的内容

        // 当前为首页，直接给导航栏菜单赋样式
        if ('/' == winUrl) {
            navLi.eq(0).addClass(css);
            return true;
        }

        // 当前为菜单页，直接给第一个菜单分类选项卡赋样式
        var firstH = navLi.eq(0).find('a').attr('href');
        var sameMenu = firstH.indexOf(winUrl);
        if (!sameMenu) {
            navLi.eq(0).addClass(css);
            return true;
        }

        // 当前页面href中包含导航栏菜单href，给该菜单赋样式
        navLi.each( function() {
            var h = $(this).find('a').attr('href');
            var sameMenu = winUrl.indexOf(h);
            if (!sameMenu && '/' != h && '' != h && '/user' != h) {
                $(this).addClass(css);
                return true;
            }
        });
    }

    // 导航栏
    menuHasActive('bre-nav', 'bre-menu-active');
    // 选项卡/用户中心左侧菜单
    if ( $('#bre-menu-nav').length ) {
        menuHasActive('bre-menu-nav', 'am-active')
    }


    /* 实现会员中心导航栏按钮效果 */
    var userLeft = $('#user-left');
    var userMenuBtn = $('#user-menu-btn');
    userMenuBtn.click( function() {
        //userLeft.toggleClass('user-left-dis');
        var disOrNo = userLeft.css('display');
        //alert("what["+disOrNo+"]");
        if ( 'none' == disOrNo ) {
            userLeft.css('display', 'block');
        }
        else {
            userLeft.css('display', 'none');
        }
    });


    /* 对页面中的iframe高度进行等比例显示 */
    var iframe = $('iframe');
    var iframeWidth = iframe.contents().find('body').width();
    iframe.height(iframeWidth/1.28);
    
})(jQuery);