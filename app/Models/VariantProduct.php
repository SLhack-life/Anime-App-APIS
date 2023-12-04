<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VariantImage;

class VariantProduct extends Model
{
    use HasFactory;
    public function variant_image_detail(){
        return $this->hasMany(VariantImage::class, 'variant_id','id');
    }
}
