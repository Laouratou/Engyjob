<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapeCle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'start_date',
        'end_date',
        'due_date',
        'pay_status',
        'project_id',
        'user_id',
        'freelancer_id',
        'status',
    ];

    protected $appends = [
        'tasks_completed',
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

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getTasksCompletedAttribute()
    {
        $completed = $this->tasks()->where('status', 'completed')->count();
        $remaining = $this->tasks()->where('status', '!=', 'completed')->count();

        // Check if total tasks is zero to prevent division by zero
        if ($completed + $remaining === 0) {
            return 0;
        }

        // Calculate percentage
        $percentage = ($completed / ($completed + $remaining)) * 100;

        return round($percentage, 2);
    }
}
