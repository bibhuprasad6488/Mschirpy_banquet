<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

class VenueImage extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'venue_images';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'business_id', 'venue_id', 'image'];


    public function getMediaCollectionAttribute()
    {
        $media = Media::where(['model_id' => $this->id, 'collection_name' => 'venue'])->first();
        if (!empty($media)) {
            return $media->getUrl();
        } else {
            return url('admin/assets/img/no-image.png');
        }
    }

    public function venue()
    {
        return $this->belongsTo(\App\Models\Venue::class, 'venue_id', 'id');
    }
}