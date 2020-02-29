define(['jquery'], function ($) {
    var Controller = {
        index: function () {
            // 评论
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
            // 百度地图规划
            $(function () {
                // 导航栏
                $(".traffic-type").find("li").click(function () {
                    $(".traffic-type").find("li").removeClass();
                    $(this).addClass("active");
                });
                // 地图高度自适应
                function mapResponse() {
                    $("#baidu_map").height($("#baidu_map").width() / 1.33);
                    $("#traffic_result").height($("#baidu_map").width() / 1.33);
                }
                mapResponse();
                $(window).resize(function () {
                    mapResponse();
                });
                // 坐标拾取
                $(".pickup").click(function () {
                    map.addEventListener("click", function (e) {
                        $("#start_lng").val(e.point.lng);
                        $("#start_lat").val(e.point.lat);
                        $("#start_address").val(e.point.lng + ", " + e.point.lat);
                    });
                });
                // 绘制地图
                var map = new BMap.Map("baidu_map");
                map.centerAndZoom(new BMap.Point($("#end_lng").val(), $("#end_lat").val()), 13);
                map.enableScrollWheelZoom(true);
                // 补全地址
                $("#start_address").on("click", function () {
                    var ac = new BMap.Autocomplete({
                        "input": "start_address",
                        "location": map
                    });
                });
                // 规划
                $("#traffic-plan").click(function () {
                    var trafficType = $(".traffic-type li[class='active']").attr("id");
                    if (trafficType == "drive") {
                        map.clearOverlays();
                        var driving = new BMap.DrivingRoute(map, {
                            renderOptions: {
                                map: map,
                                autoViewport: true,
                                panel: "traffic_result"
                            }
                        });
                        var start = new BMap.Point($("#start_lng").val(), $("#start_lat").val());
                        var end = new BMap.Point($("#end_lng").val(), $("#end_lat").val());
                        driving.search(start, end);
                    } else if (trafficType == "bus") {
                        map.clearOverlays();
                        transit = new BMap.TransitRoute(map, {
                            renderOptions: {
                                map: map,
                                panel: "traffic_result"
                            }
                        });
                        var start = new BMap.Point($("#start_lng").val(), $("#start_lat").val());
                        var end = new BMap.Point($("#end_lng").val(), $("#end_lat").val());
                        transit.search(start, end);
                    } else {
                        map.clearOverlays();
                        var walk = new BMap.WalkingRoute(map, {
                            renderOptions: {
                                map: map,
                                autoViewport: true
                            }
                        });
                        var start = new BMap.Point($("#start_lng").val(), $("#start_lat").val());
                        var end = new BMap.Point($("#end_lng").val(), $("#end_lat").val());
                        walk.search(start, end);
                    }
                });
            });
        }
    };
    return Controller;
});