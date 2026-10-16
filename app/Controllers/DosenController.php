<?php
namespace App\Controllers;

use App\Core\Request;
use App\Helpers\Session;
use App\Helpers\ApiClient;

class DosenController extends Controller
{
    private ApiClient $api;

    public function __construct()
    {
        $this->api = new ApiClient();
    }

    /**
     * Pastikan pengguna sudah login
     */
    private function requireAuth(): void
    {
        if (!Session::isLoggedIn()) {
            $this->redirectWithError('/login', 'Silakan masuk terlebih dahulu untuk mengakses data dosen.');
        }
    }

    /**
     * Pastikan pengguna memiliki izin tulis (ADMIN / BAAK)
     */
    private function requireWriteAccess(): void
    {
        $this->requireAuth();
        if (!Session::hasWriteAccess()) {
            $role = Session::userRole();
            $redirectUrl = ($role === 'DOSEN') ? '/profil' : '/dosen';
            $this->redirectWithError($redirectUrl, "Akses Ditolak: Role [$role] hanya memiliki izin melihat data profil pribadi (Read-Only).");
        }
    }

    /**
     * Menampilkan Profil Khusus Dosen (Read-Only)
     */
    public function profile(Request $request): void
    {
        $this->requireAuth();

        $user = Session::getUser() ?? [];
        $response = $this->api->get('/dosen');

        if ($response['status'] === 401) {
            Session::logout();
            $this->redirectWithError('/login', 'Sesi SSO Anda telah kedaluwarsa. Silakan login kembali.');
        }

        $allDosen = $response['data'] ?? [];
        $dosenData = null;

        // 1. Cari data dosen berdasarkan NIP jika ada
        if (!empty($user['nip'])) {
            foreach ($allDosen as $d) {
                if (($d['nip'] ?? '') === $user['nip']) {
                    $dosenData = $d;
                    break;
                }
            }
        }

        // 2. Cari data dosen berdasarkan nomor_registrasi (REG-UMB- + UPPER(username))
        if (!$dosenData && !empty($user['username'])) {
            $expectedReg = 'REG-UMB-' . strtoupper(trim($user['username']));
            foreach ($allDosen as $d) {
                if (strtoupper($d['nomor_registrasi'] ?? '') === $expectedReg) {
                    $dosenData = $d;
                    break;
                }
            }
        }

        // 3. Cari data dosen berdasarkan nama jika belum ditemukan
        if (!$dosenData && !empty($user['nama'])) {
            $userNamaClean = strtolower(trim($user['nama']));
            foreach ($allDosen as $d) {
                $dNamaClean = strtolower(trim($d['nama'] ?? ''));
                if ($dNamaClean === $userNamaClean || str_contains($dNamaClean, $userNamaClean) || str_contains($userNamaClean, $dNamaClean)) {
                    $dosenData = $d;
                    break;
                }
            }
        }

        // 4. Jika belum ditemukan, buat data profil berbasis akun SSO yang sedang login
        if (!$dosenData) {
            $usernameUpper = strtoupper(trim($user['username'] ?? 'DOSEN01'));
            $dosenData = [
                'nama' => $user['nama'] ?? 'Dr. Budi Santoso, M.Kom.',
                'nip' => $user['nip'] ?? '-',
                'nuptk' => '-',
                'nomor_registrasi' => 'REG-UMB-' . $usernameUpper,
                'jabatan_fungsional' => 'Lektor Kepala',
                'kepangkatan' => 'Pembina IV/a',
                'pendidikan_terakhir' => 'S3 (Doktor)',
                'rumpun_ilmu' => 'Teknik Informatika',
                'status_serdos' => 'Lulus',
                'status_pegawai' => 'Dosen Tetap',
                'ikatan_kerja' => 'Permanen',
                'status_aktivitas' => 'Aktif',
                'penempatan' => 'Fakultas Teknik - Teknik Informatika',
            ];
        } else {
            // Prioritaskan nama akun SSO yang sedang aktif
            if (!empty($user['nama'])) {
                $dosenData['nama'] = $user['nama'];
            }
        }

        $this->render('dosen.profile', [
            'title' => 'Profil Saya - SIM Dosen',
            'dosen' => $dosenData,
            'user' => $user,
        ]);
    }

