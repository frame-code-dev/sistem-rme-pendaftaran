<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GeneralConsent;
use App\Models\Kunjungan;
use App\Models\PemeriksaanObjective;
use App\Models\PemeriksaanSubjective;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Config\Auth;
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
        helper(['my_helper']);
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
                        ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir, pasien.tanggal_lahir,
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
                            ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir,  pasien.pekerjaan, pasien.alamat_lengkap, pasien.tanggal_lahir,
                                pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs')
                            ->find($id);
        return view('pemeriksaan/create',$param);
    }

    public function store(){
        $rules = [
            'jenis_keluhan' => 'required',
            'jenis_riwayat' => 'required',
            'merokok' => 'required',
            'stress' => 'required',
            'aktivitas_fisik' => 'required',
            'alkohol' => 'required',
            'kondisi_umum' => 'required',
            'tipe_kesadaran' => 'required',
            'tekanan_darah' => 'required',
            'nadi' => 'required',
            'suhu' => 'required',
            'respitory_rate' => 'required',
            'spo' => 'required',
            'berat_badan' => 'required',
            'tinggi_badan' => 'required',
            'hasil_bt' => 'required',
            'lingkar_perut' => 'required',
            'lokasi_nyeri' => 'required',
            'rasa_nyeri' => 'required',
            'kepala' => 'required',
            'thorax' => 'required',
            'abdomen' => 'required',
            'ekstremitas' => 'required',
            'lainnya' => 'required',
            'status_mental' => 'required',
            'respon_emosi' => 'required',
            'bahasa' => 'required',
            'kebutuhan_spiritual' => 'required',
            'hubungan_dengan_keluarga' => 'required',
            'tindak_lanjut' => 'required',
        ];
        if (!$this->validate($rules))
        {
            dd($this->validator->getErrors());
            return '';
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        try {
            $data = $this->request->getPost();
            $data_subjektif = [
                'id_kunjungan' => $data['id_kunjungan'],
                'id_user' => user()->id,
                'jenis_keluhan' => $data['jenis_keluhan'],
                'type' => strtolower($data['jenis_riwayat']),
                'complaint' => $data['keluhan_text'],
                'riwayat_text' => $data['riwayat_text'],
                'smoking' => $data['merokok'],
                'diet' => $data['kurang_makan'],
                'stress' => $data['stress'],
                'physical_activity' => $data['aktivitas_fisik'],
                'alcohol_consumption' => $data['alkohol'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]; 
            $subject = new PemeriksaanSubjective;
            $subject->insert($data_subjektif);

            $signature_penanggung = $this->request->getPost('signature_perawat');
            $signature_penanggung = str_replace('data:image/png;base64,', '', $signature_penanggung);
            $signature_penanggung = str_replace(' ', '+', $signature_penanggung);
            $signature_penanggungData = base64_decode($signature_penanggung);
            // Menyimpan gambar penanggung
            $filename = uniqid().'.png';
            $filePathPenanggung = FCPATH . 'signature/'.$filename; // Ganti 'uploads' dengan folder yang diinginkan
            if (file_put_contents($filePathPenanggung, $signature_penanggungData) === false) {
                throw new \RuntimeException('Gagal menyimpan gambar penanggung.');
            }
            $simpanObjective = new PemeriksaanObjective();

            $dataObjective = [
                'kunjungan_id' => $data['id_kunjungan'],
                'user_id' => user()->id,
                'ttd_name' => $filename,
                'kondisi_umum' => $data['kondisi_umum'],
                'kesadaran_e' => $data['tipe_kesadaran'],
                'tingkat_kesadaran' => $data['tingkat_kesadaran'],
                'tekanan_darah' => $data['tekanan_darah'],
                'respiratory_rate' => $data['respitory_rate'],
                'nadi' => $data['nadi'],
                'spo2' => $data['spo'],
                'suhu' => $data['suhu'],
                'berat_badan' => $data['berat_badan'],
                'tinggi_badan' => $data['tinggi_badan'],
                'imt' => $data['hasil_bt'],
                'lingkar_perut' => $data['lingkar_perut'],
                'skala_nyeri' => $data['skala_nyeri'] == 'Anak' ? 'Anak Usia > 3 Tahun' : 'Dewasa',
                'lokasi_nyeri' => $data['lokasi_nyeri'],
                'rasa_nyeri' => $data['rasa_nyeri'],
                'bb' => $data['bb'],
                'appetite' => $data['appetite'],
                'condition' => $data['condition'],
                'kepala' => $data['kepala'],
                'thorax' => $data['thorax'],
                'abdomen' => $data['abdomen'],
                'ekstremitas' => $data['ekstremitas'],
                'lainnya' => $data['lainnya'],
                'status_mental' => $data['status_mental'],
                'respon_emosi' => $data['respon_emosi'],
                'bahasa' => $data['bahasa'],
                'kebutuhan_spiritual' => $data['kebutuhan_spiritual'],
                'hubungan_dengan_keluarga' => $data['hubungan_dengan_keluarga'],
                'tindak_lanjut' => $data['tindak_lanjut'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Handling skala_nyeri conditionally
            if ($data['skala_nyeri'] == 'Anak' ) {
                $dataObjective['tingkat_nyeri_anak'] = $data['tingkat_nyeri_anak'];
                $dataObjective['jenis_nyeri_anak'] = $data['jenis_nyeri_anak'];
                $dataObjective['bb'] = $data['bb_anak'];
                $dataObjective['bb_penurunan_anak'] = $data['bb_penurunan_anak'];
            } else {
                $dataObjective['tingkat_nyeri_dewasa'] = $data['tingkat_nyeri_dewasa'];
                $dataObjective['jenis_nyeri_dewasa'] = $data['jenis_nyeri_dewasa'];
            }

            $simpanObjective->insert($dataObjective);
            if ($data['tindak_lanjut'] == 'ya') {
                session()->setFlashdata("status_success", true);
                session()->setFlashdata('message', 'Data Pemeriksaan berhasil ditambahkan.');
                return redirect()->to('pemeriksaan-lab');
            }else{
                session()->setFlashdata("status_success", true);
                session()->setFlashdata('message', 'Data Pemeriksaan berhasil ditambahkan.');
                return redirect()->to('pemeriksaan');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function createDokter($id){
        $param['title'] = 'Tambah Data Pemeriksaan';
        $param['pasien']  = $this->kunjunganModel
                            ->join('pasien','pasien.id=kunjungan.id_pasien')
                            ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir,  pasien.pekerjaan, pasien.alamat_lengkap, pasien.tanggal_lahir,
                                pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs')
                            ->find($id);
        $current_pemeriksaan_subject = new PemeriksaanSubjective();
        $current_pemeriksaan_object = new PemeriksaanObjective();
        $param['current_pemeriksaan_subject'] = $current_pemeriksaan_subject->where('id_kunjungan', $id)->first();  
        $param['current_pemeriksaan_object'] = $current_pemeriksaan_object->where('kunjungan_id', $id)->first(); 
        return view('pemeriksaan/dokter/create',$param);
    }
}
