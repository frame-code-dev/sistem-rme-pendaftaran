<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GeneralConsent;
use App\Models\Kunjungan;
use App\Models\Pasien;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;

class PendaftaranController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $validation;
    protected $userModel;
    protected $pasienModel;
    protected $generalConsent;
    protected $kunjunganModel;
    public $param;
    
    public function __construct() {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->pasienModel = new Pasien();
        $this->generalConsent = new GeneralConsent();
        $this->kunjunganModel = new Kunjungan();
      
    }
    public function index()
    {
        $param['title'] = 'List Pendaftaran Pasien';
        $param['data'] = $this->pasienModel->findAll();
        return view('pendaftaran/index',$param);
    }

    public function create() {
        helper(['my_helper']);
        $param['title'] = 'Tambah Pendaftaran Pasien';
        $param['no_rm'] = generateNoRm();
        return view('pendaftaran/create',$param);
    }

    public function store() {
        $rules = [
            'no_rm' => 'required',
            'no_nik' => 'required',
            'jenis_pasien' => 'required',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nama_kk' => 'required',
            'no_kk' => 'required',
            'agama' => 'required',
            'gol_darah' => 'required',
            'pendidikan' => 'required',
            'status_kawin' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_lengkap' => 'required',
            'provinsi' => 'required',
            'pekerjaan' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'kode_pos' => 'required',
            'ket_wilayah' => 'required',
        ];
        if (! $this->validate($rules))
        {
            return redirect()->to('pendaftaran')->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $no_rm = $this->request->getPost('no_rm');
            $no_bpjs = $this->request->getPost('no_bpjs');
            $no_nik = $this->request->getPost('no_nik');
            $jenis_pasien = $this->request->getPost('jenis_pasien');
            $nama_lengkap = $this->request->getPost('nama_lengkap');
            $tempat_lahir = $this->request->getPost('tempat_lahir');
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $jenis_kelamin = $this->request->getPost('jenis_kelamin');
            $nama_kk = $this->request->getPost('nama_kk');
            $no_kk = $this->request->getPost('no_kk');
            $agama = $this->request->getPost('agama');
            $pekerjaan = $this->request->getPost('pekerjaan');
            $gol_darah = $this->request->getPost('gol_darah');
            $pendidikan = $this->request->getPost('pendidikan');
            $status_kawin = $this->request->getPost('status_kawin');
            $nama_ayah = $this->request->getPost('nama_ayah');
            $nama_ibu = $this->request->getPost('nama_ibu');
            $alamat_lengkap = $this->request->getPost('alamat_lengkap');
            $provinsi = $this->request->getPost('provinsi');
            $kabupaten = $this->request->getPost('kabupaten');
            $kecamatan = $this->request->getPost('kecamatan');
            $desa = $this->request->getPost('desa');
            $kode_pos = $this->request->getPost('kode_pos');
            $ket_wilayah = $this->request->getPost('ket_wilayah');
            $tanggal_lahir = date("Y-m-d", strtotime($tgl_lahir));
            $data = [
                'nik' => $no_nik,
                'no_rm' => $no_rm,
                'no_bpjs' => $no_bpjs,
                'nama_lengkap' => $nama_lengkap,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'jenis_pasien' => $jenis_pasien,
                'nama_kk' => $nama_kk,
                'no_kk' => $no_kk,
                'alamat_lengkap' => $alamat_lengkap,
                'provinsi' => $provinsi,
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'desa' => $desa,
                'kode_pos' => $kode_pos,
                'keterangan_wilayah' => $ket_wilayah,
                'agama' => $agama,
                'gol_darah' => $gol_darah,
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'status_nikah' => $status_kawin,
                'nama_ayah' => $nama_ayah,
                'nama_ibu' => $nama_ibu,
            ];

            $id = $this->pasienModel->insert($data);
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data Pendaftaran berhasil ditambahkan.');
            return redirect()->to('consent/create/'.$id);
        } catch (\Exception $e) {
            dd($e);
        } 
    }

    public function show($id){
        $param['title'] = 'Detail Pendaftaran Pasien';
        $param['pasien'] = $this->pasienModel->find($id);
        return view('pendaftaran/show',$param);
    }
    public function edit($id){
        $param['title'] = 'Edit Pendaftaran Pasien';
        $param['pasien'] = $this->pasienModel->find($id);
        return view('pendaftaran/edit',$param);
    }

    public function update($id) {
        $rules = [
            'no_rm' => 'required',
            'no_nik' => 'required',
            'jenis_pasien' => 'required',
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nama_kk' => 'required',
            'no_kk' => 'required',
            'agama' => 'required',
            'gol_darah' => 'required',
            'pendidikan' => 'required',
            'status_kawin' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_lengkap' => 'required',
            'provinsi' => 'required',
            'pekerjaan' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'kode_pos' => 'required',
            'ket_wilayah' => 'required',
        ];
        if (! $this->validate($rules))
        {
            return redirect()->to('pendaftaran')->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $no_rm = $this->request->getPost('no_rm');
            $no_bpjs = $this->request->getPost('no_bpjs');
            $no_nik = $this->request->getPost('no_nik');
            $jenis_pasien = $this->request->getPost('jenis_pasien');
            $nama_lengkap = $this->request->getPost('nama_lengkap');
            $tempat_lahir = $this->request->getPost('tempat_lahir');
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $jenis_kelamin = $this->request->getPost('jenis_kelamin');
            $nama_kk = $this->request->getPost('nama_kk');
            $no_kk = $this->request->getPost('no_kk');
            $agama = $this->request->getPost('agama');
            $pekerjaan = $this->request->getPost('pekerjaan');
            $gol_darah = $this->request->getPost('gol_darah');
            $pendidikan = $this->request->getPost('pendidikan');
            $status_kawin = $this->request->getPost('status_kawin');
            $nama_ayah = $this->request->getPost('nama_ayah');
            $nama_ibu = $this->request->getPost('nama_ibu');
            $alamat_lengkap = $this->request->getPost('alamat_lengkap');
            $provinsi = $this->request->getPost('provinsi');
            $kabupaten = $this->request->getPost('kabupaten');
            $kecamatan = $this->request->getPost('kecamatan');
            $desa = $this->request->getPost('desa');
            $kode_pos = $this->request->getPost('kode_pos');
            $ket_wilayah = $this->request->getPost('ket_wilayah');
            $tanggal_lahir = date("Y-m-d", strtotime($tgl_lahir));
            $data = [
                'nik' => $no_nik,
                'no_rm' => $no_rm,
                'no_bpjs' => $no_bpjs,
                'nama_lengkap' => $nama_lengkap,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'jenis_pasien' => $jenis_pasien,
                'nama_kk' => $nama_kk,
                'no_kk' => $no_kk,
                'alamat_lengkap' => $alamat_lengkap,
                'provinsi' => $provinsi,
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'desa' => $desa,
                'kode_pos' => $kode_pos,
                'keterangan_wilayah' => $ket_wilayah,
                'agama' => $agama,
                'gol_darah' => $gol_darah,
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'status_nikah' => $status_kawin,
                'nama_ayah' => $nama_ayah,
                'nama_ibu' => $nama_ibu,
            ];

            $this->pasienModel->update($id,$data);

            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data Pendaftaran berhasil diganti.');
            return redirect()->to('pendaftaran');
        } catch (\Exception $e) {
            dd($e);
        } 
    }

    public function destroy($id) {
        $pasien = $this->pasienModel->find($id);
        $query_consent = $this->generalConsent->where('pasien_id', $pasien['id']);
        $consent_result = $query_consent->findAll();
        if (!empty($consent_result)) {
            foreach ($consent_result as $value) {
                $this->kunjunganModel->where('id_general_consent', $value['id'])->delete();
                $this->generalConsent->delete($value['id']);
            }
        }
        $this->pasienModel->delete($id);
        session()->setFlashdata("status_success", true);
        session()->setFlashdata('message', 'Data Pendaftaran berhasil dihapus.');
        return redirect()->to('pendaftaran');


    }
}
