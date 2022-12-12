<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppsUpdate extends Model
{
    protected $table = 'apps_updates';

    protected $fillable = ['version', 'status'];
}
