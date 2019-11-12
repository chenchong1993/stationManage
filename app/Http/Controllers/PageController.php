<?php


namespace App\Http\Controllers;


use App\stationInfo;
use App\stationLocation;
use Webpatser\Uuid\Uuid;

class PageController extends Controller
{
    /**
     * 测试
     */
    public function test(){
        $stationInfo = stationInfo::get();
        $stationNum = sizeof(stationInfo::get());
        $onlineNum = sizeof(stationInfo::where("stationStatus" ,'=', "online")->get());
        $stationInfo['stationNum'] = $stationNum;
        $stationInfo['onlineNum'] = $onlineNum;
        return view('welcome',['stationInfos'=>$stationInfo]);
    }
    /**
     * 主页
     */
    public function index(){
        return view('index');
    }
    /**
     * 基准站分布
     */
    public function stationsLocation(){
        return view('stationsLocation');
    }
    /**
     * 基准站列表
     */
    public function stationList(){
        $AreaName = rq('stationArea');
        $stationName = rq('stationName');
       // dd($AreaName);
        if ($stationName == null){
            if ($AreaName == null||$AreaName=="全国"){
                $stationInfo = stationInfo::all();
                return view('stationList',['stationInfos'=>$stationInfo]);
            }else{
                $stationInfo = stationInfo::where("stationArea" ,'=', $AreaName)->get();
                return view('stationList',['stationInfos'=>$stationInfo]);
            }
        }else{
            if($stationInfo = stationInfo::where("stationName" ,'=', $stationName)->get()){
                return view('stationList',['stationInfos'=>$stationInfo]);
            }
        }

    }
    /**
     * 基准站状态动态刷新
     */
    public function stationStatus(){
        $stationInfo = stationInfo::all();
        return view('stationStatus',['stationInfos'=>$stationInfo]);
    }
    /**
     * 添加基准站
     */
    public function stationAdd(){
        return view('stationAdd');
    }
    /**
     * 添加基准站
     */
    public function stationImport(){
        return view('stationImport');
    }
    /**
     * 编辑基准站
     */
    public function stationEdit(){
        $stationID = rq('stationID');
        $stationInfo = stationInfo::where("stationID" ,'=', $stationID)->get();
        $stationLocationInfo = stationLocation::where("stationID" ,'=', $stationID)->get();
        $stationInfo['stationLocation'] = $stationLocationInfo;
        return view('stationEdit',['stationInfos'=>$stationInfo]);
//        dump ($CORSinfo);
    }
}