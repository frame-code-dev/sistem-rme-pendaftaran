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
    <a href="<?=site_url('apotek')?>" class="flex <?= in_array($activeMenuSatu, ['apotek']) ? 'bg-blue-900 text-white' : 'text-gray-900' ?> items-center p-3 text-gray-900 dark:text-white hover:bg-blue-900 dark:hover:bg-gray-700 group">
        <svg class="w-5 h-5 <?= in_array($activeMenuSatu, ['apotek']) ? 'bg-blue-900 text-white' : 'text-gray-500' ?> transition duration-75 dark:text-blue-900 group-hover:text-white dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
        </svg>
        <span class="ms-3 <?= in_array($activeMenuSatu, ['apotek']) ? 'bg-blue-900 text-white' : 'text-gray-500' ?> group-hover:text-white">Apotek</span>
    </a>
</li>
<hr>
