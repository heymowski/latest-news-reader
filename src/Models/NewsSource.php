<?php

namespace Heymowski\LatestNewsReader\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsSource extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'slug', 'url', 'logo_url'];

    /**
     * Get News Items.
     */
    public function newsItems()
    {
        return $this->hasMany('Heymowski\LatestNewsReader\Models\NewsItem');
    }
}
