<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

class Venue extends Model implements HasMedia
{
   use HasFactory;
   use InteractsWithMedia;
   protected $table = 'venues';
   protected $primaryKey = 'id';
   protected $fillable = ['user_id', 'business_id', 'package_id', 'venue_name', 'price', 'venue_type', 'slug', 'status', 'max_people', 'image', 'custom_fields'];

   protected $casts = [
      'package_id' => 'array',
      'custom_fields' => 'array'
   ];

   protected $appends = [
        'bookedvenue'
    ];

   public function getMediaCollectionAttribute()
   {
      $media = Media::where(['model_id' => $this->id, 'collection_name' => 'venue'])->first();
      if (!empty($media)) {
         return $media->getUrl();
      } else {
         return url('admin/assets/img/no-image.png');
      }
   }

   public function package()
   {
      return $this->hasMany(\App\Models\Package::class, 'package_id', 'id');
   }
   public function booking()
   {
      return $this->hasMany(\App\Models\Booking::class, 'venue_id', 'id');
   }

   public function venuetype()
   {
      return $this->belongsTo(\App\Models\Venuetype::class, 'venue_type', 'id');
   }

   public function venueimage()
   {
      return $this->hasMany(\App\Models\VenueImage::class, 'venue_id', 'id');
   }

   public function getPackageDatasAttribute()
   {
      return \App\Models\Package::whereIN('id', $this->package_id)->get();
   }

   public function getAmenityDatasAttribute()
   {
      return \App\Models\Amenity::whereIN('id', $this->custom_fields['amenity'])->get();
   }
   public function getBookedVenueAttr($ss)
    {
        return $ss;
    }
}