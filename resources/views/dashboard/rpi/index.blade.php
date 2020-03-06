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

    <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">CPU Temp</h5>
                  <p class="card-text">{{ $cpuTemp[0] }}</p>
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

</div>

@endsection