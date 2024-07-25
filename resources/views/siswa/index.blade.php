@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
            <div class="container mt-5">
        {{-- <h3 class="mb-4 text-center">{{$title ?? ''}}</h3> --}}
        <div class="col-12 d-flex mb-2">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm" style="margin-right: 10px">Tambah</a> 
            <a class="btn btn-success btn-sm" href="{{route('export.datasiswa')}}" style="margin-right: 10px"><i class="ri-file-chart-line"></i>Laporan per Siswa</a>
            <a href="{{route('export.lulusan.sekolah')}}" class="btn btn-success btn-sm">Laporan per Sekolah</a>

        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th width="50">Nama</th>
                    <th width="50">NISN</th>
                    <th width="100">HP</th>
                    <th width="100">Gender</th>
                    @if (Auth::user()->role_id != 3)
                        <th width="100">Kota</th>
                        <th width="100">Sekolah</th>
                    @endif
                    <th width="100">Universitas</th>
                    <th width="100">Fakultas</th>
                    <th width="50">Jalur Lulusan</th>
                    <th width="50">Tahun Ajaran</th>
                    <th width="50">Status Karir</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $no++}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nisn }}</td>
                        <td>{{ $user->hp }}</td>
                        <td>{{ $user->gender ==1 ? 'Laki - Laki' : 'Perempuan' }}</td>
                        @if (Auth::user()->role_id != 3)
                            <td>{{ $user->kota?->name }}</td>
                            <td>{{ $user->sekolah?->name }}</td>
                        @endif
                        <td>{{ $user->universitas?->name }}</td>
                        <td>{{ $user->fakultas?->value }}</td>
                        <td>{{ $user->jalur?->name }}</td>
                        <td>{{ $user->tahun_ajaran?->tahun }}</td>
                        <td>{{ $user->karir?->name }}</td>
                        <td>
                            <a href="{{ route('siswa.show', $user->id) }}" class="btn btn-info btn-sm"><i class="ri-eye-line"></i></a>
                            <a href="{{ route('siswa.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="ri-edit-2-line"></i></a>
                            <form action="{{ route('siswa.destroy', ['id' => $user->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="ri-delete-bin-line"></i></button>
                            </form>
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