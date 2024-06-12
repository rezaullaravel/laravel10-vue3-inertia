<?php

namespace App\Models;

use App\Models\MultiImg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class,'category_id')->withDefault();
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id')->withDefault();
    }

    public function MultiImages(){
        return $this->hasMany(MultiImg::class,'product_id');
    }
}
