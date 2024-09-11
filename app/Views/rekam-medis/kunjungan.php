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
             <div class="grid grid-cols-2 gap-3">
                <div class="">
                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Dari<span class="me-2 text-red-500">*</span></label>
                    <input type="text" placeholder="d-m-Y" name="dari" id="dari" datepicker datepicker-format="dd-mm-yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?=isset($_GET['dari']) ? $_GET['dari'] : ''?>" autocomplete="off">
                   
                </div>
                <div class="">
                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Sampai<span class="me-2 text-red-500">*</span></label>
                    <input type="text" placeholder="d-m-Y" name="sampai" id="sampai" datepicker datepicker-format="dd-mm-yyyy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?=isset($_GET['sampai']) ? $_GET['sampai'] : ''?>" autocomplete="off">
                    
                </div>
                
            </div>
            <div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md mt-3">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Tampilkan</button>
            </div>
        </div>
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
            <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400" id="datatable">
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