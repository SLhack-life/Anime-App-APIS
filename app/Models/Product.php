<?php

namespace App\Models;
use App\Models\Image;
use App\Models\Category;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    // protected $fillable = [
    //     'name', 'image','short_description','category_id','long_description','tags','price','featured_product','status','type','sku','published','visibility','promotional_price','category','brand'
    // ];
    protected $guarded=[];
    // public $table="products";
    public function  image_detail(){
        return $this->hasMany(Image::class, 'product_id','id');
    }
    public function  variant_product(){
        return $this->hasMany(VariantProduct::class, 'product_id','id');
    }
    public function  category_detail(){
        return $this->hasMany(Category::class, 'id','category_id');
    }
   
}
