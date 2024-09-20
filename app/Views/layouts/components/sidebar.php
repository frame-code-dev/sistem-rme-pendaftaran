
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-blue-50 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <?php if (in_groups('dokter')) : ?>
                <?=$this->include('layouts/components/menu/dokter'); ?>
            <?php endif;?>
            <?php if (in_groups('perawat')) : ?>
                <?=$this->include('layouts/components/menu/perawat'); ?>
            <?php endif;?>
            <?php if (in_groups('administrator')) : ?>
                <?=$this->include('layouts/components/menu/admin'); ?>
            <?php endif;?>
            <?php if (in_groups('kepala')) : ?>
                <?=$this->include('layouts/components/menu/kepala'); ?>
            <?php endif;?>
            <?php if (in_groups('pendaftaran')) : ?>
                <?=$this->include('layouts/components/menu/petugas'); ?>
            <?php endif;?>
            <?php if (in_groups('penanggung')) : ?>
                <?=$this->include('layouts/components/menu/penanggung'); ?>
            <?php endif;?>
            <?php if (in_groups('petugaslab')) : ?>
                <?=$this->include('layouts/components/menu/petugaslab'); ?>
            <?php endif;?>
            <?php if (in_groups('farmasi')) : ?>
                <?=$this->include('layouts/components/menu/farmasi'); ?>
            <?php endif;?>
            
           
        </ul>
    </div>
</aside>