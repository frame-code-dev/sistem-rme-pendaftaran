<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use App\Models\PemeriksaanDetailObat;
use CodeIgniter\HTTP\ResponseInterface;

class ApotekController extends BaseController
{
    protected $kunjunganModel;

    public function __construct() {
        helper(['my_helper']);
        $this->kunjunganModel = new Kunjungan();
    }
    public function index()
    {
        $param['title'] = 'DATA LIST APOTEK';
        $param['data'] = $this->kunjunganModel
                        ->join('pasien','pasien.id=kunjungan.id_pasien')
                        ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir, pasien.tanggal_lahir,
                            pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs')
                        ->where('poli','Poli Umum')
                        ->where('kunjungan.status_pemeriksaan','SELESAI')
                        ->findAll();
        return view('apotek/index',$param);
    }

    public function detail($id)  {
        $query_obat = new PemeriksaanDetailObat();
        $param['title'] = 'Detail Obat Apotek';
        $param['data'] = $query_obat->join('obat','obat.id=pemeriksaan_detail_obat.id_obat')
                                    ->select('pemeriksaan_detail_obat.*,obat.nama')
                                    ->where('id_kunjungan',$id)
                                    ->findAll();
        return view('apotek/detail',$param);
    }
}
