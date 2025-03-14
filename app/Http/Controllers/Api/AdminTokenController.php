<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTokenController extends BaseController
{
    public function getToken(Request $request)
    {
        if(Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])){
            $user = Auth::user();
            $success['token'] = $user->createToken('fms-admin')->plainTextToken;

            return $this->sendResponse($success, 'User authenticated', 200);

        } else {
            return $this->sendError('Unauthorized', ['error' => 'Unauthorized']);
        }
    }
}
