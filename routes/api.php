<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$api = $app->make(Dingo\Api\Routing\Router::class);

$api->version('v1', function ($api) {
    
    $api->post('/auth/login', [
        'as' => 'api.auth.login',
        'uses' => 'App\Http\Controllers\Auth\AuthController@postLogin',
    ]);
    $api->post('/auth/recover', [
        'as' => 'api.auth.recover',
        'uses' => 'App\Http\Controllers\Auth\AuthController@postRecover',
    ]);

    $api->post('/auth/register', [
        'as' => 'api.auth.register',
        'uses' => 'App\Http\Controllers\UsersController@postRegister',
    ]);
    $api->post('/auth/request_email', [
        'as' => 'api.auth.request_email',
        'uses' => 'App\Http\Controllers\UsersController@request_email',
    ]);
    $api->post('/auth/request_phone', [
        'as' => 'api.auth.request_phone',
        'uses' => 'App\Http\Controllers\UsersController@request_phone',
    ]);
    $api->get('/auth/verify_email/{secretcode}', [
        'as' => 'api.auth.verify_email',
        'uses' => 'App\Http\Controllers\UsersController@verify_email',
    ]);
    $api->patch('/auth/verify_phone', [
        'as' => 'api.auth.verify_phone',
        'uses' => 'App\Http\Controllers\UsersController@verify_phone',
    ]);
    $api->post('/auth/reset_password', [
        'as' => 'api.auth.reset_password',
        'uses' => 'App\Http\Controllers\UsersController@reset_password',
    ]);
    $api->post('/auth/request_forgot_password', [
        'as' => 'api.auth.request_forgot_password',
        'uses' => 'App\Http\Controllers\UsersController@request_forgot_password',
    ]);
    $api->post('/auth/forgot_password/{secretcode}', [
        'as' => 'api.auth.forgot_password',
        'uses' => 'App\Http\Controllers\UsersController@forgot_password',
    ]);

    $api->group([
        'middleware' => 'api.auth',
        
    ], function ($api) {
        $api->get('/', [
            'uses' => 'App\Http\Controllers\APIController@getIndex',
            'as' => 'api.index'
        ]);
        $api->get('/auth/user', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@getUser',
            'as' => 'api.auth.user'
        ]);
        $api->patch('/auth/refresh', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@patchRefresh',
            'as' => 'api.auth.refresh'
        ]);
        $api->delete('/auth/invalidate', [
            'uses' => 'App\Http\Controllers\Auth\AuthController@deleteInvalidate',
            'as' => 'api.auth.invalidate'
        ]);

//USERS
        $api->get('/profiles', [
            'uses' => 'App\Http\Controllers\UsersController@index',
            'as' => 'api.auth.users'
        ]);
        $api->get('/profile/{username}', [
            'uses' => 'App\Http\Controllers\UsersController@view',
            'as' => 'api.auth.view'
        ]);

        $api->put('/me/update', [
            'uses' => 'App\Http\Controllers\UsersController@update',
            'as' => 'api.auth.update'
        ]);
        $api->patch('/me/changepassword', [
            'uses' => 'App\Http\Controllers\UsersController@change_password',
            'as' => 'api.auth.changepassword'
        ]);

        $api->post('/me/logout', [
            'uses' => 'App\Http\Controllers\UsersController@logout',
            'as' => 'api.auth.logout'
        ]);
        $api->post('/me/changepicture', [
            'uses' => 'App\Http\Controllers\UsersController@uploadImage',
            'as' => 'api.auth.changepicture'
        ]);
        
    });
});