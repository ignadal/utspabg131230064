<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{

    use InteractsWithMedia;
    
    protected $fillable = [
        'product_name',
        'product_code',
        'price',
        'tanggal_masuk',
        'quantity'
    ]; 
}
