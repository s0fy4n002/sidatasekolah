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
                <div class="col-10 offset-1">
                    <h5 class="mb-4">{{$title ?? ''}}</h5>
                </div>
                <div class="col-10 offset-1">
                <!-- Formulir Create -->
                    <div class="card">
                        <div class="card-body">
                              <form action="{{ route('siswa.store') }}" method="POST">
                                @csrf
                                    
                               
                                    <div class="mb-3">
                                        <label for="nisn" class="form-label">NISN</label>
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn" name="nisn" value="{{ old('nisn') }}" required>
                                        @error('nisn')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <div class="mb-3 col-md-6 col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                      
                                        <div class="mb-3 col-md-6 col-12">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
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
                                

                                <div class="form-group row">
                                    <div class="mb-3 col-md-6 col-12">
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
    
                                    <div class="mb-3 col-md-6 col-12">
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
                                </div>
                                <div class="form-group row">

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="sekolah_id" class="form-label">Sekolah</label>
                                        <select class="form-select @error('sekolah_id') is-invalid @enderror" id="sekolah_id" name="sekolah_id" required>
                                            <option value="" disabled selected>-Pilih-</option>
                                            @foreach ($schools as $sekolah)
                                                <option value="{{$sekolah->id}}" {{ old('sekolah_id') == $sekolah->id ? 'selected' : '' }}>{{$sekolah->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('sekolah_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="jalur_id" class="form-label">Lulusan Jalur</label>
                                        <select class="form-select @error('jalur_id') is-invalid @enderror" id="jalur_id" name="jalur_id" required>
                                            <option value="" disabled selected>-Pilih-</option>
                                            @foreach ($jalur as $j)
                                                <option value="{{$j->id}}" {{ old('jalur_id') == $j->id ? 'selected' : '' }}>{{$j->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('jalur_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-md-4 col-12">
                                        <label for="tahun_ajaran_id" class="form-label">Tahun Ajaran</label>
                                        <select class="form-select @error('tahun_ajaran_id') is-invalid @enderror" id="tahun_ajaran_id" name="tahun_ajaran_id" required>
                                            <option value="" disabled selected>-Pilih-</option>
                                            @foreach ($tahun_ajaran as $tha)
                                                <option value="{{$tha->id}}" {{ old('tahun_ajaran_id') == $tha->id ? 'selected' : '' }}>{{$tha->tahun}}</option>
                                            @endforeach
                                        </select>
                                        @error('tahun_ajaran_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                </div>

                                <div class="mb-3 col-md-6 col-12">
                                    <label for="status_study" class="form-label">Status Study</label>
                                    <br>
                                    <label class="radio" style="margin-right: 10px" for="status_study_1"> <input type="radio" name="status_study" id="status_study_1" value="1">Kuliah</label> 

                                    <label class="radio" for="status_study_0"> <input type="radio" name="status_study" id="status_study_0" value="2">Kerja</label>
                                   
                                    @error('status_study')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                               <div class="form-group row" id="study" style="display: none">
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="universitas_id" class="form-label">Universitas</label>
                                        <select class="form-select @error('universitas_id') is-invalid @enderror" id="universitas_id" name="universitas_id">
                                            <option value="" disabled selected>-Pilih-</option>
                                            @foreach ($universitas as $univ)
                                                <option value="{{$univ->id}}" {{ old('universitas_id') == $univ->id ? 'selected' : '' }}>{{$univ->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('universitas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3 col-md-6 col-12">
                                        <label for="fakultas_id" class="form-label">Fakultas</label>
                                        <select class="form-select @error('fakultas_id') is-invalid @enderror" id="fakultas_id" name="fakultas_id">
                                            <option value="" disabled selected>-Pilih-</option>
                                            @foreach ($faculties as $fakultas)
                                                <option value="{{$fakultas->id}}" {{ old('fakultas_id') == $fakultas->id ? 'selected' : '' }}>{{$fakultas->value}}</option>
                                            @endforeach
                                        </select>
                                        @error('fakultas_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                               </div>

                              
                                <div class="mb-3" id="karir" style="display: none">
                                    <label for="karir_id" class="form-label">Status Karir</label>
                                    <select class="form-select @error('karir_id') is-invalid @enderror" id="karir_id" name="karir_id">
                                        <option value="" disabled selected>-Pilih-</option>
                                        @foreach ($karir as $kar)
                                            <option value="{{$kar->id}}" {{ old('karir_id') == $kar->id ? 'selected' : '' }}>{{$kar->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('karir_id')
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

@push('addon-script')
    <script>
        let study = document.getElementById('study')
        let karir = document.getElementById('karir')
        let universitas_id = document.getElementById('universitas_id')
        let fakultas_id = document.getElementById('fakultas_id')
        let karir_id = document.getElementById('karir_id')

        let kuliah = document.getElementById('status_study_1')
        let kerja = document.getElementById('status_study_0')

        kuliah.addEventListener('click', function(e){
            karir.style.display='none'
            study.style.display='flex'
            universitas_id.setAttribute('required', true)
            fakultas_id.setAttribute('required', true)

            karir_id.removeAttribute('required')
        })
        kerja.addEventListener('click', function(e){
            karir.style.display='block'
            study.style.display='none'

            universitas_id.removeAttribute('required')
            fakultas_id.removeAttribute('required')

            karir_id.setAttribute('required', true)
        })

    </script>
@endpush
@endsection