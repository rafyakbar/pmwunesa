<?php

use Illuminate\Database\Seeder;
use PMW\Models\Fakultas;
use PMW\Models\Prodi;

class FakultasProdiSeeder extends Seeder
{

    const PRODI = [
        'Ilmu Pendidikan' => [
            '' ,
            'S1 Manajemen Pendidikan',
            'S1 Teknologi Pendidikan',
            'S1 Bimbingan Konseling',
            'S1 Psikologi',
            'S1 Pendidikan Luar Biasa',
            'S1 Pendidikan Guru Sekolah Dasar',
            'S1 Pendidikan Luar Sekolah',
            'S1 PG - PAUD'
        ],
        'Bahasa & Seni' => [
            'S1 Desain Komunikasi Visual',
            'S1 Pendidikan Bahasa Mandarin',
            'S1 Seni Musik',
            'S1 Seni Rupa',
            'S1 Sastra Inggris',
            'S1 Pendidikan Bahasa Jerman',
            'S1 Pendidikan Seni Rupa',
            'S1 Sastra Jerman',
            'S1 Pendidikan Bahasa Inggris',
            'S1 Pendidikan Bahasa dan Sastra Jawa',
            'S1 Pendidikan Bahasa Jepang',
            'S1 Sastra Indonesia',
            'S1 Pendidikan Bahasa dan Sastra Indonesia',
            'S1 Pendidikan Seni Drama, Tari, dan Musik',
            'D III Desain Grafis',
            'D III Bahasa Inggris'
        ],
        'Matematika & Ilmu Pengetahuan Alam' => [
            'S1 Pendidikan Biologi',
            'S1 Matematika',
            'S1 Pendidikan Kimia',
            'S1 Fisika',
            'S1 Pendidikan Matematika',
            'S1 Biologi',
            'S1 Pendidikan Sains',
            'S1 Pendidikan Fisika',
            'S1 Kimia'
        ],
        'Ilmu Sosial & Hukum' => [
            'S1 Ilmu Hukum',
            'S1 Pendidikan Sejarah',
            'S1 Ilmu Administrasi Negara',
            'S1 Pendidikan Pancasila dan Kewarganegaraan',
            'S1 Sosiologi',
            'S1 Pendidikan Geografi',
            'S1 Ilmu komunikasi',
            'D III Administrasi Negara'
        ],
        'Teknik' => [
            'S1 Teknik Mesin',
            'D III Manajemen Transportasi',
            'S1 Teknik Elektro',
            'S1 Teknik Sipil',
            'S1 Pend. Teknik Elektro',
            'DIII Tata Boga',
            'S1 Pend Teknik Bangunan',
            'S1 Pendidikan Tata Rias',
            'S1 Teknik Informatika',
            'S1 Sistem Informasi',
            'DIII Teknik Mesin',
            'DIII Teknik Sipil',
            'S1 Pendidikan Teknologi Informasi',
            'D III Manajemen Informatika',
            'S1 Pendidikan Tata Boga',
            'DIII Tata Busana',
            'DIII Teknik Listrik',
            'S1 Pend Teknik Mesin',
            'S1 Pendidikan Tata Busana',
            'S1 Pendidikan Kesejahteraan Keluarga'
        ],
        'Ilmu Keolahragaan' => [
            'S1 Pendidikan Kepelatihan Olahraga',
            'S1 Ilmu Keolahragaan',
            'S1 Pend. Jasmani, Kesehatan, dan Rekreasi'
        ],
        'Ekonomi' => [
            'S1 Pendidikan Akuntansi',
            'S1 Pendidikan Tata Niaga',
            'S1 Pendidikan Administrasi Perkantoran',
            'D III Akuntansi',
            'S1 Manajemen',
            'S1 Pend. Ekonomi',
            'S1 Ekonomi Islam',
            'S1 Akuntansi'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::PRODI as $fakultas => $daftarProdi)
        {
            $idfakultas = Fakultas::create([
                'nama' => $fakultas
            ]);
            foreach ($daftarProdi as $prodi)
            {
                Prodi::create([
                    'nama' => $prodi,
                    ''
                ]);
            }
        }
    }

}
