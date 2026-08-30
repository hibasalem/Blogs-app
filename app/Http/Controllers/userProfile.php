<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userProfile extends Controller
{
    public function showUserProfile(User $user)
    {
        $posts = $user->posts()->get();
        return view('profile-posts', ['user' => $user, 'posts' => $posts]);
    }

}
