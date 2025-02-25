<?php

namespace App\Models;
use App\Models\Product as ProductModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getproduct(){
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
