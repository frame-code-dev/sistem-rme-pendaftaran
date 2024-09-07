<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Diagnosa;
use App\Models\LogActivity;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;

class DiagnosaController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $validation;
    protected $userModel;
    protected $diagnosaModel;
    public $param;

    public function __construct() {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->diagnosaModel = new Diagnosa();
    }
    public function index()
    {
        $this->param['title'] = 'Data Diagnosa';
        $this->param['data'] = $this->diagnosaModel->findAll();
        return view('diagnosa/index', $this->param);
    }
    
    public function create() {
        $this->param['title'] = 'Tambah Diagnosa';
        return view('diagnosa/create', $this->param);
    }

    public function store() {
        $rules = [
            'kode' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[diagnosa.diagnosa_kode]',
            'nama_diagnosa' => 'required',
        ];

        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $kode = $this->request->getPost("kode");
            $nama_diagnosa = $this->request->getPost("nama_diagnosa");
            $data = [
                'diagnosa_kode' => $kode,
                'diagnosa_nama' => $nama_diagnosa,
            ];

            $this->diagnosaModel->insert($data);
            $data = [
                'user_id' => user()->id,
                'action' => 'Menambahkan data diagnosa',
                'ip_address' => $this->request->getUserAgent(),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $log = new LogActivity();
            $log->insertLog($data);
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data diagnosa berhasil ditambahkan.');
            return redirect()->to('master-data/diagnosa');
        } catch (\Throwable $th) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal ditambahkan, <br>' . $th->getMessage());
			return redirect()->back();
		} catch (\Exception $e) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal ditambahkan, <br>' . $e->getMessage());
			return redirect()->back();
		}
    }

    public function show($id) {
        $param['title'] = 'Detail Diagnosa';
        $param['data'] = $this->diagnosaModel->find($id);
        return view('diagnosa/show',$param);
    }

    public function edit($id) {
        $param['title'] = 'Edit Diagnosa';
        $param['data'] = $this->diagnosaModel->find($id);
        return view('diagnosa/edit',$param);
    }

    public function update($id) {
        $rules = [
            'kode' => 'required',
            'nama_diagnosa' => 'required',
        ];

        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $kode = $this->request->getPost("kode");
            $nama_diagnosa = $this->request->getPost("nama_diagnosa");
            $data = [
                'diagnosa_kode' => $kode,
                'diagnosa_nama' => $nama_diagnosa,
            ];

            $this->diagnosaModel->update($id,$data);
            $data = [
                'user_id' => user()->id,
                'action' => 'Mengganti data diagnosa',
                'ip_address' => $this->request->getUserAgent(),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $log = new LogActivity();
            $log->insertLog($data);
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data diagnosa berhasil mengganti.');
            return redirect()->to('master-data/diagnosa');
        } catch (\Throwable $th) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal mengganti, <br>' . $th->getMessage());
			return redirect()->back();
		} catch (\Exception $e) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal mengganti, <br>' . $e->getMessage());
			return redirect()->back();
		}
    }

    public function destroy($id) {
        $this->diagnosaModel->delete($id);
        $data = [
            'user_id' => user()->id,
            'action' => 'Menghapus data diagnosa',
            'ip_address' => $this->request->getUserAgent(),
            'created_at' => date("Y-m-d H:i:s"),
        ];
        $log = new LogActivity();
        $log->insertLog($data);
        session()->setFlashdata("status_success", true);
        session()->setFlashdata('message', 'Data diagnosa berhasil dihapus.');
        return redirect()->to('master-data/diagnosa');
    }


}
