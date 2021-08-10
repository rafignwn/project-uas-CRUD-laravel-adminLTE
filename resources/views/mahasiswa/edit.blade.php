@extends('adminlte::page')

@section('title', 'Edit Mahasiswa')

@section('content_header')
    <h1 class="m-0 text-dark">Edit Mahasiswa</h1>
@stop

@section('content')
    <form action="{{route('mahasiswa.update', $student)}}" method="post">
        @method('PUT')
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="exampleInputName">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="name" value="{{$student->name ?? old('name')}}">
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Nim</label>
                        <input type="number" class="form-control @error('nim') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Nim" name="nim" value="{{$student->nim ?? old('nim')}}">
                        @error('nim') <span class="text-danger">{{$message}}</span> @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{route('mahasiswa.index')}}" class="btn btn-default">
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop