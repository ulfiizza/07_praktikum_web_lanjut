<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //update data mahasiswa yang ada saat ini milik TI 2H
        DB::table('mahasiswas')->update(['kelas_id' => 8]);
    }
}
