<?php

$app->group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers',

], function ($app) {
    $app->post('/login', [
        'as' => 'login',
        'uses' => 'AdminController@login'
    ]);
    $app->get('/logout', [
        'as' => 'logout',
        'uses' => 'AdminController@logout'
    ]);
    $app->get('/me', [
        'as' => 'me',
        'uses' => 'AdminController@me'
    ]);

    $app->get('/', [
        'as' => 'index',
        'uses' => 'AdminController@index'
    ]);
    $app->post('/', [
        'as' => 'create',
        'uses' => 'AdminController@create'
    ]);
    $app->put('/{key:[-\w]+}', [
        'as' => 'update',
        'uses' => 'AdminController@update'
    ]);
});

/*
 * The frontend which does the actual redirecting
 */
$app->get('/{key:[-\w]*}', function($key) use ($app) {
    $target = $app['db']->table('link')->where('key', $key)->pluck('target');
    if ($target) {
        return redirect($target);
    }
    return redirect('http://chefkoch.de/');
});
