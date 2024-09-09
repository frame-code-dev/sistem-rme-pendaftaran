<?= $this->extend('layouts/app') ?>

<?= $this->section('content')?>
<div class="p-4 sm:ml-64">
    <div class="p-4 mt-14">
        <div class="flex gap-2 items-center content-center">
            <h4 class="font-bold text-2xl">Dashboard</h4><p class="text-gray-500 text-sm">Monitoring  your current data</p>
        </div>
        <hr>
        <div class="grid grid-cols-3 gap-4 my-4">
            <div class="card p-5 w-full border border-red-100 bg-red-50 h-[127px] relative">
                <div class="flex gap-5">
                <div>
                    <button class="w-20 h-20 p-5 rounded-full bg-red-200 flex align-middle items-center content-center mx-auto">
                        <svg class="text-3xl mt-1 text-red-500 items-center content-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                        </svg>

                    </button>
                </div>
                <div class="mt-3">
                        <h2 class="text-theme-text text-3xl font-bold tracking-tighter">
                            20
                        </h2>
                        <p class="text-gray-500 text-sm tracking-tighter">
                            TOTAL PASIEN
                        </p>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection('content')?>