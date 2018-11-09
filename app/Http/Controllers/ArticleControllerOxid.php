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

    public function showAllArticles()
    {
        $articleList = oxNew(OxidArticleList::class);
        $articleList->selectString('SELECT * FROM oxarticles');
        if (count($articleList)) {
            // TODO @smxsm: object2array
            $articleListObject = $this->_oxObject2Array($articleList);

            return response()->json($articleListObject);
        }

        return response('No articles found', 404);
    }


}
