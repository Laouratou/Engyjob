<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdVerification extends Model
{
    use HasFactory;
    protected $table = 'id_verifications';

    protected $fillable = [
        'user_id',
        'verified_by_user_id',
        'number',
        'type',
        'path',
        'is_verified',
        'is_rejected'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }
}
