<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;

     protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }


      public function subcategory()
      {
        return $this->belongsTo(Subcategory::class, 'subcategory_id','id');
      }



      public function colors()
      {
          return $this->belongsToMany('App\Models\Color')->withTimestamps();
      }
      public function sizes()
      {
          return $this->belongsToMany('App\Models\Size')->withTimestamps();
      }

      public function productImage(){
        return $this->hasMany('App\Models\ProductImage');
    }





}
