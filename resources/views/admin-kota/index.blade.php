@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
            <div class="container mt-5">
        <h3 class="mb-4 text-center">{{$title ?? ''}}</h3>
        <div class="col-12 mb-2">
            <a href="{{ route('admin-sekolah.create') }}" style="margin-right: 10px" class="btn btn-primary">Tambah</a>
            <a href="<?= route("admin-kota.generate") ?>" class="btn btn-success">Laporan Per Kota</a>
        </div>

       

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Sekolah</th>
                    <th>Jumlah Lulusan SNBP</th>
                    <th>Jumlah Lulusan SNBT</th>
                    <th>Jumlah Lulusan SPAN SPTK</th>
                    <th>Jumlah Lulusan Perguruan Tinggi</th>
                    <th>Jumlah Lulusan Kedinasan</th>
                    <th>Jumlah</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $result->nama_sekolah }}</td>
                        <td>{{ $result->jumlah_lulusan_snbt }}</td>
                        <td>{{ $result->jumlah_lulusan_snbt }}</td>
                        <td>{{ $result->jumlah_lulusan_span_sptkin }}</td>
                        <td>{{ $result->jumlah_lulusan_perguruan_swasta }}</td>
                        <td>{{ $result->jumlah_lulusan_kedinasan }}</td>
                        <td>{{ $result->jumlah_total }}</td>
                        
                        <td>
                            <a href="{{ route('admin-kota.sekolah.detail', $result->id) }}" class="btn btn-primary btn-sm">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        

        <!-- end: Content -->
    </div>
</main>
@endsection