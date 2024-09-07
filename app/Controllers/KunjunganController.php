<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GeneralConsent;
use App\Models\Kunjungan;
use App\Models\Pasien;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;

class KunjunganController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $validation;
    protected $userModel;
    protected $pasienModel;
    protected $generalModel;
    protected $kunjunganModel;
    public $param;

    public function __construct() {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->pasienModel = new Pasien();
        $this->generalModel = new GeneralConsent();
        $this->kunjunganModel = new Kunjungan(); 
    }
    public function create($id)
    {
        helper(['my_helper']);
        $param['title'] = 'Tambah Data Kunjungan';
        $param['general'] = $this->generalModel->find($id);
        $param['pasien'] = $this->pasienModel->find($param['general']['pasien_id']);
        $param['no_antrian'] = getNewQueueNumber($param['pasien']['id'], $param['general']['id']);
        return view('kunjungan/create', $param);
    }

    public function store($id) {
        $rules = [
            'tanggal_kunjungan' => 'required',
            'jenis_kunjungan' => 'required',
            'poli_tujuan' => 'required',
            'cara_bayar' => 'required',
        ];
        if (! $this->validate($rules))
        {
            return redirect()->to('kunjungan/create/'.$id)->withInput()->with('errors', $this->validator->getErrors());
        }
        
        try {
            $param['general'] = $this->generalModel->find($id);
            $param['pasien'] = $this->pasienModel->find($param['general']['pasien_id']);
            $id_pasien = $param['pasien']['id'];
            $id_general_consent = $param['general']['id'];
            $no_antrian = $this->request->getPost('no_antrian');
            $poli = $this->request->getPost('poli_tujuan');
            $status_kunjungan = $this->request->getPost('jenis_kunjungan');
            $cara_bayar = $this->request->getPost('cara_bayar');
            $tanggal_kunjungan = date('Y-m-d', strtotime($this->request->getPost('tanggal_kunjungan')));
            $data = [
                'id_pasien' => $id_pasien,
                'id_general_consent' => $id_general_consent,
                'no_antrian' => $no_antrian,
                'poli' => $poli,
                'status_kunjungan' => $status_kunjungan,
                'status_pemeriksaan' => 'PENDING',
                'tanggal_kunjungan' => $tanggal_kunjungan,
                'cara_bayar' => $cara_bayar,
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $this->kunjunganModel->insert($data);
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data kunjungan ditambahkan.');
            return redirect()->to('pemeriksaan');
        } catch (\Exception $e) {
            dd($e);
        } 
        dd($this->request->getPost());
    }
}
