define(['jquery', 'form', 'template', 'upload'], function ($, Form, Template, Upload) {
    var Controller = {
        index: function () {
            // 绑定上传事件
            Form.events.plupload($("#photo-form"));

            // 上传照片弹出框
            $("#upload-photo").on("click", function () {
                if (document.cookie.replace(/(?:(?:^|.*;\s*)uid\s*\=\s*([^;]*).*$)|^.*$/, '$1')) {  //判断登录
                    var id = "phototpl";
                    var content = Template(id, {});
                    Layer.open({
                        type: 1,
                        title: __('上传照片'),
                        area: ["600px", "400px"],
                        content: content,
                        success: function (layero) {
                            Form.api.bindevent($("#photo-form", layero), function (data) {
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