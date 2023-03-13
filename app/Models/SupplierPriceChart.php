<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;

class SupplierPriceChart extends Model
{
    use HasFactory;

    protected $table = 'supplier_price_charts';
    protected $primaryKey = 'id';
    protected $fillable = ['supplier_id','category_id','department_id','item_id','data','mrp','qty','unit','valid_from','valid_to','is_submit'];
    protected $casts = [
        'data'=>'array'
    ];

    public function item()
    {
    	return $this->belongsTo(\App\Models\IngredientItem::class, 'item_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(\App\Models\Department::class, 'department_id', 'id');
    }
    
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id', 'id');
    }

    public function ing_cat()
    {
        return $this->belongsTo(\App\Models\IngredientCategory::class, 'category_id', 'id');
    }

    public function ing_item()
    {
        return $this->belongsTo(\App\Models\IngredientItem::class, 'item_id','id');
    }


    public function get_name()
    {
        $datatArr = [];
        foreach($this->data as $k=>$v){
            $itemname = Brand::where('id',$k)->first()->brand_name;
            $datatArr[$itemname] = $v;
        }
        return $datatArr;
    }

    


}
