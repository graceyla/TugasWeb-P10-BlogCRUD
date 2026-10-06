<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Pertama Kali Install Laravel',
                'category' => 'Cerita Kuliah',
                'content' => "Minggu lalu akhirnya install Laravel untuk pertama kali. Ternyata harus install Composer dulu, terus baru bisa create-project.\n\nSempat bingung kenapa awalnya database-nya pakai sqlite, ternyata dari Laravel 11 default-nya memang sqlite. Tinggal ganti DB_CONNECTION di file .env jadi mysql.",
            ],
            [
                'title' => 'Bedanya GET dan POST di Form',
                'category' => 'Tutorial',
                'content' => "GET biasanya dipakai buat ambil data, contohnya form pencarian. Datanya kelihatan di URL.\n\nPOST dipakai buat kirim data yang mengubah sesuatu di server, misalnya simpan data baru. Di Laravel setiap form POST wajib ada @csrf biar aman dari serangan CSRF.",
            ],
            [
                'title' => 'Kenapa Harus Pakai Prepared Statement',
                'category' => 'Tutorial',
                'content' => "Waktu tugas CRUD PHP native, dosen bilang semua query yang ada input user harus pakai prepared statement. Alasannya supaya aman dari SQL Injection.\n\nDi Laravel, Eloquent dan Query Builder sudah otomatis pakai parameter binding, jadi kita ga perlu bikin manual lagi.",
            ],
            [
                'title' => 'Tips Begadang Ngerjain Tugas Tanpa Tumbang',
                'category' => 'Opini',
                'content' => "Jujur begadang itu ga sehat, tapi kadang deadline numpuk. Tips dari aku: jangan minum kopi terlalu banyak, mending air putih yang banyak.\n\nTerus kerjain bagian yang paling susah duluan pas otak masih segar. Bagian styling CSS bisa belakangan.",
            ],
            [
                'title' => 'Mengenal Route Model Binding',
                'category' => 'Tutorial',
                'content' => "Route model binding itu fitur Laravel yang otomatis ambil data dari database berdasarkan parameter di URL.\n\nJadi kalau ada route posts/{post} dan di controller kita tulis function show(Post \$post), Laravel langsung cari post dengan id itu. Kalau ga ketemu otomatis 404.",
            ],
            [
                'title' => 'AI Bakal Gantiin Programmer?',
                'category' => 'Teknologi',
                'content' => "Banyak yang bilang AI bakal gantiin programmer. Menurut aku AI lebih cocok jadi alat bantu, sama kayak kalkulator buat orang akuntansi.\n\nTetap aja kita harus paham konsep dasarnya, karena kalau ga paham kita ga bisa ngecek hasilnya bener atau salah.",
            ],
            [
                'title' => 'Blade Component Itu Apa Sih',
                'category' => 'Tutorial',
                'content' => "Blade component itu potongan tampilan yang bisa dipakai berulang-ulang, misalnya alert atau card.\n\nBikinnya pakai php artisan make:component Alert, nanti muncul class di app/View/Components dan view di resources/views/components. Cara pakainya tinggal tulis <x-alert />.",
            ],
            [
                'title' => 'Pengalaman Pertama Presentasi Tugas',
                'category' => 'Cerita Kuliah',
                'content' => "Pertama kali presentasi tugas di depan kelas rasanya deg-degan banget. Apalagi pas dosen nanya kenapa pakai transaction di proses hapus.\n\nUntungnya sebelumnya sudah baca-baca dulu, jadi bisa jawab: biar kalau salah satu query gagal, semua perubahan dibatalkan.",
            ],
            [
                'title' => 'Git Itu Penting Banget Ternyata',
                'category' => 'Teknologi',
                'content' => "Dulu aku pikir git cuma buat upload tugas ke GitHub. Ternyata fungsinya jauh lebih dari itu, kita bisa lihat riwayat perubahan dan balik ke versi sebelumnya kalau ada yang rusak.\n\nUrutan yang paling sering dipakai: git add, git commit, terus git push.",
            ],
        ];

        foreach ($posts as $i => $post) {
            // dikasih jarak waktu biar urutan terbarunya kelihatan natural
            $waktu = now()->subDays(count($posts) - $i)->setTime(rand(8, 21), rand(0, 59));

            Post::create($post)->forceFill([
                'created_at' => $waktu,
                'updated_at' => $waktu,
            ])->save();
        }
    }
}
