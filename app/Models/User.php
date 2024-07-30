<?php

// App\Models\User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'first_name',
        'user_type',
        'phone',
        'company_name',
        'password',
        'wallet',
        'total_earnings',
        'total_spent',
        'total_withdrawn',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

  
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relations
    public function profil()
    {
        return $this->hasOne(Profil::class);
    }

    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function skills()
    {
        return $this->hasMany(FreelancerSkill::class);
    }

    // get freelancer ratings average
    public function get_ratings()
    {
        return $this->hasMany(Review::class)->avg('rate') ?? 0;
    }

    public function workingDays()
    {
        return $this->belongsToMany(WorkingDay::class, 'user_working_days', 'user_id', 'day_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Project::class, 'favorites', 'user_id', 'project_id')->withTimestamps();
    }

    public function receivedNotes()
    {
        return $this->hasMany(Note::class, 'freelancer_id');
    }

    public function givenNotes()
    {
        return $this->hasMany(Note::class, 'entreprise_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'freelancer_id');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function allowedServices()
    {
        $membership = $this->membership;

        if ($membership) {
            return Service::where('membership_id', $membership->id)->get();
        }

        return collect();
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function countStickyProposals()
    {
        return $this->proposals()->where('is_sticky', true)->count();
    }

    public function countHiddenProposals()
    {
        return $this->proposals()->where('is_hidden', true)->count();
    }
}
