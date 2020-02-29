define(['jquery', 'form', 'template', 'upload'], function ($, Form, Template, Upload) {
    var Controller = {
        index: function () {
            // 删除评论
            $(".comment-delete").click(function (e) {
                var id = $(e.target).attr("id");
                layer.confirm('是否删除评论？', {
                    btn: ['删除', '取消']
                }, function (index) {
                    layer.close(index);
                    $.post("message/deleteMessage?id="+id, function (res) {
                        if (res == 'success') {
                            layer.msg('删除成功');
                        } else {
                            layer.msg('删除失败');
                        }
                    });
                });
            });
        },
        list: function () {
            // 绑定上传事件
            Form.events.plupload($("#strategy-form"));

            // 上传弹出框
            $("#upload-strategy").on("click", function () {
                if (document.cookie.replace(/(?:(?:^|.*;\s*)uid\s*\=\s*([^;]*).*$)|^.*$/, '$1')) { //判断登录
                    var id = "strategytpl";
                    var content = Template(id, {});
                    Layer.open({
                        type: 1,
                        title: __('上传攻略'),
                        area: ["600px", "400px"],
                        content: content,
                        success: function (layero) {
                            Form.api.bindevent($("#strategy-form", layero), function (data) {
                                Layer.closeAll();
                            });
                        }
                    });
                } else {
                    Layer.msg("请登录后上传");
                }
            });
        }
    };
    return Controller;
});