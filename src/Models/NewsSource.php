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

    /**
     * The Users that subscribed to this NewsSource
     */
    public function users()
    {
    	// model, table, local_model_key, remote_model_key 
        return $this->belongsToMany('App\User', 'news_source_users', 'news_source_id', 'user_id')->withTimestamps();
    }
}
