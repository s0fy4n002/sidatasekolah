@extends('layout.main-layout')
@section('content')
<main class="bg-light">
    <div class="p-2">
        <!-- start: Navbar -->
        @include('layout.partials.nav')
        <!-- end: Navbar -->

        <!-- start: Content -->
            <div class="container mt-5">
        <h3 class="mb-4 text-center">Pengaturan Jam</h3>

        <a href="{{ route('jam-slot.create') }}" class="btn btn-primary mb-3">Tambah Jam</a>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div>
            <form action="{{route('jam-slot.index')}}" method="get">
                <div class="col-3 d-flex">
                    <select name="key_hari" id="" class="form-control">
                        <option value="0">-Semua hari-</option>
                        @foreach ($days as $hari)
                            <option {{$key_hari == $hari->id ? 'selected':''}} value="{{$hari->id}}">{{$hari->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success ms-2" type="submit">Filter</button>
                </div>
               
            </form>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Jam Ke</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jam_slots as $jam_slot)
                    <tr>
                        <td>{{ $jam_slot->jam_ke }}</td>
                        <td>{{ $jam_slot->hari->name }}</td>
                        <td>{{ $jam_slot->jam_mulai }}</td>
                        <td>{{ $jam_slot->jam_selesai }}</td>
                        <td>
                            {{-- <a href="{{ route('jam_slot.show', $jam_slot->id) }}" class="btn btn-info btn-sm">Lihat</a> --}}
                            <a href="{{ route('jam-slot.edit', $jam_slot->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('jam-slot.destroy', $jam_slot->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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