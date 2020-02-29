define(['jquery'], function ($) {
    var Controller = {
        index: function () {
            // 天气查询
            $(function () {
                $.get("https://restapi.amap.com/v3/weather/weatherInfo?key=8a59330102f814c0a73ebdbcc9b0ab5b&city=330100", function (res) {
                    $('#weather').text(res.lives[0].weather);
                    $('#temperature').text(res.lives[0].temperature);
                    $('#humidity').text(res.lives[0].humidity);
                    $('#windpower').text(res.lives[0].windpower);
                    $('#winddirection').text(res.lives[0].winddirection);
                });
            });

            // 百度全景
            $(function () {
                // 全景高度自适应
                function mapResponse() {
                    $("#panorama").height($("#panorama").width() / 1.5);
                }
                mapResponse();
                $(window).resize(function () {
                    mapResponse();
                });
                // 全景展示
                var panorama = new BMap.Panorama('panorama');
                panorama.setPosition(new BMap.Point($("#end_lng").val(), $("#end_lat").val()));
            });

            // 百度地图
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