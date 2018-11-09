<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllArticles()
    {
        return response()->json(Article::all());
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneArticle($id)
    {
        return response()->json(Article::find($id));
    }

    /**
     * @param $column
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showArticlesByColumn($column, $id)
    {
        return response()->json(Article::findByColumn($column, $id));
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $Article = Article::create($request->all());

        return response()->json($Article, 201);
    }

    /**
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $Article = Article::findOrFail($id);
        $Article->update($request->all());

        return response()->json($Article, 200);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function delete($id)
    {
        Article::findOrFail($id)->delete();

        return response('Deleted Successfully', 200);
    }

}
