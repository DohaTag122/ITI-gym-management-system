<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function send()
    {
        Mail::send(['text'=>'email'],['name','Doha'],function($message){
            $message->to('dohatag53@gmail.com','Doha')->subject('Test Email');
            $message->from('dohatag53@gmail.com','Doha');


        });
        return redirect()->route('home');
    }
}
