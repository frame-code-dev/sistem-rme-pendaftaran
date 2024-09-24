<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\PemeriksaanLab;
use App\Models\PemeriksaanLabDetail;
use App\Models\PemeriksaanLabForm;
use CodeIgniter\HTTP\ResponseInterface;

class PemeriksaanLabController extends BaseController
{
    protected $kunjunganModel;
    protected $validation;
    public function __construct() {
        $this->kunjunganModel = new Kunjungan();
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        if (in_groups('perawat')) {
            return redirect()->to('/pemeriksaan');
        }
        $param['title'] = 'ANTRIAN PEMERIKSAAN LABORATORIUM';
        $param['data'] = $this->kunjunganModel
                        ->join('pasien','pasien.id=kunjungan.id_pasien')
                        ->join('pemeriksaan_objective','pemeriksaan_objective.kunjungan_id=kunjungan.id')
                        ->join('users','users.id=pemeriksaan_objective.user_id')
                        ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, 
                                pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir, 
                                pasien.tanggal_lahir,
                                pasien.alamat_lengkap,
                                pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs,
                                pemeriksaan_objective.tindak_lanjut,pemeriksaan_objective.jenis_pemeriksaaan,
                                users.name')
                        ->where('poli','Poli Umum')
                        ->where('pemeriksaan_objective.tindak_lanjut','ya')
                        ->findAll();
        $param['data_selesai'] = $this->kunjunganModel
                        ->join('pasien','pasien.id=kunjungan.id_pasien')
                        ->join('pemeriksaan_lab','pemeriksaan_lab.id_kunjungan=kunjungan.id')
                        ->join('pemeriksaan_objective','pemeriksaan_objective.kunjungan_id=kunjungan.id')
                        ->join('users','users.id=pemeriksaan_objective.user_id')
                        ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, 
                                pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir, 
                                pasien.tanggal_lahir,
                                pasien.alamat_lengkap,
                                pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs,
                                pemeriksaan_objective.tindak_lanjut,pemeriksaan_objective.jenis_pemeriksaaan,
                                users.name,pemeriksaan_lab.status,pemeriksaan_lab.jenis_pemeriksaan')
                        ->where('poli','Poli Umum')
                        ->where('pemeriksaan_objective.tindak_lanjut','ya')
                        ->findAll();
        return view('pemeriksaan-lab/index',$param);
    }

    public function create($id) {
        $param['title'] = 'TAMBAH PEMERIKSAAN LABORATORIUM';
        $param['data'] = $this->kunjunganModel
                        ->join('pemeriksaan_objective','pemeriksaan_objective.kunjungan_id=kunjungan.id')
                        ->select('kunjungan.*, pemeriksaan_objective.tindak_lanjut,pemeriksaan_objective.jenis_pemeriksaaan')
                        ->where('kunjungan.id',$id)
                        ->first();
        $form_isian = new PemeriksaanLabForm();
       
        $param['form_isian'] = $form_isian->where('id_kunjungan',$id)->findAll();
        return view('pemeriksaan-lab/create',$param);
    }

