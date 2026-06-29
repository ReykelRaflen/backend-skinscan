<?php

namespace database\seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rekomendasi;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Buat Akun Admin Pertama ──
        User::updateOrCreate(
            ['email' => 'admin@glowternity.com'],
            [
                'nama' => 'Admin Glowternity',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // ── Buat Rekomendasi Awal ──
        $rekomendasi = [
            [
                'label_kulit' => 'Acne',
                'tingkat_urgensi' => 'Tinggi',
                'tips_perawatan' => 'Gunakan cleanser ringan dengan asam salisilat. Hindari memencet jerawat secara paksa.'
            ],
            [
                'label_kulit' => 'Oily',
                'tingkat_urgensi' => 'Sedang',
                'tips_perawatan' => 'Gunakan pelembap berbahan dasar air (gel). Hindari produk berbahan minyak berlebih.'
            ],
            [
                'label_kulit' => 'Dry',
                'tingkat_urgensi' => 'Rendah',
                'tips_perawatan' => 'Gunakan pelembap tebal dengan kandungan ceramide dan asam hialuronat secara teratur.'
            ],
        ];

        foreach ($rekomendasi as $item) {
            Rekomendasi::updateOrCreate(['label_kulit' => $item['label_kulit']], $item);
        }
    }
}