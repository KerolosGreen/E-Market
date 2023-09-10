<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class orderitem extends Model
{
    use HasFactory;
    public $table="order_items";
    public $timestamps=false;
    protected $guarded=[];

    public function product(){
        return $this->belongsTo(product::class);
    }
}
