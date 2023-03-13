<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venuetype extends Model
{
    use HasFactory;
    protected $table = 'venuetypes';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','venue_type','status'];

    public function venue()
    {
    	return $this->hasMany(App\Models\Venue::class,'venue_type','id');
    }

    public function menuforitems()
    {
    	return $this->hasMany(App\Models\Menuitem::class,'venue_type','id');
    }

    public function package()
    {
    	return $this->hasMany(App\Models\Package::class,'venue_type','id');
    }
}
