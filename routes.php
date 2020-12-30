<?php

use Illuminate\Routing\Router;

// 接口
Route::group([
    'prefix' => config('qihu.qualification_prefix', 'qualification'),
    'namespace' => 'Qihucms\Qualification\Controllers\Api',
    'middleware' => ['api'],
], function (Router $router) {
    $router->apiResource('qualification-pas', 'PaController')->except(['index']);
    $router->apiResource('qualification-cos', 'CoController')->except(['index']);
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