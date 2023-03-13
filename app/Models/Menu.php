<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

class Menu extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'business_id', 'name', 'category_id','cuisine_id', 'subcategory_id', 'menu_type', 'image', 'description', 'price', 'gst', 'slug', 'status'];

    public function getMediaCollectionAttribute()
    {
        $media = Media::where(['model_id' => $this->id, 'collection_name' => 'menu'])->first();
        if (!empty($media)) {
            return $media->getUrl();
        } else {
            return url('admin/assets/img/no-image.png');
        }
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }


    public function subcategory()
    {
        return $this->belongsTo(\App\Models\Subcategory::class, 'subcategory_id', 'id');
    }
}