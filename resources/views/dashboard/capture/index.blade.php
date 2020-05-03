@extends('layouts.main')

@section('content')
    <div class="card">
    <div class="card-header" >
        File Captures
    </div>

    {{-- FIRST ROW --}}
    <div class="card-body">
    <div class="card-group">

            <div class="card">
            <div class="card-header">Raw Captures</div>
            <div class="card-body">

            <table class="table table-bordered data-table">
                <tbody>
                        <tr>
                            <td><b>FILE NAME</b></td>
                            <td><b>SIZE</b></td>
                            <td><b>ACTION</b></td>
                        </tr>


                    @foreach ($raw_capture as $raw_capture_file)
                        @if(basename($raw_capture_file) == '.gitattributes')
                            <!-- SKIP -->
                        @else
                            <tr>
                                <td>{{ basename($raw_capture_file) }}</td> 

                                <td>{{ (Storage::size($raw_capture_file) / 1000) . ' kb' }}</td>                                                                                                                                 

                                <td>
                                    <a href="/raw_capture/{{ basename($raw_capture_file) }}" class="btn btn-primary">Download</a>
                                    
                                    <form action="{{ route('capture.destroy', 'kill') }}" method="POST">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="file" name="file" value="{{ $raw_capture_file }}">

                                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="Delete"/>
                                    </form>
                                </td>

                            </tr> 
                        @endif
                    @endforeach
                </tbody>
            </table>

            </div>
            </div>

    </div>
    </div>

    {{-- SECOND ROW --}}
    <div class="card-body">
    <div class="card-group">

            <div class="card">
            <div class="card-header">Decoded Captures</div>
            <div class="card-body">
                
            <table class="table table-bordered data-table">
                <tbody>

                    <tr>
                        <td><b>FILE NAME</b></td>
                        <td><b>SIZE</b></td>
                        <td><b>ACTION</b></td>
                    </tr>

                    @foreach ($decode as $decode_file)
                        @if(basename($decode_file) == '.gitattributes')
                            <!-- SKIP -->
                        @else
                            <tr>
                                <td>{{ basename($decode_file) }}</td>                                                                 

                                <td>{{ (Storage::size($decode_file) / 1000) . ' kb' }}</td>                                                                                                                                 

                                <td>
                                    <a href="/decode/{{ basename($decode_file) }}" class="btn btn-primary">Download</a>
                                    
                                    <form action="{{ route('capture.destroy', 'kill') }}" method="POST">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="file" name="file" value="{{ $decode_file }}">

                                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="Delete"/>
                                    </form>
                                </td>

                            </tr> 
                        @endif
                    @endforeach
                </tbody>  
            </table>

            </div>
            </div>

    </div>
    </div>

    {{-- THIRD ROW --}}
    <div class="card-body">
    <div class="card-group">

            <div class="card">
            <div class="card-header">Audio Captures</div>
            <div class="card-body">

            <table class="table table-bordered data-table">
                <tbody>

                    <tr>
                        <td><b>FILE NAME</b></td>
                        <td><b>SIZE</b></td>
                        <td><b>ACTION</b></td>
                    </tr>

                    @foreach ($voice as $voice_file)
                        @if(basename($voice_file) == '.gitattributes')
                            <!-- SKIP -->
                        @else
                            <tr>
                                <td>{{ basename($voice_file) }}</td>                                                                 

                                <td>{{ (Storage::size($voice_file) / 1000) . ' kb' }}</td>                                                                                                                                 

                                <td>
                                    <a href="/voice/{{ basename($voice_file) }}" class="btn btn-primary">Download</a>
                                    
                                    <form action="{{ route('capture.destroy', 'kill') }}" method="POST">
                                        {{method_field('DELETE')}}
                                        {{csrf_field()}}
                                        <input type="hidden" class="form-control" id="file" name="file" value="{{ $voice_file }}">

                                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" value="Delete"/>
                                    </form>
                                </td>

                            </tr> 
                        @endif
                    @endforeach
                </tbody>  
            </table>

            </div>
            </div>

    </div>
    </div>

</div>
@endsection