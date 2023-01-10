<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Services\SMSGateway;
use App\Models\Role;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{

    public $sms;

    public function __construct(SMSGateway $SMSGateway)
    {
        $this->sms = $SMSGateway;
    }

    public function register(RegisterRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = $request->full_name . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('/uploads/users/');
            $image->move($path, $file_name);
            $request->image = '/uploads/users/' . $file_name;
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'birthday' => $request->birthday ?? null,
            'image' => $request->image ?? null,
            'role_id' => Role::where('name', 'User')->first()->id
        ]);

        $this->sms->sendVerificationCode(['user_id' => $user->id]);

        return response([
            'user' => $user,
            'token' => $user->createToken('secret')->plainTextToken
        ], 200);
    }
    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->validated())) {
            return response([
                'message' => 'Invalid login.'
            ], 403);
        }

        return response([
            'user' => auth()->user(),
            'verified' => VerificationCode::where('user_id',Auth::id())->first() ? 0: 1,
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ], 200);
    }
    public function update(Request $request)
    {
        $attr = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' .auth()->id(),
            'phone' => 'required|unique:users,phone,' .auth()->id(),
            'image' => 'nullable|mimes:jpg,jpeg,png,gif|max:4000',
            'birthday' => 'nullable',
        ]);

        if ($image = $request->file('image')) {
            $file_name = $request->full_name . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('/uploads/users/');
            $image->move($path, $file_name);
            $attr['image'] = '/uploads/users/' . $file_name;

            if(File::exists(public_path(auth()->user()->image)))
                File::delete(public_path(auth()->user()->image));
        }

        auth()->user()->update([
            'full_name' => $attr['full_name'],
            'email' => $attr['email'],
            'phone' => $attr['phone'],
            'image' => $attr['image'] ?? null,
        ]);
        return response([
            'message' => 'Profile Updated'
        ], 200);
    }

    public function check_otp(Request $request)
    {
        $check = $this->sms->checkOTPCode($request->code);

        if(!$check) {
            return response([
                'message' => 'Incorrect Code'
            ], 401);
        } else {
            $this->sms->removeOTPCode($request->code);
            return response([
                'message' => 'Account Verified'
            ], 200);
        }
    }

    public function forgot_password(Request $request)
    {
        $user_id = User::where('phone', $request->phone)->first()->id;
        $this->sms->sendVerificationCode(['user_id' => $user_id]);
        return response([
            'message' => 'Code sent to phone number'
        ], 200);
    }

    public function refresh_token()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ]);
    }
}
