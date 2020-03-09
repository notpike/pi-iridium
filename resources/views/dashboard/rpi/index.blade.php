@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header" >
        RPI Control
        {{-- <a href="{{ route("rpi.index") }}" onclick="return confirm('Are you sure?')" class="float-right btn btn-danger btn-sm">SHUTDOWN</a>
        <a href="{{ route("rpi.index") }}" onclick="return confirm('Are you sure?')" class="float-right btn btn-primary btn-sm">RESTART</a> --}}

        <a href="{{ route("rpi.shutdown") }}" onclick="return confirm('Are you sure you want to SHUTDOWN?')" class="float-right btn btn-danger btn-sm">SHUTDOWN</a>
        <a href="{{ route("rpi.restart") }}" onclick="return confirm('Are you sure you want to RESTART?')" class="float-right btn btn-primary btn-sm">RESTART</a>
    </div>

    {{-- FIRST ROW --}}
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

    {{-- SECOND ROW --}}
    <div class="card-body">
    <div class="card-group">

        <div class="col-sm-6">
            <div class="card">
            <div class="card-header">Memory</div>
            <div class="card-body">
                <p class="card-text">Total: {{ $totalMemory[0] }} MB</p>
                {{-- <p class="card-text">Used: {{ $usedMemory[0] }} MB</p>
                <p class="card-text">Free: {{ $totalMemory[0] - $usedMemory[0] }} MB</p> --}}

                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ ($usedMemory[0] / $totalMemory[0]) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($usedMemory[0] / $totalMemory[0]) * 100 }}%">{{ $usedMemory[0] }} MB</div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
            <div class="card-header">Swap</div>
            <div class="card-body">
                <p class="card-text">Total: {{ $totalSwap[0] }} MB</p>
                {{-- <p class="card-text">Used: {{ $usedSwap[0] }} MB</p>
                <p class="card-text">Free: {{ $totalSwap[0] - $usedSwap[0] }} MB</p> --}}


                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ ($usedSwap[0] / $totalSwap[0]) * 100 }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ ($usedSwap[0] / $totalSwap[0]) * 100 }}%">{{ $usedSwap[0] }} MB</div>
                </div>
            </div>
            </div>
        </div>

    </div>
    </div>

    {{-- THIRD ROW --}}
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

                {{-- <div class="col-sm-6">
                    <div class="card">
                    <div class="card-header">lsusb</div>
                    <div class="card-body">
                        <p class="card-text">
<pre>
@foreach($lsusb as $data)
{{ $data }}
@endforeach
</pre>  
                        </p>
                    </div>
                    </div>
                </div> --}}

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

    {{-- FORTH ROW --}}
    <div class="card-body">
            <div class="card">
            <div class="card-header">lsusb</div>
            <div class="card-body">
                <p class="card-text">
<pre>
@foreach($lsusb as $data)
{{ $data }}
@endforeach
</pre>  
                </p>
            </div>
            </div>
        </div>

    {{-- Fith ROW --}}
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