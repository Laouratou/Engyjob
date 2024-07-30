<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'path',
        'file_type',
        'file_size',
        'project_id',
        'user_id',
        'freelancer_id',
        'added_by_user_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by_user_id');
    }
}
