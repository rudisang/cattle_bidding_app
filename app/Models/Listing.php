<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'breed',
        'gallery',
        'end_date',
        'options',
        'start_date',
        'end_time',
        'location',
        'base_price',
        'old',
        'description',
        'status',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function bids(){
        return $this->hasMany('App\Models\Bid');
    }
}
