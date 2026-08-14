<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first() ?? User::first();
        $authorId = $admin ? $admin->id : null;

        $articles = [
            [
                'title' => 'Analisis UU PDP terhadap Bisnis Digital di Indonesia',
                'slug' => Str::slug('Analisis UU PDP terhadap Bisnis Digital di Indonesia'),
                'content' => '<h3>Pengantar Undang-Undang Pelindungan Data Pribadi</h3>
<p>Undang-Undang Nomor 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP) telah menjadi era baru dalam tata kelola hukum siber di Indonesia. Kebijakan ini mewajibkan setiap korporasi dan pengendali data untuk memperketat standar keamanan sistem telekomunikasi.</p>
<h4>Dampak Strategis Bagi Ekosistem Bisnis Digital</h4>
<p>Bagi pelaku industri digital, terdapat setidaknya tiga aspek utama yang harus diperhatikan:</p>
<ul>
    <li><strong>Kewajiban Pengendali Data:</strong> Perusahaan wajib memperoleh persetujuan eksplisit dari subjek data sebelum melakukan pemrosesan.</li>
    <li><strong>Penunjukan DPO (Data Protection Officer):</strong> Korporasi dengan pemrosesan data berskala besar diwajibkan memiliki pejabat khusus pelindung data.</li>
    <li><strong>Sanksi Administratif dan Pidana:</strong> Ketidakpatuhan dapat berakibat pada denda administrasi sebesar maksimal 4% dari pendapatan tahunan atau sanksi pidana berat.</li>
</ul>
<p>Dengan masa transisi yang terus berjalan, perusahaan bisnis digital diharapkan segera melakukan audit tata kelola data untuk menjamin kepatuhan hukum secara menyuluruh.</p>',
                'cover_image' => null,
                'gallery' => [
                    'https://images.unsplash.com/photo-1450133064473-71024230f91b?auto=format&fit=crop&q=80&w=600&h=400',
                    'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?auto=format&fit=crop&q=80&w=600&h=400'
                ],
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'views_count' => 342,
                'status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Perkembangan Regulasi AI dan Implikasinya bagi Hukum di Indonesia',
                'slug' => Str::slug('Perkembangan Regulasi AI dan Implikasinya bagi Hukum di Indonesia'),
                'content' => '<h3>Kecerdasan Buatan dan Tantangan Etika Hukum</h3>
<p>Pesatnya perkembangan teknologi Artificial Intelligence (AI), khususnya Generative AI, menantang konstruksi hukum tradisional di seluruh dunia. Kementerian Kominfo Indonesia telah menerbilkan Surat Edaran tentang Etika Kecerdasan Buatan sebagai landasan awal kepatuhan teknologi.</p>
<h4>Isu Utama di Seputar Regulasi AI</h4>
<p>Beberapa poin diskursus hukum utama mengenai pemanfaatan AI mencakup:</p>
<ol>
    <li><strong>Hak Kekayaan Intelektual (HKI):</strong> Apakah karya yang dihasilkan oleh AI dapat diberikan hak cipta, dan siapa subjek hukum yang bertanggung jawab?</li>
    <li><strong>Pertanggungjawaban Hukum (Liability):</strong> Dalam kasus kesalahan diagnosis atau keputusan algoritmik hukum, apakah pengembang perangkat lunak atau pengguna yang dituntut?</li>
    <li><strong>Transparansi Algoritma:</strong> Pentingnya pencegahan bias dalam sistem peradilan dan otomatisasi kontrak komersial.</li>
</ol>
<p>Anticipatory regulation sangat diperlukan oleh praktisi hukum agar dapat mendampingi inovator teknologi tanpa menghambat pergerakan inovasi.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&q=80&w=600&h=400',
                'gallery' => null,
                'video_url' => null,
                'views_count' => 218,
                'status' => 'published',
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Mengenal Corporate Compliance: Pilar Tata Kelola Perusahaan Modern',
                'slug' => Str::slug('Mengenal Corporate Compliance: Pilar Tata Kelola Perusahaan Modern'),
                'content' => '<h3>Mengapa Corporate Compliance Sangat Vital?</h3>
<p>Dalam lanskap bisnis modern yang dinamis dan berteknologi berat, Corporate Compliance atau Kepatuhan Perusahaan bukan lagi sekadar urusan administratif formalitas. Ini merupakan perisai utama untuk melindungi citra korporasi dari potensi ligitimasi dan kerugian finansial jangka panjang.</p>
<h4>Komponen Utama Tata Kelola Modern (GCG)</h4>
<p>Penerapan kepatuhan yang efektif membutuhkan pengintegrasian dari:</p>
<ul>
    <li>Audit Kepatuhan Internal yang dilakukan secara berkala.</li>
    <li>Pemberantasan Praktik Penyuapan dan Anti-Korupsi sesuai ISO 37001.</li>
    <li>Pencegahan Risiko Ketenagakerjaan dan Lingkungan Hidup (ESG Compliance).</li>
</ul>
<p>Mitra konsultansi hukum berteknologi tinggi seperti LexaLink memainkan peran penting dalam menyediakan analisa regulasi secara presisi dan efisien.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&q=80&w=600&h=400',
                'gallery' => null,
                'video_url' => null,
                'views_count' => 189,
                'status' => 'published',
                'published_at' => now()->subDays(6),
            ]
        ];

        foreach ($articles as $item) {
            Article::updateOrCreate(
                ['slug' => $item['slug']],
                array_merge($item, ['user_id' => $authorId])
            );
        }
    }
}
