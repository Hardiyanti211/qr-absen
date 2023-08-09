@php
    $konf = DB::table('setting')->first();
@endphp

@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body table table-responsive">
                    @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ $message }}
                    </div>
                    @endif
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Masuk</th>
                                <th>Jam Masuk</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($masuk as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->tanggal_masuk)->isoFormat('dddd, D MMMM Y')  }}</td>
                                    <td>{{ $row->jam_masuk }}</td>
                                    <td>
                                        @if ($row->jam_masuk <= $konf->masuk_setting)
                                            Berhasil
                                        @else
                                            Telat    
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection