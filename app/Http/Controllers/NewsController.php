<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\StoreRoleRequest;
use App;
use App\NewsMeta;
use App\NewsArticle;
use App\Language;
use Illuminate\Http\Request;
use Config;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $languages = Language::where('status', 'ACTIVE')->where('default', false)->get();

        $news_metas = NewsMeta::with('newsArticles')->orderBy('id')->paginate(10);

        return view('admin.news.index', compact('news_metas', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $lang_id = $request->lang_id;
        $languages = Language::where('status', 'ACTIVE')->where('default', false)->get();
        return view('admin.news.add', compact('id', 'lang_id', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {
        $meta_id = $request['id'];
        $lang_id = $request['lang_id'];
        if ($meta_id == null) {
            $languages = Language::where('status', 'ACTIVE')->get();
            $default_lang = $languages->where('default', 1)->first();

            $news_meta = NewsMeta::create($request->all());
            $news_article = new NewsArticle();
            $news_article->meta_id = $news_meta->id;
            $news_article->lang_id = $default_lang->id;
            $news_article->title = $request['title'];
            $news_article->body = $request['body'];
            $news_article->save();

            return redirect()->route('news.index')
                ->with('success', 'News created successfully');
        } else {

            $news_article = new NewsArticle();
            $news_article->meta_id = $meta_id;
            $news_article->lang_id = $lang_id;
            $news_article->title = $request['title'];
            $news_article->body = $request['body'];
            $news_article->save();

            return redirect()->route('news.index')
                ->with('success', 'News Article created successfully');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {


        $lang_id = $request->lang_id;

        $news_meta = NewsMeta::with(['newsArticles' => function ($query) use ($lang_id) {
            $query->where('lang_id', $lang_id);
        }])->findOrFail($id);

        $news_article = NewsArticle::with('parent')->where('meta_id', $id)->where('lang_id', $lang_id)->firstOrFail();

        return view('admin.news.show', compact('news_article', 'news_meta'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $default_lang = Language::where('default', 1)->first();
        $lang_id = isset($request->lang_id) ? $request->lang_id : $default_lang->id;
        $languages = Language::where('status', 'ACTIVE')->where('default', false)->get();
        $news_meta = NewsMeta::findOrFail($id);
        $news_article = NewsArticle::where('meta_id', $id)->where('lang_id', $lang_id)->first();

        return view('admin.news.edit', compact('news_article', 'news_meta', 'lang_id', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNewsRequest $request, $id)
    {

        $lang_id = $request['lang_id'];

        $default_lang = Language::where('status', 'ACTIVE')->where('default', 1)->first();
        $news_article = NewsArticle::where('meta_id', $id)->where('lang_id', $lang_id)->firstOrFail();

        if ($lang_id == $default_lang->id) {


            NewsMeta::findOrFail($id)->update($request->all());

            $news_article->update($request->all());

            return redirect()->route('news.index')
                ->with('success', 'News updated successfully');
        } else {

            $news_article->update($request->all());

            return redirect()->route('news.index')
                ->with('success', 'News Article updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $lang_id = isset($request['lang_id']) ? $request['lang_id'] : 1;

        $default_lang = Language::where('status', 'ACTIVE')->where('default', 1)->first();


        if ($lang_id == $default_lang->id) {


            NewsMeta::findOrFail($id)->delete();

            return redirect()->route('news.index')
                ->with('success', 'NewsMeta deleted successfully');
        } else {
            $news_article = NewsArticle::where('meta_id', $id)->where('lang_id', $lang_id)->firstOrFail();
            $news_article->delete();

            return redirect()->route('news.index')
                ->with('success', 'NewsArticle deleted successfully');
        }



    }
}
