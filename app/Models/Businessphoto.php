<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

class Businessphoto extends Model implements HasMedia
{
    use HasFactory;
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'businessphotos';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','title','image'];

    public function getMediaCollectionAttribute()
    {
        $media = Media::where(['model_id'=>$this->id,'collection_name'=>'businessphoto'])->first();
        if(!empty($media)){
            return $media->getUrl();
        }else{
            return url('admin/assets/img/no-image.png');
        }
    }
}
