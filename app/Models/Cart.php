<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Image;

class Cart extends Model
{
    use HasFactory;
    protected $guarded=[];
     public function  product_detail(){
        return $this->hasOne(Product::class, 'id','product_id');
     }
     public function  image_detail(){
        return $this->hasMany(Image::class, 'product_id','id');
    }
    
}
