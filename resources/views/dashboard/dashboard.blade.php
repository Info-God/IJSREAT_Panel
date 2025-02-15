@extends('layouts/contentNavbarLayout')

@section('content')
    <div class="card p-3">
        <div class="card-header ">
            <div class="d-flex justify-content-between">
                <h3>Dashboard</h3>
                <p class="text-primary d-lg-block d-none"> <strong style="text-transform: uppercase;">International Journal of Scientific Research in Engineering & Technology (IJSREAT)
                </strong>
                </p>
            </div>
            <div class="row mt-1 gy-4 justify-content-center">
                @foreach ($data as $d)
                    <div class="col-md-5  col-lg-3 pt-3 ps-3 card mx-2">
                        <h6>{{ $d['name'] }}</h6>
                        <p>{{ $d['count'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
