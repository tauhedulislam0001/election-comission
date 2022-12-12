<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class WalletDeposit extends MOdel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sd_id', 'user_type_id', 'credit_note_id', 'payment_mode', 'trans_ref', 'deposit_date', 'amount', 'amount_recieved','status', 'attachment', 'remarks', 'currency','pgw_amount'
    ];


    /**
     * Get all of the deposit ledger.
     */
    public function ledger()
    {
        return $this->morphMany('App\WalletLedger', 'head');
    }

    /**
     * Get the agent details
     */
    public function agent()
    {
        return $this->belongsTo(AdminUser::class, 'user_id');
    }

    public function soleDistributor()
    {
        return $this->belongsTo(AdminUser::class, 'sd_id');
    }

    public function userType()
    {
        return $this->belongsTo(AdminUser::class, 'user_type_id');
    }

    public function agentUser()
    {
        return $this->agent()->select('id', 'agent_code', 'username', 'user_type');
    }

    public function creditNote()
    {
        return $this->belongsTo(CreditNote::class, 'credit_note_id');
    }
    

    /**
     * Get the pending count
     */
    public static function getPendingCount()
    {
        $userType = Auth::guard('admin')->user()->user_type;

        if($userType == 1 or $userType == 2) {
            return self::where('status', 'Pending')->where('user_type_id','8')->count();
        } elseif($userType == 4){
            return self::where('status', 'Pending')->where('user_type_id','8')->where('sd_id', Auth::guard('admin')->user()->id)->count();
        }
    }

    /**
     * Get the pending count
     */
    public static function customerWalletRequest()
    {
        $userType = Auth::guard('admin')->user()->user_type;

        if($userType == 1 or $userType == 2) {
            return self::where('status', 'Pending')->where('user_type_id','10')->count();
        } elseif($userType == 10){
            return self::where('status', 'Pending')->where('user_type_id','10')->where('sd_id', Auth::guard('admin')->user()->id)->count();
        }
    }

    public static function getDistributerPendingCount(){
        $userType = Auth::guard('admin')->user()->user_type;
        if($userType == 1 or $userType == 2) {
            return self::where('status', 'Pending')->where('user_type_id','4')->count();
        }elseif($userType == 4){
        return self::where('status', 'Pending')->where('user_type_id','4')->where('sd_id', Auth::guard('admin')->user()->id)->count();
        }elseif($userType == 3){
        return self::where('status', 'Pending')->where('user_type_id','3')->where('sd_id', Auth::guard('admin')->user()->id)->count();
        }
    }
}
