<?php

$app->group([
    'prefix' => 'api',
    'namespace' => 'App\Http\Controllers',

], function ($app) {
    $app->post('/login', [
        'as' => 'login',
        'uses' => 'AdminController@login'
    ]);
});

$app->group([
    'middleware' => 'auth.chefkoch',
    'prefix' => 'api',
    'namespace' => 'App\Http\Controllers',

], function ($app) {
    $app->get('/me', [
        'as' => 'me',
        'uses' => 'AdminController@me'
    ]);
    $app->get('/', [
        'as' => 'links',
        'uses' => 'AdminController@links'
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
 * The backend to manipulate links
 */
$app->get('/admin', function() {
    return view('admin');
});

/*
 * The frontend which does the actual redirecting
 */
$app->get('/{key:[-\w]*}', function($key) use ($app) {
    $target = $app['db']->table('link')->where('key', $key)->pluck('target');
    if ($target) {
        return redirect($target);
    }
    return redirect(getenv('APP_DEFAULT_URL'));
});
