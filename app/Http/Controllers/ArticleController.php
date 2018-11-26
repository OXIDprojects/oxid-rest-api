<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Article;
use App\Helpers\FilterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers
 */
class ArticleController extends Controller
{

    /**
     * Get all articles
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllArticles()
    {
        $limit = (Input::get('limit') ? Input::get('limit') : '100');
        $page = (Input::get('page') ? Input::get('page') : '1');
        $skip = ($page > 1 ? ($page - 1) * $limit : 0);
        $order_by = (Input::get('order_by') ? Input::get('order_by') : 'oxartnum');
        $order = (Input::get('order') ? Input::get('order') : 'asc');

        if (!empty($filters = FilterHelper::prepareFilters())) {
            if (($articles = Article::leftJoin('oxartextends', 'oxarticles.oxid', '=', 'oxartextends.oxid')->where(array_values($filters))->orderBy($order_by, $order)->skip($skip)->take($limit)->get()) && count($articles)) {
                return response()->json($articles);
            }
        } else {
            if ($articles = Article::leftJoin('oxartextends', 'oxarticles.oxid', '=', 'oxartextends.oxid')->whereNotNull('oxarticles.oxid')->orderBy($order_by, $order)->skip($skip)->take($limit)->get()) {
                return response()->json($articles);
            }
        }

        return response('No articles found', 404);
    }

    /**
     * Get only one article
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneArticle($id)
    {
        if ($article = Article::leftJoin('oxartextends', 'oxarticles.oxid', '=', 'oxartextends.oxid')->find($id)) {
            return response()->json($article);
        }

        return response('Article with id ' . $id . ' not found', 404);
    }

    /**
     * Create an article
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        // this fails since OXID is blacklisted in model ...
        //$Article = Article::create($request->json()->all());
        // so we need a workaround
        $Article = new Article;
        $id = $request->json()->get('OXID');
        // if no OXID provided, generate a new one
        if (!$id) {
            $id = $this->generateUId();
            $Article->OXID = $id;
        }
        // we need to force setting the id ...
        // TODO: maybe remove OXID from $guarded and
        // just let it overwrite? Or find a better solution
        // for create vs. update and OXID field ... :)
        $Article->setSkipGuarded(true);
        $Article->fill($request->json()->all());
        $Article->save();
        // activate blacklist again ...
        $Article->setSkipGuarded(false);
        // reload article
        $Article = Article::findOrFail($id);

        return response()->json($Article, 201);
    }

    /**
     * Update an article
     *
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $Article = Article::findOrFail($id);
        $Article->update($request->json()->all());

        return response()->json($Article, 200);
    }

    /**
     * Delete an article
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function delete($id)
    {
        if ($article = Article::find($id)) {
            if ($article->delete()) {
                return response('Article with id ' . $id . ' deleted successfully', 200);
            }
        }

        return response('Article with id ' . $id . ' not found', 404);
    }

}
