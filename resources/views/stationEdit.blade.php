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

    <title>编辑基准站</title>
</head>
<body>
<article class="page-container">
    <form class="form form-horizontal" id="form-article-add"  method="post" action="{{url('/api/apiStationInfoEdit')}}">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>基准站id：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" readonly="readonly" value="{{old('stationID')?old('stationID'):$stationInfos[0]->stationID}}"
                       placeholder="" id="stationID" name="stationID">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>基准站名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('stationName')?old('stationMame'):$stationInfos[0]->stationName}}"
                       placeholder="" id="stationName" name="stationName">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>基准站IP：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('stationIP')?old('stationIP'):$stationInfos[0]->stationIP}}"
                       placeholder="" id="stationIP" name="stationIP">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>基准站端口：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('stationPort')?old('stationPort'):$stationInfos[0]->stationPort}}"
                       placeholder="" id="stationPort" name="stationPort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>服务IP：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('serverIP')?old('serverIP'):$stationInfos[0]->serverIP}}"
                       placeholder="" id="serverIP" name="serverIP">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>服务端口：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('serverPort')?old('serverPort'):$stationInfos[0]->serverPort}}"
                       placeholder="" id="serverPort" name="serverPort">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地区：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('stationArea')?old('stationArea'):$stationInfos[0]->stationArea}}"
                       placeholder="" id="stationArea" name="stationArea">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>纬度：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('stationLat')?old('stationLat'):$stationInfos['stationLocation'][0]->stationLat}}"
                       placeholder="" id="stationLat" name="stationLat">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>经度：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{old('stationLng')?old('stationLng'):$stationInfos['stationLocation'][0]->stationLng}}"
                       placeholder="" id="stationLng" name="stationLng">
            </div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 保存并提交</button>
                {{--<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>--}}
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

    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

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

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>