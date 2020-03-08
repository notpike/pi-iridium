@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header" >
        RPI Control
        <a href="{{ route("rpi.shutdown") }}" class="float-right btn btn-danger btn-sm">SHUTDOWN</a>
        <a href="{{ route("rpi.restart") }}" class="float-right btn btn-primary btn-sm">RESTART</a>
    </div>

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

    <div class="card-body">
    <div class="card-group">

        <div class="col-sm-6">
            <div class="card">
            <div class="card-header">Memory</div>
            <div class="card-body">
                <p class="card-text">Total: {{ $totalMemory[0] }} MB</p>
                <p class="card-text">Used: {{ $usedMemory[0] }} MB</p>
                <p class="card-text">Free: {{ $totalMemory[0] - $usedMemory[0] }} MB</p>
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
            <div class="card-header">Swap</div>
            <div class="card-body">
                <p class="card-text">Total: {{ $totalSwap[0] }} MB</p>
                <p class="card-text">Used: {{ $usedSwap[0] }} MB</p>
                <p class="card-text">Free: {{ $totalSwap[0] - $usedSwap[0] }} MB</p>
            </div>
            </div>
        </div>

    </div>
    </div>

    <div class="card-body">
    <div class="card-group">

        <div class="col-sm-6">
            <div class="card">
            <div class="card-header">Filesystem</div>
            <div class="card-body">
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

    <div class="col-sm-6">
            <div class="card">
            <div class="card-header">ifconfig</div>
            <div class="card-body">
                <p class="card-text">
<pre>
@foreach($ifconfig as $data)
{{ $data }}
@endforeach
</pre>  
                </p>
            </div>
            </div>
        </div>

    </div>
    </div>

    <div class="card-body">
        <div class="card">
        <div class="card-header">dmesg</div>
        <div class="card-body" style="overflow-y: auto; height: 250px" >
            <p class="card-text">
<pre>
@foreach($dmesg as $data)
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