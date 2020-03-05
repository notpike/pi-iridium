@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header">RPI Control</div>

        <h6>CPU Temp : {{ $cpuTemp[0] }}</h6>
        {{-- <h6>Memory: {{}}</h6> --}}
        <h6>Filesystem:</h6>
            <pre>
            @foreach($filesystem as $data)
{{ $data }}
            @endforeach
            </pre>

        </div>
@endsection