<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id';
    protected $fillable = ['customer_id', 'event_date', 'start_time', 'end_time', 'amount_of_gathering', 'price', 'venue_or_hall', 'type', 'advance_details', 'followup_details', 'event_status'];
    protected $casts = [
        'advance_details' => 'array',
        'followup_details' => 'array'
    ];

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class, 'customer_id', 'id');
    }
}
