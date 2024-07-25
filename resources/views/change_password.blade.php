@extends('layout.main-layout') <!-- Jika menggunakan layout dasar -->

@section('content')
<main class="bg-light">
    @include('layout.partials.nav')
    <div class="container mt-5">
         <!-- Menampilkan pesan sukses jika ada -->
        
        <div class="row offset-1">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Ubah Password</h5>

                        <!-- Menampilkan pesan error jika ada -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

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


                        <form action="{{ route('proses_change_password') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="old_password" class="form-label">Password Lama</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Ubah Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
