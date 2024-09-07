<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GeneralConsent;
use App\Models\Kunjungan;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;

class PemeriksaanController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $validation;
    protected $userModel;
    protected $kunjunganModel;
    protected $generalConsentModel;
    public $param;
    
    public function __construct() {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->kunjunganModel = new Kunjungan();
        $this->generalConsentModel = new GeneralConsent();
    }
    public function index()
    {
        $param['title'] = 'Antrian Pasien Poli Umum';
        $param['data'] = $this->kunjunganModel
                        ->join('pasien','pasien.id=kunjungan.id_pasien')
                        ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap,pasien.tanggal_lahir,
                        pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs')
                        ->where('poli','Poli Umum')
                        ->findAll();
        return view('pemeriksaan/index',$param);
    }

    public function create($id)
    {
        $param['title'] = 'Tambah Data Pemeriksaan';
        $param['pasien']  = $this->kunjunganModel
                            ->join('pasien','pasien.id=kunjungan.id_pasien')
                            ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap,pasien.tanggal_lahir,
                                pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs')
                            ->find($id);
        return view('pemeriksaan/create',$param);
    }
}
