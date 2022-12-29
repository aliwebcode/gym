<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HolidayRequest;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::latest()->get();
        return view('admin.settings.holidays.index', compact('holidays'));
    }

    public function store(HolidayRequest $request)
    {
        $rangArray = [];

        $startDate = strtotime($request->from);
        $endDate = strtotime($request->to);

        for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400))
        {
            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }

        foreach ($rangArray as $item)
        {
            Holiday::create([
                'day' => $item
            ]);
        }
        return redirect()->back()->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return redirect()->back()->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
