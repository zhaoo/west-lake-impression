define(['fast', 'template', 'moment', 'layer'], function (Fast, Template, Moment) {
    var Frontend = {
        api: Fast.api,
        init: function () {
            /* zhaoo */
            // 评论
            $('#message-form').on('submit', function (e) {
                var form = $(this);
                var formdata = $(this).serialize();

                function reset_form() {
                    $("#name").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $("#content").val('');
                }

                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formdata,
                    success: function (text) {
                        if (text == "success") {
                            reset_form();
                            layer.msg('评论成功');
                        } else {
                            reset_form();
                            layer.msg('评论失败');
                        }
                    }
                });
                e.preventDefault();
            });

            // 导航栏
            $("nav").fadeIn(300);

            // 返回顶部
            $(document).ready(function () {
                $(window).scroll(function () {
                    var height = $(window).height();
                    var scrollTop = $(window).scrollTop();
                    var scrollPercent = Math.round((scrollTop) / ($(document).height() - height) * 100);
                    $("#scroll-percent").text(scrollPercent + "%");
                    if (scrollTop > height) {
                        $(".back-to-top").addClass("back-to-top-on");
                    } else {
                        $(".back-to-top").removeClass("back-to-top-on");
                    }
                });
                $('.back-to-top').click(function () {
                    $('body,html').animate({
                        scrollTop: '0px'
                    }, 1000);
                });
            });

            // 锚点滑动
            $(function () {
                $('.anchor-slid').click(function () { // a[href *=#], area[href *=#]
                    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                        var $target = $(this.hash);
                        $target = $target.length && $target || $('[name=' + this.hash.slice(1) + ']');
                        if ($target.length) {
                            var targetOffset = $target.offset().top;
                            $('html,body').animate({
                                scrollTop: targetOffset
                            }, 1000);
                            return false;
                        }
                    }
                });
            })

            var si = {};
            //发送验证码
            $(document).on("click", ".btn-captcha", function (e) {
                var type = $(this).data("type") ? $(this).data("type") : 'mobile';
                var element = $(this).data("input-id") ? $("#" + $(this).data("input-id")) : $("input[name='" + type + "']", $(this).closest("form"));
                var text = type === 'email' ? '邮箱' : '手机号码';
                if (element.val() === "") {
                    Layer.msg(text + "不能为空！");
                    element.focus();
                    return false;
                } else if (type === 'mobile' && !element.val().match(/^1[3-9]\d{9}$/)) {
                    Layer.msg("请输入正确的" + text + "！");
                    element.focus();
                    return false;
                } else if (type === 'email' && !element.val().match(/^[\w\+\-]+(\.[\w\+\-]+)*@[a-z\d\-]+(\.[a-z\d\-]+)*\.([a-z]{2,4})$/)) {
                    Layer.msg("请输入正确的" + text + "！");
                    element.focus();
                    return false;
                }
                var that = this;
                element.isValid(function (v) {
                    if (v) {
                        $(that).addClass("disabled", true).text("发送中...");
                        var data = {event: $(that).data("event")};
                        data[type] = element.val();
                        Frontend.api.ajax({url: $(that).data("url"), data: data}, function () {
                            clearInterval(si[type]);
                            var seconds = 60;
                            si[type] = setInterval(function () {
                                seconds--;
                                if (seconds <= 0) {
                                    clearInterval(si);
                                    $(that).removeClass("disabled").text("发送验证码");
                                } else {
                                    $(that).addClass("disabled").text(seconds + "秒后可再次发送");
                                }
                            }, 1000);
                        }, function () {
                            $(that).removeClass("disabled").text('发送验证码');
                        });
                    } else {
                        Layer.msg("请确认已经输入了正确的" + text + "！");
                    }
                });

                return false;
            });
            //tooltip和popover
            if (!('ontouchstart' in document.documentElement)) {
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            }
            $('body').popover({selector: '[data-toggle="popover"]'});
        }
    };
    Frontend.api = $.extend(Fast.api, Frontend.api);
    //将Template渲染至全局,以便于在子框架中调用
    window.Template = Template;
    //将Moment渲染至全局,以便于在子框架中调用
    window.Moment = Moment;
    //将Frontend渲染至全局,以便于在子框架中调用
    window.Frontend = Frontend;

    Frontend.init();
    return Frontend;
});
