<?php

namespace Heymowski\LatestNewsReader\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsSource extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'user_id', 'name', 'slug', 'url', 'logo_url', 'status'];

    /**
     * Get News Items.
     */
    public function newsItems()
    {
        return $this->hasMany('Heymowski\LatestNewsReader\Models\NewsItem');
    }
}
