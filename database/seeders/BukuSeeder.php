<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriMap = Kategori::pluck('id', 'kode_kategori')->toArray();

        // Jika kategori belum ada, jalankan KategoriSeeder terlebih dahulu
        if (empty($kategoriMap)) {
            $this->call(KategoriSeeder::class);
            $kategoriMap = Kategori::pluck('id', 'kode_kategori')->toArray();
        }

        $bukus = [
            [
                'isbn' => '978-602-6232-01-1',
                'judul' => 'Pemrograman Web Berbasis Laravel 11',
                'penulis' => 'Chandro Pardede, S.Kom., M.Sc.',
                'penerbit' => 'Del Press',
                'tahun_terbit' => 2024,
                'kode_kategori' => 'KAT-RPL',
                'stok' => 12,
                'sinopsis' => 'Buku panduan komprehensif implementasi pola arsitektur MVC, Eloquent ORM, dan pengujian web pada ekosistem modern Laravel.',
            ],
            [
                'isbn' => '978-602-6232-02-8',
                'judul' => 'Clean Code: Panduan Praktis Perangkat Lunak Berkualitas',
                'penulis' => 'Robert C. Martin',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2020,
                'kode_kategori' => 'KAT-RPL',
                'stok' => 8,
                'sinopsis' => 'Prinsip-prinsip penulisan kode bersih, refactoring, dan disiplin pengembangan perangkat lunak profesional.',
            ],
            [
                'isbn' => '978-602-6232-03-5',
                'judul' => 'Refactoring: Memperbaiki Desain Kode yang Sudah Ada',
                'penulis' => 'Martin Fowler',
                'penerbit' => 'Addison-Wesley',
                'tahun_terbit' => 2019,
                'kode_kategori' => 'KAT-RPL',
                'stok' => 5,
                'sinopsis' => 'Teknik merestrukturisasi arsitektur kode tanpa mengubah perilaku eksternal guna meningkatkan fleksibilitas sistem.',
            ],
            [
                'isbn' => '978-602-6232-04-2',
                'judul' => 'Arsitektur Enterprise & Analisis Sistem Informasi',
                'penulis' => 'Dr. Arnaldo Marulitua Sinaga',
                'penerbit' => 'Informatika Bandung',
                'tahun_terbit' => 2023,
                'kode_kategori' => 'KAT-SI',
                'stok' => 15,
                'sinopsis' => 'Metodologi perancangan arsitektur enterprise untuk transformasi digital institusi perguruan tinggi dan korporasi.',
            ],
            [
                'isbn' => '978-602-6232-05-9',
                'judul' => 'Desain Basis Data Relasional & Normalisasi Skema',
                'penulis' => 'C. J. Date',
                'penerbit' => 'O\'Reilly Media',
                'tahun_terbit' => 2021,
                'kode_kategori' => 'KAT-SI',
                'stok' => 10,
                'sinopsis' => 'Teori relasional mendalam, prinsip ACID, optimasi kueri SQL, dan pencegahan anomali data.',
            ],
            [
                'isbn' => '978-602-6232-06-6',
                'judul' => 'Manajemen Proyek Sistem Informasi dengan Kerangka Agile',
                'penulis' => 'Ken Schwaber & Jeff Sutherland',
                'penerbit' => 'Penerbit Andi',
                'tahun_terbit' => 2022,
                'kode_kategori' => 'KAT-SI',
                'stok' => 7,
                'sinopsis' => 'Penerapan framework Scrum, Kanban, dan pemantauan sprint pada deliverable proyek sistem informasi berskala besar.',
            ],
            [
                'isbn' => '978-602-6232-07-3',
                'judul' => 'Pembelajaran Mesin: Teori dan Implementasi Praktis',
                'penulis' => 'Ian Goodfellow & Yoshua Bengio',
                'penerbit' => 'MIT Press',
                'tahun_terbit' => 2022,
                'kode_kategori' => 'KAT-AI',
                'stok' => 9,
                'sinopsis' => 'Fondasi matematis deep learning, backpropagation, convolutional networks, dan generative model terkini.',
            ],
            [
                'isbn' => '978-602-6232-08-0',
                'judul' => 'Pemrosesan Bahasa Alami dan Pemodelan Bahasa Besar',
                'penulis' => 'Dan Jurafsky & James H. Martin',
                'penerbit' => 'Pearson',
                'tahun_terbit' => 2024,
                'kode_kategori' => 'KAT-AI',
                'stok' => 14,
                'sinopsis' => 'Eksplorasi representasi token, mekanisme atensi Transformer, fine-tuning LLM, dan evaluasi semantik bahasa manusia.',
            ],
            [
                'isbn' => '978-602-6232-09-7',
                'judul' => 'Pengantar Sains Data dan Visualisasi Informasi',
                'penulis' => 'Jake VanderPlas',
                'penerbit' => 'O\'Reilly Media',
                'tahun_terbit' => 2021,
                'kode_kategori' => 'KAT-AI',
                'stok' => 11,
                'sinopsis' => 'Pipelines manipulasi data komputasional menggunakan NumPy, Pandas, Scikit-Learn, dan visualisasi interaktif.',
            ],
            [
                'isbn' => '978-602-6232-10-3',
                'judul' => 'Keamanan Jaringan & Pertahanan Terhadap Serangan Siber',
                'penulis' => 'William Stallings',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2023,
                'kode_kategori' => 'KAT-SEC',
                'stok' => 6,
                'sinopsis' => 'Prinsip kriptografi kunci publik, enkripsi AES, integritas hash SHA, serta deteksi intrusi jaringan IDS/IPS.',
            ],
            [
                'isbn' => '978-602-6232-11-0',
                'judul' => 'Ethical Hacking dan Uji Penetrasi Web',
                'penulis' => 'Georgia Weidman',
                'penerbit' => 'No Starch Press',
                'tahun_terbit' => 2022,
                'kode_kategori' => 'KAT-SEC',
                'stok' => 10,
                'sinopsis' => 'Metodologi audit keamanan web berbasis standar OWASP Top 10, mitigasi SQL Injection, XSS, dan CSRF.',
            ],
            [
                'isbn' => '978-602-6232-12-7',
                'judul' => 'Protokol Jaringan Komputer TCP/IP dan Routing Tingkat Lanjut',
                'penulis' => 'Andrew S. Tanenbaum',
                'penerbit' => 'Pearson Education',
                'tahun_terbit' => 2020,
                'kode_kategori' => 'KAT-SEC',
                'stok' => 8,
                'sinopsis' => 'Arsitektur protokol layer internet, subnetting IPv4/IPv6, algoritma Dijkstra, BGP, serta analisis paket Wireshark.',
            ],
            [
                'isbn' => '978-602-6232-13-4',
                'judul' => 'Matematika Diskrit dan Aplikasinya dalam Ilmu Komputer',
                'penulis' => 'Kenneth H. Rosen',
                'penerbit' => 'McGraw-Hill Education',
                'tahun_terbit' => 2021,
                'kode_kategori' => 'KAT-MAT',
                'stok' => 13,
                'sinopsis' => 'Logika proposisional, teori himpunan, relasi ekuivalensi, kombinatorika, teori graf, dan pembuktian induktif.',
            ],
            [
                'isbn' => '978-602-6232-14-1',
                'judul' => 'Pengantar Desain & Analisis Algoritma Kompleksitas',
                'penulis' => 'Thomas H. Cormen (CLRS)',
                'penerbit' => 'MIT Press',
                'tahun_terbit' => 2022,
                'kode_kategori' => 'KAT-MAT',
                'stok' => 9,
                'sinopsis' => 'Analisis asimtotik Notasi Big-O, strategi divide and conquer, pemrograman dinamis, greedy, serta graf traversal.',
            ],
            [
                'isbn' => '978-602-6232-15-8',
                'judul' => 'Struktur Data Dasar: Senarai Berantai hingga Pohon Biner',
                'penulis' => 'Mark Allen Weiss',
                'penerbit' => 'Addison-Wesley',
                'tahun_terbit' => 2020,
                'kode_kategori' => 'KAT-MAT',
                'stok' => 12,
                'sinopsis' => 'Implementasi struktur data fundamental: stack, queue, binary search tree, heap, hash table, dan balanced AVL tree.',
            ],
            [
                'isbn' => '978-602-6232-16-5',
                'judul' => 'Nilai-Nilai Dasar Institut Teknologi Del: MarTuhan, Marroha, Marbisuk',
                'penulis' => 'Tim Pembina Karakter Del',
                'penerbit' => 'Del Press',
                'tahun_terbit' => 2023,
                'kode_kategori' => 'KAT-DEL',
                'stok' => 25,
                'sinopsis' => 'Internalisasi nilai luhur integritas, kepedulian sosial, dan kecerdasan berkarakter dalam kehidupan akademik kampus Del.',
            ],
            [
                'isbn' => '978-602-6232-17-2',
                'judul' => 'Etika Profesi Rekayasawan dan Tanggung Jawab Sosial Teknologi',
                'penulis' => 'Charles B. Fleddermann',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2021,
                'kode_kategori' => 'KAT-DEL',
                'stok' => 15,
                'sinopsis' => 'Kajian kode etik profesi insinyur, dilema moral dalam kecerdasan buatan, hak kekayaan intelektual, dan privasi data.',
            ],
            [
                'isbn' => '978-602-6232-18-9',
                'judul' => 'Kepemimpinan Efektif Mahasiswa dan Kerja Sama Antar Tim',
                'penulis' => 'John C. Maxwell',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2020,
                'kode_kategori' => 'KAT-DEL',
                'stok' => 18,
                'sinopsis' => 'Prinsip kepemimpinan melayani, resolusi konflik, komunikasi asertif, serta sinergi kerja sama dalam tim proyek.',
            ],
            [
                'isbn' => '978-602-6232-19-6',
                'judul' => 'Pengujian Perangkat Lunak Otomatis dengan PHPUnit & Pest',
                'penulis' => 'Nuno Maduro',
                'penerbit' => 'Laravel News Publishing',
                'tahun_terbit' => 2024,
                'kode_kategori' => 'KAT-RPL',
                'stok' => 10,
                'sinopsis' => 'Panduan pengujian unit, integration test, HTTP feature test, assertion, mock object, dan prinsip Test-Driven Development.',
            ],
            [
                'isbn' => '978-602-6232-20-2',
                'judul' => 'Desain Antarmuka Pengguna & User Experience Modern',
                'penulis' => 'Don Norman',
                'penerbit' => 'Basic Books',
                'tahun_terbit' => 2021,
                'kode_kategori' => 'KAT-RPL',
                'stok' => 7,
                'sinopsis' => 'Psikologi desain objek interaksi sehari-hari, affordance, feedback, heuristik kegunaan Nielsen, dan wireframing.',
            ],
            [
                'isbn' => '978-602-6232-21-9',
                'judul' => 'Cloud Computing: Prinsip Dasar AWS, Azure, dan GCP',
                'penulis' => 'Thomas Erl',
                'penerbit' => 'Prentice Hall',
                'tahun_terbit' => 2023,
                'kode_kategori' => 'KAT-SEC',
                'stok' => 9,
                'sinopsis' => 'Konsep IaaS, PaaS, SaaS, kontainerisasi Docker, orkestrasi Kubernetes, arsitektur serverless, dan keamanan cloud.',
            ],
            [
                'isbn' => '978-602-6232-22-6',
                'judul' => 'Manajemen Basis Data NoSQL: MongoDB dan Redis',
                'penulis' => 'Pramod J. Sadalage',
                'penerbit' => 'Addison-Wesley',
                'tahun_terbit' => 2022,
                'kode_kategori' => 'KAT-SI',
                'stok' => 6,
                'sinopsis' => 'Penyimpanan dokumen JSON, in-memory caching Redis, partisi sharding, dan teorema CAP pada distributed system.',
            ],
            [
                'isbn' => '978-602-6232-23-3',
                'judul' => 'Visi Komputer dan Pengenalan Citra Digital Terapan',
                'penulis' => 'Richard Szeliski',
                'penerbit' => 'Springer',
                'tahun_terbit' => 2022,
                'kode_kategori' => 'KAT-AI',
                'stok' => 8,
                'sinopsis' => 'Filtrasi spasial konvolusi, segmentasi objek, OpenCV, arsitektur YOLO untuk deteksi real-time objek digital.',
            ],
            [
                'isbn' => '978-602-6232-24-0',
                'judul' => 'Aljabar Linier Elementer untuk Ilmu Komputer',
                'penulis' => 'Howard Anton & Chris Rorres',
                'penerbit' => 'Erlangga',
                'tahun_terbit' => 2021,
                'kode_kategori' => 'KAT-MAT',
                'stok' => 14,
                'sinopsis' => 'Operasi matriks dan vektor, eliminasi Gauss-Jordan, ruang vektor, transformasi linier, nilai eigen dan vektor eigen.',
            ],
        ];

        foreach ($bukus as $buku) {
            $kategoriId = $kategoriMap[$buku['kode_kategori']] ?? null;

            if ($kategoriId) {
                Buku::firstOrCreate(
                    ['isbn' => $buku['isbn']],
                    [
                        'judul' => $buku['judul'],
                        'penulis' => $buku['penulis'],
                        'penerbit' => $buku['penerbit'],
                        'tahun_terbit' => $buku['tahun_terbit'],
                        'kategori_id' => $kategoriId,
                        'stok' => $buku['stok'],
                        'sinopsis' => $buku['sinopsis'],
                    ]
                );
            }
        }
    }
}
