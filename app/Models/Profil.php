<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    //fillable
    protected $fillable = [
        'user_id',
        'photo',
        'date_naissance',
        'fonction',
        'domaine_activite',
        'apercu',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'youtube',
        'behance',
        'website',
        'ville',
        'province',
        'code_postal',
        'pays',
        'username',
        'is_verified',
        'prix',
        'category_id',
        'working_days',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        // return $this->hasMany(Project::class);
    }

    public function freelancersTypes()
    {

        return $this->belongsTo(FreelancerType::class, 'freelancer_type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id') ?? "";
    }
}
