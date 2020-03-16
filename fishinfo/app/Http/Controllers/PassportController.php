<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class PassportController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'contact' => 'required|unique:users',
            'password' => 'required|min:2',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'password' => bcrypt($request->password)
        ]);
 
        $token = $user->createToken('Fisheries')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'contact' => $request->contact,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('Fisheries')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
}
