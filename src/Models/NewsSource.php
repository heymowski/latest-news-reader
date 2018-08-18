<?php

namespace Heymowski\LatestNewsReader\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsSource extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'name', 'slug', 'url'];
}
