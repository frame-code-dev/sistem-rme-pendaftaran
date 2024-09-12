<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use CodeIgniter\HTTP\ResponseInterface;

class KunjunganLaporanController extends BaseController
{
    public $param;
    public function __construct() {
        helper(['my_helper']);
    }
    public function index()
    {
        $result_data = new Kunjungan();
        $param['title'] = 'Laporan Kunjungan Pasien';
        $param['start'] = isset($_GET['start']) && $_GET['start'] != '' ? $_GET['start'] : '';
        $param['end'] = isset($_GET['end']) && $_GET['end'] != '' ? $_GET['end'] : '';
        $param['cara_bayar'] = isset($_GET['cara_bayar']) && $_GET['cara_bayar'] != '' ? $_GET['cara_bayar'] : '';
        
        $query = $result_data
            ->join('pasien', 'kunjungan.id_pasien = pasien.id')
            ->where('kunjungan.status_pemeriksaan', 'SELESAI');
            // Apply the filters conditionally
            if ($param['start'] != '') {
                $query->where('kunjungan.tanggal_kunjungan >=', date('Y-m-d', strtotime($param['start'])));
            }

            if ($param['end'] != '') {
                $query->where('kunjungan.tanggal_kunjungan <=',  date('Y-m-d', strtotime($param['end'])));
            }

            if ($param['cara_bayar'] != '') {
                $query->where('kunjungan.cara_bayar', $param['cara_bayar']);
            }

            // Execute the query and fetch results
            $param['data'] = $query->findAll();
        return view('rekam-medis/kunjungan',$param);
    }
    public function pdf()
    {
        $result_data = new Kunjungan();
        $param['title'] = 'Laporan Kunjungan Pasien';
        $param['start'] = isset($_GET['start']) && $_GET['start'] != '' ? $_GET['start'] : '';
        $param['end'] = isset($_GET['end']) && $_GET['end'] != '' ? $_GET['end'] : '';
        $param['cara_bayar'] = isset($_GET['cara_bayar']) && $_GET['cara_bayar'] != '' ? $_GET['cara_bayar'] : '';
        $query = $result_data
            ->join('pasien', 'kunjungan.id_pasien = pasien.id')
            ->join('general_consent', 'kunjungan.id_general_consent = general_consent.id')
            ->select('kunjungan.*,
            pasien.id as pasien_id_pasien, pasien.no_rm, pasien.nik, pasien.nama_lengkap,pasien.jenis_kelamin,
            pasien.jenis_pasien,pasien.tanggal_lahir,
            general_consent.id as id_general,general_consent.jenis_perawatan,general_consent.cara_bayar as cara_bayar_general')
            ->where('kunjungan.status_pemeriksaan', 'SELESAI');
            // Apply the filters conditionally
            if ($param['start'] != '') {
                $query->where('kunjungan.tanggal_kunjungan >=', date('Y-m-d', strtotime($param['start'])));
            }

            if ($param['end'] != '') {
                $query->where('kunjungan.tanggal_kunjungan <=',  date('Y-m-d', strtotime($param['end'])));
            }

            if ($param['cara_bayar'] != '') {
                $query->where('kunjungan.cara_bayar', $param['cara_bayar']);
            }

            // Execute the query and fetch results
            $param['data'] = $query->findAll();
        
        return view('rekam-medis/pdf/kunjungan',$param);
    }
}
