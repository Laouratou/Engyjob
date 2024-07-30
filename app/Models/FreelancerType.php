<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'is_active'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function freelancers()
    {
        return $this->hasMany(Profil::class);
    }
}
