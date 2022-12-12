<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerFeedBack extends Model
{
    protected $table = 'customer_feedbacks';

    protected $fillable = ['video_link', 'description', 'post_link', 'status'];
}
