@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header">Iridium Control</div>
    
    <div class="card-body">

    <div class="card-group">
        <div class="col-sm-6">
            <div class="card">
            <div class="card-header">CPU Temp</div>
            <div class="card-body">
                {{-- <p class="card-text">{{ $cpuTemp[0] / 1000 }} C</p> --}}

                {{-- DEV USE ON QUBESOS --}}
                <p class="card-text">{{ $cpuTemp[0] }} C</p> 
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
            <div class="card-header">Kernal Version</div>
            <div class="card-body">
                <p class="card-text">{{ $version[0]}}</p>
            </div>
            </div>
        </div>

        
</div>




    </div>
@endsection