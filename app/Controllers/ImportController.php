<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Diagnosa;
use App\Models\DiagnosaSembilan;
use CodeIgniter\HTTP\ResponseInterface;

class ImportController extends BaseController
{
    public $param;
    public function importExcel()
    {
        $param['title'] = 'Import Excel';
        return view('import/index', $param);
    }

    public  function importExcelStore(){
        $data = $this->request->getPost('data'); 
        $result = json_decode($data, true);
        if ($this->request->getPost('kode_icd') == 'icd9') {
            foreach ($result as $row) {
                $diagnosaSembilan = new DiagnosaSembilan();
                $diagnosaSembilan->insert([
                    'diagnosa_kode' => $row['CODE'],
                    'diagnosa_nama' => $row['STR'],
                    'diagnosa_ket' => $row['SAB'],
                ]);
            };
        }else{
            foreach ($result as $row) {
                $diagnosaSepuluh = new Diagnosa();
                $diagnosaSepuluh->insert([
                    'diagnosa_kode' => $row['skri'],
                    'diagnosa_nama' => $row['STR'],
                ]);
            };
        }
        session()->setFlashdata("status_success", true);
		session()->setFlashdata('message', 'Data diagnosa berhasil ditambahkan.');
        return redirect()->back();
    }
}
