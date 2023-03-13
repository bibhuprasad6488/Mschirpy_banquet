<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentRequest extends Model
{
    use HasFactory;
    protected $table = 'department_requests';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','department_id','cat_id','item_id','brands','qty'];

    protected $casts = [
        'brands' => 'array'
    ];

    public function ingredient_item() {
        return $this->belongsTo(\App\Models\IngredientItem::class, 'item_id', 'id');
    }

    public function department() {
        return $this->belongsTo(\App\Models\Department::class, 'department_id', 'id');
    }

    public function ing_cat()
    {
        return $this->belongsTo(\App\Models\IngredientCategory::class, 'cat_id', 'id');
    }
}
