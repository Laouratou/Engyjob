<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'invoice_code',
        'purchase_date',
        'expiry_date',
        'price',
        'user_id',
        'user_type',
        'payment_method',
        'periodicity',
        'is_active',
        'is_cancelled',
        'available_services',
        'allowed_offers',
        'allowed_featured_services',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //format name
    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    //format periodicity
    public function getPeriodicityAttribute($value)
    {
        switch ($value) {
            case 'monthly':
                return 'Mensuel';
                break;

            case 'yearly':
                return 'Annuel';
                break;
            default:
                # code...
                return '-';
                break;
        }
    }

    public function getPaymentMethodAttribute($value)
    {
        switch ($value) {
            case 'paypal':
                return 'Paypal';
                break;
            case 'stripe':
                return 'Stripe';
                break;
            case 'orange_money':
                return 'Orange Money';
                break;
            case 'moov_money':
                return 'Moov Money';
                break;
            case 'sank_money':
                return 'Sank Money';
            default:
                # code...
                return '-';
                break;
        }
    }

    public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }


    public function decrementService()
    {
        $this->available_services--;
        $this->save();
    }

    public function isActive()
    {
        $now = Carbon::now();
        return $this->is_active && $this->purchase_date && $now->between($this->purchase_date, $this->expiry_date);
    }

    public function calculateExpiryDate($validityDays)
    {
        return $this->purchase_date->copy()->addDays($validityDays);
    }

  

public function getMaxHiddenProposals()
{
    return $this->hidden_services;
}

public function getRemainingDays()
{
    return Carbon::now()->diffInDays($this->expiry_date);
}
   

}