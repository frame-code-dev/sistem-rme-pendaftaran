<?php 
    $uri = service('uri');
    $activeMenuSatu = $uri->getSegment(1); 
    $activeMenuDua = $uri->getSegment(2); 
?>
<h5 class="text-gray-500 font-bold uppercase dark:text-gray-400 px-3">MENU</h5>
<li>
    <a href="<?=site_url('dashboard')?>" class="flex items-center p-3 <?= in_array($activeMenuSatu, ['dashboard']) ? 'bg-blue-900 text-white' : 'text-gray-900' ?> text-gray-900 dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group">
    <svg class="w-5 h-5 <?= in_array($activeMenuSatu, ['dashboard']) ? 'text-white' : 'text-gray-900' ?> transition duration-75 dark:text-blue-900 group-hover:text-white dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Zm16 14a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2ZM4 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6Zm16-2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6Z"/>
    </svg>
    <span class="ms-3 <?= in_array($activeMenuSatu, ['dashboard']) ? 'text-white' : 'text-gray-900' ?> group-hover:text-white">Dashboard</span>
    </a>
</li>
<hr>

<li>
    <a href="<?=site_url('pendaftaran')?>" class="flex <?= in_array($activeMenuSatu, ['pendaftaran','consent','kunjungan']) ? 'bg-blue-900 text-white' : 'text-gray-900' ?> items-center p-3 text-gray-900 dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group">
        <svg class="w-5 h-5 <?= in_array($activeMenuSatu, ['pendaftaran','consent','kunjungan']) ? 'bg-blue-900 text-white' : ' text-gray-500' ?> transition duration-75 dark:text-blue-900 group-hover:text-white dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h4M9 3v4a1 1 0 0 1-1 1H4m11 6v4m-2-2h4m3 0a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z"/>
        </svg>
        <span class="ms-3 <?= in_array($activeMenuSatu, ['pendaftaran','consent','kunjungan']) ? 'bg-blue-900 text-white' : ' text-gray-500' ?> group-hover:text-white">Pendaftaran</span>
    </a>
</li>
<hr>


<li>
    <button type="button" class="flex <?= in_array($activeMenuSatu, ['rekam-medis']) ? 'bg-blue-900 text-white' : 'text-gray-500' ?> items-center w-full p-3 text-base text-gray-900 transition duration-75 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700" aria-controls="rekam-medis" data-collapse-toggle="rekam-medis">
        <svg class="flex-shrink-0 w-5 h-5 <?= in_array($activeMenuSatu, ['rekam-medis']) ? 'bg-blue-900 text-white' : 'text-gray-900' ?> transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 8H4m0-2v13a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-5.032a1 1 0 0 1-.768-.36l-1.9-2.28a1 1 0 0 0-.768-.36H5a1 1 0 0 0-1 1Z"/>
        </svg>
        <span class="flex-1 ms-3 <?= in_array($activeMenuSatu, ['rekam-medis']) ? 'bg-blue-900 text-white' : 'text-gray-500' ?> group-hover:text-white text-left rtl:text-right whitespace-nowrap">Rekam Medis</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>
    <ul id="rekam-medis" class="<?= in_array($activeMenuSatu, ['rekam-medis']) ? '' : 'hidden' ?> py-2 space-y-2">
        
        <li>
            <a href="<?=site_url('rekam-medis/kunjungan-laporan')?>" class="flex items-center w-full p-2 <?=$activeMenuDua == 'kunjungan-laporan' ? 'bg-blue-900 text-white' : 'text-gray-500'?>  transition duration-75 pl-11 group hover:bg-blue-900 dark:text-white dark:hover:bg-gray-700">
                <svg class="flex-shrink-0 w-4 h-4 <?=$activeMenuDua == 'kunjungan-laporan' ? 'bg-blue-900 text-white' : 'text-gray-500'?> transition duration-75 group-hover:text-white dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m10 16 4-4-4-4"/>
                </svg>
                <span class="group-hover:text-white">
                    Laporan Kunjungan 
                </span>
            </a>
        </li>
       
    </ul>
</li>
<hr> 