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
                            <th scope="col" class="px-4 py-3">Nama Obat</th>
                            <th scope="col" class="px-4 py-3">Dosis Obat</th>
                            <th scope="col" class="px-4 py-3">Aturan Obat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $row) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3"><?= $row['nama'] ?></td>
                                <td class="px-4 py-3"><?= $row['dosis_obat'] ?></td>
                                <td class="px-4 py-3"><?= ucwords($row['aturan_obat']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="flex justify-end">
                    <a href="<?=base_url('apotek')?>" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Kembali</a>
                </div>
            </div>
    </div>
</div>
<?=$this->endSection()?>