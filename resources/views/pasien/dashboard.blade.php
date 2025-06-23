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
                    <h3>{{ $num_of_riwayats }}</h3>

                    <p>Riwayat periksa</p>
                </div>
                <a href="{{ route('pasien-show-riwayat') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $num_of_incoming_periksa }}</h3>

                    <p>Jadwal periksa kedepan</p>
                </div>
                <a href="{{ route('pasien-show-daftar-poli') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

@endsection