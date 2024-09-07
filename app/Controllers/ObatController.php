<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogActivity;
use App\Models\Obat;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;

class ObatController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $validation;
    protected $userModel;
    protected $obatModel;
    public $param;
    
    public function __construct() {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->obatModel = new Obat();
    }
    public function index()
    {
        $this->param['title'] = 'Data Obat';
        $this->param['data'] = $this->obatModel->findAll();
        return view('obat/index', $this->param);
    }

    public function create() {
        $this->param['title'] = 'Tambah Obat';
        return view('obat/create', $this->param);
    }

    public function store() {
        $rules = [
            'obat' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[obat.nama]',
            'satuan' => 'required',
        ];

        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $nama = $this->request->getPost("obat");
            $satuan = $this->request->getPost("satuan");
            $data = [
                'nama' => $nama,
                'satuan' => $satuan,
            ];

            $this->obatModel->insert($data);
            $data = [
                'user_id' => user()->id,
                'action' => 'Menambahkan data obat',
                'ip_address' => $this->request->getUserAgent(),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $log = new LogActivity();
            $log->insertLog($data);
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data obat berhasil ditambahkan.');
            return redirect()->to('master-data/obat');
        } catch (\Throwable $th) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data obat gagal ditambahkan, <br>' . $th->getMessage());
			return redirect()->back();
		} catch (\Exception $e) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data obat gagal ditambahkan, <br>' . $e->getMessage());
			return redirect()->back();
		}
    }

    public function show($id) {
        $param['title'] = 'Detail Obat';
        $param['data'] = $this->obatModel->find($id);
        return view('obat/show',$param);
    }

    public function edit($id) {
        $param['title'] = 'Edit Obat';
        $param['data'] = $this->obatModel->find($id);
        return view('obat/edit',$param);
    }

    public function update($id) {
        $rules = [
            'obat' => 'required',
            'satuan' => 'required',
        ];

        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $nama = $this->request->getPost("obat");
            $satuan = $this->request->getPost("satuan");
            $data = [
                'nama' => $nama,
                'satuan' => $satuan,
            ];

            $this->obatModel->update($id,$data);
            $data = [
                'user_id' => user()->id,
                'action' => 'Mengganti data obat',
                'ip_address' => $this->request->getUserAgent(),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $log = new LogActivity();
            $log->insertLog($data);
            session()->setFlashdata("status_success", true);
            session()->setFlashdata('message', 'Data obat berhasil mengganti.');
            return redirect()->to('master-data/obat');
        } catch (\Throwable $th) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data obat gagal mengganti, <br>' . $th->getMessage());
			return redirect()->back();
		} catch (\Exception $e) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data obat gagal mengganti, <br>' . $e->getMessage());
			return redirect()->back();
		}
    }

    public function destroy($id) {
        $this->obatModel->delete($id);
        $data = [
            'user_id' => user()->id,
            'action' => 'Menghapus data obat',
            'ip_address' => $this->request->getUserAgent(),
            'created_at' => date("Y-m-d H:i:s"),
        ];
        $log = new LogActivity();
        $log->insertLog($data);
        session()->setFlashdata("status_success", true);
        session()->setFlashdata('message', 'Data obat berhasil dihapus.');
        return redirect()->to('master-data/obat');
    }
}
