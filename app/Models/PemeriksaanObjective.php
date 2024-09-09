<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanObjective extends Model
{
    protected $table            = 'pemeriksaan_objective';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kunjungan_id',
        'user_id',
        'ttd_name',
        'kondisi_umum',
        'kesadaran_e',
        'kesadaran_v',
        'kesadaran_m',
        'tingkat_kesadaran',
        'tekanan_darah',
        'respiratory_rate',
        'nadi',
        'spo2',
        'suhu',
        'berat_badan',
        'tinggi_badan',
        'imt',
        'lingkar_perut',
        'skala_nyeri',
        'tingkat_nyeri_anak',
        'jenis_nyeri_anak',
        'keterangan_nyeri_anak',
        'tingkat_nyeri_dewasa',
        'jenis_nyeri_dewasa',
        'keterangan_nyeri_dewasa',
        'lokasi_nyeri',
        'durasi',
        'rasa_nyeri',
        'hubungan_dengan_keluarga',
        'tindak_lanjut',
        'kebutuhan_spiritual',
        'bahasa',
        'respon_emosi',
        'status_mental',
        'lainnya',
        'ekstremitas',
        'abdomen',
        'thorax',
        'kepala',
        'condition',
        'appetite',
        'bb_penurunan_anak',
        'bb',
        'created_at',
        'updated_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
