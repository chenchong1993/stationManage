<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="hui/lib/html5shiv.js"></script>
    <script type="text/javascript" src="hui/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="hui/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="hui/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="hui/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>基准站站信息列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 基准站信息管理 <span class="c-gray en">&gt;</span> 基准站信息列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c" style="float: left ;padding-bottom: 10px">
        <span class="select-box inline">
            <select name="AreaID" class="select" id="AreaID" onchange="searchArea()">
                <option value="kongbai">请选择区域</option>
                <option value="quanguo">全国</option>
                <option value="beijing">北京市</option>
                <option value="hunan">湖南省</option>
                <option value="hebei">河北省</option>
                <option value="shanxi">山西省</option>
                <option value="neimenggu">内蒙古</option>
                <option value="liaoning">辽宁省</option>
                <option value="jilin">吉林省</option>
                <option value="heilongjiang">黑龙江</option>
		</select>
        </span>
    </div>
    <div class="text-c" style="float: right">
        <input type="text" class="input-text" style="width:250px" placeholder="输入基准站名" id="stationName" name="stationName">
        <button type="submit" class="btn btn-success radius" id="" name="" onclick="searchStation()"><i class="Hui-iconfont">&#xe665;</i> 搜基准站</button>
    </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-sort table-responsive">
            <thead>
            <tr class="text-c">

                <th width="60">基准站名</th>
                <th width="90">基准站站IP</th>
                <th width="60">基准站端口</th>
                <th width="90">服务IP</th>
                <th width="60">服务端口</th>
                <th width="40">地区</th>
                <th width="60">是否已启用</th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-cc"></tr>
            @foreach($stationInfos as $stationInfo)
                <tr class="text-c">
                    <td>{{ $stationInfo->stationName }}</td>
                    <td>{{ $stationInfo->stationIP }}</td>
                    <td>{{ $stationInfo->stationPort}}</td>
                    <td>{{ $stationInfo->serverIP }}</td>
                    <td>{{ $stationInfo->serverPort }}</td>
                    <td>{{ $stationInfo->stationArea }}</td>
                    @if($stationInfo->stationStatus == 'online')
                    <td class="td-status">
                        <span class="label label-success radius">已启用</span>
                    </td>
                    @else
                    <td class="td-status">
                        <span class="label label-default radius">已禁用</span>
                    </td>
                    @endif
                    <td class="f-14 td-manage">
                        <a style="text-decoration:none" onClick="stationStatus(this,'{{ $stationInfo->stationID}}','{{$stationInfo->stationStatus}}')" href="javascript:;" title="
                         @if($stationInfo->stationStatus == 'online')
                            停用
                         @else
                            开启
                         @endif
                            ">
                            <i class="Hui-iconfont">
                                @if($stationInfo->stationStatus == 'online')
                                    &#xe631;
                                @else
                                    &#xe615;
                                @endif
                            </i>
                        </a>
{{--编辑功能的验证没想好，先不用这个功能--}}
{{--                        <a style="text-decoration:none" class="ml-5" onClick="CORS_edit('{{ $stationInfo->stationID}}')" href="javascript:;" title="编辑">--}}
{{--                            <i class="Hui-iconfont">&#xe6df;</i>--}}
{{--                        </a>--}}
                        <a style="text-decoration:none" class="ml-5" onClick="CORSinfo_del(this,'{{ $stationInfo->stationID }}')" href="javascript:;" title="删除">
                            <i class="Hui-iconfont">&#xe6e2;</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<script type="text/javascript">
    // 定义全局变量
    var AreaName = "全国";

    /*编辑基准站信息*/
    function CORS_edit(stationID){
        console.log(stationID);
        window.location.href = '/stationEdit?stationID=' + stationID;
    }
    /*删除基准站*/
    function CORSinfo_del(obj,stationID){
        layer.confirm('确认要删除吗？',function(index){
            console.log(stationID);
            $.post("/api/apiStationDelete",
                {
                    stationID:stationID
                },
                function (data){
                if (data == 0){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }else {
                    console.log(data.msg);
                }
                }
            );

        });
    }
    /**
     * 获取地区编码
     */
    function getAreaID(){
        var select = document.getElementById("AreaID");
        AreaID = select.value
    }
    /**
     * 获取地区名
     */
    function  getAreaName(AreaID) {
        if (AreaID=="quanguo"){
            AreaName = "全国";
        }
        if (AreaID=="beijing"){
            AreaName = "北京";
        }
        if (AreaID=="hunan"){
            AreaName = "湖南";
        }
        if (AreaID=="hebei"){
            AreaName = "河北";
        }
        if (AreaID=="shanxi"){
            AreaName = "山西";
        }
        if (AreaID=="neimenggu"){
            AreaName = "内蒙古";
        }
        if (AreaID=="liaoning"){
            AreaName = "辽宁";
        }
        if (AreaID=="jilin"){
            AreaName = "吉林";
        }
        if (AreaID=="heilongjiang"){
            AreaName = "黑龙江";
        }
    }

    /**
     *根据下拉框的选择对，点击检索出目标省的基准站信息数据
     * @param AreaID 省ID
     */
    function searchArea() {
        var AreaID = document.getElementById("AreaID").value;
        console.log(AreaID)
        getAreaName(AreaID);
        console.log(AreaName);
        window.location.href = '/stationList?stationArea=' + AreaName;
    }
    function searchStation() {
        var stationName = document.getElementById("stationName").value;
        window.location.href = '/stationList?stationName=' + stationName;
        console.log(stationName)
    }

    /**
     * 改变数据站状态，通过网页控制基准站在线状态
     * @param obj
     * @param id
     * @param stationStatus
     */
    function stationStatus(obj,id,stationStatus){
        if (stationStatus == "online"){
            layer.confirm('确认要停用吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.post("/api/apiStationStatus",
                    {
                        'stationID': id,
                        'stationStatus':stationStatus
                    },
                    function (dat, status) {
                        if (dat.status == 0) {
                            console.log(dat.data);

                            layer.msg('已停用!',{icon: 5,time:1000});

                            location.reload();
                        } else {
                            console.log('ajax error!');
                        }
                    }
                );

            });
        }
        else{
            layer.confirm('确认要启用吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.post("/api/apiStationStatus",
                    {
                        'stationID': id,
                        'stationStatus':stationStatus
                    },
                    function (dat, status) {
                        if (dat.status == 0) {
                            console.log(dat.data);

                            layer.msg('已启用!',{icon: 6,time:1000});

                            location.reload();
                        } else {
                            console.log('ajax error!');
                        }
                    }
                );

            });
        }

    }


</script>
</body>
</html>