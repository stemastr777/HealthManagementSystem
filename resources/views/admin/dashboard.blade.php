@extends('dashboard')

@section('username')
    admin
@endsection

@section('main-content')

<div class="row">
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $num_of_available_obat }}</h3>

                <p>Jumlah obat</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('dokter-show-obat')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection