<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanSubjective extends Model
{
    protected $table            = 'pemeriksaan_subjective';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kunjungan',
        'id_user',
        'jenis_keluhan',
        'type',	
        'complaint',
        'riwayat_text',
        'alergi',
        'alergi_lainnya',
        'smoking',	
        'diet',	
        'physical_activity',	
        'alcohol_consumption',	
        'stress',	
        'history',	
        'created_at',	
        'updated_at',	
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
