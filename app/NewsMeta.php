<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class NewsMeta extends Model
{
    protected $table = 'news_metas';

    protected $fillable = ['status',];

    public function newsArticles()
    {

    return $this->hasMany(NewsArticle::class, 'meta_id');

    }

    public function scopePublished(Builder $query)
    {

        return$query->where('status', 'PUBLISHED');

    }


}
