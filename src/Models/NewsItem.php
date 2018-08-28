<?php

namespace Heymowski\LatestNewsReader\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['news_source_id', 'title', 'description', 'content', 'category', 'categories', 'author', 'authors', 'contributor', 'contributors', 'copyright', 'date', 'updated_date', 'link', 'source'];

    /**
     * Get NewsSource.
     */
    public function newsSource()
    {
        return $this->belongsTo('Heymowski\LatestNewsReader\Models\NewsSource');
    }
}
