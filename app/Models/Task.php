<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'end_date',
        'project_id',
        'user_id',
        'freelancer_id',
        'etape_cle_id',
        'status',
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

    public function etape_cle()
    {
        return $this->belongsTo(EtapeCle::class);
    }

    // format status
    // public function getStatusAttribute($value)
    // {
    //     switch ($value) {
    //         case 'pending':
    //             return 'En attente';
    //             break;
    //         case 'in_progress':
    //             return 'En cours';
    //             break;
    //         case 'completed':
    //             return 'Terminée';
    //             break;
    //         case 'cancelled':
    //             return 'Annulée';
    //             break;
    //         default:
    //             # code...
    //             return '-';
    //             break;
    //     }
    // }
}
