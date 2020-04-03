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
                    @foreach ($raw_capture as $raw_capture_file)
                        @if(basename($raw_capture_file) == '.gitattributes')
                            <!-- SKIP -->
                        @else
                            <tr>
                                <td>{{ basename($raw_capture_file) }}</td>                                                                 

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
                <p class="card-text">Holder</p>
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
                <p class="card-text">Holder</p>
            </div>
            </div>

    </div>
    </div>

@endsection