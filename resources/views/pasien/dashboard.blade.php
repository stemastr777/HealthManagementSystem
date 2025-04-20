@extends('dashboard')

@section('username')
  <a href="#" class="d-block">{{ $pasien_name }}</a>
@endsection

@section('main-content')

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $banyak_riwayat }}</h3>

                    <p>Riwayat periksa</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('pasien-riwayat') }}" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

@endsection