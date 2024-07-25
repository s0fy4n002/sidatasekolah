@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        @include('layout.partials.nav')
            <h3 class="text-center mt-5">
                Data Sekolah {{Auth::user()->sekolah?->name}}<br>
            </h3>

            <div class="row g-3">
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="#"
                        class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                        <div>
                            <i class="ri-user-line summary-icon bg-primary mb-2"></i>
                            <div>Total Siswa</div>
                        </div>
                        <h4>{{$total_user}}</h4>
                    </a>
                </div>
                @if ($total_sekolah >0)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="#"
                            class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                            <div>
                                <i class="ri-user-line summary-icon bg-primary mb-2"></i>
                                <div>Total Sekolah</div>
                            </div>
                            <h4>{{$total_sekolah}}</h4>
                        </a>
                    </div>
                @endif
               
            </div>
            @if (Auth::user()->role_id == 2)
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Sekolah</th>
                                        <th>Jumlah Lulusan SNBP</th>
                                        <th>Jumlah Lulusan SNBT</th>
                                        <th>Jumlah Lulusan SPAN SPTKIN</th>
                                        <th>Jumlah Lulusan Ke Perguruan Swasta</th>
                                        <th>Jumlah Lulusan Kedinasan</th>
                                        <th>Jumlah</th>
                                        <th>Action</th>
                                    </tr>
                    
                                </thead>
                                <tbody>
                                    @php
                                        $no=1;
                                    @endphp
                                    @foreach ($results as $result)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$result->nama_sekolah}}</td>
                                            <td>{{$result->jumlah_lulusan_snbp}}</td>
                                            <td>{{$result->jumlah_lulusan_snbt}}</td>
                                            <td>{{$result->jumlah_lulusan_span_sptkin}}</td>
                                            <td>{{$result->jumlah_lulusan_perguruan_swasta}}</td>
                                            <td>{{$result->jumlah_lulusan_kedinasan}}</td>
                                            <td>{{$result->jumlah_total}}</td>
                                            <td> <a href="{{route('siswa.index',['sekolah_id' => $result->sekolah_id])}}" class="btn btn-sm btn-success">Lihat</a> </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::user()->role_id==1)
            <div class="row">
                <div class="col-12 table-responsive">
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
                                <th>Action</th>
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
                                    <td> <a href="{{route('super-admin.listSekolah',['kota_id' => $result->kota_id])}}" class="btn btn-sm btn-success">Lihat</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
           
            @endif
       
    </div>
</main>
@endsection