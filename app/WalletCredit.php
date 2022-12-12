<?php

namespace App;

use App\AdminUser;
use Illuminate\Database\Eloquent\Model;

class WalletCredit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sd_id', 'payment_mode', 'amount', 'payment_status', 'status'
    ];


    /**
     * Get the agent details
     */
    public function agent()
    {
        return $this->belongsTo(AdminUser::class, 'user_id');
    }

    public function walletRequest()
    {
        return WalletCredit::where('Approval Pending')->count();
    }
}
