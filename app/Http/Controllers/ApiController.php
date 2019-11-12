<?php


namespace App\Http\Controllers;


use App\stationInfo;
use App\stationLocation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class ApiController extends Controller
{
    /**
     * 测试路由
     */
    public function apiTest()
    {
        return 0;

    }

    /**
     * 从数据库中获取基准站坐标并刷新到地图上
     */
    public function apiGetstationLocationList(){
        $stationInfo = stationInfo::get();
        $stationLocationInfo = stationLocation::get();
        $stationInfo['stationLocation'] = $stationLocationInfo;
        return suc($stationInfo);
    }
    /**
     * 封装json格式的POST请求
     */
    public function apiPostJson($url,$data)
    {
        header("Content-type:application/json;charset=utf-8");
        //这里需要注意的是这里php会自动对json进行编码，而一些java接口不自动解码情况（中文）
        $json_data = json_encode($data,JSON_UNESCAPED_UNICODE);
//$json_data = json_encode($data);
//curl方式发送请求
        $ch = curl_init();
//设置请求为post
        curl_setopt($ch, CURLOPT_POST, 1);
//请求地址
        curl_setopt($ch, CURLOPT_URL, $url);
//json的数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//显示请求头
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
//请求头定义为json数据
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json;charset=utf-8',
                'Content-Length: '.strlen($json_data)
            )
        );
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    /**
     * 添加基准站接口
     */
    public function apiStationInfoAdd(){
        //控制器验证，如果通过继续往下执行，如果没通过抛出异常返回当前视图。
        $validator = Validator::make(rq(), [
            'stationName' => 'required',
            'stationIP' => 'required',
            'stationPort' => 'required',
            'serverIP' => 'required',
            'serverPort' => 'required',
            'stationArea' => 'required',
            'stationX' => '',
            'stationY' => '',
            'stationZ' => '',
            'stationLat' => 'required',
            'stationLng' => 'required'
        ]);
        if ($validator->fails())
            return err(1, $validator->messages());

        $stationID = Uuid::generate();
        $stationName = rq('stationName');
        $stationName_pinyin = pinyin_abbr($stationName);
        $stationIP = rq('stationIP');
        $stationPort = rq('stationPort');
        $serverIP = rq('serverIP');
        $serverPort = rq('serverPort');
        $stationArea = rq('stationArea');
        //$stationX = rq('CORSX');
        //$stationY = rq('CORSY');
        $stationLat = rq('stationLat');
        $stationLng = rq('stationLng');
        $serverCmd = "tcp -t tcp -p :".$serverPort." -T tcp -P ".$stationIP.":".$stationPort;

        //验证逻辑，确保站名和服务端口是唯一的
        $nameNum = sizeof(stationInfo::where("stationName" ,'=', $stationName)->get());
        $pinyinNum = sizeof(stationInfo::where("stationName_pinyin" ,'=', $stationName_pinyin)->get());
        //$IPNum = sizeof(stationInfo::where("serverIP" ,'=', $serverIP)->get());
        $portNum = sizeof(stationInfo::where("serverPort" ,'=', $serverPort)->get());
        if ($nameNum == 0 ){
            if ($pinyinNum == 0 ){
                if ($portNum == 0 ) {
                    $stationInfo = new stationInfo();
                    $stationInfo->stationID = $stationID;
                    $stationInfo->stationName = $stationName;
                    $stationInfo->stationName_pinyin = $stationName_pinyin;
                    $stationInfo->stationIP = $stationIP;
                    $stationInfo->stationPort = $stationPort;
                    $stationInfo->stationStatus = "offline";
                    $stationInfo->serverIP = $serverIP;
                    $stationInfo->serverPort = $serverPort;
                    $stationInfo->stationArea = $stationArea;
                    $stationInfo->serverCmd = $serverCmd;

                    $stationLocationInfo = new stationLocation();
                    $stationLocationInfo->stationID = $stationID;
                    $stationLocationInfo->stationArea = $stationArea;
                    $stationLocationInfo->stationLat = $stationLat;
                    $stationLocationInfo->stationLng = $stationLng;

                    if ($stationInfo->save() && $stationLocationInfo->save()) {
                        return "添加成功<br>";
                    } else {
                        return "请检查输入的数据<br>";
                    }
                }else{
                    return "服务器".$serverIP."端口".$serverPort."已被占用<br>";
                }
            }
            else{
                return "基准站名首字母已被占用<br>";
            }
        }else{
            return "基准站名已被占用<br>";
        }
    }
    /**
     * 基准站批量导入
     */
    public function apiStationsInfoImport(){
        //控制器验证，如果通过继续往下执行，如果没通过抛出异常返回当前视图。
        $validator = Validator::make(rq(), [
            'stationsInfo' => 'required',
        ]);
        if ($validator->fails())
            return err(1, $validator->messages());

        $stationsInfo = rq('stationsInfo');

        $stationsArry = explode(";",$stationsInfo,-1);
        $importStatus = array();
        //$stationArry = array();
        for ($i=0; $i<sizeof($stationsArry); $i++) {
            $stationsArry[$i] = trim($stationsArry[$i],"\n");
            $stationArry[$i] = explode(",",$stationsArry[$i]);

            $stationArry[$i][8] = pinyin_abbr($stationArry[$i][0]);  //基准站名称拼音
            $stationArry[$i][9] = "tcp -t tcp -p :".$stationArry[$i][4]." -T tcp -P ".$stationArry[$i][1].":".$stationArry[$i][2];
            $stationArry[$i][10] = Uuid::generate();

            //验证逻辑，确保站名和服务端口是唯一的
            $nameNum = sizeof(stationInfo::where("stationName" ,'=', $stationArry[$i][0])->get());
            $pinyinNum = sizeof(stationInfo::where("stationName_pinyin" ,'=', $stationArry[$i][8])->get());
            //$IPNum = sizeof(stationInfo::where("serverIP" ,'=', $serverIP)->get());
            $portNum = sizeof(stationInfo::where("serverPort" ,'=', $stationArry[$i][4])->get());
            if ($nameNum == 0 ){
                if ($pinyinNum == 0 ){
                    if ($portNum == 0 ) {
                        $stationInfo[$i] = new stationInfo();
                        $stationInfo[$i]->stationID = $stationArry[$i][10];
                        $stationInfo[$i]->stationName = $stationArry[$i][0];
                        $stationInfo[$i]->stationName_pinyin = $stationArry[$i][8];
                        $stationInfo[$i]->stationIP = $stationArry[$i][1];
                        $stationInfo[$i]->stationPort = $stationArry[$i][2];
                        $stationInfo[$i]->stationStatus = "offline";
                        $stationInfo[$i]->serverIP = $stationArry[$i][3];
                        $stationInfo[$i]->serverPort = $stationArry[$i][4];
                        $stationInfo[$i]->stationArea = $stationArry[$i][5];
                        $stationInfo[$i]->serverCmd = $stationArry[$i][9];

                        $stationLocationInfo[$i] = new stationLocation();
                        $stationLocationInfo[$i]->stationID = $stationArry[$i][10];
                        $stationLocationInfo[$i]->stationArea = $stationArry[$i][5];
                        $stationLocationInfo[$i]->stationLat = $stationArry[$i][6];
                        $stationLocationInfo[$i]->stationLng = $stationArry[$i][7];

                        if ($stationInfo[$i]->save() && $stationLocationInfo[$i]->save()) {
//                            echo "基准站".$stationArry[$i][0]."添加成功";
                        } else {
//                            echo "请检查输入的数据";
                        }
                    }else{
                        //echo "添加基准站：".$stationArry[$i][0]."时，服务器".$stationArry[$i][3]."端口".$stationArry[$i][4]."已被占用";
                        $importStatus[$i] = "添加基准站：".$stationArry[$i][0]."时，服务器".$stationArry[$i][3]."端口".$stationArry[$i][4]."已被占用";
                    }
                }
                else{
                   // echo "添加基准站：".$stationArry[$i][0]."时，基准站名首字母已被占用";
                    $importStatus[$i] = "添加基准站：".$stationArry[$i][0]."时，基准站名首字母已被占用";
                }
            }else{
                //echo "添加基准站：".$stationArry[$i][0]."时，基准站名已被占用";
                $importStatus[$i] = "添加基准站：".$stationArry[$i][0]."时，基准站名已被占用";
            }
        }
        return suc($importStatus);
    }
    /**
     * 删除用户接口
     */
    public function apiStationDelete()
    {
        $stationID = rq('stationID');
        $stationInfo = stationInfo::where("stationID",'=',$stationID)->first();
        $stationLocationInfo = stationLocation::where("stationID",'=',$stationID)->first();
        if ($stationInfo->delete()&&$stationLocationInfo->delete()){
            return 0;
        }else{
            return 1;
        }

    }
    /**
     * 编辑基准站接口
     * 编辑功能的验证逻辑没写好，先不用这个功能
     */
    public function apiStationInfoEdit(){
        //控制器验证，如果通过继续往下执行，如果没通过抛出异常返回当前视图。
        $validator = Validator::make(rq(), [
            'stationID'=>'required',
            'stationName' => 'required',
            'stationIP' => 'required',
            'stationPort' => 'required',
            'serverIP' => 'required',
            'serverPort' => 'required',
            'stationArea' => 'required',
            'stationX' => '',
            'stationY' => '',
            'stationZ' => '',
            'stationLat' => 'required',
            'stationLng' => 'required'
        ]);
        if ($validator->fails())
            return err(1, $validator->messages());

        $stationID = rq('stationID');
        $stationName = rq('stationName');
        $stationName_pinyin = pinyin_abbr($stationName);
        $stationIP = rq('stationIP');
        $stationPort = rq('stationPort');
        $serverIP = rq('serverIP');
        $serverPort = rq('serverPort');
        $stationArea = rq('stationArea');
        $stationLat = rq('stationLat');
        $stationLng = rq('stationLng');
        $serverCmd = "tcp -t tcp -p :".$serverPort." -T tcp -P ".$stationIP.":".$serverPort;

        $stationInfo = stationInfo::where("stationID" ,'=', $stationID)->first();
        $stationLocationInfo = stationLocation::where("stationID" ,'=', $stationID)->first();

        //验证逻辑，确保站名和服务端口是唯一的
        $nameNum = sizeof(stationInfo::where("stationName" ,'=', $stationName)->get());
        $pinyinNum = sizeof(stationInfo::where("stationName_pinyin" ,'=', $stationName_pinyin)->get());
        //$IPNum = sizeof(stationInfo::where("serverIP" ,'=', $serverIP)->get());
        $portNum = sizeof(stationInfo::where("serverPort" ,'=', $serverPort)->get());

        if ($nameNum>0){
            return "基准站名重复";
        }elseif ($pinyinNum>0){
            return "基准站名首字母重复";
        }elseif ($portNum>0){
            return "服务端口重复";
        }else{
            $stationInfo->stationName = $stationName;
            $stationInfo->stationName_pinyin = $stationName_pinyin;
            $stationInfo->stationIP = $stationIP;
            $stationInfo->stationPort = $stationPort;
            $stationInfo->stationStatus = "offline";
            $stationInfo->serverIP = $serverIP;
            $stationInfo->serverPort = $serverPort;
            $stationInfo->stationArea = $stationArea;
            $stationInfo->serverCmd = $serverCmd;

            //$stationLocationInfo->stationID = $stationID;
            $stationLocationInfo->stationArea = $stationArea;
            $stationLocationInfo->stationLAT = $stationLat;
            $stationLocationInfo->stationLNG = $stationLng;

            if ($stationInfo->update() && $stationLocationInfo->update()) {
                return "编辑成功<br>";
            } else {
                return "请检查输入的数据<br>";
            }
        }
    }
    /**
     * 更新基准站在线状态接口
     * @return array
     */
    public function apiStationStatus(){
        //控制器验证，如果通过继续往下执行，如果没通过抛出异常返回当前视图。
        $validator = Validator::make(rq(), [
            'stationID'=>'required|exists:stationInfo,stationID',
            'stationStatus' => 'required'
        ]);
        if ($validator->fails())
            return err(1, $validator->messages());


        $targetStationStatus = '';
        if (rq('stationStatus') == 'online')
            $targetStationStatus = 'offline';
        else
            $targetStationStatus = 'online';


        DB::table('stationInfo')->where('stationID',rq('stationID'))->update(['stationStatus'=>$targetStationStatus]);

        return suc();
    }
    /**
     * 外部接口：获取基准站信息列表
     */
    public function apiGetStationInfo(){
        $stationInfo = stationInfo::get();
        return $stationInfo;
    }

}