<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id',
        'user_id',
        'deadline',
        'budget_type',
        'budget',
        'max_budget',
        'is_active',
        'project_duration_id',
        'freelancer_type_id',
        'freelancer_level_id',
        'en_vedette',
        'cover_image',
        'status',
        'freelancer_id',
        'hired_on',
        'proposal_id',
        'is_hidden',
    ];


    public function hiredProjects()
{
    return $this->hasMany(Project::class, 'freelancer_id');
}
    // Relations
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function projectDuration()
    {
        return $this->belongsTo(ProjectDuration::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function freelancerType()
    {
        return $this->belongsTo(FreelancerType::class);
    }

    public function freelancerLevel()
    {
        return $this->belongsTo(FreelancerLevel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectFiles()
    {
        return $this->hasMany(ProjectFileUploaded::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class)->orderBy('is_sticky', 'desc');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Accessors and Mutators
    public function getSkillsAttribute($value)
    {
        return explode(",", $value);
    }

    // Check if the project is favorited by a specific user
    public function isFavoritedBy($userId)
    {
        return $this->favoredBy()->where('user_id', $userId)->exists();
    }

    // Relation to retrieve users who favorited this project
    public function favoredBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function isFavorited()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return $user->favorites()->where('project_id', $this->id)->exists();
        }
        return false;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function company()
{
    return $this->belongsTo(Company::class);
}

}
