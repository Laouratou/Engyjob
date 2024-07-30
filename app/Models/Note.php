<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['freelancer_id', 'entreprise_id', 'rating'];

    // Relation avec l'utilisateur (freelancer) concerné
    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    // Relation avec le projet concerné
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function entreprise()
    {
        return $this->belongsTo(User::class, 'entreprise_id');
    }
}
