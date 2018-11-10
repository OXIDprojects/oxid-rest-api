<?php

namespace App\Http\Controllers;

use App\Article;

// OXID classes
use OxidEsales\Eshop\Application\Model\Article as OxidArticle;
use OxidEsales\Eshop\Application\Model\ArticleList as OxidArticleList;

class ArticleControllerOxid extends BaseControllerOxid
{

    /**
     * Load full OXID article
     *
     * @param string $id
     *
     * @return void
     */
    public function showOneArticle($id)
    {
        $article = oxNew(OxidArticle::class);
        // disable lazy loading to get all fields immediately
        $article->disableLazyLoading();
        if ($article->load($id)) {
            $articleObject = $this->_oxObject2Array($article);

            return response()->json($articleObject);
        }

        return response('Article with id ' . $id . ' not found', 404);
    }

    /**
     * Load ArticleList via OXID framework
     *
     * @return void
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


}
