<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function showAllArticles()
    {
        return response()->json(Article::all());
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
