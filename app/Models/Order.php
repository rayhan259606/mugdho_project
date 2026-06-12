<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function antiqueProduct()
    {
        return $this->belongsTo(AntiqueProduct::class, 'antique_product_id');
    }

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'digital_product_id');
    }

    public function gadget()
    {
        return $this->belongsTo(Gadget::class, 'gadget_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
