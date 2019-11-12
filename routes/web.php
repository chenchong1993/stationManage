<?php

function rq($key = null)
{
    return ($key == null) ? \Illuminate\Support\Facades\Request::all() : \Illuminate\Support\Facades\Request::get($key);
}

/**
 * @param null $data
 * @return array 成功返回0
 */
function suc($data = null)
{
    $ram = ['status' => 0];
    if ($data) {
        $ram['data'] = $data;
        return $ram;
    }
    return $ram;
}

/**
 * @param $code
 * @param null $data
 * @return array 失败返回错误码和信息
 */
function err($code, $data = null)
{
    if ($data)
        return ['status' => $code, 'data' => $data];
    return ['status' => $code];
}


Route::group(['middleware' => 'web'], function () {

    Route::get('test', 'PageController@test');//测试
    Route::get('index', 'PageController@index')->middleware('auth');//主页
    Route::get('stationList', 'PageController@stationList');//基准站列表
    Route::get('stationAdd', 'PageController@stationAdd');//添加基准站
    Route::get('stationEdit', 'PageController@stationEdit');//编辑基准站
    Route::get('stationImport', 'PageController@stationImport');//基准站批量导入
    Route::get('stationsLocation', 'PageController@stationsLocation');//基准站网分布
    Route::get('stationStatus', 'PageController@stationStatus');//基准站列表

    Route::group(['prefix' => 'api'], function () {
        Route::get('apiTest', 'ApiController@apiTest');//测试路由
        Route::post('apiStationInfoAdd', 'ApiController@apiStationInfoAdd');//添加基准站信息
        Route::post('apiStationsInfoImport', 'ApiController@apiStationsInfoImport');//批量导入基准站信息
        Route::post('apiStationInfoEdit', 'ApiController@apiStationInfoEdit');//修改CORS站信息
        Route::post('apiStationDelete','ApiController@apiStationDelete'); //删除基准站
        Route::post('apiStationStatus','ApiController@apiStationStatus'); //获取基准站在线状态
        Route::get('apiGetstationLocationList','ApiController@apiGetstationLocationList'); //获取基准站位置
        Route::get('apiGetStationInfo','ApiController@apiGetStationInfo'); //外部接口，获取基准站信息列表


        Route::get('apiAddInfo/{stationArea}','ApiController@apiAddInfo'); //



    });
});

Route::get('/', 'PageController@index')->middleware('auth');
Route::get('/home', 'PageController@index')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index');
