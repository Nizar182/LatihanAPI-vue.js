<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'username' => 'required|string|max:255|exists:users,username',
            'password' => 'required|string:max:255'
        ]);
        if ($validate->fails()) return $this->responseApiValidate($validate->errors());
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password]))
        {
            $user = Auth::user();
            $token = substr(strstr($user->createToken('sanctum')->plainTextToken, '|'), 1);
            return response()->json([
                'success' => true,
                'message' => 'Success Login',
                'token' => $token,
                'society' => $user->society,
            ]);
        }
        return response()->json([
            'success'=> false,
            'message'=>'Incorrect Password',
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->responseApiMessage(true, "Success logout");
    }
}
