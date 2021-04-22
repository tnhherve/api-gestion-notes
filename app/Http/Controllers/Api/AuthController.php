<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $tokens_validity = 24*60;

        $this->guard()->factory()->setTTL($tokens_validity);
        
        if(!$token = $this->guard()->attempt($validator->validated()))
        {
            return response()->json([
                'error'=> 'unauthorized'
            ], 401);
        }

        return $this->responseWithToken($token);

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|numeric|min:7',
            'password' => 'required|string|min:6',
            'avatar' => 'image|mines:jpg,png,jpeg|max:2048',
            'date_naissance' => 'required|date'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                $validator->errors()
            ], 422);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'status' => true,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return response()->json([
            'status' => true,
            'message' => 'user logged out successfully'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json($this->guard()->user());
    }

    public function refresh(Request $request)
    {
        return $this->responseWithToken($this->guard()->refresh());
    }

    public function responseWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'token_validity' => $this->guard()->factory()->getTTL()*60
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
