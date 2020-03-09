@extends('layouts.main')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Iridium Coverage Map (Real-Time)</h2><br>
                    <tr>
                        <td>
                            <table width="100%" cellspacing="0" cellpadding="0" bordercolor="#CCCCCC" border="0">
                                <tbody>
                                    <tr>
                                        <td valign="middle" height="466" align="center">
                                            {{-- <iframe src="https://www.gsattrack.com/home/iridiumnextsatellites" width="830px" height="483px">Image of Iridium Certus Constellation</iframe> --}}
                                            <iframe src="https://www.gsattrack.com/home/iridiumnextsatellites" width="100%" height="100%">Iridium Certus Map</iframe>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>  
                        </td>
                    </tr>

                </div>
            </div>
        {{-- </div>
    </div>
</div> --}}
@endsection
