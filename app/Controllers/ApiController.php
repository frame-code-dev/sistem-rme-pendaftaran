<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Diagnosa;
use App\Models\DiagnosaSembilan;
use App\Models\Obat;
use CodeIgniter\HTTP\ResponseInterface;

class ApiController extends BaseController
{
    public function sepuluh()
    {
            $diagnosaModel = new Diagnosa();
            $search = $this->request->getGet('search') ?? '';  // Get search term from AJAX request
            if ($search != '') {
                $diagnosa = $diagnosaModel->like('diagnosa_kode', $search)->findAll();  // Limit to 10 results
            }else{
                $diagnosa = $diagnosaModel->findAll();  // Limit to 10 results

            }
            $data = [];
            foreach ($diagnosa as $row) {
                $data[] = [
                    'id' => $row['diagnosa_kode'],
                    'text' => $row['diagnosa_nama'],
                ];
            }

            return $this->response->setJSON($data);

    }

    public function sembilanData()
    {
            $diagnosaModel = new DiagnosaSembilan();
            $search = $this->request->getGet('search') ?? '';  // Get search term from AJAX request
            if ($search != '') {
                $diagnosa = $diagnosaModel->like('diagnosa_kode', $search)->findAll();  // Limit to 10 results
            }else{
                $diagnosa = $diagnosaModel->findAll();  // Limit to 10 results

            }
            $data = [];
            foreach ($diagnosa as $row) {
                $data[] = [
                    'id' => $row['diagnosa_kode'],
                    'text' => $row['diagnosa_nama'],
                ];
            }

            return $this->response->setJSON($data);

    }

    public function obat() {
        $query_obat = new Obat();
        $obat = $query_obat->findAll();
		echo json_encode($obat);
    }
}
