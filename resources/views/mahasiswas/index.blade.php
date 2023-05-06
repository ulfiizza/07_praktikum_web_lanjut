@extends('mahasiswas.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
    </div>
</div>
<form class="row mb-3 mt-5" action="{{ route('cari') }}" method="POST">
    @csrf
    <div class="col-md-6">
        <div class="d-flex flex-row">
            <input type="text" value="{{ (request()->cariMahasiswa) ? request()->cariMahasiswa : '' }}" name="cariMahasiswa" class="form-control" placeholder="cari mahasiswa">
            <button type="submit" class="btn btn-primary ml-3">Cari</button>
        </div>
    </div>
    <div class="col-md-6 d-flex flex-row justify-content-end">
        <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Input Mahasiswa</a>
    </div>
</form>
 
 @if ($message = Session::get('success'))
 <div class="alert alert-success">
 <p>{{ $message }}</p>
 </div>
 @endif
 
 <table class="table table-bordered">
 <tr>
 <th>Nim</th>
 <th>Nama</th>
 <th>Kelas</th>
 <th>Jurusan</th>
 <th>No_Handphone</th>
 <th>E-mail</th>
 <th>Tanggal Lahir</th>
 <th width="280px">Action</th>
 </tr>
 @foreach ($paginate as $mhs)
<tr>
    <td>{{ $mhs->Nim }}</td>
    <td>{{ $mhs->Nama }}</td>
    <td>{{ $mhs->kelas->nama_kelas }}</td> 
    <td>{{ $mhs->Jurusan }}</td>
    <td>{{ $mhs->No_Handphone }}</td>
    <td>{{ $mhs->email }}</td>
    <td>{{ $mhs->tanggalLahir }}</td>
    <td>
        <form action="{{ route('mahasiswas.destroy',$mhs->Nim) }}" method="POST">
            <a class="btn btn-info" href="{{ route('mahasiswas.show',$mhs->Nim) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$mhs->Nim) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <a class="btn btn-warning" href="{{ route('nilai',$mhs->Nim) }}">Nilai</a>
        </form>
    </td>
 </tr>
 @endforeach
 </table>
 <br>
 <div class="row">
        <div class="col-md-12">
            {{ $paginate->links() }}
        </div>
</div>
@endsection
