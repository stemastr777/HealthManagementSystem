@extends('dashboard')

@section('username')
{{ $username }}
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
                    <th>Nama Pasien</th>
                    <th>Tanggal Periksa</th>
                    <th>Rekomendasi obat</th>
                    <th>Catatan</th>
                    <th>Biaya Periksa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periksas as $periksa)

                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $periksa->id }}</td>
                    <td>{{ $periksa->daftarPolis->pasiens->nama }}</td>
                    <td>{{ $periksa->tgl_periksa }}</td>

                    @if ($periksa->biaya_periksa === 0)
                    <td style="opacity: 0.8; font-style: italic;">Belum melakukan diagnosa</td>
                    <td style="opacity: 0.8; font-style: italic;">Belum melakukan diagnosa</td>
                    <td style="opacity: 0.8; font-style: italic;">Belum melakukan diagnosa</td>
                    <td>
                        <a href="{{route('dokter-periksa-pasien', $periksa->id)}}" type="button" class="btn btn-success" style="width: 85px;">Examine</a>
                    </td>
                    @else
                    <td style="max-width: 300px;">
                        <ul style="padding: 10px;">
                            @foreach ($periksa->detailPeriksas as $detail)
                                <li>{{$detail->obat->nama_obat}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $periksa->catatan }}</td>
                    <td>{{ $periksa->biaya_periksa }}</td>
                    <td>
                        <a href="{{route('dokter-periksa-pasien', $periksa->id)}}" type="button" class="btn btn-warning" style="width: 85px;">Update</a>
                        <p style="font-size:smaller; font-weight: 700; margin-bottom:0; margin-top:10px;">Updated at:</p>
                        <p style="opacity: 0.8; font-style:italic; font-size:small">{{ $periksa->detailPeriksas->first()->updated_at }}</p>
                    </td>
                    @endif
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection