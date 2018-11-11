<?php

namespace App\Http\Controllers;

use App\Article;
use App\Helpers\FilterHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

// OXID classes
use OxidEsales\Eshop\Application\Model\Article as OxidArticle;
use OxidEsales\Eshop\Application\Model\ArticleList as OxidArticleList;
use OxidEsales\Eshop\Core\UtilsObject as OxidUtils;

/**
 * Class ArticleControllerOxid
 *
 * @package App\Http\Controllers
 */
class ArticleControllerOxid extends BaseControllerOxid
{

    /**
     * Get only one article
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function showAllArticles()
    {
        $limit = (Input::get('limit') ? Input::get('limit') : '10');
        $page = (Input::get('page') ? Input::get('page') : '1');
        $skip = ($page > 1 ? ($page - 1) * $limit : 0);
        $order_by = (Input::get('order_by') ? Input::get('order_by') : 'oxartnum');
        $order = (Input::get('order') ? Input::get('order') : 'asc');

        $articleListOxid = oxNew(OxidArticleList::class);
        $oDb = \OxidEsales\Eshop\Core\DatabaseProvider::getDb();
        // build SQL filter string
        $filter = '';
        if (!empty($filters = FilterHelper::prepareFilters())) {
            foreach ($filters as $f) {
                $filter .= ' AND ' . $f['key'] . ' ' . $f['action'] . ' ' . $oDb->quote($f['value']);
            }
        }

        $articleListOxid->selectString("SELECT * FROM oxarticles WHERE 1 $filter ORDER BY $order_by $order LIMIT $skip, $limit");
        if (count($articleListOxid)) {
            $articleList = [];
            foreach ($articleListOxid->getArray() as $oxid => $oxObject) {
                $articleList[] = $this->_oxObject2Array($oxObject);
            }

            return response()->json($articleList);
        }

        return response('No articles found', 404);
    }

    /**
     * Get all articles
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function showOneArticle($id)
    {
        $article = oxNew(OxidArticle::class);
        // disable lazy loading to get all fields immediately
        $article->disableLazyLoading();
        if ($article->load($id)) {
            // special case longdesc
            $longDesc = $article->getLongDesc();
            $articleObject = $this->_oxObject2Array($article);
            $articleObject['OXLONGDESC'] = $longDesc;

            return response()->json($articleObject);
        }

        return response('Article with id ' . $id . ' not found', 404);
    }

    /**
     * Delete an article
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Exception
     */
    public function delete($id)
    {
        $article = oxNew(OxidArticle::class);
        if ($article->load($id)) {
            if ($article->delete()) {
                return response('Article with id ' . $id . ' deleted successfully', 200);
            }
        }

        return response('Article with id ' . $id . ' not found', 404);
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
        $article = oxNew(OxidArticle::class);
        if ($article->load($id)) {
            $data = $request->json()->all();
            $article->assign($data);
            if ($article->save()) {
                return $this->showOneArticle($id);
            } else {
                return response('Problem updating article with id: ' . $id, 500);
            }
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
        $id = OxidUtils::generateUId();
        $article = oxNew(OxidArticle::class);
        $article->setId($id);
        $data = $request->json()->all();
        $article->assign($data);
        if ($article->save()) {
            return $this->showOneArticle($id);
        } else {
            return response('Problem creating article with id: ' . $id, 500);
        }
    }
}
