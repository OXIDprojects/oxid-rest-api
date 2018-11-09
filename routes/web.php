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
    '/rest/', function () use ($router) {
        return $router->app->version();
    }
);

$router->group(
    ['prefix' => 'rest/v1'], function () use ($router) {
        // oxarticles
        $router->get('articles', ['uses' => 'ArticleController@showAllArticles']);
        $router->get('articles/{column}/{id}', ['uses' => 'ArticleController@showArticlesByColumn']);
        $router->get('articles/{id}', ['uses' => 'ArticleController@showOneArticle']);
        $router->post('articles', ['uses' => 'ArticleController@create']);
        $router->delete('articles/{id}', ['uses' => 'ArticleController@delete']);
        $router->put('articles/{id}', ['uses' => 'ArticleController@update']);
    }
);
$router->group(
    ['prefix' => 'rest/v1/object'], function () use ($router) {
        // Oxid Bootstrap routes
        $router->get('articles/{id}', ['uses' => 'OxidArticleController@showOneArticleFull']);
    }
);
