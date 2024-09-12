<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use App\Models\PemeriksaanDokter;
use App\Models\PemeriksaanObjective;
use App\Models\PemeriksaanSubjective;
use CodeIgniter\HTTP\ResponseInterface;

class RiwayatPelayananController extends BaseController
{
    protected $kunjunganModel;
    public $param;
    public function __construct() {
        helper(['my_helper']);
        $this->kunjunganModel = new Kunjungan();
    }
    public function index()
    {
        $result_data = new Kunjungan();
        $param['title'] = 'Riwayat Pelayanan';
        $param['data'] = $result_data
                    ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, 
                    pasien.tempat_lahir,  pasien.pekerjaan, pasien.alamat_lengkap, pasien.tanggal_lahir,
                    pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs, 
                    pemeriksaan_subjective.id_kunjungan, pemeriksaan_subjective.id_user,
                    pemeriksaan_objective.tindak_lanjut')
                    ->join('pasien', 'kunjungan.id_pasien = pasien.id')
                    ->join('pemeriksaan_assesment', 'kunjungan.id = pemeriksaan_assesment.kunjungan_id')
                    ->join('pemeriksaan_objective', 'kunjungan.id = pemeriksaan_objective.kunjungan_id')
                    ->join('pemeriksaan_subjective', 'kunjungan.id = pemeriksaan_subjective.id_kunjungan')
                    ->where('kunjungan.status_pemeriksaan','SELESAI')
                    ->findAll();
        return view('rekam-medis/riwayat',$param);
    }

    public function detail($id) {
        $param['title'] = 'Detail Riwayat Pelayanan';
        $param['pasien']  = $this->kunjunganModel
                            ->join('pasien','pasien.id=kunjungan.id_pasien')
                            ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir,  pasien.pekerjaan, pasien.alamat_lengkap, pasien.tanggal_lahir,
                                pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs')
                            ->find($id);
        $current_pemeriksaan_subject = new PemeriksaanSubjective();
        $current_pemeriksaan_object = new PemeriksaanObjective();
        $current_pemeriksaan_dokter = new PemeriksaanDokter();
        $param['current_pemeriksaan_subject'] = $current_pemeriksaan_subject->where('id_kunjungan', $id)->first();  
        $param['current_pemeriksaan_object'] = $current_pemeriksaan_object->where('kunjungan_id', $id)->first(); 
        $param['current_dokter'] = $current_pemeriksaan_dokter->where('kunjungan_id', $id)->first(); 
        return view('rekam-medis/detail/riwayat',$param);
    }
}
