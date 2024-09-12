<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanDokter extends Model
{
    protected $table            = 'pemeriksaan_assesment';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kunjungan_id',	
        'user_id',	
        'signature_dokter',	
        'alasan_rujukan',	
        'rujukan_eksternal_detail',	
        'rujukan_eksternal',	
        'rujukan_internal_poli',	
        'rujukan_internal',	
        'kesadaran',	
        'status_pasien_keluar',	
        'dokter_pemeriksa',	
        'jenis_keperluan',	
        'tindakan_kasus',	
        'tindakan_kode',	
        'tindakan',	
        'diagnosa_kasus',	
        'diagnosa_sepluh_kode',	
        'diagnosa_sepluh',	
        'intervensi_keperawatan_lainnya',	
        'intervensi_keperawatan',	
        'assesment_keperawatan_lainnya',	
        'assesment_keperawatan',
        'jenis_penglihatan',
        'jenis_pendengaran',
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
