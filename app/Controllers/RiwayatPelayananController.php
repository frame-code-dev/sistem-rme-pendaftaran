<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use CodeIgniter\HTTP\ResponseInterface;

class RiwayatPelayananController extends BaseController
{
    public $param;
    public function index()
    {
        $result_data = new Kunjungan();
        $param['title'] = 'Riwayat Pelayanan';
        $param['data'] = $result_data
                    ->join('pasien', 'kunjungan.id_pasien = pasien.id')
                    ->join('pemeriksaan_assesment', 'kunjungan.id = pemeriksaan_assesment.kunjungan_id')
                    ->join('pemeriksaan_objective', 'kunjungan.id = pemeriksaan_objective.kunjungan_id')
                    ->join('pemeriksaan_subjective', 'kunjungan.id = pemeriksaan_subjective.id_kunjungan')
                    ->where('kunjungan.status_pemeriksaan','SELESAI')
                    ->findAll();
        return view('rekam-medis/riwayat',$param);
    }
}
