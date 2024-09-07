<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GeneralConsent;
use App\Models\Pasien;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use Myth\Auth\Models\UserModel;

class GeneralConsentController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $validation;
    protected $userModel;
    protected $pasienModel;
    protected $generalModel;
    public $param;

    public function __construct() {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->pasienModel = new Pasien();
        $this->generalModel = new GeneralConsent();
      
    }
    public function index($id)
    {
        $param['title'] = 'Tambah General Consent';
        $param['pasien'] = $this->pasienModel->find($id);
        return view('general-consent/create', $param);
        
    }

    public function store($id) {
        $rules = [
            'nama_lengkap' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat_lengkap' => 'required',
            'no_hp' => 'required',
            'hubungan_pasien' => 'required',
            'jenis_perawatan' => 'required',
            'privasi_khusus' => 'required',
            'akses_keluarga' => 'required',
            'cara_bayar' => 'required',
            'signature_penanggung' => 'required',
            'signature_petugas' => 'required',
        ];
        if (! $this->validate($rules))
        {
            return redirect()->to('consent/create/'.$id)->withInput()->with('errors', $this->validator->getErrors());
        }
        try {
            $nama_lengkap = $this->request->getPost('nama_lengkap');
            $tempat_lahir = $this->request->getPost('tempat_lahir');
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $alamat_lengkap = $this->request->getPost('alamat_lengkap');
            $no_hp = $this->request->getPost('no_hp');
            $hubungan_pasien = $this->request->getPost('hubungan_pasien');
            $jenis_perawatan = $this->request->getPost('jenis_perawatan');
            $privasi_khusus = $this->request->getPost('privasi_khusus');
            $akses_keluarga = $this->request->getPost('akses_keluarga');
            $permintaan_privasi_khusus = $this->request->getPost('permintaan_privasi_khusus') ?? null;
            $cara_bayar = $this->request->getPost('cara_bayar');
            // ttd penanggung jawab 
            $signature_penanggung = $this->request->getPost('signature_penanggung');
            $signature_penanggung = str_replace('data:image/png;base64,', '', $signature_penanggung);
            $signature_penanggung = str_replace(' ', '+', $signature_penanggung);
            $signature_penanggungData = base64_decode($signature_penanggung);
            // Menyimpan gambar penanggung
            $filePathPenanggung = FCPATH  . 'signature/'.uniqid().'.png'; // Ganti 'uploads' dengan folder yang diinginkan
            if (file_put_contents($filePathPenanggung, $signature_penanggungData) === false) {
                throw new \RuntimeException('Gagal menyimpan gambar penanggung.');
            }
            // ttd petugas 
            $signature_petugas = $this->request->getPost('signature_petugas');
            $signature_petugas = str_replace('data:image/png;base64,', '', $signature_petugas);
            $signature_petugas = str_replace(' ', '+', $signature_petugas);
            $signature_petugasData = base64_decode($signature_petugas);
            $filePathPetugas = FCPATH  . 'signature/'.uniqid().'.png'; // Ganti 'uploads' dengan folder yang diinginkan
            if (file_put_contents($filePathPetugas, $signature_petugasData) === false) {
                throw new \RuntimeException('Gagal menyimpan gambar penanggung.');
            }
            $tanggal_lahir = date('Y-m-d', strtotime($tgl_lahir));
            $data = [
                'pasien_id' => $id,	
                'nama_lengkap' => $nama_lengkap,	
                'tempat_lahir' => $tempat_lahir,	
                'tanggal_lahir' => $tanggal_lahir,	
                'alamat_lengkap' => $alamat_lengkap,	
                'no_hp' => $no_hp,	
                'status_hubungan_pasien' => $hubungan_pasien,	
                'privasi_khusus' => $privasi_khusus,	
                'permintaan_privasi_khusus' => $permintaan_privasi_khusus,	
                'akses_keluarga' => $akses_keluarga,	
                'cara_bayar' => $cara_bayar,	
                'jenis_perawatan' => $jenis_perawatan,
                'signature_penanggung' => $filePathPenanggung,	
                'signature_petugas' => $filePathPetugas,	
                'created_at' =>  date("Y-m-d H:i:s"),	
            ];
            $id_general = $this->generalModel->insert($data);
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data general consent berhasil ditambahkan.');
            return redirect()->to('kunjungan/create/'.$id_general);
        } catch (Exception $th) {
            dd($th);
            session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data general consent gagal ditambahkan, <br>' . $th->getMessage());
            return redirect()->to('consent/create/'.$id);
        }
    }

    public function pdf() {
        // Get the GET parameters
        $param['request'] = $this->request->getGet();
        $param['pasien'] = $this->pasienModel->find($param['request']['id']);
        // Your logic here...
        return view('general-consent/pdf', $param);
    }
}
