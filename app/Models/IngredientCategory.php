<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    use HasFactory;
    protected $table = 'ingredient_categories';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','category_name','status'];

    public function ingredient_item() {
        return $this->hasMany(\App\Models\IngredientItem::class, 'ingredient_cat_id', 'id');
    }

    public function supplier()
    {
    	return $this->hasMany(\App\Models\Supplier::class, 'cat_id', 'id');
    }
}
