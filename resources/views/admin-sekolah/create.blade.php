@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
         <div class="container mt-5">

            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-8 offset-2">
                    <h5 class="mb-4">{{$title ?? ''}}</h5>
                </div>
                <div class="col-8 offset-2">
                <!-- Formulir Create -->
                    <div class="card">
                        <div class="card-body">
                              <form action="{{ route('admin-sekolah.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                                    @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hp" class="form-label">HP</label>
                                    <input type="text" class="form-control @error('hp') is-invalid @enderror" id="hp" name="hp" value="{{ old('hp') }}" required>
                                    @error('hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                        <option value="" disabled selected>-Pilih-</option>
                                        <option value="1" {{ old('gender') == 1 ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="2" {{ old('gender') == 2 ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kota_id" class="form-label">Kota / Kabupaten</label>
                                    <select class="form-select @error('kota_id') is-invalid @enderror" id="kota_id" name="kota_id" required>
                                        <option value="" disabled selected>-Pilih-</option>
                                        @foreach ($cities as $city)
                                            <option value="{{$city->id}}" {{ old('kota_id') == $city->id ? 'selected' : '' }}>{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('kota_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="sekolah_id" class="form-label">Sekolah</label>
                                    <select class="form-select @error('sekolah_id') is-invalid @enderror" id="sekolah_id" name="sekolah_id" required>
                                        <option value="" disabled selected>-Pilih kota dulu-</option>
                                    </select>
                                    @error('sekolah_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                               

                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin-sekolah.index') }}" class="btn btn-secondary">Kembali</a>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>

        <!-- end: Content -->
    </div>
</main>

@push("addon-script")
    <script>
        let select_kota = document.querySelector("#kota_id")
        let sekolah =  JSON.parse('<?= $schools ?>')
      
        let select_sekolah = document.querySelector("#sekolah_id")
        select_kota.addEventListener('change', function(e){
            let selected_kota_id = e.target.value;
            let filter_sekolah = sekolah.filter(i => i.kota_id == selected_kota_id)
            select_sekolah.innerHTML=''
            let defaultoption = document.createElement('option')
            defaultoption.value = ''
            defaultoption.text = '-Pilih-'
            select_sekolah.appendChild(defaultoption)
            filter_sekolah.forEach(sekolah => {
                let option = document.createElement('option')
                option.value = sekolah.id
                option.text = sekolah.name
                select_sekolah.appendChild(option)
            });
        })      

    </script>
@endpush

@endsection