@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong> 
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $karyawan->name }}">
                    </div> 
                    <div class="form-group mb-2">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $karyawan->email }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-dark"><i class="fas fa-save fa-pulse"> </i> Save</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
