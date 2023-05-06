@extends('mahasiswas.layout')
 
@section('content')
 
<div class="container mt-5">
 
 <div class="row justify-content-center align-items-center">
 <div class="card" style="width: 24rem;">
 <div class="card-header">
 Edit Mahasiswa
 </div>
 <div class="card-body">
 @if ($errors->any())
 <div class="alert alert-danger">
 <strong>Whoops!</strong> There were some problems with your i
nput.<br><br>
 <ul>
 @foreach ($errors->all() as $error)
 <li>{{ $error }}</li>
 @endforeach
 </ul>
 </div>
 @endif
 <form method="post" action="{{ route('mahasiswas.update', $mahasiswa->Nim) }}" id="myForm">
 @csrf
 @method('PUT')
 <div class="form-group">
 <label for="Nim">Nim</label> 
 <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $mahasiswa->Nim }}" aria-describedby="Nim" > 
 </div>
 <div class="form-group">
 <label for="Nama">Nama</label> 
 <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $mahasiswa->Nama }}" aria-describedby="Nama" > 
 </div>
 <div class="form-group">
 <label for="Kelas">Kelas</label> 
 <select name="kelas" class="form-control">
    @foreach($kelas as $kls)
        <option value="{{$kls->id}}" {{ $mahasiswa->kelas_id == $kls->id ? 'selected' : '' }}>{{$kls->nama_kelas}}</option>
    @endforeach
</select>
 </div>
 <div class="form-group">
 <label for="Jurusan">Jurusan</label> 
 <input type="text" name="Jurusan" class="form-control" id="Jurusan" value="{{ $mahasiswa->Jurusan }}" aria-describedby="Jurusan" > 
 </div>
 <div class="form-group">
 <label for="No_Handphone">No_Handphone</label> 
 <input type="text" name="No_Handphone" class="form-control" id="No_Handphone" value="{{ $mahasiswa->No_Handphone }}" aria-describedby="No_Handphone" > 
 </div>
 <div class="form-group">
 <label for="email">E-mail</label> 
 <input type="text" name="email" class="form-control" id="email" value="{{ $mahasiswa->email }}" aria-describedby="email" > 
 </div>
 <div class="form-group">
 <label for="tanggalLahir">Tanggal Lahir</label> 
 <input type="date" name="tanggalLahir" class="form-control" id="tanggalLahir" value="{{ $mahasiswa->tanggalLahir }}" aria-describedby="tanggalLahir" > 
 </div>
 <button type="submit" class="btn btn-primary">Submit</button>
 </form>
 </div>
 </div>
 </div>
</div>
@endsection
