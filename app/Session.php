<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'data', 
        'form', 
        'form1', 
        'form2', 
        'form3', 
        'form4', 
    ];   
}
