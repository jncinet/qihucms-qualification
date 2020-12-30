<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'prefix' => config('qihu.qualification_prefix', 'qualification'),
    'namespace' => 'Qihucms\Qualification\Controllers\Api',
    'middleware' => ['api'],
    'as' => 'api.qualification.'
], function (Router $router) {
    // 查询个人认证资料
    $router->get('pas', 'PaController@check')->name('pa.check');
    // 申请个人认证
    $router->post('pas', 'PaController@store')->name('pa.store');
    // 查询企业认证
    $router->get('cos', 'CoController@check')->name('co.check');
    // 申请企业认证资料
    $router->post('cos', 'CoController@store')->name('co.store');
});

// 后台管理
Route::group([
    'prefix' => config('admin.route.prefix') . '/qualification',
    'namespace' => 'Qihucms\Qualification\Controllers\Admin',
    'middleware' => config('admin.route.middleware'),
    'as' => 'admin.'
], function (Router $router) {
    // 认证
    $router->resource('pas', 'PaController');
    $router->resource('cos', 'CoController');
});