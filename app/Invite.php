<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{

    protected $fillable = [
        'email', 'token',
    ];

    public static function getInviteByToken($token)
    {
        return Invite::where('token', $token)->where('claimed', NULL)->first();
    }





}
