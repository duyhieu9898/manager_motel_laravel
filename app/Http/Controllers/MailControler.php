<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function sendEmail()
    {
        Mail::send('home', ['user' => "hieu"], function ($m) {
            $m->from('duyhieu9898@gmail.com', 'LARAVEL MAIL');

            $m->to('duyhieu9898@gmail.com', "data-name")->subject('cai lon gi the!');
        });
    }
}
