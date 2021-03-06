<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Workshop;
use App\Booking;
use App\WorkshopLedger;
use App\Billing;


class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showHome()
    {
        $customers     = Customer::all();
        $CustomerCount = count($customers);

        $workshops     = Workshop::all();
        $WorkshopCount = count($workshops);
        $total_bookings = Booking::all()->count();

        $bookings_active   = Booking::ActiveBookings()->count();
        $total_jazzcash = WorkshopLedger::where('transaction_type','Top-Up')->get()->sum('amount');
        $total_matured_revenue = Booking::acceptedCompletedBookings()->get()->pluck('billing')->sum('lead_charges');
        return view('admin.home')->with(['CustomerCount' => $CustomerCount,'WorkshopCount' => $WorkshopCount, 'bookings_active' => $bookings_active, 'total_bookings' => $total_bookings, 'total_jazzcash' => $total_jazzcash, 'total_matured_revenue' => $total_matured_revenue ]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show Home
     *
     * @return \Illuminate\Http\Response
     */
}
