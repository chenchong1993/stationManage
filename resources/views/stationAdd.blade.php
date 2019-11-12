<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
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
    <!--/meta 作为公共模版分离出去-->

    <title>新增基准站</title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-article-add" action="{{ url('/api/apiStationInfoAdd') }}" method="post">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>基准站名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="stationName" name="stationName">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>基准站IP：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="stationIP" name="stationIP">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>基准站端口：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="stationPort" name="stationPort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>服务IP：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="serverIP" name="serverIP">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>服务端口：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="serverPort" name="serverPort">
            </div>
        </div>
{{--        <div class="row cl">--}}
{{--            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>接入数据流类型：</label>--}}
{{--            <div class="formControls col-xs-8 col-sm-9">--}}
{{--                <span class="select-box inline">--}}
{{--                <select name="intype" class="select" id="intype" onchange="getInType()">--}}
{{--                    <option value="0">TCP</option>--}}
{{--                    <option value="1">Ntrip</option>--}}
{{--                </select>--}}
{{--                </span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row cl">--}}
{{--            <label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>挂载点：</label>--}}
{{--            <div class="formControls col-xs-8 col-sm-9">--}}
{{--                <input type="text" class="input-text" value="" placeholder="" id="mountpoint" name="mountpoint">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row cl">--}}
{{--            <label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>用户名：</label>--}}
{{--            <div class="formControls col-xs-8 col-sm-9">--}}
{{--                <input type="text" class="input-text" value="" placeholder="" id="username" name="username">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row cl">--}}
{{--            <label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>密码：</label>--}}
{{--            <div class="formControls col-xs-8 col-sm-9">--}}
{{--                <input type="text" class="input-text" value="" placeholder="" id="password" name="password">--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地区：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="stationArea" name="stationArea">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>纬度：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="stationLat" name="stationLat">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>经度：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="stationLng" name="stationLng">
            </div>
        </div>
{{--        <div class="row cl">--}}
{{--            <label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>X：</label>--}}
{{--            <div class="formControls col-xs-8 col-sm-9">--}}
{{--                <input type="text" class="input-text" value=""--}}
{{--                       placeholder="" id="stationX" name="stationX">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row cl">--}}
{{--            <label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>Y：</label>--}}
{{--            <div class="formControls col-xs-8 col-sm-9">--}}
{{--                <input type="text" class="input-text" value=""--}}
{{--                       placeholder="" id="stationY" name="stationY">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="row cl">--}}
{{--            <label class="form-label col-xs-4 col-sm-2"><span class="c-red"></span>Z：</label>--}}
{{--            <div class="formControls col-xs-8 col-sm-9">--}}
{{--                <input type="text" class="input-text" value=""--}}
{{--                       placeholder="" id="stationZ" name="stationZ">--}}
{{--            </div>--}}
{{--        </div>--}}


        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button  class="btn btn-primary radius" type="submit" onClick="check();"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
            </div>
        </div>
</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="hui/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="hui/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="hui/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="hui/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="hui/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="hui/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="hui/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="hui/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="hui/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">

    // var intype = 0;
    //
    // /**
    //  * 获取接入流类型
    //  */
    // function getInType(){
    //     var select = document.getElementById("intype");
    //     intype = select.value
    //     // console.log(intype);
    // }

    function check(){
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        // getInType();
        //console.log("222222222222222");

        //表单验证
        $("#form-article-add").validate({
            rules: {
                stationName: {
                    required: true,
                },
                stationIP: {
                    required: true,
                },
                stationPort: {
                    required: true,
                },
                serverIP: {
                    required: true,
                },
                serverPort: {
                    required: true,
                },
                stationArea: {
                    required: true,
                },
                stationLat:{
                    required:true,
                 },
                stationLng:{
                    required:true,
                },
            },
            onkeyup: false,
            focusCleanup: true,
            success: "valid",
        });
    });
    }
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>