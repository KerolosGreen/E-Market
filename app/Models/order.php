<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\payment;
use App\Models\user;
use App\Models\info;
use App\Models\orderitem;



class order extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $guarded = [];
    
    public function payment(){
        return $this->belongsTo(payment::class);
    }
    public function address(){
        return $this->belongsTo(info::class);
    }
    public function user(){
        return $this->belongsTo(user::class);
    }
    public function orderitem(){
        return $this->hasMany(orderitem::class);
    }
}
