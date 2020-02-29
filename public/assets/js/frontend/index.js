define(['jquery'], function ($) {
    var Controller = {
        index: function () {
            // 导航栏
            $("nav").hide();
            $(window).on('scroll.navChange', function () {
                if ($(window).scrollTop() > $(window).height()) {
                    $("nav").fadeIn(300);
                } else {
                    $("nav").fadeOut(300);
                }
            });
        }
    };
    return Controller;
});