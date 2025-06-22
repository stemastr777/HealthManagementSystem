@extends('dashboard')

@section('username')
{{ $username }}
@endsection

@section('main-content')

<!-- MAKE APPOINTMENT -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Make appointment</h3>
    </div>
    <form action="{{ route('pasien-submit-daftar-poli') }}" method="POST">
        @csrf {{-- Tambahkan token CSRF --}}
        <div class="card-body">
            <livewire:appointment-form :dokters='$dokters' />

            <label for="jadwal_periksa">Masukkan keluhan</label>
            <textarea name="keluhan" id="keluhan" rows="5" cols="20" class="form-control" placeholder="Masukkan keluhan Anda"></textarea>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<!-- UPCOMING APPOINTMENT -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Upcoming appointment</h3>
    </div>
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID Daftar Poli</th>
                    <th>Nama Dokter</th>
                    <th>Tanggal Periksa</th>
                    <th>Nomor antrian</th>
                    <th>Keluhan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayats as $riwayat)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $riwayat->id }}</td>
                    <td>{{ $riwayat->jadwalPeriksa->dokter->user->nama }}</td>
                    <td>{{ $riwayat->jadwalPeriksa->hari . ', ' .  $riwayat->periksa->tgl_periksa . ' ' . $riwayat->jadwalPeriksa->jam_mulai . '-' . $riwayat->jadwalPeriksa->jam_selesai}}</td>
                    <td>{{ $riwayat->no_antrian }}</td>
                    <td>{{ $riwayat->keluhan }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection