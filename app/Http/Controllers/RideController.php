<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ride;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Booking;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookedRide;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rides = Ride::where('date_time', '>=', Carbon::now())->get();
        return view('home', compact('rides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ride.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          "origin" => "required",
          "destination" => "required",
          "vehicle_capacity" => "required",
          "date" => "required",
          "time" => "required"
        ]);

        $ridedate = Carbon::parse($request['date']);
        $ridetime = Carbon::parse($request['time']);
        $date_time =$ridedate->format('Y-m-d')." ".$ridetime->format('H:i:s');
        $date_time = Carbon::parse($date_time);

        Ride::create([
            "user_id" => Auth::id(),
            "origin" => $request['origin'],
            "destination" => $request['destination'],
            "vehicle_capacity" => $request['vehicle_capacity'],
            "date_time" => $date_time,
        ]);

        alert()->success('You have added your ride', 'success');
        return back();
    }

    public function book($id)
    {
        if (Auth::user()->hasBooked($id)) {
            return back();
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'ride_id' => $id
        ]);

        Mail::to(Auth::user()->email)
        ->send(new BookedRide($booking));

        alert()->success('You have booked a ride', 'success');
        return back();
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
}
