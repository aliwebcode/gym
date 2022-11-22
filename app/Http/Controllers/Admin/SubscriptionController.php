<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubscriptionRequest;
use App\Models\Subscription;
use App\Models\SubscriptionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SubscriptionController extends Controller
{

    public function index()
    {
        $subscriptions = Subscription::latest()->get();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $subscription_categories = SubscriptionCategory::get(['id', 'name_en']);
        return view('admin.subscriptions.create', compact('subscription_categories'));
    }

    public function store(SubscriptionRequest $request)
    {
        if ($image = $request->file('image')) {
            $file_name = rand(1, 99) . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/subscriptions');
            $image->move($path, $file_name);
            $request->image = 'uploads/subscriptions/' . $file_name;

            // Save Data
            Subscription::create([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'duration' => $request->duration,
                'price' => $request->price,
                'subscription_category_id' => $request->subscription_category_id,
                'image' => $request->image
            ]);
        }
        return redirect()->route('admin.subscriptions.index')->with([
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
        $subscription = Subscription::findOrFail($id);
        $subscription_categories = SubscriptionCategory::get(['id', 'name_en']);
        return view('admin.subscriptions.edit', compact('subscription', 'subscription_categories'));
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        if ($image = $request->file('image')) {
            // Delete old image
            if(File::exists($subscription->image))
                unlink($subscription->image);
            $file_name = rand(1, 99) . time() . "." . $image->getClientOriginalExtension();
            $path = public_path('uploads/subscriptions');
            $image->move($path, $file_name);
            $request->image = 'uploads/subscriptions/' . $file_name;
            $subscription->update([
                'image' => $request->image
            ]);
        }

        // Update record
        $subscription->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'duration' => $request->duration,
            'price' => $request->price,
            'subscription_category_id' => $request->subscription_category_id,
        ]);

        return redirect()->route('admin.subscriptions.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Subscription $subscription)
    {
        // Delete old image
        if(File::exists($subscription->image))
            unlink($subscription->image);
        // Delete record
        $subscription->delete();
        return redirect()->back()->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
