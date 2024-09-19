<?=$this->extend('layouts/app')?>
<?=$this->section('content')?>
<div class="p-4 sm:ml-64 h-screen">
    <div class="p-4 mt-14">
            <div class="head lg:flex grid grid-cols-1 justify-between w-full">
                <div class="heading flex-auto">
                    <p class="text-blue-950 font-sm text-xs">
                        Apotek
                    </p>
                    <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                        <?=esc($title)?>
                    </h2>
                </div>
            </div>

            <div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
                <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400 datatable" id="datatable">
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
                            <th scope="col" class="px-4 py-3">Status Pemeriksaan</th>
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
                                        <a href="<?=base_url('apotek/detail/'.$row['id'])?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Detail Obat
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
<?=$this->endSection()?>