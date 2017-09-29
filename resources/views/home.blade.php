@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Available Rides</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Vehicle Capacity</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($rides as $key => $ride)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ride->origin }}</td>
                                    <td>{{ $ride->destination }}</td>
                                    <td>{{ $ride->vehicle_capacity }}</td>
                                    <td>
                                        @if (Auth::user()->hasBooked($ride->id))
                                            <label class="btn btn-xs btn-primary" onclick="event.preventDefault();">Booked</label>
                                        @else
                                            <button class="btn btn-xs btn-success" onclick="event.preventDefault();
                                                document.getElementById('bookRide{{ $ride->id }}').submit()">book ride
                                                <form action="{{ url('book', $ride->id) }}" method="post" id="bookRide{{ $ride->id }}">
                                                    {{ csrf_field() }}
                                                </form>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
