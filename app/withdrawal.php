<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class withdrawal extends Model
{
    protected $table = 'withdrawals';

    protected $fillable = ['agent_id', 'sd_id', 'amount', 'withdraw_type'];

}
