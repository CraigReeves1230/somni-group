<?php


namespace App\Services;


use Illuminate\Support\Facades\Mail;

class Mailer
{
    public function send_mail($sender_email, $sender_name, $recipient, $subject, $view, $data = [])
    {

        Mail::send($view, $data, function($message) use($sender_email, $sender_name, $recipient, $subject){

            $message->from($sender_email, $sender_name);
            $message->to($recipient->email)->subject($subject);
        });
    }
}