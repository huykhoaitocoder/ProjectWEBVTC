<?php

namespace App\Http\Controllers\frontend;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'app_id' => 'required|exists:apps,id',
            'reason' => 'required|string|max:255',
        ]);

        Report::create([
            'user_id' => auth()->id(),
            'app_id' => $request->app_id,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Báo cáo của bạn đã được gửi.');
    }
}
