@extends('layout.main-layout')

@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
        <div class="container mt-5">
            <h5 class="mb-4">Detail Data Guru</h5>

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
                    <!-- Card untuk menampilkan detail guru -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Informasi Guru</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>ID:</strong> {{ $guru->id }}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ $guru->name }}</li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong> 
                                    {{ $guru->jenis_kelamin == 1 ? 'Laki-laki' : 'Perempuan' }}
                                </li>
                            </ul>
                            <div class="mt-3">
                                <a href="{{ route('guru.edit', $guru->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Kembali</a>
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
