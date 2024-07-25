@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        @include('layout.partials.nav')

        <div class="container mt-5">
        <h3 class="mb-4 text-center">{{$title ?? ''}}</h3>
    </div>
  
    <div class="col-10 offset-1">
        <div class="mb-2">
            <a href="{{route('export.lulusan.kota')}}" class="btn btn-success btn-sm">Xls</a>
        </div>
    
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kota/Kabupaten</th>
                    <th>Jumlah Lulusan SNBP</th>
                    <th>Jumlah Lulusan SNBT</th>
                    <th>Jumlah Lulusan SPAN SPTKIN</th>
                    <th>Jumlah Lulusan Ke Perguruan Swasta</th>
                    <th>Jumlah Lulusan Kedinasan</th>
                    <th>Jumlah</th>
                </tr>

            </thead>
            <tbody>
                @php
                    $no=1;
                @endphp
                @foreach ($results as $result)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$result->nama_kota}}</td>
                        <td>{{$result->jumlah_lulusan_snbp}}</td>
                        <td>{{$result->jumlah_lulusan_snbt}}</td>
                        <td>{{$result->jumlah_lulusan_span_sptkin}}</td>
                        <td>{{$result->jumlah_lulusan_perguruan_swasta}}</td>
                        <td>{{$result->jumlah_lulusan_kedinasan}}</td>
                        <td>{{$result->jumlah_total}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection