@extends('dashboard')

@section('username')
Admin
@endsection


@section('main-content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Manage Obat</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('admin-update-or-create-obat') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="nama_obat">Nama Obat</label>
                <input type="text" name="nama_obat" class="form-control" placeholder="Input nama obat" <?php echo isset($obat_in_edit) ? 'readonly' : '' ?> value="{{$obat_in_edit?->nama_obat ?? ''}}" />
            </div>
            <div class="form-group">
                <label for="kemasan">Kemasan</label>
                <input type="text" name="kemasan" class="form-control" placeholder="Input kemasan" value="{{$obat_in_edit?->kemasan ?? ''}}">
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" class="form-control" placeholder="Input harga" value="{{$obat_in_edit?->harga ?? ''}}">
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
        <h3 class="card-title">List obat</h3>
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
                    <th>ID Obat</th>
                    <th>Nama Obat</th>
                    <th>Kemasan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($obats as $index => $obat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ 'B' . str_pad($obat->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $obat['nama_obat'] }}</td>
                    <td>{{ $obat['kemasan'] }}</td>
                    <td>{{ $obat['harga'] }}</td>
                    <td>
                        <div style="display: flex; flex-direction: row; column-gap: 10px;">
                            <form action="{{ route('admin-delete-obat', $obat->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="width: fit-content;">Hapus</button>
                            </form>
                            <a href="{{ route('admin-edit-obat', $obat->id) }}" type="button" class="btn btn-warning" style="width: fit-content;">Edit</a>
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