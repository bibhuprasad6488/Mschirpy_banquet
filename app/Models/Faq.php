<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

class Faq extends Model  implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'faqs';
    protected $primaryKey = 'id';
    protected $fillable = ['business_id', 'title', 'content'];
}