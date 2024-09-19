<?=$this->extend('layouts/app')?>
<?=$this->section('content')?>
<?=$this->include('petugas/modal/update')?>
<div class="p-4 sm:ml-64 h-screen">
    <div class="p-4 mt-14">
        <div class="head lg:flex grid grid-cols-1 justify-between w-full">
            <div class="heading flex-auto">
                <p class="text-blue-950 font-sm text-xs">
                    Master Data
                </p>
                <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                    <?=esc($title)?>
                </h2>
            </div>
            <div class="layout lg:flex grid grid-cols-1 lg:mt-0 mt-5 justify-end gap-5">
                <div class="button-wrapper gap-2 flex lg:justify-end">
                    <a href="<?=base_url('master-data/petugas/create')?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-3.5 h-3.5 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                        </svg>
                        Tambah Data</a>
                </div>
            </div>
           
        </div>
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative overflow-x-auto">
            <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400 datatable" id="datatable">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Nama Lengkap</th>
                        <th scope="col" class="px-4 py-3">Username</th>
                        <th scope="col" class="px-4 py-3">Email</th>
                        <th scope="col" class="px-4 py-3">Hak Akses</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Tanggal</th>
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
                            <td class="px-4 py-3"><?= $row->name ?? '-' ?></td>
                            <td class="px-4 py-3"><?= $row->username ?></td>
                            <td class="px-4 py-3"><?= $row->email ?></td>
                            <td class="px-4 py-3"><?= $row->role ?></td>
                            <td class="px-4 py-3">
                            <span data-modal-target="update-modal" data-modal-toggle="update-modal" 
                                data-user="<?= $row->id ?>" 
                                class="update-modal cursor-pointer 
                                    bg-<?= $row->active == 1 ? 'green' : 'red' ?>-100 text-<?= $row->active == 1 ? 'green' : 'red' ?>-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded 
                                    dark:bg-<?= $row->active == 1 ? 'green' : 'red' ?>-900 dark:text-<?= $row->active == 1 ? 'green' : 'red' ?>-300"><?=$row->active == 1 ? 'Aktif' : "Nonaktif" ?>
                            </span>
                            </td>
                            <td class="px-4 py-3"><?= $row->created_at ?></td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <div class="inline-flex rounded-md shadow-sm">
                                    <a href="<?= base_url('master-data/petugas/show/' . $row->id) ?>" aria-current="page" class="px-4 py-2 text-sm font-medium text-blue-700 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Show
                                    </a>
                                    <a href="<?= base_url('master-data/petugas/edit/' . $row->id) ?>" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                        Edit
                                    </a>
                                    <?php if ($row->id != user()->id) : ?>
                                        <a href="#" data-id="<?= $row->id ?>" onclick="deleteConfirm('petugas/delete/<?= $row->id ?>')" data-modal-target="hapus default-modal" data-modal-toggle="default-modal"class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                            Hapus
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?=$this->endSection()?>