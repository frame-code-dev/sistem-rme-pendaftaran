<?php

use App\Models\Kunjungan;
use App\Models\Pasien;
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
?>