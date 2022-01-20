<?php

namespace App\Http\Controllers;

use App\Mail\ContactMeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function contact() {
        return view('contact');
    }

    public function contactMe(Request $request) {
        
        $validator = Validator::make($request->all(), [
            'username'=> 'required|string',
            'email'=> 'required|email'
        ]);

        if(!$request->username || $request->username == '' || !$request->email || $request->email == '') {
            return false;
        }

        $username = htmlspecialchars($request->username);
        $email = $request->email;
        $content = htmlspecialchars($request->message);

        // Envoi du mail
        Mail::to('oriendo.54@gmail.com')->send(new ContactMeMail($username, $email, $content));

        $message = 'Votre message a correctement été envoyé.';

        return true;
    }
}
