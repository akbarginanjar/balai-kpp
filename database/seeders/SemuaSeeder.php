<?php

namespace Database\Seeders;

use App\Models\Tb_jenis_bayar;
use App\Models\Tb_jenis_penggunaan;
use App\Models\Tb_jenisAset;
use App\Models\Tb_kondisi;
use App\Models\Tb_lama_sewa;
use App\Models\Tb_setting;
use Illuminate\Database\Seeder;

class SemuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting
        $setting = Tb_setting::create(['icon' => 'icondamkar.png', 'judul' => 'Belajar Link', 'alamat' => 'Jalan Sayuran Mantap', 'call_us' => '083643827212', 'email_us' => 'email@gmail.com', 'facebook' => 'http://facebook.com', 'twitter' => 'http://twitter.com', 'instagram' => 'http://instagram.com', 'linkedin' => 'http://linkedin.com']);
    }
}
