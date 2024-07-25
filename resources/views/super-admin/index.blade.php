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
            <a href="{{ route('super-admin.createAdminKota') }}" class="btn btn-primary btn-sm" style="margin-right: 10px">Tambah</a> 
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
                    <th width="50">Username</th>
                    <th width="50">Kota</th>
                    <th width="100">HP</th>
                    <th width="100">Gender</th>
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
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->kota?->name }}</td>
                        <td>{{ $user->hp }}</td>
                        <td>{{ $user->gender ==1 ? 'Laki - Laki' : 'Perempuan' }}</td>
                        <td>
                            <a href="{{ route('super-admin.showAdminKota', ['id' => $user->id] ) }}" class="btn btn-info btn-sm"><i class="ri-eye-line"></i></a>
                            <a href="{{ route('super-admin.editAdminKota',['id'=> $user->id]) }}" class="btn btn-warning btn-sm"><i class="ri-edit-2-line"></i></a>
                            
                            {{-- <a href="{{ route('admin.sekolah.resetPassword', $user->id) }}" class="btn btn-success btn-sm"><i class="ri-refresh-line"></i></a> --}}

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