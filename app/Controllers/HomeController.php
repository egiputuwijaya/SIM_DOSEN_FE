<?php
namespace App\Controllers;

use App\Core\Request;
use App\Helpers\Session;

class HomeController extends Controller
{
    /**
     * Tampilkan Halaman Utama (Landing Page) SIM DOSEN
     */
    public function index(Request $request): void
    {
        $stats = [
            [
                'number' => '350+',
                'label' => 'Dosen Tetap & Bersertifikasi',
                'desc' => 'Tenaga pendidik profesional berintegritas tinggi',
                'icon' => 'academic-cap'
            ],
            [
                'number' => '9',
                'label' => 'Fakultas & Pascasarjana',
                'desc' => 'Menaungi berbagai bidang ilmu sains dan humaniora',
                'icon' => 'building'
            ],
            [
                'number' => '28',
                'label' => 'Program Studi',
                'desc' => 'Terakreditasi Baik Sekali & Unggul oleh BAN-PT/LAM',
                'icon' => 'award'
            ],
            [
                'number' => '12.000+',
                'label' => 'Mahasiswa Terbimbing',
                'desc' => 'Generasi muda yang didampingi dalam tridharma',
                'icon' => 'users'
            ],
            [
                'number' => '1.500+',
                'label' => 'Publikasi & Riset',
                'desc' => 'Karya ilmiah terindeks SINTA, Scopus, dan WOS',
                'icon' => 'database'
            ]
        ];

        $services = [
            [
                'icon' => 'academic-cap',
                'title' => 'Administrasi Perkuliahan & RPS',
                'desc' => 'Kelola jadwal mengajar, rencana pembelajaran semester (RPS), absensi kelas mingguan, dan rekapitulasi nilai mahasiswa secara transparan.',
                'tag' => 'Pendidikan'
            ],
            [
                'icon' => 'users',
                'title' => 'Bimbingan Akademik & Skripsi',
                'desc' => 'Verifikasi Kartu Rencana Studi (KRS) mahasiswa bimbingan, konsultasi daring berkala, serta pemantauan tugas akhir dan sidang komprehensif.',
                'tag' => 'Bimbingan'
            ],
            [
                'icon' => 'award',
                'title' => 'Penelitian & Inovasi (LPPM)',
                'desc' => 'Pencatatan rekam jejak riset dosen, pengajuan hibah penelitian internal dan nasional (Kemdiktisaintek), hingga sertifikasi Hak Kekayaan Intelektual (HAKI).',
                'tag' => 'Riset'
            ],
            [
                'icon' => 'building',
                'title' => 'Pengabdian Masyarakat (PkM)',
                'desc' => 'Dokumentasi kegiatan penerapan ipteks bagi masyarakat, pendampingan desa binaan persyarikatan Muhammadiyah, dan kemitraan industri.',
                'tag' => 'Pengabdian'
            ],
            [
                'icon' => 'badge-check',
                'title' => 'Beban Kinerja Dosen (BKD)',
                'desc' => 'Pelaporan pemenuhan rubrik BKD semesteran sesuai standar LLDIKTI wilayah II untuk kelayakan tunjangan profesi dan kehormatan.',
                'tag' => 'Kinerja'
            ],
            [
                'icon' => 'shield',
                'title' => 'Layanan Mandiri & Kepegawaian',
                'desc' => 'Akses mandiri profil dosen, riwayat kepangkatan akademik (Asisten Ahli hingga Guru Besar), data sertifikasi, dan SK mengajar resmi.',
                'tag' => 'Layanan Mandiri'
            ]
        ];

        $steps = [
            [
                'step' => '01',
                'title' => 'Autentikasi Akun Resmi',
                'desc' => 'Masuk menggunakan NIP atau Username akun dosen yang telah terdaftar resmi di Pangkalan Data UMB.'
            ],
            [
                'step' => '02',
                'title' => 'Pilih Menu Layanan Tridharma',
                'desc' => 'Akses modul perkuliahan, bimbingan mahasiswa, penginputan nilai, atau pelaporan riset dan BKD.'
            ],
            [
                'step' => '03',
                'title' => 'Kelola Data & Unduh Laporan',
                'desc' => 'Perbarui rekam jejak akademik, cetak rekapitulasi kinerja, dan pantau status validasi secara real-time.'
            ]
        ];

        $faqs = [
            [
                'q' => 'Bagaimana cara dosen mendapatkan akun SIM Dosen UMB?',
                'a' => 'Akun dosen diterbitkan secara resmi oleh Biro Administrasi Akademik & Kepegawaian (BAAK) atau BIPD UMB. Gunakan NIP atau username resmi yang telah diberikan oleh fakultas.'
            ],
            [
                'q' => 'Apakah SIM Dosen terintegrasi dengan SIM Mahasiswa UMB?',
                'a' => 'Ya, sistem ini terhubung secara langsung dengan pangkalan data akademik mahasiswa, sehingga daftar bimbingan, jadwal kuliah, dan pengisian nilai saling tersinkronisasi.'
            ],
            [
                'q' => 'Apa yang harus dilakukan jika lupa kata sandi akun?',
                'a' => 'Silakan hubungi helpdesk Biro Teknologi Informasi (BIPD) melalui email support@umb.ac.id atau datang ke Gedung Rektorat Lt. 2 dengan membawa identitas kepegawaian.'
            ],
            [
                'q' => 'Apakah portal ini dapat diakses melalui ponsel pintar (smartphone)?',
                'a' => 'Tentu saja. SIM Dosen dirancang dengan antarmuka responsif modern sehingga dapat diakses dengan nyaman melalui desktop, tablet, maupun smartphone kapan pun dan di mana pun.'
            ]
        ];

        $developers = [
            [
                'name' => 'Egi Putu Wijaya',
                'role' => 'System Architect & Fullstack Developer',
                'desc' => 'Bertanggung jawab atas arsitektur sistem, basis data, dan antarmuka pengguna secara keseluruhan.',
                'github' => 'https://github.com/egiputuawijaya'
            ],
            [
                'name' => 'Khairul Pratama',
                'role' => 'Backend & Security Specialist',
                'desc' => 'Fokus pada perancangan basis data, integrasi sistem, dan manajemen keamanan backend.',
                'github' => 'https://github.com/Pratama12340'
            ],
            [
                'name' => 'Rahman Badio',
                'role' => 'Frontend & UI/UX Developer',
                'desc' => 'Membangun komponen antarmuka yang responsif, modern, dan memberikan pengalaman pengguna yang optimal.',
                'github' => 'https://github.com/erxanz'
            ]
        ];

        $developerPhotos = [
            'person/1.jpeg',
            'person/2.jpeg',
            'person/3.jpeg'
        ];

        $user = Session::getUser() ?? [];
        $userName = $user['nama'] ?? ($user['username'] ?? 'Dosen UMB');

        $this->render('home.index', [
            'title' => 'SIM DOSEN - Universitas Muhammadiyah Bengkulu',
            'stats' => $stats,
            'services' => $services,
            'steps' => $steps,
            'faqs' => $faqs,
            'developers' => $developers,
            'developerPhotos' => $developerPhotos,
            'isLoggedIn' => Session::isLoggedIn(),
            'userRole' => Session::userRole(),
            'userName' => $userName
        ], 'layouts.landing');
    }
}
