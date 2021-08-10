@extends('adminlte::page')

@section('title', 'List Mahasiswa')

@section('content_header')
    <h1 class="m-0 text-dark">List Mahasiswa</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{route('mahasiswa.create')}}" class="btn btn-primary mb-2">
                        Tambah
                    </a>

                    <table class="table table-hover table-bordered table-stripped" id="example2">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Nim</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $key => $student)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$student->name}}</td>
                                <td>{{$student->nim}}</td>
                                <td>
                                    <a href="{{route('mahasiswa.edit', $student)}}" class="btn btn-primary btn-xs">
                                        Edit
                                    </a>
                                    <a href="{{route('mahasiswa.destroy', $student)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <form action="" id="delete-form" method="post">
        @method('delete')
        @csrf
    </form>
    <script>
        $('#example2').DataTable({
            "responsive": true,
        });

        function notificationBeforeDelete(event, el) {
            event.preventDefault();
            if (confirm('Apakah anda yakin akan menghapus data ? ')) {
                $("#delete-form").attr('action', $(el).attr('href'));
                $("#delete-form").submit();
            }
        }

    </script>

    @if (session('success_message'))
        <script>
            Swal.fire('Error!', {{session('success_message')}}, 'error');
        </script>
    @endif

    @if (session('error_message'))
    <script>
        Swal.fire('Error!', {{session('error_message')}}, 'error');
    </script>
@endif
@endpush