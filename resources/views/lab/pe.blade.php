@extends('layouts.lab')
@section('content')
<div class="container">
    <h1 class="text-primary text-center mt-5">Daftar PE <br class="d-block d-md-none">E-SWAB</h1>
    <h5 class="text-primary text-center">Hasil yang belum dimasukan</h5>

    <div class="row mt-5">
        <div class="col table-responsive">
            <table class="table table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center" scope="col">#</th>
                        <th class="text-center" scope="col">Nomor Tabung</th>
                        <th scope="col">Nama</th>
                        {{-- <th class="text-center" scope="col">Umur</th> --}}
                        <th class="text-center" scope="col">Jenis Kelamin</th>
                        @if (Request::url() == route('lab.pe.all'))
                        <th class="text-center" scope="col">Status</th>
                        @endif
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pes as $key=>$pe)
                    <tr>
                        <th class="text-center" scope="row">{{ ($key+1) }}</th>
                        <td class="text-center">{{ $pe->tube_code }}</td>
                        <td>{{ $pe->person->name }}</td>
                        {{-- <td class="text-center">{{ $pe->person->age }}</td> --}}
                        <td class="text-center">{{ $pe->person->jenis_kelamin }}</td>
                        @if (Request::url() == route('lab.pe.all'))
                        <th class="text-center" scope="col">{{ $pe->result == null ? 'Belum Ada' : Str::title($pe->result->value) }}</th>
                        @endif
                        <td class="text-center">
                            <a class="btn btn-danger btn-pill" href="{{ route('lab.pe.action.positive', ['code' => $pe->code]) }}">Positif</a>
                            <a class="btn btn-primary btn-pill" href="{{ route('lab.pe.action.negative', ['code' => $pe->code]) }}">Negatif</a>
                            @if (Request::url() == route('lab.pe.all'))
                            <a class="btn btn-secondary btn-pill" href="{{ route('lab.pe.action.retire', ['code' => $pe->code]) }}">Cabut Hasil</a>
                            @endif
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
