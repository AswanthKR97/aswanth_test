<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $fillable = ['city','dob','user_id','otp','verified'];
    protected $table = 'users_details';
}
