<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
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
}
