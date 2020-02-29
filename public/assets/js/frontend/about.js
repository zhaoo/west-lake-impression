define(['jquery', 'layer'], function ($) {
    var Controller = {
        index: function () {
            $('#contact-form').on('submit', function (e) {
                var form = $(this);
                var formdata = $(this).serialize();

                function reset_form() {
                    $("#name").val('');
                    $("#email").val('');
                    $("#content").val('');
                }

                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: formdata,
                    success: function (text) {
                        if (text == "success") {
                            reset_form();
                            layer.msg('留言成功');

                        } else {
                            reset_form();
                            layer.msg('留言失败');
                        }
                    }
                });
                e.preventDefault();
            });
        }
    };
    return Controller;
});