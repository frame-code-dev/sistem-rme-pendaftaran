<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create the user model
        $userModel = new UserModel();
        $groupModel = new GroupModel();

        // Create roles and permissions
        $groupModel->insert([
            'name'        => 'administrator',
            'description' => 'Administrator role'
        ]);

        $groupModel->insert([
            'name'        => 'pendaftaran',
            'description' => 'Pendaftaran role'
        ]);

        $groupModel->insert([
            'name'        => 'perawat',
            'description' => 'Perawat role'
        ]);

        $groupModel->insert([
            'name'        => 'dokter',
            'description' => 'Dokter role'
        ]);
        $groupModel->insert([
            'name'        => 'farmasi',
            'description' => 'Farmasi role'
        ]);
        $groupModel->insert([
            'name'        => 'petugaslab',
            'description' => 'Petugas Lab role'
        ]);
        $groupModel->insert([
            'name'        => 'penanggung',
            'description' => 'Penanggung Jawab RM'
        ]);
        $groupModel->insert([
            'name'        => 'kepala',
            'description' => 'Kepala Rumah Sakit'
        ]);
        

        // Create users
        $users = [
            [
                'name'     => 'Administrator',
                'email'    => 'admin@mail.com',
                'username' => 'admin',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
            [
                'name'     => 'Pendaftaran',
                'email'    => 'pendaftaran@mail.com',
                'username' => 'pendaftaran',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
            [
                'name'     => 'Dokter',
                'email'    => 'dokter@mail.com',
                'username' => 'dokter',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
            [
                'name'     => 'Perawat',
                'email'    => 'perawat@mail.com',
                'username' => 'perawat',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
            [
                'name'     => 'Farmasi',
                'email'    => 'farmasi@mail.com',
                'username' => 'farmasi',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
            [
                'name'     => 'Petugas Lab',
                'email'    => 'petugaslab@mail.com',
                'username' => 'petugaslab',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
            [
                'name'     => 'Penanggung Jawab RM',
                'email'    => 'penanggungjawabrm@mail.com',
                'username' => 'penanggungjawab',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
            [
                'name'     => 'Kepala Rumah Sakit',
                'email'    => 'kepala@mail.com',
                'username' => 'kepala',
                'password' => 'password', // Ensure this meets your password requirements
                'active'   => 1,
            ],
        ];
        
        foreach ($users as $userData) {
            // Create a new user entity
            $user = new User($userData);

            // Save the user
            $userModel->save($user);

            // Get the ID of the created user
            $userId = $userModel->getInsertID();

            // Assign roles to users
            if ($userData['username'] === 'admin') {
                $groupModel->addUserToGroup($userId, 1);
            } else if ($userData['username'] === 'pendaftaran') {
                $groupModel->addUserToGroup($userId, 2);
            } else if ($userData['username'] === 'perawat') {
                $groupModel->addUserToGroup($userId, 3);
            } else if ($userData['username'] === 'dokter') {
                $groupModel->addUserToGroup($userId, 4);
            } else if ($userData['username'] === 'farmasi') {
                $groupModel->addUserToGroup($userId, 5);
            } else if ($userData['username'] === 'petugaslab') {
                $groupModel->addUserToGroup($userId, 6);
            } else if ($userData['username'] === 'penanggungjawab') {
                $groupModel->addUserToGroup($userId, 7);
            } else if ($userData['username'] === 'kepala') {
                $groupModel->addUserToGroup($userId, 8);
            }
            
        }
    }
}
