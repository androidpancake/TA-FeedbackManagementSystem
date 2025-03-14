<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminRegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validateAdmin = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required',
            'nip' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        // $validated = Validator::make($validateAdmin);

        if($validateAdmin->fails())
        {
            return $this->sendError('Validation Error', $validateAdmin->errors());
        }
        
        $dataRequested = $request->all();
        $dataRequested['password'] = bcrypt($dataRequested['password']);
        $user = Admin::create($dataRequested);

        $success['token'] = $user->createToken('fms-admin')->plaintextToken;

        return $this->sendResponse($success, 'Success Create Admin', 200);
 
    }
}
