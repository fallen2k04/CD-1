<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of appointments.
     */
    public function index()
    {
        $appointments = Appointment::with('customer')
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ], [
            'appointment_date.after_or_equal' => 'Không thể đặt lịch trong quá khứ.',
        ]);

        // Check for double booking
        $exists = Appointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('status', 'active')
            ->exists();

        if ($exists) {
            return back()->withErrors(['appointment_time' => 'Thời gian này đã có người đặt.'])->withInput();
        }

        // Find or create customer
        $customer = Customer::firstOrCreate(['name' => $request->customer_name]);

        // Create appointment
        Appointment::create([
            'customer_id' => $customer->id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'active',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Đặt lịch thành công!');
    }

    /**
     * Cancel the specified appointment.
     */
    public function cancel(Appointment $appointment)
    {
        $appointment->update(['status' => 'cancelled']);

        return redirect()->route('appointments.index')->with('success', 'Đã hủy lịch hẹn.');
    }
}
