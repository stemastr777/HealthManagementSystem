@extends('dashboard')

@section('username')
    {{ $nama_dokter }}
@endsection

@section('main-content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Periksa</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ID Periksa</th>
                    <th>ID Pasien</th>
                    <th>Tanggal Periksa</th>
                    <th>Catatan</th>
                    <th>Biaya Periksa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periksas as $periksa)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $periksa->id }}</td>
                        <td>{{ $periksa->pasien->nama }}</td>
                        <td>{{ $periksa->tgl_periksa }}</td>
                        <td>{{ $periksa->catatan }}</td>
                        <td>{{ $periksa->biaya_periksa }}</td>
                    </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection