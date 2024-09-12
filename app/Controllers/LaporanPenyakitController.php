<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanPenyakitController extends BaseController
{
    public function index()
    {
        $result_data = new Kunjungan();
        $query = $result_data
                ->join('pemeriksaan_assesment', 'kunjungan.id = pemeriksaan_assesment.kunjungan_id')
                ->select('pemeriksaan_assesment.diagnosa_sepluh_kode AS kode_penyakit, pemeriksaan_assesment.diagnosa_sepluh AS nama_penyakit, COUNT(pemeriksaan_assesment.diagnosa_sepluh_kode) AS jumlah')
                ->where('kunjungan.status_pemeriksaan', 'SELESAI')
                ->groupBy('pemeriksaan_assesment.diagnosa_sepluh_kode, pemeriksaan_assesment.diagnosa_sepluh') // Group by diagnosis code and name
                ->orderBy('jumlah', 'DESC') // Optional: Order by the count
                ->findAll();
        $param['data'] = $query;
        $param['title'] = 'Tabel 10 Besar Penyakit';
        return view('rekam-medis/penyakit', $param);
    }
}
