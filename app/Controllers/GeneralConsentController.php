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
        //  Periksa apakah pasien_id sudah ada di tabel general_consent
        $existingConsent = $this->generalModel->where('pasien_id', $id)->first();
        if ($existingConsent) {
            // Jika data sudah ada, insert data baru dengan informasi yang ada
            $data = [
                'pasien_id' => $existingConsent['pasien_id'],
                'nama_lengkap' => $existingConsent['nama_lengkap'],
                'tempat_lahir' => $existingConsent['tempat_lahir'],
                'tanggal_lahir' => $existingConsent['tanggal_lahir'],
                'alamat_lengkap' => $existingConsent['alamat_lengkap'],
                'no_hp' => $existingConsent['no_hp'],
                'status_hubungan_pasien' => $existingConsent['status_hubungan_pasien'],
                'privasi_khusus' => $existingConsent['privasi_khusus'],
                'permintaan_privasi_khusus' => $existingConsent['permintaan_privasi_khusus'],
                'akses_keluarga' => $existingConsent['akses_keluarga'],
                'cara_bayar' => $existingConsent['cara_bayar'],
                'jenis_perawatan' => $existingConsent['jenis_perawatan'],
                'signature_penanggung' => $existingConsent['signature_penanggung'],
                'signature_petugas' => $existingConsent['signature_petugas'],
                'created_at' => date("Y-m-d H:i:s"),
            ];
            // Insert data ke tabel general_consent
            $id_general = $this->generalModel->insert($data);
            return redirect()->to('kunjungan/create/'.$id_general);
        }
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
        if (!$this->validate($rules))
        {
            dd($this->validator->getErrors());
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
            $filename_penaggungData = uniqid().'.png';
            $filePathPenanggung = FCPATH  . 'signature/'.$filename_penaggungData; // Ganti 'uploads' dengan folder yang diinginkan
            if (file_put_contents($filePathPenanggung, $signature_penanggungData) === false) {
                throw new \RuntimeException('Gagal menyimpan gambar penanggung.');
            }
            // ttd petugas 
            $filename_petugasData = '';
            $signature_petugas = $this->request->getPost('signature_petugas');
            if (isset($signature_petugas)) {
             
                $signature_petugas = str_replace('data:image/png;base64,', '', $signature_petugas);
                $signature_petugas = str_replace(' ', '+', $signature_petugas);
                $signature_petugasData = base64_decode($signature_petugas);
                $filename_petugasData = uniqid().'.png';
                $filePathPetugas =  FCPATH . 'signature/'.$filename_petugasData; // Ganti 'uploads' dengan folder yang diinginkan
                if (file_put_contents($filePathPetugas, $signature_petugasData) === false) {
                    throw new \RuntimeException('Gagal menyimpan gambar penanggung.');
                }
            }
            $files = $this->request->getFiles();
            $newName = '';
            if (count($files) > 0) {
                $uploadPath = FCPATH . 'signature/';
                foreach ($files as $key => $value) {
                    if ($value->isValid() && !$value->hasMoved()) {
                        $newName = $value->getRandomName();
                        $value->move($uploadPath, $newName);
                    }
                }
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
                'signature_penanggung' => $filename_penaggungData,	
                'signature_petugas' => count($files) > 0 ? $newName : $filename_petugasData,	
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
        // Assuming $param['request']['signature_petugas'] contains the base64 string
        $signature_petugas = $param['request']['signature_petugas'];

        // Remove the base64 prefix and clean up the string
        $signature_petugas = str_replace('data:image/png;base64,', '', $signature_petugas);
        $signature_petugas = str_replace(' ', '+', $signature_petugas);

        // Decode the base64 image
        $signature_petugasData = base64_decode($signature_petugas);

        // Generate a unique file name and save the image
        $filename_petugasData = uniqid() . '.png';
        $filePath = WRITEPATH . 'uploads/' . $filename_petugasData; // Save in writable/uploads
        file_put_contents($filePath, $signature_petugasData);

        // Pass the file URL to the view
        $param['signature_petugas_url'] = base_url('writable/uploads/' . $filename_petugasData);
        // Your logic here...
        return view('general-consent/pdf', $param);
    }
}
