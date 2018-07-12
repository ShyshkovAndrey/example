<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invite;
use App\Mail\InviteGenerate;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{

    public function create()
    {
        return view('admin.invites.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['email' => 'required|email|unique:invites|unique:users']);
        $email = $request->get('email');

        do {
            $token = bin2hex(openssl_random_pseudo_bytes(16));
        } while (Invite::where('token', $token)->first());

        $invite = Invite::create([
            'email' => $email,
            "token" => $token

        ]);
        Mail::to($request->get('email'))->send(new InviteGenerate($invite));
        return redirect()
            ->back();
    }


}
