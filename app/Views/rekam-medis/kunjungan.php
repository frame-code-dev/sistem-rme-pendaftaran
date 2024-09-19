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
        </div>
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
            <form action="" method="GET">
                <div class="grid grid-cols-3 gap-3">
                    <div class="col-span-2 w-full">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tanggal Range<span class="me-2 text-red-500">*</span></label>
                        <div id="date-range-picker" date-rangepicker class="flex items-center w-full">
                            <div class="relative w-1/2">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="datepicker-range-start" value="<?=isset($_GET['start']) ? $_GET['start'] : ''?>" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative w-1/2">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="datepicker-range-end" name="end" value="<?=isset($_GET['end']) ? $_GET['end'] : ''?>" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                            </div>
                        </div>

                    </div>
                   <div class="">
                       <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Cara Bayar<span class="me-2 text-red-500">*</span></label>
                       <select id="cara_bayar" name="cara_bayar" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                           <option disabled hidden selected value=""> -- Pilih Cara Bayar --</option>
                           <option <?= 'BPJS' == set_value("cara_bayar",isset($_GET['cara_bayar']) ? $_GET['cara_bayar'] : '') ? "selected" : "" ?> value="BPJS">BPJS</option>
                           <option <?= 'UMUM' == set_value("cara_bayar",isset($_GET['cara_bayar']) ? $_GET['cara_bayar'] : '') ? "selected" : "" ?> value="UMUM">UMUM</option>
                       </select>
                       
                   </div>
               </div>
               <div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md mt-3">
                   <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Tampilkan</button>
                   <?php
                        $start = isset($_GET['start']) ? $_GET['start'] : '';
                        $end = isset($_GET['end']) ? $_GET['end'] : '';
                        $cara_bayar = isset($_GET['cara_bayar']) ? $_GET['cara_bayar'] : '';
                   ?>
                   <a href="<?=base_url('rekam-medis/kunjungan-laporan/pdf'.'?start='.$start.'&end='.$end.'&cara_bayar='.$cara_bayar)?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800" type="submit">Cetak PDF</a>
               </div>
            </form>
        </div>
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
            <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400 datatable" id="datatable">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Tanggal Kunjungan</th>
                        <th scope="col" class="px-4 py-3">NO. RM</th>
                        <th scope="col" class="px-4 py-3">NIK</th>
                        <th scope="col" class="px-4 py-3">Nama</th>
                        <th scope="col" class="px-4 py-3">Tanggal Lahir</th>
                        <th scope="col" class="px-4 py-3">Jenis Kelamin</th>
                        <th scope="col" class="px-4 py-3">Jenis Pasien</th>
                        <th scope="col" class="px-4 py-3">NO. BPJS</th>
                    </tr>
                </thead>
                <tbody>
                        <?php $no = 1;
                            foreach ($data as $row) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3"><?= date('d-m-Y', strtotime($row['tanggal_kunjungan']) ?? '') ?></td>
                                <td class="px-4 py-3"><?= $row['no_rm'] ?></td>
                                <td class="px-4 py-3"><?= $row['nik'] ?></td>
                                <td class="px-4 py-3"><?= ucwords($row['nama_lengkap']) ?></td>
                                <td class="px-4 py-3"><?= $row['tanggal_lahir'] ?></td>
                                <td class="px-4 py-3"><?= $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                                <td class="px-4 py-3"><?= $row['jenis_pasien'] ?></td>
                                <td class="px-4 py-3"><?= $row['no_bpjs'] ?? '-' ?></td>
                            </tr>
                        <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<?=$this->endSection()?>