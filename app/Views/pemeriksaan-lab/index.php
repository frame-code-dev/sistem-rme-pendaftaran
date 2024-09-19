<?=$this->extend('layouts/app')?>
<?=$this->section('content')?>
    <div class="p-4 sm:ml-64 h-screen">
        <div class="p-4 mt-14">
            <div class="head lg:flex grid grid-cols-1 justify-between w-full">
                <div class="heading flex-auto">
                    <p class="text-blue-950 font-sm text-xs">
                        Pemeriksaaan
                    </p>
                    <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                        <?=esc($title)?>
                    </h2>
                </div>
            </div>
            <div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Belum Dilayanin</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Sudah Dilayanin</button>
                        </li>
                        
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400 datatable" id="datatable">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th scope="col" class="px-4 py-3">NO. RM</th>
                                    <th scope="col" class="px-4 py-3">NIK</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">UMUR</th>
                                    <th scope="col" class="px-4 py-3">Jenis Kelamin</th>
                                    <th scope="col" class="px-4 py-3">Alamat</th>
                                    <th scope="col" class="px-4 py-3">Poli Pengirim</th>
                                    <th scope="col" class="px-4 py-3">Dokter Pengirim</th>
                                    <th scope="col" class="px-4 py-3">Jenis Pemeriksaaan</th>
                                    <th scope="col" class="px-4 py-3">Jenis Pasien</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data as $row) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-3"><?= $no++ ?></td>
                                        <td class="px-4 py-3"><?= $row['no_rm'] ?></td>
                                        <td class="px-4 py-3"><?= $row['nik'] ?></td>
                                        <td class="px-4 py-3"><?= $row['nama_lengkap'] ?></td>
                                        <td class="px-4 py-3"><?= hitungUmur($row['tanggal_lahir']) ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_kelamin'] ?></td>
                                        <td class="px-4 py-3"><?= $row['alamat_lengkap'] ?></td>
                                        <td class="px-4 py-3"><?= $row['poli'] ?></td>
                                        <td class="px-4 py-3"><?= $row['name'] ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_pemeriksaaan'] ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_pasien'] ?></td>
                                        <td class="px-4 py-3">
                                            <a href="<?=base_url('pemeriksaan-lab/create/'.$row['id'])?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                Tambah Pemeriksaaan LAB
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400 datatable" id="datatable">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-4 py-3">No</th>
                                    <th scope="col" class="px-4 py-3">NO. RM</th>
                                    <th scope="col" class="px-4 py-3">NIK</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">UMUR</th>
                                    <th scope="col" class="px-4 py-3">Jenis Kelamin</th>
                                    <th scope="col" class="px-4 py-3">Alamat</th>
                                    <th scope="col" class="px-4 py-3">Poli Pengirim</th>
                                    <th scope="col" class="px-4 py-3">Dokter Pengirim</th>
                                    <th scope="col" class="px-4 py-3">Jenis Pemeriksaaan</th>
                                    <th scope="col" class="px-4 py-3">Jenis Pasien</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($data_selesai as $row) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-3"><?= $no++ ?></td>
                                        <td class="px-4 py-3"><?= $row['no_rm'] ?></td>
                                        <td class="px-4 py-3"><?= $row['nik'] ?></td>
                                        <td class="px-4 py-3"><?= $row['nama_lengkap'] ?></td>
                                        <td class="px-4 py-3"><?= hitungUmur($row['tanggal_lahir']) ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_kelamin'] ?></td>
                                        <td class="px-4 py-3"><?= $row['alamat_lengkap'] ?></td>
                                        <td class="px-4 py-3"><?= $row['poli'] ?></td>
                                        <td class="px-4 py-3"><?= $row['name'] ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_pemeriksaan'] ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_pasien'] ?></td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end items-center content-center gap-3">
                                                <div>
                                                    <span class="text-xs text-green-800 bg-green-100 p-2"><?=$row['status']?></span>
                                                </div>
                                                <div>
                                                    <a href="<?=base_url('pemeriksaan-lab/cetak-pdf/'.$row['id'])?>"  target="_blank" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                                                        </svg>
                                                        Cetak PDF
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?=$this->endSection()?>
