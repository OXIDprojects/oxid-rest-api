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

$router->get(
    '/', function () use ($router) {
    return $router->app->version();
}
);

// db only routes
$router->group(
    ['prefix' => 'rest/v1/', 'middleware' => 'auth'], function () use ($router) {
    // oxarticles
    $router->get('articles', ['uses' => 'ArticleController@showAllArticles']);
    $router->get('articles/{id}', ['uses' => 'ArticleController@showOneArticle']);
    $router->post('articles', ['uses' => 'ArticleController@create']);
    $router->delete('articles/{id}', ['uses' => 'ArticleController@delete']);
    $router->put('articles/{id}', ['uses' => 'ArticleController@update']);
}
);

// oxid object routes
$router->group(
    ['prefix' => 'rest/v1/object/', 'middleware' => 'auth'], function () use ($router) {
    // oxarticles
    $router->get('articles', ['uses' => 'ArticleControllerOxid@showAllArticles']);
    $router->get('articles/{id}', ['uses' => 'ArticleControllerOxid@showOneArticle']);
    $router->post('articles', ['uses' => 'ArticleControllerOxid@create']);
    $router->delete('articles/{id}', ['uses' => 'ArticleControllerOxid@delete']);
    $router->put('articles/{id}', ['uses' => 'ArticleControllerOxid@update']);
}
);
