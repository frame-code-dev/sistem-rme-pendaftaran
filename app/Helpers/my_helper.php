<?php

use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\PemeriksaanDetailObat;
use App\Models\PemeriksaanLab;
use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\I18n\Time;

    function hitungUmur($tanggalLahir)
    {
        // Mengubah string tanggal lahir menjadi objek Time
        $tanggalLahirObj = Time::parse($tanggalLahir);

        // Mengambil waktu saat ini
        $sekarang = Time::now();

        // Menghitung selisih tahun
        $umur = $tanggalLahirObj->difference($sekarang)->getYears();

        return $umur;
    }
    function generateNoRM()
    {
        // Prefiks untuk No RM
        $prefix = 'KP';

        // Ambil nomor urut terakhir dari database
        $pasien = new Pasien();

        // Mengambil nomor urut terakhir yang menggunakan prefix 'kp'
        $pasien->selectMax('no_rm');
        $pasien->like('no_rm', $prefix, 'after');
        $lastNoRM = $pasien->get()->getRow()->no_rm;

        if ($lastNoRM) {
            // Jika ada nomor RM, ambil nomor urut terakhir dan tambahkan 1
            $lastNo = (int) substr($lastNoRM, strlen($prefix)); // Mengambil bagian nomor urut
            $newNo = $lastNo + 1;
        } else {
            // Jika tidak ada, nomor urut dimulai dari 1
            $newNo = 1;
        }

        // Membuat nomor RM baru dengan format kpXXX (XXX adalah nomor urut)
        $newNoRM = $prefix . sprintf('%03d', $newNo); // Menambahkan leading zeroes

        return $newNoRM;
    }

    function getNewQueueNumber($id_pasien, $id_general_consent)
    {
       $kunjunganModel = new Kunjungan();
        
        // Get the maximum no_antrian for the current date, patient, and consent ID
        $kunjunganModel->select('IFNULL(MAX(no_antrian), 0) + 1 AS new_no_antrian');
        $kunjunganModel->where('DATE(created_at)', date('Y-m-d'));
        $kunjunganModel->where('id_pasien', $id_pasien);
        $kunjunganModel->where('id_general_consent', $id_general_consent);
        
        $query = $kunjunganModel->get();
        return $query->getRow()->new_no_antrian;
    }

    function checkPemeriksaanSubject($id){
        $current_kunjungan = new Kunjungan();
        $data = $current_kunjungan->join('pemeriksaan_subjective','pemeriksaan_subjective.id_kunjungan=kunjungan.id')
        ->join('pasien','pasien.id=kunjungan.id_pasien')
        ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, 
            pasien.tempat_lahir,  pasien.pekerjaan, pasien.alamat_lengkap, pasien.tanggal_lahir,
            pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs, 
            pemeriksaan_subjective.id_kunjungan, pemeriksaan_subjective.id_user')
        ->where('kunjungan.status_pemeriksaan','PENDING')
        ->where('kunjungan.id',$id)
        // ->where('pemeriksaan_subjective.id_user',user()->id)
        ->countAllResults();
        return $data;
    }

    function checkPemeriksaanLab($id){
        $current_kunjungan = new Kunjungan();
        $data = $current_kunjungan
        ->join('pemeriksaan_objective','pemeriksaan_objective.kunjungan_id=kunjungan.id')
        ->join('pemeriksaan_subjective','pemeriksaan_subjective.id_kunjungan=kunjungan.id')
        ->join('pasien','pasien.id=kunjungan.id_pasien')
        ->select('kunjungan.*,pasien.id as pasien_id, pasien.no_rm, pasien.nik, pasien.nama_lengkap, 
            pasien.tempat_lahir,  pasien.pekerjaan, pasien.alamat_lengkap, pasien.tanggal_lahir,
            pasien.jenis_kelamin, pasien.jenis_pasien, pasien.no_bpjs, 
            pemeriksaan_subjective.id_kunjungan, pemeriksaan_subjective.id_user,
            pemeriksaan_objective.tindak_lanjut')
        ->where('kunjungan.id',$id)
        ->where('kunjungan.status_pemeriksaan','PENDING')
        ->first()['tindak_lanjut'];
        return $data;
    }
    function checkPemeriksaanLabData($id){
        $current_kunjungan_lab = new PemeriksaanLab();
        $data = $current_kunjungan_lab->where('id_kunjungan',$id)->countAllResults();
        return $data;
    }

    function checkInsertPemeriksaanLab() {
        
    }

    function data_obat($id) {
        $query_obat = new PemeriksaanDetailObat();
        $data = $query_obat->join('obat','obat.id=pemeriksaan_detail_obat.id_obat')
                        ->select('pemeriksaan_detail_obat.*,obat.nama')
                        ->where('pemeriksaan_detail_obat.id_kunjungan',$id)
                        ->findAll();
        return $data;
    }

    function getVillageById($id_kecamatan, $id_desa)
    {
        // URL to the JSON file
     
        $url = 'https://ibnux.github.io/data-indonesia/kelurahan/' . $id_kecamatan.'.json';

        // Create a new cURL instance
        $client = \Config\Services::curlrequest();

        try {
            // Fetch the data
            $response = $client->get($url);

            // Decode JSON data
            $villages = json_decode($response->getBody(), true);

            // Check if decoding was successful
            if (json_last_error() === JSON_ERROR_NONE) {
                // Search for the village with the given ID
                $village = array_filter($villages, function ($village) use ($id_desa) {
                    return $village['id'] == $id_desa;
                });

                // Check if the village was found
                if (!empty($village)) {
                    // Return the found village
                    return array_values($village)[0];
                } else {
                    // Return an error if no village was found with the given ID
                    return 'Village not found';
                }
            } else {
                return 'Failed to decode JSON';
            }
        } catch (HTTPException $e) {
            // Handle the exception (e.g., network issues)
            return 'Failed to retrieve data';
        }
    }
?>