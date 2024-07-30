<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'freelancer_id',
        'project_id',
        'etape_cle_id',
        'type',
        'payment_method',
        'amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function etapecle()
    {
        return $this->belongsTo(EtapeCle::class, 'etape_cle_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }


    public function formatType($value)
    {
        switch ($value) {
            case 'credit':
                return 'Crédit';
                break;
            case 'debit':
                return 'Débit';
                break;
            default:
                # code...
                return $value;
                break;
        }
    }
 
}
