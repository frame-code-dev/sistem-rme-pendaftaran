<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LogActivity;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;

class PetugasController extends BaseController
{
    protected $helpers = ['form', 'url'];
    protected $validation;
    protected $userModel;
    protected $groupModel;
    public $param;

    public function __construct() {
        $this->validation = \Config\Services::validation();
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
    }
    public function index()
    {
        $param['title'] = 'List Petugas';
        $param['data'] = $this->userModel->getAllUsers();
        return view('petugas/index',$param);
    }

    public function create() {
        $param['title'] = 'Create Petugas';
        return view('petugas/create',$param);
    }

    public function store() {
        $rules = [
            'username' => 'required|alpha_numeric_space|min_length[3]|max_length[30]|is_unique[users.username]',
            'nama' => 'required',
            'password' => 'required',
            'role' => 'required',
            'email'    => 'required|valid_email|is_unique[users.email]',
        ];
     
        if (! $this->validate($rules))
        {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        

		try {
            $nama = $this->request->getPost("nama");
            $username = $this->request->getPost("username");
            $email = $this->request->getPost("email");
            $role = $this->request->getPost("role");
            $password = (string) $this->request->getPost('password');

            $data = [
				"name" => $nama,
				"email" => $email,
				"username" => $username,
				"password" => $password,
				"active" => 1,
			];
            $user = new User($data);
            $this->userModel->save($user);
            $userId = $this->userModel->getInsertID();
             // Assign roles to users
            if ($role === 'admin') {
                $this->groupModel->addUserToGroup($userId, 1);
            } else if ($role === 'pendaftaran') {
                $this->groupModel->addUserToGroup($userId, 2);
            } else if ($role === 'perawat') {
                $this->groupModel->addUserToGroup($userId, 3);
            } else if ($role === 'dokter') {
                $this->groupModel->addUserToGroup($userId, 4);
            }
            $data = [
                'user_id' => user()->id,
                'action' => 'Menambahkan data petugas dengan username : '.$username,
                'ip_address' => $this->request->getUserAgent(),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $log = new LogActivity();
            $log->insertLog($data);
			session()->setFlashdata("status_success", true);
			session()->setFlashdata('message', 'Data user berhasil ditambahkan.');
			return redirect()->to('master-data/petugas');
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
        $param['title'] = 'Detail Petugas';
        $param['data'] = $this->userModel->getFindUsers($id);
        return view('petugas/show',$param);
    }

    public function edit($id) {
        $param['title'] = 'Edit Petugas';
        $param['data'] = $this->userModel->getFindUsers($id);
        return view('petugas/edit',$param);
    }

    public function update($id) {
        $rules = [
            'username' => 'required',
            'nama' => 'required',
            'role' => 'required',
            'email'    => 'required|valid_email',
        ];
     
        if (! $this->validate($rules))
        {
            return redirect()->to('master-data/petugas/edit/'.$id)->withInput()->with('errors', $this->validator->getErrors());
        }
        

		try {
            $param['data'] = $this->userModel->getFindUsers($id);
            $nama = $this->request->getPost("nama");
            $username = $this->request->getPost("username");
            $email = $this->request->getPost("email");
            $role = $this->request->getPost("role");
            $password = (string) $this->request->getPost('password');
            if ($password != '' || $password != null) {
                $users = model(UserModel::class);
                $user = $users->where('id', $id)
                        ->first();
                $user->name = $nama;
                $user->email = $email;
                $user->username = $username;
                $user->password         = $this->request->getPost('password');
                $user->reset_hash       = null;
                $user->reset_at         = date('Y-m-d H:i:s');
                $user->reset_expires    = null;
                $user->force_pass_reset = false;
                $users->save($user);
            }else{
                $data = [
                    "name" => $nama,
                    "email" => $email,
                    "username" => $username,
                    "active" => 1,
                ];
                $this->userModel->updateUser($id,$data);
            }
           
            $userId = $id;
            if ($role != $param['data']->role) {
                if ($role === 'admin') {
                    $this->groupModel->removeUserFromGroup($userId,$param['data']->group_id);
                    $this->groupModel->addUserToGroup($userId, 1);
                } else if ($role === 'pendaftaran') {
                    $this->groupModel->removeUserFromGroup($userId,$param['data']->group_id);
                    $this->groupModel->addUserToGroup($userId, 2);
                } else if ($role === 'perawat') {
                    $this->groupModel->removeUserFromGroup($userId,$param['data']->group_id);
                    $this->groupModel->addUserToGroup($userId, 3);
                } else if ($role === 'dokter') {
                    $this->groupModel->removeUserFromGroup($userId,$param['data']->group_id);
                    $this->groupModel->addUserToGroup($userId, 4);
                }
            }
            $data = [
                'user_id' => user()->id,
                'action' => 'Mengganti data petugas',
                'ip_address' => $this->request->getUserAgent(),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $log = new LogActivity();
            $log->insertLog($data);
			session()->setFlashdata("status_success", true);
			session()->setFlashdata('message', 'Data user berhasil diganti.');
			return redirect()->to('master-data/petugas');
		} catch (\Throwable $th) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal diganti, <br>' . $th->getMessage());
			return redirect()->back();
		} catch (\Exception $e) {
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal diganti, <br>' . $e->getMessage());
			return redirect()->back();
		}
    }

    public function destroy($id) {
        $this->userModel->deleteUser($id);
        $data = [
            'user_id' => user()->id,
            'action' => 'Menghapus data petugas',
            'ip_address' => $this->request->getUserAgent(),
            'created_at' => date("Y-m-d H:i:s"),
        ];
        $log = new LogActivity();
        $log->insertLog($data);
        session()->setFlashdata("status_success", true);
        session()->setFlashdata('message', 'Data user berhasil dihapus.');
        return redirect()->to('master-data/petugas');
    }

    public function updateStatus() {
        $id = $this->request->getPost("id");
        $user_current = $this->userModel->getFindUsers($id);
        if ($user_current->active == 1) {
            $data =[
                "active" => 0
            ];
        }else{
            $data =[
                "active" => 1
            ];
        }
        $this->userModel->updateUser($id,$data);
        $data = [
            'user_id' => user()->id,
            'action' => 'Update Status data petugas',
            'ip_address' => $this->request->getUserAgent(),
            'created_at' => date("Y-m-d H:i:s"),
        ];
        $log = new LogActivity();
        $log->insertLog($data);
        session()->setFlashdata("status_success", true);
        session()->setFlashdata('message', 'Data status user berhasil diganti.');
        return redirect()->to('master-data/petugas');
    }

    public function updatePassword() {
        $param['title'] = 'Update Profile';
        $param['data'] = $this->userModel->getFindUsers(user()->id);
        return view('petugas/update-password',$param);
    }

    public function updatePasswordStore() {
        $id = user()->id;
		try {
            $param['data'] = $this->userModel->getFindUsers($id);
            $nama = $this->request->getPost("nama");
            $username = $this->request->getPost("username");
            $email = $this->request->getPost("email");
            $password = (string) $this->request->getPost('password');
            if ($password != '' || $password != null) {
                $users = model(UserModel::class);
                $user = $users->where('id', $id) ->first();
                $user->password         = $this->request->getPost('password');
                $user->reset_hash       = null;
                $user->reset_at         = date('Y-m-d H:i:s');
                $user->reset_expires    = null;
                $user->force_pass_reset = false;
                $users->save($user);
            }else{
                $data = [
                    "name" => $nama,
                    "email" => $email,
                    "username" => $username,
                    "active" => 1,
                ];
                $this->userModel->update($id,$data);
            }
            $data = [
                'user_id' => user()->id,
                'action' => 'Mengganti data petugas',
                'ip_address' => $this->request->getUserAgent(),
                'created_at' => date("Y-m-d H:i:s"),
            ];
            $log = new LogActivity();
            $log->insertLog($data);
			session()->setFlashdata("status_success", true);
			session()->setFlashdata('message', 'Data user berhasil diganti.');
			return redirect()->to('/');
		} catch (\Throwable $th) {
            dd($th);
			session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal diganti, <br>' . $th->getMessage());
			return redirect()->back();
		} catch (\Exception $e) {
            dd($e);
            session()->setFlashdata("status_error", true);
			session()->setFlashdata('error', 'Data user gagal diganti, <br>' . $e->getMessage());
			return redirect()->back();
		}
    }
}
