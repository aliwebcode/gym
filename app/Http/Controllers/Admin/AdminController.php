<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile.index', compact('user'));
    }

    public function update_profile(Request $request, $id)
    {
        $user = Auth::user();

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
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthday' => $request->birthday ?? null,
            'image' => $request->image ?? $request->old_image,
        ]);

        return redirect()->route('admin.profile')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }
}
