define(['jquery', 'layer'], function ($) {
    var Controller = {
        index: function () {
            $(".comment-delete").click(function (e) {
                var id = $(e.target).attr("id");
                layer.confirm('是否删除评论？', {
                    btn: ['删除', '取消']
                }, function (index) {
                    layer.close(index);
                    $.post("message/deleteMessage?id=" + id, function (res) {
                        if (res == 'success') {
                            layer.msg('删除成功');
                        } else {
                            layer.msg('删除失败');
                        }
                    });
                });
            });
        }
    };
    return Controller;
});