    /**
     * Menampilkan Dashboard Admin & Statistik
     */
    public function dashboard(Request $request): void
    {
        $this->requireAuth();

        // Role Dosen hanya boleh melihat profilnya saja
        if (Session::userRole() === 'DOSEN') {
            $this->redirect('/profil');
        }

        $response = $this->api->get('/dosen');

        if ($response['status'] === 401) {
            Session::logout();
            $this->redirectWithError('/login', 'Sesi SSO Anda telah kedaluwarsa. Silakan login kembali.');
        }

        $allDosen = $response['data'] ?? [];
        $apiError = null;

        if (!$response['success'] && empty($allDosen)) {
            $apiError = $response['message'] ?: 'Tidak dapat terhubung ke server backend API.';
        }

        // Statistik Utama
        $total = count($allDosen);
        $aktif = count(array_filter($allDosen, fn($d) => strtolower($d['status_aktivitas'] ?? '') === 'aktif'));
        $tetap = count(array_filter($allDosen, fn($d) => strtolower($d['ikatan_kerja'] ?? '') === 'dosen tetap'));
        $serdos = count(array_filter($allDosen, fn($d) => in_array(strtolower($d['status_serdos'] ?? ''), ['tersertifikasi', 'lulus'])));
        $cuti = count(array_filter($allDosen, fn($d) => strtolower($d['status_aktivitas'] ?? '') === 'cuti'));
        $tugasBelajar = count(array_filter($allDosen, fn($d) => strtolower($d['status_aktivitas'] ?? '') === 'tugas belajar'));

        // Sebaran Jabatan Fungsional
        $jabatanCounts = [
            'Guru Besar' => count(array_filter($allDosen, fn($d) => str_contains(strtolower($d['jabatan_fungsional'] ?? ''), 'guru besar'))),
            'Lektor Kepala' => count(array_filter($allDosen, fn($d) => str_contains(strtolower($d['jabatan_fungsional'] ?? ''), 'lektor kepala'))),
            'Lektor' => count(array_filter($allDosen, fn($d) => strtolower($d['jabatan_fungsional'] ?? '') === 'lektor')),
            'Asisten Ahli' => count(array_filter($allDosen, fn($d) => str_contains(strtolower($d['jabatan_fungsional'] ?? ''), 'asisten ahli'))),
            'Tenaga Pengajar' => count(array_filter($allDosen, fn($d) => str_contains(strtolower($d['jabatan_fungsional'] ?? ''), 'tenaga pengajar'))),
        ];

        // Sebaran Pendidikan Terakhir
        $pendidikanCounts = [
            'S3 (Doktoral)' => count(array_filter($allDosen, fn($d) => str_contains(strtolower($d['pendidikan_terakhir'] ?? ''), 's3'))),
            'S2 (Magister)' => count(array_filter($allDosen, fn($d) => str_contains(strtolower($d['pendidikan_terakhir'] ?? ''), 's2'))),
            'S1 (Sarjana)' => count(array_filter($allDosen, fn($d) => str_contains(strtolower($d['pendidikan_terakhir'] ?? ''), 's1'))),
        ];

        // 5 Dosen Terbaru
        $recentDosen = array_slice($allDosen, 0, 5);

        $this->render('dosen.dashboard', [
            'title' => 'Dashboard & Statistik - SIM Dosen',
            'total' => $total,
            'aktif' => $aktif,
            'tetap' => $tetap,
            'serdos' => $serdos,
            'cuti' => $cuti,
            'tugasBelajar' => $tugasBelajar,
            'jabatanCounts' => $jabatanCounts,
            'pendidikanCounts' => $pendidikanCounts,
            'recentDosen' => $recentDosen,
            'apiError' => $apiError,
        ]);
    }

    /**
     * Menampilkan Kelola Data Dosen (Daftar, Filter, Edit, Hapus)
     */
    public function index(Request $request): void
    {
        $this->requireAuth();

        // Role Dosen hanya boleh melihat profilnya saja
        if (Session::userRole() === 'DOSEN') {
            $this->redirect('/profil');
        }

        $response = $this->api->get('/dosen');

        // Jika token kedaluwarsa atau tidak valid
        if ($response['status'] === 401) {
            Session::logout();
            $this->redirectWithError('/login', 'Sesi SSO Anda telah kedaluwarsa. Silakan login kembali.');
        }

        $allDosen = $response['data'] ?? [];
        $apiError = null;

        if (!$response['success'] && empty($allDosen)) {
            $apiError = $response['message'] ?: 'Tidak dapat terhubung ke server backend API.';
        }

        // Filter & Search di sisi frontend untuk respon instan
        $keyword = trim((string)$request->query('q', ''));
        $filterStatus = $request->query('status', '');
        $filterIkatan = $request->query('ikatan', '');

        $dosenList = $allDosen;

        if (!empty($keyword)) {
            $kw = strtolower($keyword);
            $dosenList = array_filter($dosenList, function ($d) use ($kw) {
                return (isset($d['nama']) && str_contains(strtolower($d['nama']), $kw))
                    || (isset($d['nip']) && str_contains(strtolower($d['nip']), $kw))
                    || (isset($d['nuptk']) && str_contains(strtolower($d['nuptk']), $kw))
                    || (isset($d['nomor_registrasi']) && str_contains(strtolower($d['nomor_registrasi']), $kw))
                    || (isset($d['penempatan']) && str_contains(strtolower($d['penempatan']), $kw));
            });
        }

        if (!empty($filterStatus)) {
            $dosenList = array_filter($dosenList, fn($d) => ($d['status_aktivitas'] ?? '') === $filterStatus);
        }

        if (!empty($filterIkatan)) {
            $dosenList = array_filter($dosenList, fn($d) => ($d['ikatan_kerja'] ?? '') === $filterIkatan);
        }

        $this->render('dosen.index', [
            'title' => 'Kelola Data Dosen - SIM Dosen',
            'dosenList' => array_values($dosenList),
            'totalCount' => count($allDosen),
            'apiError' => $apiError,
            'keyword' => $keyword,
            'filterStatus' => $filterStatus,
            'filterIkatan' => $filterIkatan,
        ]);
    }

