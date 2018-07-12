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

        $news_articles = NewsArticle::where('lang_id', 1)->orderBy('id')->paginate(10);

        return view('admin.news.index', compact('news_articles', 'locale', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lang_id=null)
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
    public function store(Request $request)
    {

        $languages = Language::where('status', 'ACTIVE')->get();
        $default_lang = $languages->where('default', 1)->first();


        $news = NewsMeta::create($request->all());
        $news_translated = new NewsArticle();
        $news_translated->meta_id = $news->id;
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
        $news = NewsMeta::findOrFail($id);

        $news_translated = NewsMeta::where('parent_id', $id);
        $locales = Config::get('app.locales');

        return view('admin.news.show', compact('news', 'locales', 'news_translated', 'news1'));
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
            ->with('success', 'NewsMeta updated successfully');
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
