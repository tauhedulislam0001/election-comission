<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class CarBookActionHistory extends Authenticatable
{

    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'car_book_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'carbook_id', 'wallet_request_id', 'wallet_deposite_id', 'action', 'action_data', 'by_user'
    ];

    public function carBook()
    {
        return $this->belongsTo('App\CarBook', 'carbook_id');
    }

    public function user()
    {
        return $this->belongsTo('App\AdminUser', 'by_user');
    }

    public function walletReqeust()
    {
        return $this->belongsTo('App\WalletCredit', 'wallet_request_id');
    }

    public function walletDeposit()
    {
        return $this->belongsTo('App\WalletDeposit', 'wallet_deposite_id');
    }
}
