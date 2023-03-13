<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContentManagement extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table = 'content_management';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'business_id', 'page_id', 'others', 'content', 'image'];



    public function getMediaCollectionAttribute()
    {
        $media = Media::where(['model_id' => $this->id, 'collection_name' => 'contents'])->first();
        if (!empty($media)) {
            return $media->getUrl();
        } else {
            return url('admin/assets/img/no-image.png');
        }
    }


    public function page()
    {
        return $this->belongsTo(\App\Models\Page::class, 'page_id', 'id');
    }
}