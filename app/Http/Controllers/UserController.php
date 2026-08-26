<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $incomingRequest = $request->validate(
            [
                "username" => ["required", "string", "min:3", "max:20", Rule::unique("users", 'username')],
                "email" => ["required", "email", Rule::unique("users", 'email')],
                "password" => ["required", "min:2", "max:30", "confirmed"],
            ]
        );
        $user = User::create([
            "username" => $incomingRequest["username"],
            "email" => $incomingRequest["email"],
            "password" => bcrypt($incomingRequest["password"]),

        ]);
        auth()->login($user);
        return redirect("/")->with("success", "Account is created successfully");
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate(
            [
                "loginusername" => ["required"],
                "loginpassword" => ["required"]
            ]
        );
        if (
            auth()->attempt([

                "username" => $incomingFields["loginusername"],
                "password" => $incomingFields["loginpassword"],
            ])
        ) {
            $request->session()->regenerate();
            return redirect("/")->with("success", "You have successfully logged in.");
        }

        return redirect("/")->with("fail", "Incorrect data");

    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect("/")->with("success", "You have logged out.");


    }



    public function showHomepage(Request $request)
    {
        if (auth()->check()) {
            return view("homepage-feed");

        } else {
            return view("homepage");
        }


    }
}
