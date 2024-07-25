@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        @include('layout.partials.nav')

        <div class="container mt-5">
        <h3 class="mb-4 text-center">{{$title ?? ''}}</h3>
    </div>
  
    <div class="col-12">
        <div class="mb-2">
            <a href="{{route('export.datasiswa')}}" class="btn btn-success btn-sm">Xls</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>HP</th>
                        <th>Gender</th>
                        <th>Kabupaten / Kota</th>
                        <th>Nama Sekolah</th>
                        <th>Universitas</th>
                        <th>Fakultas</th>
                        <th>Jalur Lulusan</th>
                        <th>Tahun Ajaran</th>
                        <th>Status Karir</th>
                    </tr>
    
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($results as $result)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$result->name}}</td>
                            <td>{{$result->nisn}}</td>
                            <td>{{$result->hp}}</td>
                            <td>{{$result->gender ==1 ?'laki-laki':'perempuan'}}</td>
                            <td>{{$result->kota?->name}}</td>
                            <td>{{$result->sekolah?->name}}</td>
                            <td>{{$result->universitas?->name}}</td>
                            <td>{{$result->fakultas?->value}}</td>
                            <td>{{$result->jalur?->name}}</td>
                            <td>{{$result->tahun_ajaran?->tahun}}</td>
                            <td>{{$result->karir?->name ?? '-'}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</main>
@endsection