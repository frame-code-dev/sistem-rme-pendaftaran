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
                    <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400" id="datatable">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">NO. RM</th>
                                <th scope="col" class="px-4 py-3">NIK</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Tanggal Lahir</th>
                                <th scope="col" class="px-4 py-3">Jenis Kelamin</th>
                                <th scope="col" class="px-4 py-3">Jenis Pasien</th>
                                <th scope="col" class="px-4 py-3">NO. BPJS</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $row) : ?>
                                <?php if ($row['status_pemeriksaan'] == 'PENDING' || $row['status_pemeriksaan'] == 'DILAYANIN' ) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-3"><?= $no++ ?></td>
                                        <td class="px-4 py-3"><?= $row['no_rm'] ?></td>
                                        <td class="px-4 py-3"><?= $row['nik'] ?></td>
                                        <td class="px-4 py-3"><?= ucwords($row['nama_lengkap']) ?></td>
                                        <td class="px-4 py-3"><?= $row['tanggal_lahir'] ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_pasien'] ?></td>
                                        <td class="px-4 py-3"><?= $row['no_bpjs'] ?? '-' ?></td>
                                        <td>
                                            <a href="<?=base_url('pemeriksaan/create/'.$row['id'])?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                                Tambahkan Pemeriksaaan
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                    <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400" id="datatable">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">NO. RM</th>
                                <th scope="col" class="px-4 py-3">NIK</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Tanggal Lahir</th>
                                <th scope="col" class="px-4 py-3">Jenis Kelamin</th>
                                <th scope="col" class="px-4 py-3">Jenis Pasien</th>
                                <th scope="col" class="px-4 py-3">NO. BPJS</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($data as $row) : ?>
                                <?php if ($row['status_pemeriksaan'] == 'SELESAI') : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-3"><?= $no++ ?></td>
                                        <td class="px-4 py-3"><?= $row['no_rm'] ?></td>
                                        <td class="px-4 py-3"><?= $row['nik'] ?></td>
                                        <td class="px-4 py-3"><?= ucwords($row['nama_lengkap']) ?></td>
                                        <td class="px-4 py-3"><?= $row['tanggal_lahir'] ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                        <td class="px-4 py-3"><?= $row['jenis_pasien'] ?></td>
                                        <td class="px-4 py-3"><?= $row['no_bpjs'] ?? '-' ?></td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900"><?= $row['status_pemeriksaan'] ?? '-' ?></span></td>

                                        <td>
                                            <a href="" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                                                Riwayat CPPT
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>
