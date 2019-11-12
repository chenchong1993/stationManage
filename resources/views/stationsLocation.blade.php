<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no"/>
    <title>基准站分布系统</title>
    <!-- 地图开始 -->
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/dijit/themes/tundra/tundra.css"/>
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/esri/css/esri.css"/>
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/fonts/font-awesome-4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/Ips_api_javascript/Ips/css/widget.css"/>
    <!-- 地图结束 -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <!-- 331地图 -->
    <script type="text/javascript" src="Ips_api_javascript/init.js"></script>
    <!-- 331地图 -->
    <style>
        html, body, .map {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background: white;
        }
    </style>
</head>

<body class="tundra">

<div class="row" style="height: 100%">

    <div id="map" class="col-md-12"></div>

</div>
</body>

<script>

    // 初始化全局参数
    var INTERVAL_TIME = 1; //数据刷新间隔时间
    var HELLO_STR = "系统初始化成功！"; //初始化欢迎语句
    var ERR_MSG = "电子围栏示范用户正处于危险区域！";//危险区域发送的信息
    var POINTSIZE = 10;    //默认图片大小为24*24
    var map;

    //地图
    require([
        "esri/map",
        "esri/geometry/Extent",
        "Ips/layers/DynamicMapServiceLayer",
        "Ips/layers/FeatureLayer",
        "Ips/layers/GraphicsLayer",
        "esri/graphic",
        "esri/geometry/Point",
        "esri/geometry/Polyline",
        "esri/geometry/Polygon",
        "esri/InfoTemplate",
        "esri/symbols/SimpleMarkerSymbol",
        "esri/symbols/SimpleLineSymbol",
        "esri/symbols/SimpleFillSymbol",
        "esri/symbols/PictureMarkerSymbol",
        "esri/symbols/TextSymbol",
        "dojo/colors",
        "dojo/on",
        "dojo/dom",
        "dojo/domReady!"
    ], function (Map, Extent,DynamicMapServiceLayer, FeatureLayer, GraphicsLayer, Graphic, Point, Polyline, Polygon, InfoTemplate, SimpleMarkerSymbol, SimpleLineSymbol,
                 SimpleFillSymbol, PictureMarkerSymbol, TextSymbol, Color, on, dom) {
        var initialExtent = new Extent({
            "spatialReference": { "wkid": 4326 }
        });

        var map = new Map("map", {
            basemap:"osm",
            center:[108.29656182, 38.04275177],
            zoom:4,
            extent:initialExtent,
            logo:false
        });
        //初始化pointLayer 用户数据点图层
        var pointLayer = new GraphicsLayer();
        map.addLayer(pointLayer);

        /**
         * 添加点图标
         * */
        function addUserPoint(stationName,stationArea,stationLng,stationLat,stationStatus,stationIP,stationPort,serverIP,serverPort) {
            //定义点的几何体
            var picpoint = new Point(stationLng,stationLat);
            // //定义点的图片符号
            if (stationStatus == "online"){
                var img_uri="/Ips_api_javascript/Ips/image/en.png";
            }else {
                var img_uri="/Ips_api_javascript/Ips/image/en-red.png";
            }
            var picSymbol = new PictureMarkerSymbol(img_uri,POINTSIZE,POINTSIZE);
            //定义点的图片符号
            var attr = {"stationName": stationName,
                        "stationStatus": stationStatus,
                        "stationArea": stationArea,
                        "stationIP": stationIP,
                        "stationPort": stationPort,
                        "serverIP": serverIP,
                        "serverPort": serverPort,
            };
            //信息模板
            var infoTemplate = new InfoTemplate();
            infoTemplate.setTitle('基准站');
            infoTemplate.setContent(
                "<b>基准站名:</b><span>${stationName}</span><br>"
                + "<b>地区:</b><span>${stationArea}</span><br>"
                + "<b>状态:</b><span>${stationStatus}</span><br>"
                + "<b>基准站IP:</b><span>${stationIP}</span><br>"
                + "<b>基准站端口:</b><span>${stationPort}</span><br>"
                + "<b>服务IP:</b><span>${serverIP}</span><br>"
                + "<b>服务端口:</b><span>${serverPort}</span><br>"
            );
            var picgr = new Graphic(picpoint, picSymbol, attr, infoTemplate);
            pointLayer.add(picgr);
            map.addLayer(pointLayer);
        }
        /**
         * 从数据库读取用户列表和用户最新坐标并更新界面
         */
        function getDataAndRefresh() {
            // 从云端读取数据
            $.get("/api/apiGetstationLocationList",
                {},
                function (dat, status) {
                    console.log(dat.data[0].stationID);
                    console.log(dat.data["stationLocation"][0].stationLng);
                    if (dat.status == 0) {
                        // 删除数据
                        pointLayer.clear();
                        //重绘
                        pointLayer.redraw();
                        for (var i in dat.data["stationLocation"]) {
                            // console.log(dat);
                            addUserPoint(
                                dat.data[i].stationName,
                                dat.data[i].stationArea,
                                dat.data["stationLocation"][i].stationLng,
                                dat.data["stationLocation"][i].stationLat,
                                dat.data[i].stationStatus,
                                dat.data[i].stationIP,
                                dat.data[i].stationPort,
                                dat.data[i].serverIP,
                                dat.data[i].serverPort
                            );
                        }
                    } else {
                        console.log('ajax error!');
                    }
                }
            );
        }
        /**
         * 刷新频率
         */
        setInterval(getDataAndRefresh, (INTERVAL_TIME * 1000));

        //显示初始化成功
    });




</script>
</html>