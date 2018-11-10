<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Helpers\FilterHelper;
use Illuminate\Http\Request;

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
        // TODO: paging, limit, sorting
        // maybe use chunks, see https://stackoverflow.com/questions/39029449/limiting-eloquent-chunks#39033142
        // or custom paginators, see https://gist.github.com/simonhamp/549e8821946e2c40a617c85d2cf5af5e
        if (!empty($filters = FilterHelper::prepareFilters())) {
            if (($articles = Article::where(array_values($filters))->get()) && count($articles)) {
                return response()->json($articles);
            }
        } else {
            //if ($articles = collect(Article::all())->paginate(5)) {
            if ($articles = Article::all()) {
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
        if ($article = Article::find($id)) {
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
