@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header">Iridium Control</div>
    
    <div class="card-body">
    <div class="card-group">
        <div class="card">
        <div class="card-header">Iridium-Extractor


                <form action="{{ route('iridium.startIridium') }}" method="POST">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <label for="filename">File Name:</label> 
                    <input type="text" id="filename" name="filename" size="20" value="output.bin">

                    <a href="{{ route('iridium.stopIridium') }}"  class="float-right btn btn-danger">STOP</a>
                    <button type="submit" class="float-right btn btn-primary">START</button>
                </form>
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