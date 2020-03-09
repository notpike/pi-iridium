@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header">Iridium Control</div>
    
    <div class="card-body">
    <div class="card-group">
        <div class="card">
        <div class="card-header">Iridium-Extractor</div>

        {{-- Tinker: >>> event(new App\Events\Iridium("message")) --}}
        {{-- websocket --}}
        <textarea  class="card-text" id="output" rows="20"></textarea >
        {{-- <p id="output"></p> --}}

         
        </div>
    </div>


    </div>      
    </div>

@endsection