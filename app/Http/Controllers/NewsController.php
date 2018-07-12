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
        $locale = App::getLocale();
        $languages = Language::where('status', 'ACTIVE')->get();
        $language = Language::where('key', $locale)->first();

        $news_metas = NewsMeta::with('newsArticles')->orderBy('id')->paginate(10);


        //$news_articles = NewsArticle::with('parent')->where('lang_id', 1)->orderBy('id')->paginate(10);

        return view('admin.news.index', compact('news_articles', 'locale', 'languages', 'news_metas', 'language'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $languages = Language::where('status', 'ACTIVE')->get();

        return view('admin.news.add', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsRequest $request)
    {

        $languages = Language::where('status', 'ACTIVE')->get();
        $default_lang = $languages->where('default', 1)->first();

        $news_meta = NewsMeta::create($request->all());
        $news_translated = new NewsArticle();
        $news_translated->meta_id = $news_meta->id;
        $news_translated->lang_id = $default_lang->id;
        $news_translated->title = $request['title'];
        $news_translated->body = $request['body'];
        $news_translated->save();

        return redirect()->route('news.index')
            ->with('success', 'NewsMeta created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lang_id = 1;

        $news_meta = NewsMeta::with(['newsArticles' => function ($query) use ($lang_id) {
            $query->where('lang_id', $lang_id);
        }])->findOrFail($id);

        $news_article = NewsArticle::where('meta_id', $id)->where('lang_id', $lang_id)->firstOrFail();

        return view('admin.news.show', compact('news_article', 'news_meta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = NewsMeta::findOrFail($id);

        return view('admin.news.edit', compact('news'));
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
        $locales = Config::get('app.locales');
        $news = NewsMeta::findOrFail($id)->update($request->all());
        /*foreach ($locales as $locale) {

            if($locale != 'en'){
                $news_translated = NewsMeta::where('parent_id', $id)->where('locale',$locale)->first();
                //return dump($news_translated);

                $news_translated->title = $request['title_'.$locale];
                $news_translated->excerpt = $request['excerpt_'.$locale];
                $news_translated->body = $request['body_'.$locale];
                $news_translated->status = $news->status;
                $news_translated->save();

            }


        }*/


        return redirect()->route('news.index')
            ->with('success', 'News updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NewsMeta::findOrFail($id)->delete();

        return redirect()->route('news.index')
            ->with('success', 'NewsMeta deleted successfully');
    }
}
