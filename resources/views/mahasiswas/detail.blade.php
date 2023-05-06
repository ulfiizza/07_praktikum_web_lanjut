@extends('mahasiswas.layout')
 
@section('content')
<div class="container mt-5">
 <div class="row justify-content-center align-items-center">
 <div class="card" style="width: 24rem;">
 <div class="card-header">
 Detail Mahasiswa
 </div>
 <div class="card-body">
 <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Nim: </b>{{$mahasiswas->Nim}}</li>
    <li class="list-group-item"><b>Nama: </b>{{$mahasiswas->Nama}}</li>
    <li class="list-group-item"><b>Kelas: </b>{{$mahasiswas->kelas->nama_kelas}}</li>
    <li class="list-group-item"><b>Jurusan: </b>{{$mahasiswas->Jurusan}}</li>
    <li class="list-group-item"><b>No Handphone: </b>{{$mahasiswas->No_Handphone}}</li>
    <li class="list-group-item"><b>E-mail: </b>{{$mahasiswas->email}}</li>
    <li class="list-group-item"><b>Tanggal Lahir: </b>{{$mahasiswas->tanggalLahir}}</li>
 </ul>
 </div>
 <a class="btn btn-success mt-3" href="{{ route('mahasiswas.index') }}">Kembali</a>
 </div>
 </div>
</div>
@endsection
