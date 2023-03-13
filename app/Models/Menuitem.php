<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\InteractsWithMedia;

use App\Models\Category;

class Menuitem extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'menu_for_items';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'business_id', 'title', 'items', 'venue_type', 'menu_type', 'price', 'status'];
    protected $casts = [
        'items' => 'array',
    ];

    public function getAvarageMenuAttribute()
    {
        $items = $this->items;
            // return Subcategory::where(['status'=>1,'user_id'=>$this->user_id])
            // ->with('menu', function($q) use ($items){
            //     return $q->whereIn('id', $items);
            // })->get();
            return Category::where(['status'=>1,'user_id'=>$this->user_id])
                    ->with('menu', function($q) use ($items){
                        return $q->whereIn('id', $items);
                    })->get();
    }

    public function getCategoryItemsAttribute()
    {
        $items = $this->items;
        return Category::where(['status'=>1])
            ->whereIn('id', Menu::distinct()->whereIn('id',$items)->get('category_id'))
            ->with('cuisine')
            ->with('menu', function($q) use ($items){
                return $q->whereIn('id', $items);
            })
            ->get();
    }

    public function getMediaCollectionAttribute()
    {
        $media = Media::where(['model_id'=>$this->id,'collection_name'=>'menu'])->first();
        if(!empty($media)){
            return $media->getUrl();
        }else{
            return url('admin/assets/img/no-image.png');
        }
    }

    public function venuetype()
    {
        return $this->belongsTo(\App\Models\Venuetype::class, 'venue_type', 'id');
    }

    public function package()
    {
        return $this->hasOne(\App\Models\Package::class, 'menu_id', 'id');
    }
}
