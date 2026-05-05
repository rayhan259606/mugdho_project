<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'service_id',
        'name',
        'address',
        'phone',
        'status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
