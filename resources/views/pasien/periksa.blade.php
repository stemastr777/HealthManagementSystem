@extends('dashboard')

@section('main-content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Make appointment</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('pasien-submit-appointment') }}" method="POST">
        @csrf {{-- Tambahkan token CSRF --}}
        <div class="card-body">
            <div class="form-group">
                <label for="exampleSelectRounded0">Pilih Dokter</label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="id_dokter">
                    <option value="" selected disabled>Daftar dokter yang tersedia</option>
                    @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleDateTime">Pilih Tanggal & Waktu</label>
                <input type="datetime-local" class="form-control" id="exampleDateTime" name="tgl_periksa" value="{{ old('tanggal_periksa', now()->format('Y-m-d\TH:i')) }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection

@section('username')
    {{ $pasien_name }}
@endsection