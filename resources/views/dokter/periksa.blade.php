@extends('dashboard')


@section('main-content')
<div class="card">
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
                    <th>Pasien</th>
                    <th>Tanggal Periksa</th>
                    <th>Catatan</th>
                    <th>Biaya Periksa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{no}</td>
                    <td>{id periksa}</td>
                    <td>{pasien}</td>
                    <td>{tgl}</td>
                    <td>{ctt}</td>
                    <td>{biaya}</td>
                </tr>
                <tr>
                    <td>{no}</td>
                    <td>{id periksa}</td>
                    <td>{pasien}</td>
                    <td>{tgl}</td>
                    <td>{ctt}</td>
                    <td>{biaya}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

@endsection