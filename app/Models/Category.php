<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'is_active',
    ];
    protected $appends = [
        'number_of_projects'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function freelancers()
    {
        return $this->hasMany(Profil::class);
    }


    public function getNumberOfProjectsAttribute()
    {
        return $this->projects()->where('is_active', 1)->count();
    }
}
