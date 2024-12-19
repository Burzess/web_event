<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Exception;
use Socialite;

class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        // redirect user to "login with Google account" page
        return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            // get user data from Google
            $user = \Laravel\Socialite\Facades\Socialite::driver('google')->user();

            // find user in the database where the social id is the same with the id provided by Google
            $finduser = User::where('social_id', $user->id)->first();

            if ($finduser)  // if user found then do this
            {
                // Log the user in
                Auth::login($finduser);

                // redirect user to dashboard page
                return redirect('/dashboard');
            }
            else
            {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'social_type' => 'google',  // the social login is using google
                    'password' => bcrypt('my-google'),  // fill password by whatever pattern you choose
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        }
        catch (Exception $e)
        {
            dd($e->getMessage());
        }
    }
}