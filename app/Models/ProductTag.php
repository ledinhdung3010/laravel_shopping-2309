<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $table='product_tag';
    protected $fillable=['product_id','product_tag','created_at','updated_at'];
}
