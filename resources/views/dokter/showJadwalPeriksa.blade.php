@extends('dashboard')

@section('username')
{{ $current_account->user->nama }}
@endsection


@section('main-content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Input new Jadwal Periksa</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="{{ route('dokter-add-jadwal-periksa') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" id="hari" required>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam mulai</label>
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam selesai</label>
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
        </div>
    </form>
</div>
<br />
<div class="card">
    <div class="card-header">
        <h3 class="card-title">List jadwal</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">NO</th>
                    <th>ID Jadwal</th>
                    <th>Hari</th>
                    <th>Jam mulai</th>
                    <th>Jam selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwals as $index => $jadwal)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ 'J' . str_pad($jadwal->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $jadwal['hari'] }}</td>
                    <td>{{ $jadwal['jam_mulai'] }}</td>
                    <td>{{ $jadwal['jam_selesai'] }}</td>
                    <td>
                        @if ($jadwal->is_active === 'true')
                            <span style="color: green; margin-right: 20px;">Activated</span>
                            <form action="{{ route('dokter-clear-jadwal-periksa', $jadwal->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger" style="width: fit-content;">Disable</button>
                            </form>

                        @else
                            <form action="{{ route('dokter-activate-jadwal-periksa', $jadwal->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary" style="width: fit-content;">Activate</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
@endsection