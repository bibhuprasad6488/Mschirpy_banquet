<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    // use InteractsWithMedia;
    protected $table = 'pages';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'business_id', 'page_name', 'others'];

    public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_name', 'id');
    }
}