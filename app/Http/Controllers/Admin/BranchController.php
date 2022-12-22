<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function index()
    {
        $branches = Branch::latest()->get();
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Branch::create([
            'name' => $request->name
        ]);
        return redirect()->back()->with([
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
        $branch = Branch::findOrFail($id);
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $branch->update(['name' => $request->name]);
        return redirect()->route('admin.branches.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);

    }

    public function destroy($id)
    {
        Branch::findOrFail($id)->delete();
        return redirect()->back()->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
