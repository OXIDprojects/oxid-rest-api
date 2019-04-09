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
 * @OA\Info(
 *     title="OXID REST API",
 *     version="1.3.2",
 *     description="A community project started on the OXID Hackathon 2018. It's based on the PHP micro framework Lumen",
 *
 *     @OA\License(
 *          name="License",
 *          url="https://docs.oxid-projects.com/oxid-rest-api/license"
 *     )
 * )
 *
 * @OA\Server(
 *      url="http://localhost",
 *      description="Development Server"
 * )
 *
 * @OA\Tag(
 *     name="Articles",
 *     description=""
 * )
 *
 * @package App\Http\Controllers
 */
class ArticleController extends Controller {

    /**
     *
     * @OA\Get(
     *      path="/rest/v1/articles",
     *      description="Get all articles",
     *      operationId="getAll",
     *      security={
     *          { "apiToken": {"t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs"} }
     *      },
     *      tags={"Articles"},
     *      @OA\Response(response="200", description="An example resource"),
     *      @OA\Response(response="404", description="No articles found")
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showAllArticles() {
        try {
            $limit = (Input::get('limit') ? Input::get('limit') : '100');
            $page = (Input::get('page') ? Input::get('page') : '1');
            $skip = ($page > 1 ? ($page - 1) * $limit : 0);
            $order_by = (Input::get('order_by') ? Input::get('order_by') : 'oxartnum');
            $order = (Input::get('order') ? Input::get('order') : 'asc');

            if (!empty($filters = FilterHelper::prepareFilters())) {
                if (($articles = Article::leftJoin('oxartextends', 'oxarticles.oxid', '=', 'oxartextends.oxid')->where(array_values($filters))->orderBy($order_by, $order)->skip($skip)->take($limit)->get()) && count($articles)) {
                    return response()->json($articles);
                }
            }

            if ($articles = Article::leftJoin('oxartextends', 'oxarticles.oxid', '=', 'oxartextends.oxid')->whereNotNull('oxarticles.oxid')->orderBy($order_by, $order)->skip($skip)->take($limit)->get()) {
                return response()->json($articles);
            }

            return response('No articles found', 404);
        } catch (\Exception $error) {
            return response($error->getMessage(), $error->getCode() ?: 404);
        }
    }

    /**
     *
     * @OA\Get(
     *      path="/rest/v1/articles/{id}",
     *      description="Get only one article",
     *      operationId="getOne",
     *      security={
     *          { "apiToken": {"t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs"} }
     *      },
     *      tags={"Articles"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="String ID of the Article to get",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(response="200", description=""),
     *      @OA\Response(response="404", description="Article with id not found"),
     *
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function showOneArticle($id) {
        try {
            $article = Article::leftJoin('oxartextends', 'oxarticles.oxid', '=', 'oxartextends.oxid')->findOrFail($id);
            return response()->json($article);
        } catch (\Exception $error) {
            return response($error->getMessage(), $error->getCode() ?: 404);
        }
    }

    /**
     *
     * @OA\Post(
     *      path="/rest/v1/articles",
     *      description="Create an article",
     *      operationId="create",
     *      security={
     *          { "apiToken": {"t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs"} }
     *      },
     *      tags={"Articles"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Create an article object",
     *          @OA\JsonContent(ref="#/components/schemas/Article")
     *      ),
     *      @OA\Response(response="200", description=""),
     *      @OA\Response(response="404", description="Article with id not found"),
     * )
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request) {

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
     *
     * @OA\Put(
     *      path="/rest/v1/articles/{id}",
     *      description="Update an article",
     *      operationId="update",
     *      security={
     *          { "apiToken": {"t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs"} }
     *      },
     *      tags={"Articles"},
     *      @OA\RequestBody(
     *          required=true,
     *          description="Update an article object",
     *          @OA\JsonContent(ref="#/components/schemas/Article")
     *      ),
     *      @OA\Response(response="200", description=""),
     *      @OA\Response(response="404", description="Article with id not found"),
     * )
     *
     * @param         $id
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request) {
        try {
            $Article = Article::findOrFail($id);
            $Article->update($request->json()->all());

            return response()->json($Article, 200);
        } catch (\Exception $error) {
            return response($error->getMessage(), $error->getCode() ?: 404);
        }
    }

    /**
     *
     * @OA\Delete(
     *      path="/rest/v1/articles/{id}",
     *      description="Delete an article",
     *      operationId="delete",
     *      security={
     *          { "apiToken": {"t6PEqwkBpbdsf93osDSF913Bmcsd78pYWLtEgvs"} }
     *      },
     *      tags={"Articles"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="String ID of the Article to get",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Response(response="200", description=""),
     *      @OA\Response(response="404", description="Article with id not found"),
     *
     * )
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function delete($id) {
        try {
            $article = Article::findOrFail($id);

            if ($article->delete()) {
                return response('Article with id ' . $id . ' deleted successfully', 200);
            }

        } catch (\Exception $error) {
            return response($error->getMessage(), $error->getCode() ?: 404);
        }
    }
}