<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'cities';
    protected $primaryKey = 'id';
    protected $fillable = ['state_id','city_name','shortcode'];

    public function business(){
    	return $this->hasMany(\App\Models\Business::class,'city','id');
    }
}
