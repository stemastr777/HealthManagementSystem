@extends('dashboard')


@section('main-content')
<div class="card">
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
          <th>ID Dokter</th>
          <th>Tanggal Periksa</th>
          <th>Catatan</th>
          <th>Obat</th>
          <th>Biaya Periksa</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($riwayats as $riwayat)
        
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{ $riwayat->id }}</td>
            <td>{{ $riwayat->dokter->nama }}</td>
            <td>{{ $riwayat->tgl_periksa }}</td>
            <td>{{ $riwayat->catatan }}</td>
            <td>{obat}</td>
            <td>{{ $riwayat->biaya_periksa }}</td>
          </tr>

        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>

@endsection

@section('username')
  <a href="#" class="d-block">{{ $pasien_name }}</a>
@endsection