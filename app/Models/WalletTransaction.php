<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'amount',
        'balance',
        'type',
        'payment_method',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function formatPaymentMethod($value)
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
                return $value;
                break;
        }
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
                return '-';
                break;
        }
    }

    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function wallet_transaction($user_id, $amount, $type, $method)
    {

        $user = User::where('id', $user_id)->first();
        $wallet_transaction = new WalletTransaction();

        $wallet_transaction->code = "WT-" . auth()->user()->id . rand(100000, 999999) . '-' . substr(time(), 0, 4);
        $wallet_transaction->user_id = $user->id;
        $wallet_transaction->amount = $amount;
        $wallet_transaction->type = $type;
        $wallet_transaction->payment_method = $method;

        if ($type == 'credit') {
            $user->update(['wallet' => $user->wallet + $amount]);
        } elseif ($type == 'debit') {
            $user->update(['wallet' => $user->wallet - $amount]);
        }
        $wallet_transaction->balance = $user->wallet;
        $wallet_transaction->save();
    }
}
