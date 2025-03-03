<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product as ProductModel;

class OrderDetail extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function getproduct(){
        return $this->belongsTo(ProductModel::class, 'product_id');
    }



}
