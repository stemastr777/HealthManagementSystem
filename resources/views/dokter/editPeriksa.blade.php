@extends('dashboard')

@section('username')
{{ $username }}
@endsection


@section('main-content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
            <div class="col-12" style="display: flex; flex-direction:row-reverse;">
                {{-- FORM --}}
                <!-- EXAMINE AREA -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pemeriksaan pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('dokter-create-detail-periksa', $periksa->id) }}">
                            @csrf
                            <div class="card-body">
                                <livewire:examine-patient-form :obats='$obats' :selectedDetailPeriksas='$periksa->detailPeriksas' />
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Catatan</label>
                                    <textarea type="text" name="catatan" rows="10" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan catatan" required>{{ $periksa->catatan }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- HISTORY AREA -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat pasien</h3>
                        </div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal Periksa</th>
                                    <th>Nama Dokter</th>
                                    <th>Keluhan</th>
                                    <th>Catatan</th>
                                    <th>Obat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayats_pasien as $riwayat)
                                <tr>
                                    <td>{{ $riwayat->jadwalPeriksa->hari . ', ' .  $riwayat->periksa->tgl_periksa . ' ' . $riwayat->jadwalPeriksa->jam_mulai . '-' . $riwayat->jadwalPeriksa->jam_selesai}}</td>
                                    <td>{{ $riwayat->jadwalPeriksa->dokter->user->nama }}</td>
                                    <td>{{ $riwayat->keluhan }}</td>
                                    <td>{{ $riwayat->periksa->catatan }}</td>
                                    <td>
                                        <ul style="padding: 10px;">
                                            @foreach ($riwayat->periksa->detailPeriksas as $detail)
                                            <li>{{$detail->obat->nama_obat}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection