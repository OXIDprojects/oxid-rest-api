<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

// OXID classes
use OxidEsales\Eshop\Application\Model\Article as OxidArticle;

class OxidArticleController extends OxidBaseController
{

    /**
     * Load full OXID article
     *
     * @param string $id
     * @return void
     */
    public function showOneArticleFull($id)
    {
        $article = oxNew(OxidArticle::class);
        // disable lazy loading to get all fields immediately
        $article->disableLazyLoading();
        if ($article->load($id)) {
            $aObject = $this->_oxObject2Array($article);
            return response()->json($aObject);
        }

        return response()->json(Article::find($id));
    }

    public function showOneArticle($id)
    {
        return response()->json(Article::find($id));
    }

    public function create(Request $request)
    {
        $Article = Article::create($request->all());

        return response()->json($Article, 201);
    }

    public function update($id, Request $request)
    {
        $Article = Article::findOrFail($id);
        $Article->update($request->all());

        return response()->json($Article, 200);
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();

        return response('Deleted Successfully', 200);
    }

}