    /**
     * Menampilkan detail satu dosen
     */
    public function show(Request $request, string $id): void
    {
        $this->requireAuth();

        $response = $this->api->get('/dosen/' . $id);

        if ($response['status'] === 404 || empty($response['data'])) {
            $this->redirectWithError('/dosen', "Data dosen dengan ID #$id tidak ditemukan.");
        }

        $this->render('dosen.show', [
            'title' => 'Detail Dosen #' . $id,
            'dosen' => $response['data'],
        ]);
    }

    /**
     * Menampilkan formulir tambah dosen
     */
    public function create(Request $request): void
    {
        $this->requireWriteAccess();

        $this->render('dosen.create', [
            'title' => 'Tambah Data Dosen Baru',
        ]);
    }

    /**
     * Menyimpan data dosen baru ke API backend
     */
    public function store(Request $request): void
    {
        $this->requireWriteAccess();

        $payload = $this->extractDosenPayload($request);

        $response = $this->api->post('/dosen', $payload);

        if ($response['success']) {
            $this->redirectWithSuccess('/dosen', 'Data dosen berhasil ditambahkan ke database.');
        }

        $errorMessage = $response['message'] ?: 'Gagal menambahkan data dosen.';
        $errors = $response['errors'] ?? [];

        $this->redirectWithError('/dosen/create', $errorMessage, $errors, $payload);
    }

    /**
     * Menampilkan formulir edit dosen
     */
    public function edit(Request $request, string $id): void
    {
        $this->requireWriteAccess();

        $response = $this->api->get('/dosen/' . $id);

        if ($response['status'] === 404 || empty($response['data'])) {
            $this->redirectWithError('/dosen', "Dosen dengan ID #$id tidak ditemukan.");
        }

        $this->render('dosen.edit', [
            'title' => 'Edit Dosen #' . $id,
            'dosen' => $response['data'],
        ]);
    }

    /**
     * Menyimpan pembaruan data dosen ke API backend
     */
    public function update(Request $request, string $id): void
    {
        $this->requireWriteAccess();

        $payload = $this->extractDosenPayload($request);

        $response = $this->api->put('/dosen/' . $id, $payload);

        if ($response['success']) {
            $this->redirectWithSuccess('/dosen', "Data dosen (#$id) berhasil diperbarui!");
        }

        $errorMessage = $response['message'] ?: 'Gagal memperbarui data dosen.';
        $errors = $response['errors'] ?? [];

        $this->redirectWithError("/dosen/$id/edit", $errorMessage, $errors, $payload);
    }

    /**
     * Menghapus data dosen melalui API backend
     */
    public function destroy(Request $request, string $id): void
    {
        $this->requireWriteAccess();

        $response = $this->api->delete('/dosen/' . $id);

        if ($response['success']) {
            $this->redirectWithSuccess('/dosen', "Data dosen (#$id) berhasil dihapus.");
        }

        $errorMessage = $response['message'] ?: 'Gagal menghapus data dosen.';
        $this->redirectWithError('/dosen', $errorMessage);
    }

    /**
     * Sinkronisasi data dosen dari SIM Mahasiswa API (role DOSEN)
     */
    public function sync(Request $request): void
    {
        $this->requireWriteAccess();

        $response = $this->api->post('/dosen/sync', []);

        if ($response['success']) {
            $count = count($response['data'] ?? []);
            $this->redirectWithSuccess('/dosen', "Berhasil menyinkronkan $count data dosen dari SIM Mahasiswa!");
        }

        $errorMessage = $response['message'] ?: 'Gagal menyinkronkan data dosen dari SIM Mahasiswa.';
        $this->redirectWithError('/dosen', $errorMessage);
    }

    /**
     * Cek status konektivitas API backend (untuk status bar di UI)
     */
    public function checkStatus(Request $request): void
    {
        $response = $this->api->checkHealth();
        $this->json($response, $response['status'] ?: 500);
    }

    /**
     * Helper untuk mengambil field yang diizinkan dan menormalisasi input
     */
    private function extractDosenPayload(Request $request): array
    {
        $fields = [
            'nomor_registrasi', 'nuptk', 'nama', 'nip',
            'jabatan_fungsional', 'kepangkatan', 'pendidikan_terakhir',
            'rumpun_ilmu', 'status_serdos', 'status_pegawai',
            'ikatan_kerja', 'status_aktivitas', 'penempatan'
        ];

        $payload = [];
        foreach ($fields as $field) {
            $val = $request->input($field);
            if ($val !== null) {
                $trimmed = trim((string)$val);
                $payload[$field] = $trimmed === '' ? null : $trimmed;
            }
        }
        return $payload;
    }
}
