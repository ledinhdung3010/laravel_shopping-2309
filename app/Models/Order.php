<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table='orders';
    protected $fillable=['extrs_code','full_name','phone',
    'address','email','order_date','created_at','status',
    'updated_at','deleted_at'];
}
