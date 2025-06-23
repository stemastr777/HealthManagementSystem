@extends('dashboard')

@section('username')
admin
@endsection

@section('main-content')

<div class="row" style="display:flex;">
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small card -->

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $num_of_registered_dokter }}</h3>

                <p>Jumlah dokter yang tersedia</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('admin-show-dokter')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $num_of_registered_pasien }}</h3>

                <p>Jumlah pasien yang terdaftar</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('admin-show-pasien')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $num_of_registered_poli }}</h3>

                <p>Jumlah jenis poli yang ada</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('admin-show-poli')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger ">
            <div class="inner">
                <h3>{{ $num_of_registered_obat }}</h3>

                <p>Jumlah obat</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('admin-show-obat')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

@endsection