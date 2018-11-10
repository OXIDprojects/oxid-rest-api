<?php

namespace App\Http\Controllers;

use App\Article;

// OXID classes
use OxidEsales\Eshop\Application\Model\Article as OxidArticle;
use OxidEsales\Eshop\Application\Model\ArticleList as OxidArticleList;

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
        $articleListOxid = oxNew(OxidArticleList::class);
        // TODO: paging, limit, sorting
        $articleListOxid->selectString('SELECT * FROM oxarticles');
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

}
