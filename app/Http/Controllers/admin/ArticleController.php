<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view("admin.article.article_list",['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.article_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'=>'required|string|max:50',
            'description'=>'required',
            'photo'=>'file|mimes:jpg,svg,png|max:10240'
        ]);
        
        $article = $data;

        if ($request->file("photo")) {
            $file  = $request->file("photo");
            $fileName = 'article-'.time().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images',$fileName,'public');
            $article['photo']= $path;
        }

        $article['published'] = $request['published']?true:false;
        $article['author_id'] = Auth::user()->id;
        if ($article['published']) {
            $article['publication_date'] = now();
        }
    // dd($article);
        $newArticle = Article::create($article);
        if ($newArticle) {
           return  redirect()->route('articles.list')->with(["status"=>"Article Added successfully"]);
        }else{
            return back()->with("error","Failed to create the Article")->withInput();
        }


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return "just to show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view("admin.article.article_edit",['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article = Article::find($id);
        if ($article->delete()) {
            return back()->with("status","Article $article->title deleted successfully");
        }else{
            return back()->with("status","Failed to delete Article $article->title");
        }
    }
}