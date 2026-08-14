<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Webinar Eksklusif: Implementasi Regulasi AI & Etika Hukum Digital 2026',
                'event_date' => '2026-08-15',
                'event_time' => '13:30 - 16:00 WIB',
                'location_type' => 'online',
                'location' => 'Zoom Exclusive Room & LexaLink Portal',
                'description' => '<h3>Mendefinisikan Batasan Hukum Artificial Intelligence</h3>
                <p>Penggunaan Artificial Intelligence (AI) dalam automasi korporasi menuntut pemahaman mendalam tentang akuntabilitas hukum dan hak cipta algoritma. Dalam webinar ini, para pakar LexaLink akan mengulas secara tuntas bagaimana perusahaan dapat memitigasi risiko gugatan hukum terkait pemanfaatan AI.</p>
                <h4>Poin Utama Materi:</h4>
                <ul>
                    <li>Konstruksi Hukum Pertanggungjawaban Produk AI (Product Liability)</li>
                    <li>Audit Kepatuhan Algoritma berdasarkan Panduan Etika Kominfo & EU AI Act</li>
                    <li>Sesi Studi Kasus: Sengketa Kekayaan Intelektual dalam Generative AI</li>
                </ul>
                <p><strong>Pembicara:</strong> Dr. Hendra Wijaya, S.H., M.H. (Partner LexaLink) & Rania Sastro, LL.M. (Cyberlaw Expert).</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=1000',
                'gallery' => [
                    'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&q=80&w=600'
                ],
                'registration_link' => 'https://zoom.us',
                'status' => 'upcoming',
            ],
            [
                'title' => 'Masterclass Offline: Corporate Legal Risk & Compliance Audit 2026',
                'event_date' => '2026-09-05',
                'event_time' => '09:00 - 17:00 WIB',
                'location_type' => 'offline',
                'location' => 'The Ritz-Carlton, Pacific Place, Jakarta Selatan',
                'description' => '<h3>Langkah Praktis Menyusun Tata Kelola Kepatuhan Korporasi Terbaik</h3>
                <p>Masterclass sehari penuh ini dipersembahkan secara khusus bagi pimpinan korporasi, General Counsel, dan Manajer Legal untuk memperkokoh benteng kepatuhan perusahaan di tengah dinamika regulasi OJK dan KPPU.</p>
                <p>Peserta akan berkesempatan untuk menyimulasikan investigasi kepatuhan internal dan menyembuhkan potensi kerentanan kontrak dagang Internasional.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&q=80&w=1000',
                'gallery' => [
                    'https://images.unsplash.com/photo-1515187029135-18ee286d815b?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&q=80&w=600'
                ],
                'registration_link' => null,
                'status' => 'upcoming',
            ],
            [
                'title' => 'Hybrid Forum: Mitigasi Kebocoran Siber & Kepatuhan UU PDP bagi Sektor Keuangan',
                'event_date' => '2026-08-25',
                'event_time' => '09:30 - 12:00 WIB',
                'location_type' => 'hybrid',
                'location' => 'LexaLink Headquarters & Google Meet Broadcast',
                'description' => '<h3>Membedah Sanksi Administrasi & Pidana UU PDP bagi Pengendali Data</h3>
                <p>Implementasi penuh Undang-Undang Perlindungan Data Pribadi (UU PDP) mewajibkan kesiapan teknis dan hukum dari setiap lembaga keuangan dan startup fintech.</p>
                <p>Kami akan mengkaji protokol wajib notifikasi kebocoran data dalam 3x24 jam serta strategi pembelaan hukum korporasi (due diligence defense).</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&q=80&w=1000',
                'gallery' => null,
                'registration_link' => null,
                'status' => 'upcoming',
            ],
            [
                'title' => 'Workshop Eksklusif: Drafting Smart Contracts & Legalitas Web3 Ekosistem',
                'event_date' => '2026-06-10',
                'event_time' => '10:00 - 15:00 WIB',
                'location_type' => 'offline',
                'location' => 'Grand Hyatt Hotel, Bundar M.1, Jakarta',
                'description' => '<h3>Arsip Event Selesai - Sukses Dihadiri 150+ Konsultan & Chief Legal Officer</h3>
                <p>Kegiatan workshop drafting smart contract yang telah terselenggara dengan sukses. Membahas kekuatan pembuktian code di pengadilan perdata serta klausul arbitrase kriptografi internasional.</p>',
                'cover_image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1?auto=format&fit=crop&q=80&w=1000',
                'gallery' => [
                    'https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&q=80&w=600',
                    'https://images.unsplash.com/photo-1492538368677-f6e0afe31dcc?auto=format&fit=crop&q=80&w=600'
                ],
                'registration_link' => null,
                'status' => 'completed',
            ],
        ];

        foreach ($events as $item) {
            Event::updateOrCreate(
                ['title' => $item['title']],
                [
                    'slug' => Str::slug($item['title']),
                    'event_date' => $item['event_date'],
                    'event_time' => $item['event_time'],
                    'location_type' => $item['location_type'],
                    'location' => $item['location'],
                    'description' => $item['description'],
                    'cover_image' => $item['cover_image'],
                    'gallery' => $item['gallery'],
                    'registration_link' => $item['registration_link'],
                    'status' => $item['status'],
                ]
            );
        }
    }
}
