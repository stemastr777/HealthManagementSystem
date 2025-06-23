@extends('dashboard')

@section('username')
{{ $username }}
@endsection

@section('main-content')

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $num_of_unchecked_pasien }}</h3>

                <p>Future schedule</p>
            </div>
            <a href="{{route('dokter-show-periksa')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

@endsection