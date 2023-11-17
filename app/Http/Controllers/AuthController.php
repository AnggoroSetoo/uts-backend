<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //bikin fungsi register
    public function register(Request $request)
    {
        #tangkap input
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        # insert ke tabel user
        $user = User::create($input);

        $data = [
            'message' => 'User is created succesfully',
        ];

        return response()->json($data, 200);
    }

    #Login
    public function login(Request $request)
    {
        #Input
        $input = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        #Get user
        $user = User::where('email', $input['email'])->first();

        # bandingkan input user dengan data di DB
        $isLoginSuccessfully = ($input['email'] === $user->email &&
            Hash::check($input['password'], $user->password)
        );

        if ($isLoginSuccessfully) {

            #Create token
            $token = $user->createToken('auth_token');

            $data = [
                'message' => 'Login successfully',
                'token' => $token->plainTextToken,
            ];

            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Login failed',
            ];

            return response()->json($data, 401);
        }
    }
}
