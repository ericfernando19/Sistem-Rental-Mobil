<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'car']);

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        $bookings = $query->latest()->get();

        $totalRevenue = $bookings->whereIn('booking_status', ['completed', 'confirmed', 'in_progress'])->sum('total_price');
        $totalBookings = $bookings->count();

        return view('admin.reports.index', compact('bookings', 'totalRevenue', 'totalBookings'));
    }
}
