@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header">Iridium Control</div>
    
    <div class="card-body">
    <div class="card-group">
        <div class="card">
        <div class="card-header">Iridium-Extractor
                <a href="{{ route("iridium.startIridium") }}"  class="float-right btn btn-danger btn-sm">START</a>
                <a href="{{ route("iridium.stopIridium") }}"  class="float-right btn btn-danger btn-sm">STOP</a>
        </div>

        {{-- websocket --}}
        {{-- php artisan websockets:serve --}}
        {{-- Tinker: >>> event(new App\Events\Iridium("message")) --}}
        <textarea readonly class="card-text" id="output" rows="20"></textarea >

         
        </div>
    </div>


    </div>      
    </div>

@endsection