<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

   // App\Models\Service.php
protected $fillable = [
    'name', 'allowed_services', 'offers_per_project', 'featured_services', 'membership_id'
];


    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, 'service_id');
    }
    
}
