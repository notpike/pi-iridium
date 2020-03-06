@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header">RPI Control</div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">CPU Temp</h5>
                <p class="card-text">{{ $cpuTemp[0] / 1000 }} C</p>
                {{-- <p class="card-text">{{ $cpuTemp[0] }} C</p> DEV USE ON QUBESOS --}}
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Memory</h5>
                <p class="card-text">Total: {{ $totalMemory[0] }} MB</p>
                <p class="card-text">Used: {{ $usedMemory[0] }} MB</p>
                <p class="card-text">Free: {{ $totalMemory[0] - $usedMemory[0] }} MB</p>
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Swap</h5>
                <p class="card-text">Total: {{ $totalSwap[0] }} MB</p>
                <p class="card-text">Used: {{ $usedSwap[0] }} MB</p>
                <p class="card-text">Free: {{ $totalSwap[0] - $usedSwap[0] }} MB</p>
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filesystem</h5>
                <p class="card-text">
<pre>
@foreach($filesystem as $data)
{{ $data }}
@endforeach
</pre>  
                </p>
            </div>
            </div>
        </div>
    </div>

</div>

@endsection