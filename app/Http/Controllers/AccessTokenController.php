<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface;
use Laravel\Passport\Http\Controllers\AccessTokenController as ATC;
use App\User;

class AccessTokenController extends ATC
{
    public function issueToken(ServerRequestInterface $request)
    {
    	$grant_type = $request->getParsedBody()['grant_type'];

        if($grant_type == 'password') {
            $username = $request->getParsedBody()['username'];
            $user = User::where('email', $username)->first();

            if($user) 
            {
                if ($user->email_verified_at) return parent::issueToken($request);
                else {
                    $response = [
                        'message' => 'Your email address is not verified.',
                        'errors' => 'User is not verified.'
                    ];

                    return response()->json($response,403)->send();
                } 
            }
            else 
            {
                $response = [
                    'message' => 'User is not registered in database.',
                    'errors' => 'User is not exists.'
                ];

                return response()->json($response,400)->send();
            }
        }

        else return parent::issueToken($request);
    }
}
