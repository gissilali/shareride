@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <form action="{{ url('give-ride') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('origin_lat') }}">
                            <label>Origin</label>
                            <location
                            input-name="origin"></location>
                        </div>
                        <div class="form-group">
                            <label>Destination</label>
                            <location
                            input-name="destination"></location>
                        </div>
                        <div class="form-group">
                            <label>Vehicle Capacity</label>
                            <input type="number" name="vehicle_capacity" id="vehicle_capacity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Date for ride</label>
                            <input type="text" name="date" id="date">
                        </div>
                        <div class="form-group">
                            <label>Time for ride</label>
                            <input type="text" name="time" id="time">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Give Ride</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ url('plugins/pickadate/picker.js') }}"></script>
    <script src="{{ url('plugins/pickadate/picker.date.js') }}"></script>
    <script src="{{ url('plugins/pickadate/picker.time.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $('#date').pickadate({
                min: new Date()
            });
            $('#time').pickatime();
        });
    </script>
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('plugins/pickadate/themes/classic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('plugins/pickadate/themes/classic.time.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('plugins/pickadate/themes/classic.date.css') }}">
@endsection