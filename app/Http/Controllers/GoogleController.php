<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;

class GoogleController extends Controller
{
    public function redirect()
    {
        $client = new \Google_Client();

        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $client->addScope(\Google_Service_Calendar::CALENDAR);

        $client->setPrompt('consent select_account');

        return redirect($client->createAuthUrl());
    }

    public function callback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        $token = $client->fetchAccessTokenWithAuthCode($request->code);

        session(['google_token' => $token]);

        return redirect('/dashboard')->with('success', 'Google conectado');
    }
}