<?=$this->extend('layouts/app')?>
<?=$this->section('content')?>
<div class="p-4 sm:ml-64 h-screen">
    <div class="p-4 mt-14">
        <div class="head lg:flex grid grid-cols-1 justify-between w-full">
            <div class="heading flex-auto">
                <p class="text-blue-950 font-sm text-xs">
                    Rekam Medis
                </p>
                <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                    <?=esc($title)?>
                </h2>
            </div>
            <a href="<?=base_url('rekam-medis/laporan-penyakit/pdf')?>"  target="_blank" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                </svg>
                Cetak PDF
            </a>
        </div>
     
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
            <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400 datatable" id="datatable">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Kode ICD 10</th>
                        <th scope="col" class="px-4 py-3">Diagnosis</th>
                        <th scope="col" class="px-4 py-3">Jumlah</th>
                      
                    </tr>
                </thead>
                <tbody>
                        <?php $no = 1;
                            foreach ($data as $row) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3"><?= $row['kode_penyakit'] ?></td>
                                <td class="px-4 py-3"><?= $row['diagnosa_nama'] ?></td>
                                <td class="px-4 py-3"><?= $row['jumlah'] ?></td>
                            </tr>
                        <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?=$this->endSection()?>