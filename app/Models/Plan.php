<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'service_id',
        'description',
        
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
