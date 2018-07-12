<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $table = 'news_articles';

    protected $fillable = ['news_id', 'lang_id', 'title', 'body',];

    public function parent()
    {
        return $this->belongsTo(NewsMeta::class, 'meta_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }


}