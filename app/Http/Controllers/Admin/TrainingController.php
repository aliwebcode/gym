<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainingRequest;
use App\Models\Branch;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TrainingController extends Controller
{
    public function index()
    {
        $trainings = Training::latest()->get();
        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        $branches = Branch::latest()->get();
        return view('admin.trainings.create', compact('branches'));
    }

    public function store(TrainingRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = rand(1, 99) . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/trainings');
            $image->move($path, $file_name);
            $request->image = 'uploads/trainings/' . $file_name;

            // Save Data
            Training::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'status' => $request->status,
                'image' => $request->image,
                'branch_id' => $request->branch_id
            ]);
        }
        return redirect()->route('admin.trainings.index')->with([
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
        $training = Training::findOrFail($id);
        $branches = Branch::latest()->get();
        return view('admin.trainings.edit', compact('training', 'branches'));
    }

    public function update(TrainingRequest $request, Training $training)
    {

        if ($image = $request->file('image')) {
            // Delete old image
            if(File::exists($training->image))
                unlink($training->image);
            $file_name = rand(1, 99) . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/trainings');
            $image->move($path, $file_name);
            $request->image = 'uploads/trainings/' . $file_name;
            $training->update([
                'image' => $request->image
            ]);
        }

        // Update record
        $training->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'status' => $request->status,
            'branch_id' => $request->branch_id
        ]);

        return redirect()->route('admin.trainings.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Training $training)
    {
        // Delete old image
        if(File::exists($training->image))
            unlink($training->image);
        // Delete record
        $training->delete();
        return redirect()->back()->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }

    public function get_trainings($branch_id)
    {
        $data = Training::where('branch_id', $branch_id)->get();
        return response()->json($data);
    }
}
