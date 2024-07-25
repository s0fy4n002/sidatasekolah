@extends('layout.main-layout')

@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
        <div class="container mt-5">
            <div class="col-8 offset-2">
                <h3 class="mb-4">Detail Data user</h3>
            </div>

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
                    <!-- Card untuk menampilkan detail user -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Siswa</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                                <li class="list-group-item"><strong>NISN:</strong> {{ $user->nisn }}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
                                <li class="list-group-item"><strong>username:</strong> {{ $user->username }}</li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong> 
                                    {{ $user->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}
                                </li>
                                <li class="list-group-item"><strong>Hp:</strong> {{ $user->hp }}</li>
                                <li class="list-group-item"><strong>Sekolah:</strong> {{ $user->sekolah?->name }}</li>
                                <li class="list-group-item"><strong>Universitas:</strong> {{ $user->universitas?->name }}</li>
                                <li class="list-group-item"><strong>Fakultas:</strong> {{ $user->fakultas?->value }}</li>
                                <li class="list-group-item"><strong>Karir:</strong> {{ $user->karir?->name }}</li>
                                <li class="list-group-item"><strong>Kota:</strong> {{ $user->kota?->name }}</li>
                                <li class="list-group-item"><strong>Jalur Lulusan:</strong> {{ $user->jalur?->name }}</li>
                                <li class="list-group-item"><strong>Tahun Ajaran:</strong> {{ $user->tahun_ajaran?->tahun }}</li>
                                <li class="list-group-item"><strong>Dibuat :</strong> {{ $user->created_at }}</li>
                                <li class="list-group-item"><strong>Di Perbaruhi :</strong> {{ $user->updated_at }}</li>
                            </ul>
                            <div class="mt-3">
                                <a href="{{ route('siswa.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: Content -->
    </div>
</main>
@endsection
