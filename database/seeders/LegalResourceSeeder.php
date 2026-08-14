<?php

namespace Database\Seeders;

use App\Models\LegalResource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LegalResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = [
            [
                'title' => 'UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi (UU PDP)',
                'document_number' => 'UU-27/2022',
                'category' => 'Undang-Undang',
                'year' => 2022,
                'effective_date' => '2022-10-17',
                'abstract' => '<p>Undang-Undang ini mengatur dasar perlindungan data pribadi di Indonesia, kewajiban pengendali dan prosesor data, kepatuhan transfer data lintas negara, hak-hak subjek data hukum, serta pembentukan lembaga otoritas pengawasan pelindungan data pribadi (DPA). Mandat masa transisi kepatuhan berakhir pada Oktober 2024 dengan sanksi administratif hingga pidana bagi korporasi yang melabrak standar proteksi enkripsi data.</p>',
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf', // Dummy streaming link
                'downloads_count' => 342,
                'tags' => ['cyberlaw', 'pdp', 'privasi', 'komersial', 'korporasi'],
            ],
            [
                'title' => 'UU No. 1 Tahun 2024 tentang Perubahan Kedua atas UU Informasi & Transaksi Elektronik',
                'document_number' => 'UU-1/2024',
                'category' => 'Undang-Undang',
                'year' => 2024,
                'effective_date' => '2024-01-02',
                'abstract' => '<p>Revisi terbaru Undang-Undang ITE yang menyederhanakan rumusan norma pencemaran nama baik, memperketat aturan hak atas pengahapusan data (Right to be Forgotten), serta memberikan kerangka legal perlindungan anak dalam ruang digital (Child Online Protection) dan otentikasi identitas digital korporasi.</p>',
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'downloads_count' => 218,
                'tags' => ['ite', 'digital', 'transaksi', 'cybersecurity', 'litigasi'],
            ],
            [
                'title' => 'Peraturan OJK No. 3/POJK.03/2024 tentang Manajemen Risiko Teknologi & AI pada Perbankan',
                'document_number' => 'POJK-3/2024',
                'category' => 'Regulasi AI',
                'year' => 2024,
                'effective_date' => '2024-02-15',
                'abstract' => '<p>Regulasi khusus sektor keuangan dan perbankan terkait implementasi Kecerdasan Buatan (AI), Machine Learning, serta infrastruktur cloud computing. Aturan ini mensyaratkan kewajiban audit algoritmik tahunan, proteksi mitigasi bias otomatis, dan protokol kelangsungan bisnis (BCP) darurat terhadap potensi kecurangan cyber.</p>',
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'downloads_count' => 456,
                'tags' => ['ojk', 'fintech', 'ai', 'perbankan', 'riskmanagement'],
            ],
            [
                'title' => 'Putusan Mahkamah Agung No. 789 K/Pdt.Sus-HKI/2023 tentang Hak Cipta Karya Algoritma Digital',
                'document_number' => 'PUTUSAN-MA-789/2023',
                'category' => 'Putusan MA',
                'year' => 2023,
                'effective_date' => '2023-11-20',
                'abstract' => '<p>Yurisprudensi penting Mahkamah Agung yang mengadili sengketa kepemilikan kode sumber (source code) dan aset kreasi komputasi algoritmik antarkantor cabang lintas negara. Putusan ini mengokohkan doktrin work-for-hire dalam hukum kekayaan intelektual digital di Indonesia.</p>',
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'downloads_count' => 175,
                'tags' => ['hki', 'hakcipta', 'algoritma', 'yurisprudensi', 'sengketa'],
            ],
            [
                'title' => 'Jurnal Kajian Kepatuhan Hukum Komputasi Awan (Cloud Computing) & Transfer Data Lintas Batas',
                'document_number' => 'KAI-RESEARCH-09/2024',
                'category' => 'Jurnal Kajian',
                'year' => 2024,
                'effective_date' => '2024-05-10',
                'abstract' => '<p>Kajian mendalam dari Tim Peneliti LexaLink mengenai tantangan yuridis pemanfaatan pusat data eksternal di luar wilayah hukum Republik Indonesia, komparasi standar GDPR Eropa vs UU PDP Indonesia, serta checklist klausul kontrak Service Level Agreement (SLA) vendor terpercaya.</p>',
                'file_path' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
                'downloads_count' => 589,
                'tags' => ['cloud', 'crossborder', 'kepatuhan', 'kajian', 'gdpr'],
            ],
        ];

        foreach ($resources as $res) {
            LegalResource::updateOrCreate(
                ['document_number' => $res['document_number']],
                array_merge($res, ['slug' => Str::slug($res['title'])])
            );
        }
    }
}
