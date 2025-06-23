@extends('dashboard')

@section('username')
admin
@endsection


@section('main-content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Manage Pasien</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin-update-or-create-pasien') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama">Nama Pasien</label>
                <input type="text" name="nama" class="form-control" placeholder="Input nama pasien" <?php echo isset($pasien_in_edit) ? 'readonly' : '' ?> value="{{$pasien_in_edit?->users->nama ?? ''}}" />
            </div>
            <div class="form-group">
                <label for="nama">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Input password" value="{{$pasien_in_edit?->users->password ?? ''}}" />
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" name="alamat" class="form-control" placeholder="Input alamat" value="{{$pasien_in_edit?->users->alamat ?? ''}}">
            </div>
            <div class="form-group">
                <label for="no_ktp">Nomor KTP</label>
                <input type="number" name="no_ktp" class="form-control" placeholder="Input nomor KTP" value="{{$pasien_in_edit?->no_ktp ?? ''}}">
            </div>
            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="text" name="no_hp" class="form-control" placeholder="Input nomor HP" value="{{$pasien_in_edit?->users->no_hp ?? ''}}">
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
        <h3 class="card-title">List Pasien</h3>
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
                    <th>No. KTP</th>
                    <th>No. HP</th>
                    <th>No. RM</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pasiens as $index => $pasien)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pasien->users->nama }}</td>
                    <td>{{ $pasien->users->alamat }}</td>
                    <td>{{ $pasien->no_ktp }}</td>
                    <td>{{ $pasien->users->no_hp }}</td>
                    <td>{{ $pasien->no_rm }}</td>
                    <td>
                        <div style="display: flex; flex-direction: row; column-gap: 10px;">
                            <form action="{{ route('admin-delete-pasien', $pasien->user_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width: fit-content;">Hapus</button>
                            </form>
                            <a href="{{ route('admin-edit-pasien', $pasien->user_id) }}" type="button" class="btn btn-warning" style="width: fit-content;">Edit</a>
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