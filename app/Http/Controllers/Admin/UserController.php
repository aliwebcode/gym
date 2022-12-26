<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $types = Role::all();
        return view('admin.users.create', compact('types'));
    }

    public function store(UserRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = $request->full_name . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('/uploads/users/');
            $image->move($path, $file_name);
            $request->image = '/uploads/users/' . $file_name;
        }

        User::create([
            'role_id' => $request->role_id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->full_name),
            'birthday' => $request->birthday ?? null,
            'image' => $request->image ?? null,
            'status' => $request->status
        ]);

        return redirect()->route('admin.users.index')->with([
            'message' => 'Added successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $types = Role::all();
        return view('admin.users.edit', compact('user', 'types'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($image = $request->file('image')) {
            $file_name = $request->full_name . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('/uploads/users/');
            $image->move($path, $file_name);
            $request->image = '/uploads/users/' . $file_name;

            // Delete Old Image
            if(File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
        }

        $user->update([
            'role_id' => $request->role_id,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday ?? null,
            'image' => $request->image ?? $request->old_image,
        ]);

        return redirect()->route('admin.users.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
