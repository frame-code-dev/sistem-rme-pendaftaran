<?= $this->extend('layouts/app') ?>
<?= $this->section('js')?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
    <script>
        var options = {
          series: [{
            name: 'Pasien Baru',
            data: <?= json_encode($data_baru) ?>
          }, {
            name: 'Pasien Lama',
            data: <?= json_encode($data_lama) ?>
          }],
          chart: {
            type: 'bar',
            height: 350
          },
          plotOptions: {
            bar: {
              horizontal: false,
              columnWidth: '55%',
              endingShape: 'rounded'
            },
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
          },
          xaxis: {
            categories: <?= json_encode($categories) ?>,
          },
          yaxis: {
            title: {
              text: 'Jumlah Pasien'
            }
          },
          fill: {
            opacity: 1
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return val + " pasien";
              }
            }
          }
        };

        var chart = new ApexCharts(document.querySelector("#kunjungan"), options);
        chart.render();
    </script>
<?= $this->endSection('js') ?>
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
                            <?=$pasien_lama?>
                        </h2>
                        <p class="text-gray-500 text-sm tracking-tighter">
                            TOTAL PASIEN LAMA
                        </p>
                </div>
                </div>
            </div>
            <div class="card p-5 w-full border border-green-100 bg-green-50 h-[127px] relative">
                <div class="flex gap-5">
                <div>
                    <button class="w-20 h-20 p-5 rounded-full bg-green-200 flex align-middle items-center content-center mx-auto">
                        <svg class="text-3xl mt-1 text-green-500 items-center content-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                        </svg>

                    </button>
                </div>
                <div class="mt-3">
                        <h2 class="text-theme-text text-3xl font-bold tracking-tighter">
                        <?=$pasien_baru?>
                        </h2>
                        <p class="text-gray-500 text-sm tracking-tighter">
                            TOTAL PASIEN BARU
                        </p>
                </div>
                </div>
            </div>
            <div class="card p-5 w-full border border-blue-100 bg-blue-50 h-[127px] relative">
                <div class="flex gap-5">
                <div>
                    <button class="w-20 h-20 p-5 rounded-full bg-blue-200 flex align-middle items-center content-center mx-auto">
                        <svg class="text-3xl mt-1 text-blue-500 items-center content-center mx-auto" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z"/>
                        </svg>

                    </button>
                </div>
                <div class="mt-3">
                        <h2 class="text-theme-text text-3xl font-bold tracking-tighter">
                        <?=$pasien_semua?>
                        </h2>
                        <p class="text-gray-500 text-sm tracking-tighter">
                            TOTAL PASIEN
                        </p>
                </div>
                </div>
            </div>
        </div>
        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-2 w-full mt-2">
            <div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
                <div class="head flex lg:flex-row flex-col justify-between gap-5 mb-2">
                    <div class="title">
                        <h2 class="font-semibold tracking-tighter text-lg text-theme-text">
                            Monitoring Presentase Kunjungan Pasien
                        </h2>
                    </div>
                </div>
                <hr>
                <div class="lg:mt-0 pt-10 mx-auto">
                    <div id="kunjungan"></div>
                </div>
            </div>
            <div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
                <div class="head flex lg:flex-row flex-col justify-between gap-5 mb-2">
                    <div class="title">
                        <h2 class="font-semibold tracking-tighter text-lg text-theme-text">
                            Monitoring 10 Besar Penyakit
                        </h2>
                    </div>
                </div>
                <hr>
                <div class="my-4">
                    <table class="w-full border text-sm text-left text-gray-500 dark:text-gray-400 mt-4 datatable" id="datatable">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3 border">No</th>
                                <th scope="col" class="px-4 py-3 border">Kode ICD 10</th>
                                <th scope="col" class="px-4 py-3 border">Diagnosis</th>
                                <th scope="col" class="px-4 py-3 border">Jumlah</th>
                            
                            </tr>
                        </thead>
                        <tbody>
                                <?php $no = 1;
                                    foreach ($data as $row) : ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-3 border"><?= $no++ ?></td>
                                        <td class="px-4 py-3 border"><?= $row['kode_penyakit'] ?></td>
                                        <td class="px-4 py-3 border"><?= $row['nama_penyakit'] ?></td>
                                        <td class="px-4 py-3 border"><?= $row['jumlah'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?=$this->endSection('content')?>