<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthAPIController extends AppBaseController
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);        
        
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'role' => '5',
            'is_admin' => '0',
            'password' => Hash::make($request->password)
        ]);        
        
        $user->save();        
        
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        //     'remember_me' => 'boolean'
        // ]);        
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
          ]);

        if ($validator->fails()) {
          return response()->json(['message'=>$validator->errors()], 401);
        }

        if(!User::where('email', '=', $request->email)->first())    
        return response()->json([
            'message' => 'Email not found'
        ], 401); 

        $finduser = User::where('email', '=', $request->email)->first();   //get db User data   
        if(!Hash::check($request->password, $finduser->password))    
            return response()->json([
                'message' => 'Wrong Password'
            ], 401);      

        $credentials = request(['email', 'password']);        
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Email or password incorrect'
            ], 401);       
            

            $user = $request->user();       
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;      

            $username = Auth::user();
         if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);        
            $token->save();        
            return response()->json([
            'message' => 'success',
            'name' => $username->name,
            'email' => $username->email,
            'access_token' => $tokenResult->accessToken,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
            ],200);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();        
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json([
            'message' => 'Success',
            'data' => $request->user()
        ],200);
    }
}