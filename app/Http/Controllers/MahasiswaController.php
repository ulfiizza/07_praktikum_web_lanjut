<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{

    public function cari(Request $request)
    {
        $cari = $request->cariMahasiswa;
        $paginate = Mahasiswa::where('Nama', 'like', '%'.$cari.'%')->paginate(5);
        return view('mahasiswas.index', compact('paginate'));
    }

    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        // with('i', (request()->input('page', 1) - 1) * 5);
        // $mahasiswa = Mahasiswa::with('kelas')->get();
        // $paginate = Mahasiswa::orderBy('Nim', 'asc')->paginate(3);
        // return view('mahasiswas.index', ['mahasiswas' => $mahasiswa, 'paginate'=>$paginate]);
        $mahasiswas = Mahasiswa::with('kelas');
        $paginate = Mahasiswa::with('kelas')->orderBy('Nim', 'asc')->paginate(3);
        return view('mahasiswas.index', ['mahasiswas' => $mahasiswas, 'paginate' => $paginate]);
    }
    public function create()
    {
        $kelas = Kelas::all(); //mendapat data dari tabel kelas
        return view('mahasiswas.create',['kelas' => $kelas]);
    }
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'kelas' => 'required',
        'Jurusan' => 'required',
        'No_Handphone' => 'required',
        'email' => 'required',
        'tanggalLahir' => 'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->Nim = $request->get('Nim');
        $mahasiswa->Nama = $request->get('Nama');
        $mahasiswa->Jurusan = $request->get('Jurusan');
        $mahasiswa->No_Handphone = $request->get('No_Handphone');
        $mahasiswa->email = $request->get('email');
        $mahasiswa->tanggalLahir = $request->get('tanggalLahir');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        //fungsi eloquent untuk menambah data
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        // Mahasiswa::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $mahasiswas = Mahasiswa::find($Nim);
        return view('mahasiswas.detail', compact('mahasiswas'));
    }
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        // $mahasiswa = Mahasiswa::find($Nim);
        $mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswas.edit', compact('mahasiswa', 'kelas'));
    }

    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'kelas' => 'required',
        'Jurusan' => 'required',
        'No_Handphone' => 'required',
        'email' => 'required',
        'tanggalLahir' => 'required',
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::find($Nim)->update($request->all());
        $mahasiswa = Mahasiswa::with('kelas')->where('Nim', $Nim)->first();
        $mahasiswa->Nim = $request->get('Nim');
        $mahasiswa->Nama = $request->get('Nama');
        $mahasiswa->Jurusan = $request->get('Jurusan');
        $mahasiswa->No_Handphone = $request->get('No_Handphone');
        $mahasiswa->email = $request->get('email');
        $mahasiswa->tanggalLahir = $request->get('tanggalLahir');
        $mahasiswa->kelas_id = $request->get('kelas');
        $mahasiswa->save();

        // $kelas = new Kelas;
        // $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk mengupdate data dengan relasi belongTo
        // $mahasiswa->kelas()->associate($kelas);
        // $mahasiswa->save();
        
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }
    public function destroy( $Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')-> with('success', 'Mahasiswa Berhasil Dihapus');
    }
    public function nilai($Nim)
    {
        $mahasiswas = Mahasiswa::with('matakuliah')->where('Nim', $Nim)->first();
        $nilai = DB::table('mahasiswa_mata_kuliah')
                    ->join('matakuliah', 'matakuliah.id', '=', 'mahasiswa_mata_kuliah.mata_kuliah_id')
                    ->where('mahasiswa_mata_kuliah.mahasiswa_Nim', $Nim)
                    ->select('nilai')
                    ->get();

        return view('mahasiswas.nilai', ['mahasiswas' => $mahasiswas, 'nilai' => $nilai]);
    }
};
