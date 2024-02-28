<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_detail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='order_details';
    protected $fillable=[
        'order_id','product_id','quantity',
        'nots','size_name','color_name',
        'payment_type','status','created_at',
        'updated_at','deleted_at'
    ];
}
