@extends('dashboard')

@section('username')
admin
@endsection


@section('main-content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Manage Poli</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin-update-or-create-poli') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Poli</label>
                <input type="text" name="nama_poli" class="form-control" placeholder="Input nama poli" value="{{$poli_in_edit?->nama_poli ?? ''}}" />
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" placeholder="Input password" value="{{$poli_in_edit?->keterangan ?? ''}}" />
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
<br />
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List poli</h3>
        <div class="card-tools">
            <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">NO</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($polis as $index => $poli)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $poli->nama_poli }}</td>
                    <td>{{ $poli->keterangan }}</td>
                    <td>
                        <div style="display: flex; flex-direction: row; column-gap: 10px;">
                            <form action="{{ route('admin-delete-poli', $poli->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width: fit-content;">Hapus</button>
                            </form>
                            <a href="{{ route('admin-edit-poli', $poli->id) }}" type="button" class="btn btn-warning" style="width: fit-content;">Edit</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection