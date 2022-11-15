<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'role' => 'required|string|in:admin,user',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
      try{
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        return $this->sendResponse($user, 'Utilisateur enregistré avec succès');
      }
        catch(\Throwable $th){
            return $this->sendError('Une erreur est survenue', $th->getMessage());
        }
    }

    public function login(Request $request) {
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expired_at = Carbon::now()->addWeeks(12);
        $token->save();
        return $this->sendResponse([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expired_at
            )->toDateTimeString()
        ], 'Utilisateur connecté avec succès');
         


    }



}
