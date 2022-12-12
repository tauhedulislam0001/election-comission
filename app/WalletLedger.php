<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class WalletLedger extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'trans_type', 'amount', 'notes', 'head_type', 'head_id'
    ];

    /**
     * Get the transaction head details
     */
    public function head()
    {
        return $this->morphTo();
    }

    /**
     * Get the agent details
     */
    public function agent()
    {
        return $this->belongsTo(AdminUser::class, 'user_id');
    }
}
