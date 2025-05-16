<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailWithAttachment;

class EmailController extends Controller
{
    public function sendMailWithAttachment()
    {
        $data = [
            'name' => 'Jeevitha',
            'amount' => '10000',
        ];

        Mail::to('jeevithathambi7188@gmail.com')->send(new sendMailWithAttachment($data));

        return response()->json(['message' => 'Email sent successfully.']);
    }
}

