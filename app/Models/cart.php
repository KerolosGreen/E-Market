<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class cart extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(product::class);
    }
}
