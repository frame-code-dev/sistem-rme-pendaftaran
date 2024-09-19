<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use App\Models\Pasien;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
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
       $result_pasien = new Pasien();

        // Menghitung jumlah pasien lama (lebih dari 30 hari dari sekarang)
        $param['pasien_lama'] = $result_pasien
            ->where('created_at <', date('Y-m-d', strtotime('-30 days')))
            ->countAllResults();

        // Menghitung jumlah pasien baru (didaftarkan hari ini)
        $param['pasien_baru'] = $result_pasien
            ->where('created_at >=', date('Y-m-d 00:00:00'))
            ->where('created_at <=', date('Y-m-d 23:59:59'))
            ->countAllResults();

        // Menghitung total semua pasien
        $param['pasien_semua'] = $result_pasien->countAllResults();
        $query_dashboard = $result_data
                ->select('MONTH(kunjungan.tanggal_kunjungan) AS bulan, kunjungan.status_kunjungan, COUNT(*) AS jumlah')
                ->where('kunjungan.status_pemeriksaan', 'SELESAI')
                ->groupBy('bulan, kunjungan.status_kunjungan')
                ->findAll();
                // Format data untuk chart
        $data_baru = [];
        $data_lama = [];
        $categories = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        foreach ($categories as $index => $bulan) {
            $data_baru[$index] = 0;
            $data_lama[$index] = 0;

            foreach ($query_dashboard as $row) {
                if ($row['bulan'] == ($index + 1)) {
                    if ($row['status_kunjungan'] == 'BARU') {
                        $data_baru[$index] = $row['jumlah'];
                    } else if ($row['status_kunjungan'] == 'LAMA') {
                        $data_lama[$index] = $row['jumlah'];
                    }
                }
            }
        }

        $param['data_baru'] = $data_baru;
        $param['data_lama'] = $data_lama;
        $param['categories'] = $categories;
        $param['data'] = $query;
        return view('dashboard',$param);
    }
}
