<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>基本设置</title>

    <!-- 菜单开始 -->
    <link rel="stylesheet" type="text/css" href="/css/menu/style.css"/>
    <!-- 菜单结束 -->
    <!-- 提示框开始 -->
    <link href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- 提示框结束 -->
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <!-- 提示框开始 -->
    <script src="/js/notify/bootstrap.min.js"></script>
    <script src="/js/notify/hullabaloo.js"></script>
    <!-- 提示框结束 -->
    <!-- tools -->
    <script type="text/javascript" src="/js/tools.js"></script>
    <!-- tools-->
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="hui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui.admin/css/style.css" />
</head>
<body>
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span> 基准站信息管理 <span class="c-gray en">&gt;</span> 基准站批量导入
    </nav>
<div class="page-container">
    <div>
        <textarea class="textarea" style="width:98%; height:300px; resize:none" placeholder="格式：&#13;&#10;基准站名,基准站IP,基准站端口,服务IP,服务端口,地区,纬度,经度;&#13;&#10;如：&#13;&#10;北京房山,111.11.111.11,10001,121.12.11.122,20001,北京,38.5,117.65;&#13;&#10;北京房山,111.11.111.11,10001,121.12.11.122,20001,北京,38.5,117.65;" id="stationImport" name="stationImport"></textarea>
    </div>
    <div class="mt-20 text-c">
        <button name="system-base-save" id="system-base-save" class="btn btn-success radius" type="submit" onclick="stationImport()"><i class="icon-ok" ></i> 导入</button>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<script type="text/javascript">
    var success = "添加成功！"; //初始化欢迎语句

    function stationImport() {
        var stationsInfo = document.getElementById("stationImport").value;
        $.post("/api/apiStationsInfoImport",
            {
                stationsInfo:stationsInfo
            },
            function (dat){
                console.log("11111111111");
                console.log(dat.data);
                if (dat.data != null){
                    for (var i in dat.data){
                        notify(dat.data[i], "sys");
                    }
                }else {
                    notify(success, "sys");
                }
            }
        );
    }
</script>
</body>
</html>