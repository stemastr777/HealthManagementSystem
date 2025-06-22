@extends('dashboard')

@section('username')
{{ $current_account->nama }}
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
                            <h3 class="card-title">Profile Dokter</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('dokter-update-profile') }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama</label>
                                    <input value="{{ $current_account->user->nama }}" type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                        placeholder="Input doctor's name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Alamat</label>
                                    <input value="{{ $current_account->user->alamat }}" type="text" name="alamat" class="form-control" id="exampleInputEmail1"
                                        placeholder="Input alamat">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nomor HP</label>
                                    <input value="{{ $current_account->user->no_hp }}" type="tel" name="no_hp" class="form-control" id="exampleInputEmail1"
                                        placeholder="Input the phone number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input value="{{ $current_account->user->email }}" type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Input email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input value="{{ $current_account->user->password }}" type="password" name="password" class="form-control" id="exampleInputEmail1"
                                        placeholder="Input password yang baru">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Poli</label>
                                    <select name="id_poli" required>
                                        @foreach ($polis as $poli)
                                            @if ($current_account->id_poli === $poli->id) 
                                                <option value="{{ $poli->id }}" selected>{{ $poli->nama_poli }}</option>
                                            @else
                                                <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update profile</button>
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