    public function store() {
        try {
            $data = $this->request->getPost();

            $signature_dokter = $this->request->getPost('signature_dokter');
            $signature_dokter = str_replace('data:image/png;base64,', '', $signature_dokter);
            $signature_dokter = str_replace(' ', '+', $signature_dokter);
            $signature_dokterData = base64_decode($signature_dokter);
            // Menyimpan gambar dokter
            $filename = uniqid().'.png';
            $filePathdokter = FCPATH . 'signature/'.$filename; // Ganti 'uploads' dengan folder yang diinginkan
            if (file_put_contents($filePathdokter, $signature_dokterData) === false) {
                throw new \RuntimeException('Gagal menyimpan gambar penanggung.');
            }
            $modelPemeriksaanLab = new PemeriksaanLab();
            $modelPemeriksaanLab->insert([
                'id_kunjungan' => $data['id_kunjungan'],
                'jenis_pemeriksaan' => $data['jenis_pemeriksaan'],
                'status' => 'Selesai',
                'ttd_pemeriksa' => $filename,
                'created_at' => date('Y-m-d H:i:s'),
                'kunjungan_id' => user()->id,
            ]);
            if ($this->request->getPost('jenis_pemeriksaan') === 'Hematologi' || $this->request->getPost('jenis_pemeriksaan') === 'Klinik Kimia') {
                foreach ($data as $key => $value) {
                    // Skip the specific keys we don't want to process
                    if (!in_array($key, ['id_kunjungan', 'jenis_pemeriksaan', 'signature_dokter', 'honeypot'])) {
                            // If 'jenis_pemeriksaan' is 'Hematologi' or 'Klinik Kimia', store in 'nilai_normal'
                            $str_replace = ucwords(str_replace('_', ' ', $key));
                            $modelPemeriksaanDetail = new PemeriksaanLabDetail();
                            $modelPemeriksaanDetail->insert([
                                'kunjungan_id' => $data['id_kunjungan'],
                                'nama' => $str_replace,
                                'nilai_normal' => $value,
                                'hasil' => null,
                            ]);
                        
                    }
                }
            } else {
                foreach ($data as $key => $value) {
                    // Skip the specific keys we don't want to process
                    if (!in_array($key, ['id_kunjungan', 'jenis_pemeriksaan', 'signature_dokter', 'honeypot'])) {
                        // Check if the 'jenis_pemeriksaan' is 'Hematologi' or 'Klinik Kimia'
                    
                        // For other types of 'jenis_pemeriksaan', store in 'hasil'
                        $str_replace = ucwords(str_replace('_', ' ', $key));
                        $modelPemeriksaanDetail = new PemeriksaanLabDetail();
                        $modelPemeriksaanDetail->insert([
                            'kunjungan_id' => $data['id_kunjungan'],
                            'nama' => $str_replace,
                            'nilai_normal' => null,
                            'hasil' => $value,
                        ]);
                    }
                }
            }
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data Pemeriksaan Lab berhasil ditambahkan.');
            return redirect()->to('pemeriksaan-lab');
        } catch (\Throwable $th) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data Pemeriksaan Lab gagal ditambahkan, <br>' . $th->getMessage());
			return redirect()->back();
		} catch (\Exception $e) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data Pemeriksaan Lab gagal ditambahkan, <br>' . $e->getMessage());
			return redirect()->back();
		}
    }

    public function pdf($id) {
       $param['current_data'] = $this->kunjunganModel
                    ->join('pasien','pasien.id=kunjungan.id_pasien')
                    ->join('pemeriksaan_lab','pemeriksaan_lab.id_kunjungan=kunjungan.id')
                    ->join('pemeriksaan_objective','pemeriksaan_objective.kunjungan_id=kunjungan.id')
                    ->join('users as pemeriksa','pemeriksa.id=pemeriksaan_lab.kunjungan_id')
                    ->join('users as dokter_pemeriksa','dokter_pemeriksa.id=pemeriksaan_objective.user_id')
                    ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, 
                                pasien.nik, pasien.nama_lengkap, pasien.tempat_lahir, 
                                pasien.tanggal_lahir,
                                pasien.jenis_kelamin,
                                pasien.alamat_lengkap,
                                pemeriksa.name as nama_pemeriksa,
                                dokter_pemeriksa.name as nama_dokter_pemeriksa,
                                pemeriksaan_lab.status,pemeriksaan_lab.jenis_pemeriksaan')
                    ->find($id);
        $param['detail_pemeriksaan'] = $this->kunjunganModel
                            ->join('pemeriksaan_lab_detail','pemeriksaan_lab_detail.kunjungan_id=kunjungan.id')
                            ->join('pemeriksaan_lab','pemeriksaan_lab.id_kunjungan=kunjungan.id')
                            ->select('pemeriksaan_lab_detail.*,pemeriksaan_lab.status,pemeriksaan_lab.jenis_pemeriksaan')
                            ->where('kunjungan.id', $id)
                            ->findAll();
        // dd($param['detail_pemeriksaan']);
        return view('pemeriksaan-lab/pdf',$param);
    }
}
