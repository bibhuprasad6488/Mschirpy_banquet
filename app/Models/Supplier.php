<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','cat_id','supplier_name','contact_no','valid_from','valid_to','email','address','bank_details','status'];
    protected $casts = [
        'bank_details'=>'array',
        'cat_id'=>'array'
    ];

    public function ingredient_item()
    {
    	return $this->hasMany(\App\Models\IngredientItem::class, 'supplier_id', 'id');
    }


    public function cat()
    {
        return $this->belongsTo(\App\Models\IngredientCategory::class, 'cat_id', 'id');
    }

    public function price_chart()
    {
        return $this->hasMany(\App\Models\SupplierPriceChart::class, 'supplier_id', 'id');
    }



}
