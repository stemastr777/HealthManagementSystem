@extends('dashboard')

@section('username')
{{ $nama_dokter }}
@endsection


@section('main-content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                {{-- FORM --}}
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Pemeriksaan pasien</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('dokter-create-detail-periksa', $periksa->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Rekomendasi obat</label>
                                    <div>
                                        <select style="height: 200px;" name="obats[]" id="obats" multiple required>
                                            @foreach ($obats as $obat)
                                                <option value="{{$obat->id}}" {{ in_array($obat->id, $selected_obats) ? 'selected' : '' }}>{{$obat->nama_obat}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Catatan</label>
                                    <textarea type="text" name="catatan" rows="10" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan catatan" required>{{ $periksa->catatan }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Harga</label>
                                    <input type="number" name="biaya_periksa" value="{{ $periksa->biaya_periksa }}" class="form-control" id="exampleInputEmail1"
                                        placeholder="Masukkan biaya periksa" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
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