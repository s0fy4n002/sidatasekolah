@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
         <div class="container mt-5">
            <h5 class="mb-4">Tambah Data Kelas</h5>

            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-8 offset-2">
                <!-- Formulir Create -->
                    <div class="card">
                        <div class="card-body">
                              <form action="{{ route('jam-slot.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="hari_id" class="form-label">Hari</label>
                                    <select value="{{old('hari_id')}}" class="form-control  @error('hari_id') is-invalid @enderror" id="hari_id" name="hari_id">
                                        @foreach($days as $hari)
                                            <option value="{{$hari->id}}">{{$hari->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('hari_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="jam_ke" class="form-label">Jam Ke</label>
                                    <select value="{{old('jam_ke')}}" class="form-control  @error('jam_ke') is-invalid @enderror" id="jam_ke" name="jam_ke">
                                        @for($i=1; $i <=15; $i++)
                                            <option {{ old('jam_ke') == $i ?'selected':''}} value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    @error('jam_ke')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                                    <input value="{{old('jam_mulai')}}" type="time" class="form-control" name="jam_mulai" />
                                    @error('jam_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                                    <input value="{{old('jam_selesai')}}" type="time" class="form-control" name="jam_selesai" />
                                    @error('jam_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('jam-slot.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>

        <!-- end: Content -->
    </div>
</main>
@endsection