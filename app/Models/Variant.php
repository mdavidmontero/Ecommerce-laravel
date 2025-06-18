<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{

    protected $fillable = [
        'sku',
        'image_path',
        'product_id',
    ];
    //relacion uno a muchos inversa
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relacion muchos a muchos
    public function features()
    {
        return $this->belongsToMany(Feature::class)->withTimestamps();
    }
}
