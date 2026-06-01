<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Car;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalBookings = Booking::count();
        $totalRevenue = Booking::whereIn('booking_status', ['completed', 'in_progress', 'confirmed'])->sum('total_price');

        $monthlyRevenue = Booking::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', date('Y'))
            ->whereIn('booking_status', ['completed', 'in_progress', 'confirmed'])
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $recentBookings = Booking::with(['user', 'car'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalCars', 'totalCustomers', 'totalBookings', 'totalRevenue',
            'monthlyRevenue', 'monthlyBookings', 'recentBookings'
        ));
    }
}
