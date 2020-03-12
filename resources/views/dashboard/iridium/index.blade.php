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

                    <label for="filename">Decimation:</label> 
                    <select id = "d" name="d">
                        <option value = "1">1</option>
                        <option value = "2">2</option>
                        <option value = "3">3</option>
                        <option value = "4" selected>4</option>
                        <option value = "5">5</option>
                        <option value = "6">6</option>
                        <option value = "7">7</option>
                        <option value = "8">8</option>
                        <option value = "9">9</option>
                        <option value = "10">10</option>
                    </select>

                    &nbsp

                    <label for="config">SDR Config:</label> 
                    <select id = "config" name="config" value="4">
                        @foreach ($data as $d)
                            <option value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                    </select>

                    &nbsp

                    <label for="d">Output File Name:</label> 
                    <input type="text" id="filename" name="filename" size="20" value="{{ 'output_' . $time . '.bin'}}">

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