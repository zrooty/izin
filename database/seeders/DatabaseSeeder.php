<?php

namespace Database\Seeders;

use App\Models\Divisi;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $it = Divisi::create([
            'nama'=> 'it',
            'active'=> '1',
        ]);

        $user = User::factory()->create([
            'nama' => 'staff_it',
            'email' => 'staff_it@example.com',
        ]);
        
        $user->karyawan()->create([
            'nama'=> $user->nama,
            'divisi_id' => $it->id,
            'nama_divisi'=> $it->nama,
            'status_karyawan'=> 'tetap',
            'tanggal_masuk'=> now(),
            'jenis_kelamin'=> 'L',
        ]);
    }
}
