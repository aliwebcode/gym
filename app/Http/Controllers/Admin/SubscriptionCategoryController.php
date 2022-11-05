<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionCategoryRequest;
use App\Models\SubscriptionCategory;
use Illuminate\Http\Request;

class SubscriptionCategoryController extends Controller
{

    public function index()
    {
        $subscription_categories = SubscriptionCategory::latest()->get();
        return view('admin.subscription_categories.index', compact('subscription_categories'));
    }

    public function create()
    {
        //
    }

    public function store(SubscriptionCategoryRequest $request)
    {
        SubscriptionCategory::create($request->validated());
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
        $category = SubscriptionCategory::findOrFail($id);
        return view('admin.subscription_categories.edit', compact('category'));
    }

    public function update(SubscriptionCategoryRequest $request, SubscriptionCategory $subscriptionCategory)
    {
        $subscriptionCategory->update($request->validated());
        return redirect()->route('admin.subscription_categories.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(SubscriptionCategory $subscriptionCategory)
    {
        $subscriptionCategory->delete();
        return redirect()->back()->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
