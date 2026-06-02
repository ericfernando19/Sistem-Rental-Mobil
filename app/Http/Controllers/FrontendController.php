<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $cars = Car::available()->latest()->take(6)->get();
        $totalCars = Car::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalBookings = Booking::count();

        return view('frontend.index', compact('cars', 'totalCars', 'totalCustomers', 'totalBookings'));
    }

    public function catalog(Request $request)
    {
        $cars = Car::query()->filter($request->all())->latest()->paginate(9);

        return view('frontend.catalog', compact('cars'));
    }

    public function detail(Car $car)
    {
        return view('frontend.detail', compact('car'));
    }

    public function booking(Car $car)
    {
        return view('frontend.booking', compact('car'));
    }

    public function storeBooking(Request $request)
    {
        $rules = [
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'driver_service' => 'boolean',
            'pickup_location' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ];

        if (! auth()->check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
            $rules['phone'] = 'required|string|max:20';
        }

        $validated = $request->validate($rules);

        $car = Car::findOrFail($validated['car_id']);

        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        $totalDays = $start->diffInDays($end) + 1;

        $totalPrice = $totalDays * $car->price_per_day;
        if ($validated['driver_service'] ?? false) {
            $totalPrice += $totalDays * 150000;
        }

        $user = auth()->user();
        if (! $user) {
            $user = User::firstOrCreate(
                ['email' => $validated['email']],
                [
                    'name' => $validated['name'],
                    'password' => bcrypt('password'),
                    'phone' => $validated['phone'],
                    'role' => 'customer',
                ]
            );
        }

        $booking = Booking::create([
            'booking_code' => Booking::generateBookingCode(),
            'user_id' => $user->id,
            'car_id' => $car->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_days' => $totalDays,
            'driver_service' => $validated['driver_service'] ?? false,
            'pickup_location' => $validated['pickup_location'],
            'total_price' => $totalPrice,
            'booking_status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('booking.success', $booking->id)
            ->with('success', 'Booking berhasil! Silakan cek email Anda untuk detail.');
    }

    public function bookingSuccess(Booking $booking)
    {
        $whatsappMessage = $this->buildWhatsAppMessage($booking);

        return view('frontend.booking-success', compact('booking', 'whatsappMessage'));
    }

    public function riwayat()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('car')
            ->latest()
            ->paginate(10);

        return view('frontend.riwayat', compact('bookings'));
    }

    public function bookingDetail(Booking $booking)
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        return view('frontend.booking-detail', compact('booking'));
    }

    private function buildWhatsAppMessage(Booking $booking): string
    {
        $message = "Halo, saya ingin melakukan booking mobil dengan detail berikut:\n\n";
        $message .= "Kode Booking: {$booking->booking_code}\n";
        $message .= "Mobil: {$booking->car->name} ({$booking->car->brand})\n";
        $message .= "Tanggal Mulai: {$booking->start_date->format('d/m/Y')}\n";
        $message .= "Tanggal Selesai: {$booking->end_date->format('d/m/Y')}\n";
        $message .= "Total Hari: {$booking->total_days}\n";
        $message .= 'Layanan Sopir: '.($booking->driver_service ? 'Ya' : 'Tidak')."\n";
        $message .= "Lokasi Jemput: {$booking->pickup_location}\n";
        $message .= 'Total Harga: Rp '.number_format($booking->total_price, 0, ',', '.')."\n\n";
        $message .= 'Terima kasih.';

        return urlencode($message);
    }
}
