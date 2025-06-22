@extends('dashboard')

@section('username')
{{ $username }}
@endsection

@section('main-content')
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Riwayat periksa</h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>NO</th>
          <th>ID Periksa</th>
          <th>Nama Dokter</th>
          <th>Tanggal Periksa</th>
          <th>Keluhan</th>
          <th>Catatan</th>
          <th>Obat</th>
          <th>Biaya Periksa</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($riwayats as $riwayat)

        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $riwayat->periksa->id }}</td>
          <td>{{ $riwayat->jadwalPeriksa->dokter->user->nama }}</td>
          <td>{{ $riwayat->jadwalPeriksa->hari . ', ' .  $riwayat->periksa->tgl_periksa . ' ' . $riwayat->jadwalPeriksa->jam_mulai . '-' . $riwayat->jadwalPeriksa->jam_selesai}}</td>
          <td>{{ $riwayat->keluhan }}</td>
          <td>{{ $riwayat->periksa->catatan }}</td>
          <td>
            <ul style="padding: 10px;">
              @foreach ($riwayat->periksa->detailPeriksas as $detail)
              <li>{{$detail->obat->nama_obat}}</li>
              @endforeach
            </ul>
          </td>
          <td>{{ $riwayat->periksa->biaya_periksa }}</td>
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection