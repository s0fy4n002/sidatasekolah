@extends('layout.main-layout')

@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
        <div class="container mt-5">
            <h5 class="mb-4">Detail Data user</h5>

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
                            <h5 class="card-title">Informasi user</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                                <li class="list-group-item"><strong>Nama:</strong> {{ $user->name }}</li>
                                <li class="list-group-item"><strong>Jenis Kelamin:</strong> 
                                    {{ $user->gender == 1 ? 'Laki-laki' : 'Perempuan' }}
                                </li>
                            </ul>
                            <div class="mt-3">
                                <a href="{{ route('super-admin.editAdminKota', ['id'=>$user->id]) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('super-admin.index') }}" class="btn btn-secondary">Kembali</a>
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
