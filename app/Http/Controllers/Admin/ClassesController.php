<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassesRequest;
use App\Models\AllowedClass;
use App\Models\Cart;
use App\Models\GymClass;
use App\Models\Subscription;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = GymClass::latest()->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        $trainings = Training::get(['id', 'name_en']);
        $subscriptions = Subscription::get(['name_en', 'id']);
        $trainers = User::whereHas('role', function ($q) {
            $q->where('name', 'Coach');
        })->get();
        return view('admin.classes.create', compact('trainings', 'subscriptions', 'trainers'));
    }

    public function store(ClassesRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = rand(1, 99) . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/classes');
            $image->move($path, $file_name);
            $request->image = 'uploads/classes/' . $file_name;

            // Save Data
            $gym_class = GymClass::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'price' => $request->price,
                'capacity' => $request->capacity,
                'duration' => $request->duration,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'training_id' => $request->training_id,
                'coach_id' => $request->coach_id,
                'status' => $request->status,
                'image' => $request->image
            ]);

            if($request->allowed_classes && count($request->allowed_classes) > 0)
            {
                foreach ($request->allowed_classes as $cl) {
                    AllowedClass::create([
                        'subscrib_id' => $cl,
                        'class_id' => $gym_class->id
                    ]);
                }
            }
        }
        return redirect()->route('admin.classes.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cls = GymClass::findOrFail($id);
        $trainings = Training::get(['id', 'name_en']);
        $trainers = User::whereHas('role', function ($q) {
            $q->where('name', 'Coach');
        })->get();
        return view('admin.classes.edit', compact('cls', 'trainings', 'trainers'));
    }

    public function update(ClassesRequest $request, GymClass $class)
    {
        if ($image = $request->file('image')) {
            // Delete old image
            if(File::exists($class->image))
                unlink($class->image);
            $file_name = rand(1, 99) . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/classes');
            $image->move($path, $file_name);
            $request->image = 'uploads/classes/' . $file_name;
            $class->update([
                'image' => $request->image
            ]);
        }

        // Update record
        $class->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
            'price' => $request->price,
            'capacity' => $request->capacity,
            'duration' => $request->duration,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'coach_id' => $request->coach_id
        ]);

        return redirect()->route('admin.classes.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(GymClass $class)
    {
        // Delete old image
        if(File::exists($class->image))
            unlink($class->image);
        // Delete record
        $class->delete();
        return redirect()->back()->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function new_customer()
    {
        $users = User::whereHas('role', function ($q) {
            $q->where('name', 'User');
        })->get();
        return view('admin.classes.new_customer', compact('users'));
    }

    public function new_customer_store(Request $request)
    {
        $payment_type = '';
        $purchase_type = '';

        $cart = Cart::create([
            'user_id' => $request->user_id,
            'payment_type_id' => $request->payment_type_id,
            'cart_date' => $request->cart_date,
            'amount' => $request->amount
        ]);
    }
}
