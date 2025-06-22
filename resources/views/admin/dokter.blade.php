@extends('dashboard')

@section('username')
admin
@endsection


@section('main-content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Manage Dokter</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin-update-or-create-dokter') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Dokter</label>
                <input type="text" name="nama" class="form-control" placeholder="Input nama dokter" value="{{$dokter_in_edit?->user->nama ?? ''}}" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Input password" value="{{$dokter_in_edit?->user->password ?? ''}}" />
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Input alamat" value="{{$dokter_in_edit?->user->alamat ?? ''}}">
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Input nomor HP" value="{{$dokter_in_edit?->user->no_hp ?? ''}}">
            </div>
            <div class="form-group">
                <label for="id_poli">Poli</label>
                <select type="number" name="id_poli" class="form-control" placeholder="Select poli">
                    @foreach ($polis as $poli)
                    <option
                        value="{{$poli->id}}"
                        {{ ($dokter_in_edit?->id_poli ?? null) == $poli->id ? 'selected' : '' }}
                    >
                        {{$poli->nama_poli}}
                    </option>
                    @endforeach
                </select>
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
        <h3 class="card-title">List dokter</h3>
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
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Poli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dokters as $index => $dokter)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dokter->user->nama }}</td>
                    <td>{{ $dokter->user->alamat }}</td>
                    <td>{{ $dokter->user->no_hp }}</td>
                    <td>{{ $dokter->polis->nama_poli }}</td>
                    <td>
                        <div style="display: flex; flex-direction: row; column-gap: 10px;">
                            <form action="{{ route('admin-delete-dokter', $dokter->user_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width: fit-content;">Hapus</button>
                            </form>
                            <a href="{{ route('admin-edit-dokter', $dokter->user_id) }}" type="button" class="btn btn-warning" style="width: fit-content;">Edit</a>
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