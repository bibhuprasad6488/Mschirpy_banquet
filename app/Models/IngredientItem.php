<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientItem extends Model
{
    use HasFactory;

    protected $table = 'ingredient_items';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','supplier_id','ingredient_cat_id','item_name','department_id','unit','brand','price','custom_fields','status'];

    protected $casts = [
        'custom_fields'=>'array',
        'brand' => 'array',
        'department_id'=>'array'
    ];

    protected $appends = ['defaultbrand'];

    public function ingredient_category()
    {
        return $this->belongsTo(\App\Models\IngredientCategory::class, 'ingredient_cat_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id', 'id');
    }

    public function department_request()
    {
        return $this->hasMany(\App\Models\DepartmentRequest::class, 'item_id','id');
    }
   
    public function getDefaultBrandAttribute()
    {
        return \App\Models\Brand::whereIN('id',$this->custom_fields['default_brand'])->orderBy('id','ASC')->get();
    }
}
