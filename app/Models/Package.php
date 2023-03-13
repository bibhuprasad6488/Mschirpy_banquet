<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'category_id', 'menu_id', 'package_name', 'price', 'package_type', 'items', 'no_of_items', 'extra_price_item', 'slug', 'venue_type', 'custom_fields', 'status'];
    protected $casts = [
        'no_of_items' => 'array',
        'category_id' => 'array',
        'custom_fields' => 'array'
    ];

    protected $appends = [
        'subcategory'
    ];

    public function getSubCategoryAttribute()
    {
        $subcatIds = $this->no_of_items;
        $ids = [];
        foreach ($subcatIds as $key => $val) {
            $ids[] = $key;
        }
        return \App\Models\Subcategory::with('menu')->whereIn('id', $ids)->get();
    }

    public function venue()
    {
        return $this->belongsTo(\App\Models\Venue::class, 'package_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(\App\Models\Menu::class, 'menu_id', 'id');
    }

    public function menuitem()
    {
        return $this->belongsTo('App\Models\Menuitem', 'menu_id', 'id');
    }

    public function venuetype()
    {
        return $this->belongsTo('App\Models\Venuetype', 'venue_type', 'id');
    }
    public function booking()
    {
        return $this->belongsTo(\App\Models\Booking::class, 'package_id', 'id');
    }
    public function getPackageItemsAttribute()
    {
        if (!empty($this->no_of_items)) {
            $blankarr = [];
            $pacItems = Category::whereIn('id', array_keys($this->no_of_items))->select('id', 'category_name')->get();
            foreach ($pacItems as $k => $item) {
                $blankarr[$item->category_name] = $this->no_of_items[$item->id];
            }
            return $blankarr;
        }
    }
}