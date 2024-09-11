<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use CodeIgniter\HTTP\ResponseInterface;

class KunjunganLaporanController extends BaseController
{
    public $param;
    public function index()
    {
        $result_data = new Kunjungan();
        $param['title'] = 'Laporan Kunjungan Pasien';
        $param['data'] = $result_data
                    ->join('pasien', 'kunjungan.id_pasien = pasien.id')
                    ->where('kunjungan.status_pemeriksaan','SELESAI')
                    ->findAll();
        return view('rekam-medis/kunjungan',$param);
    }
}
