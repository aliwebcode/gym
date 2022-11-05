<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassesRequest;
use App\Models\GymClass;
use App\Models\Training;
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
        return view('admin.classes.create', compact('trainings'));
    }

    public function store(ClassesRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = $request->name_en . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/classes');
            $image->move($path, $file_name);
            $request->image = 'uploads/classes/' . $file_name;

            // Save Data
            GymClass::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'price' => $request->price,
                'capacity' => $request->capacity,
                'duration' => $request->duration,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'training_id' => $request->training_id,
                'status' => $request->status,
                'image' => $request->image
            ]);
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
        return view('admin.classes.edit', compact('cls', 'trainings'));
    }

    public function update(ClassesRequest $request, GymClass $class)
    {
        if ($image = $request->file('image')) {
            // Delete old image
            if(File::exists($class->image))
                unlink($class->image);
            $file_name = $request->name_en . time() . "." . $image->getClientOriginalExtension();
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
}
