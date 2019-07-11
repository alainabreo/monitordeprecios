<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Socialite;
use App\User;

class SocialiteController extends Controller
{

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $userFacebook = Socialite::driver('facebook')->user();
        //dd($userFacebook);
        $user = User::where('email', $userFacebook->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $userFacebook->getName(),
                'email' => $userFacebook->getEmail(),
                'password' => '',
                'facebook_id' => $userFacebook->getId(),
                'avatar' => $userFacebook->getAvatar(),
                'nickname' => $userFacebook->getNickname()
            ]);            
        }
        auth()->login($user);
        return redirect()->route('home');
    }

    public function redirectToTwitterProvider()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterProviderCallback()
    {
        $userTwitter = Socialite::driver('twitter')->user();
        //dd($userTwitter);
        $user = User::where('email', $userTwitter->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $userTwitter->getName(),
                'email' => $userTwitter->getEmail(),
                'password' => '',
                'twitter_id' => $userTwitter->getId(),
                'avatar' => $userTwitter->getAvatar(),
                'nickname' => $userTwitter->getNickname()
            ]);            
        }
        auth()->login($user);
        return redirect()->route('home');
    }

    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback()
    {
        $userGoogle = Socialite::driver('google')->user();
        dd($userGoogle);
        $user = User::where('email', $userGoogle->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'name' => $userGoogle->getName(),
                'email' => $userGoogle->getEmail(),
                'password' => '',
                'google_id' => $userGoogle->getId(),
                'avatar' => $userGoogle->getAvatar(),
                'nickname' => $userGoogle->getNickname()
            ]);            
        }
        auth()->login($user);
        return redirect()->route('home');
    }

}
