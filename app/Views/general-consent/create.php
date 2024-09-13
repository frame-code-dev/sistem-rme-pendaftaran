<?=$this->extend('layouts/app')?>
<?=$this->section('content')?>
<div class="p-4 sm:ml-64 h-screen">
    <div class="p-4 mt-14">
        <div class="head lg:flex grid grid-cols-1 justify-between w-full">
            <div class="heading flex-auto">
                <p class="text-blue-950 font-sm text-xs">
                    General Consent
                </p>
                <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                    <?=esc($title)?>
                </h2>
            </div>
            <div class="layout lg:flex grid grid-cols-1 lg:mt-0 mt-5 justify-end gap-5">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a href="<?=base_url('dashboard')?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="<?=base_url('pendaftaran')?>" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">List Pendaftaran</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"><?=$title?></span>
                        </div>
                    </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
            <form action="<?= base_url('consent/create/store/'.$pasien['id']) ?>" method="POST" class="w-full mx-auto space-y-4"  id="form" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-3">
                    <div class="border p-3">
                        <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                            <span class="font-semibold text-white uppercase">Identitas penanggung jawab Pasien</span>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Lengkap<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("nama_lengkap") ?>">
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors.nama_lengkap")) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors.nama_lengkap") ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tempat Lahir<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" id="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?= set_value("tempat_lahir") ?>">
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors.tempat_lahir")) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors.tempat_lahir") ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div>
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tanggal Lahir<span class="me-2 text-red-500">*</span></label>
                                <input type="text" datepicker datepicker-format="mm-dd-yyyy" name="tgl_lahir" id="tgl_lahir" placeholder="Masukkan Nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?= set_value("tgl_lahir") ?>">
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors.tgl_lahir")) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors.tgl_lahir") ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Alamat Lengkap<span class="me-2 text-red-500">*</span></label>
                                <textarea name="alamat_lengkap" id="" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Alamat Lengkap"></textarea>
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors.alamat")) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors.alamat") ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">NO. HP<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan No HP" name="no_hp" id="no_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="<?= set_value("no_hp") ?>">
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors.no_hp")) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors.no_hp") ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Hubungan Dengan Pasien<span class="me-2 text-red-500">*</span></label>
                                <select id="hubungan_pasien" name="hubungan_pasien" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value=""> -- Pilih --</option>
                                    <option value="ayah">Ayah</option>
                                    <option value="ibu">Ibu</option>
                                    <option value="saudara">Saudara</option>
                                    <option value="anak">Anak</option>
                                    <option value="pasangan">Pasangan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors.hubungan_pasien")) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors.hubungan_pasien") ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="border p-3">
                        <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                            <span class="font-semibold text-white uppercase">Identitas pasien</span>
                        </div>
                        <input type="hidden" name="id" value="<?= $pasien['id'] ?>">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">No. RM<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan NO. RM" name="no_rm" id="no_rm" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("no_rm",$pasien['no_rm']) ?>">
                            </div>
                            <div class="col-span-2">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Lengkap<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" id="nama_lengkap" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("nama_lengkap",$pasien['nama_lengkap']) ?>">
                            </div>
                            <div class="">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tempat Lahir<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" id="tempat_lahir" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("tempat_lahir",$pasien['tempat_lahir']) ?>">
                            </div>
                            <div class="">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tanggal Lahir<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan Tanggal Lahir" name="tgl_lahir" id="tgl_lahir" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("tgl_lahir",$pasien['tanggal_lahir']) ?>">
                            </div>
                            <div class="col-span-2">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Perawatan<span class="me-2 text-red-500">*</span></label>
                                <select id="jenis_perawatan" name="jenis_perawatan" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option disabled hidden selected value=""> -- Pilih Jenis Perawatan --</option>
                                    <option <?= 'rawat_inap' == set_value("rawat_inap") ? "selected" : "" ?> value="rawat inap">Rawat Inap</option>
                                    <option <?= 'rawat_jalan' == set_value("rawat_jalan") ? "selected" : "" ?> value="rawat jalan">Rawat Jalan</option>
                                </select>
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors.jenis_perawatan")) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors.jenis_perawatan") ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border p-3">
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="satu-tab" data-tabs-target="#satu" type="button" role="tab" aria-controls="satu" aria-selected="false">I</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dua-tab" data-tabs-target="#dua" type="button" role="tab" aria-controls="dua" aria-selected="false">II</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="tiga-tab" data-tabs-target="#tiga" type="button" role="tab" aria-controls="tiga" aria-selected="false">III</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="empat-tab" data-tabs-target="#empat" type="button" role="tab" aria-controls="empat" aria-selected="false">IV</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="lima-tab" data-tabs-target="#lima" type="button" role="tab" aria-controls="lima" aria-selected="false">V</button>
                            </li>
                            <li role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="enam-tab" data-tabs-target="#enam" type="button" role="tab" aria-controls="enam" aria-selected="false">VI</button>
                            </li>
                        </ul>
                    </div>
                    <div id="default-tab-content">
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="satu" role="tabpanel" aria-labelledby="satu-tab">
                            <div class="mb-2">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">HAK DAN KEWAJIBAN PASIEN</h4>
                                <hr>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">This is some placeholder content the 
                            Saya telah mendapat informasi tentang Hak dan Kewajiban Pasien di UPT Puskesmas Besuki melalui leaflet/banner yang disedikan oleh petugas dan saya memiliki hak untuk mengambil bagian dalam keputusan mengenai : penyakit saya, perwatan medis, serta rencana pengobatan
                            </p>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="dua" role="tabpanel" aria-labelledby="dua-tab">
                            <div class="mb-2">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">PERSETUJUAN PELAYANAN KESEHATAN</h4>
                                <hr>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Saya mengetahui dan memberikan persetujuan untuk mendapatkan pelayanan kesehatan di Puskesmas Besuki dan dengan ini saya 
                            meminta dan memberikan kuasa kepada Tenaga Kesehatan di Puskesmas Besuki untuk memberikan pelayanan kesehatan berupa pemeriksaan 
                            fisik, prosedur diagnostik/terapi/pengobatan medis lainnya sesuai pertimbangan Tenaga Kesehatan Puskesmas Besuki yang diperlukan 
                            atau disarankan selama pelayanan kesehatan terhadap saya. Serta pengaturan makanan dan minuman sesuai dengan kondisi saat dirawat.
                            </p>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tiga" role="tabpanel" aria-labelledby="tiga-tab">
                            <div class="mb-2">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">PRIVASI</h4>
                                <hr>
                            </div>
                            <div class="p-6 bg-blue-50 rounded-lg space-y-4">
                                <!-- Section 1 -->
                                <div>
                                    <p class="font-semibold">1. Saya memberi kuasa kepada Tenaga Kesehatan Puskesmas Besuki untuk menjaga privasi dan kerahasiaan penyakit saya selama menjalani pelayanan kesehatan.</p>
                                </div>

                                <!-- Section 2 -->
                                <div>
                                    <p class="font-semibold">2. Privasi khusus</p>
                                    <div class="space-y-2">
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="privasi_khusus" value="mengijinkan" class="form-radio text-blue-600">
                                                <span class="ml-2">Saya Mengijinkan</span>
                                            </label>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="privasi_khusus" value="permintaan_khusus" class="form-radio text-blue-600">
                                                <span class="ml-2">Jika ada, Sebutkan permintaan privasi khusus</span>
                                            </label>
                                            <input type="text" placeholder="Masukkan Data" name="permintaan_privasi_khusus" class="form-input w-full border border-gray-300 rounded p-2">
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="privasi_khusus" value="tidak_mengijinkan" class="form-radio text-blue-600">
                                                <span class="ml-2">Saya Tidak Mengijinkan</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 3 -->
                                <div>
                                    <p class="font-semibold">3. Tenaga Kesehatan Puskesmas Besuki memberi akses bagi keluarga, handai taulan, serta orang lain yang akan menegok/menemui saya bila saya dirawat</p>
                                    <div class="space-y-2">
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="akses_keluarga" value="mengijinkan" class="form-radio text-blue-600">
                                                <span class="ml-2">Saya Mengijinkan</span>
                                            </label>
                                        </div>
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="akses_keluarga" value="tidak_mengijinkan" class="form-radio text-blue-600">
                                                <span class="ml-2">Saya Tidak Mengijinkan</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="empat" role="tabpanel" aria-labelledby="empat-tab">
                            <div class="mb-2">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">PERSETUJUAN PELEPASAN INFORMASI</h4>
                                <hr>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Saya memberikan persetujuan untuk memberikan informasi tentang diagnosis, kondisi medis, rencana pengobatan dan perawatan, indikasi tindakan, pengoobatan, hasil pengobatan maupun perawatan risiko dan komplikasi, serta informasi lain yang saya terima kepada:
                                - Perusahan asuransi kesehatan atau pihak lain yang menjamin pembiayaan saya.
                                - Pihak berwajib yang memerlukan informasi kesehatan saya dengan mekanisme sesuai peraturan perundangan yang berlaku.
                            </p>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="lima" role="tabpanel" aria-labelledby="lima-tab">
                            <div class="mb-2">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white">BARANG PRIBADI</h4>
                                <hr>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                            Saya setuju untuk tidak membawa barang-barang berharga yang tidak diperlukan seperti (perhiasan, alat elektronik/gedget,dll) selama menjalani pelayanan kesehatan di Puskesmas Besuki. Saya memahami dan menyetujui bahwa apabila saya membawanya, 
                            maka Puskesmas Besuki tidak bertanggung jawab terhadap kehilangan, kerusakan, atau pencurian.
                            </p>        
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="enam" role="tabpanel" aria-labelledby="enam-tab">
                            <div class="p-6 bg-blue-50 rounded-lg space-y-6">
                                <!-- Title -->
                                <div>
                                    <h2 class="text-lg font-bold">KEWAJIBAN PEMBAYARAN</h2>
                                    <p class="mt-2">Saya menyatakan setuju baik sebagai wali atau sebagai pasien, bahwa sesuai pertimbangan pelayanan yang diberikan kepada pasien, maka saya wajib untuk membayar total biaya pelayanan dengan cara bayar:</p>
                                </div>

                                <!-- Payment Method -->
                                <div class="space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="cara_bayar" value="tunai" class="form-radio text-blue-600">
                                        <span class="ml-2">Tunai</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="cara_bayar" value="asuransi" class="form-radio text-blue-600">
                                        <span class="ml-2">Pembiayaan Asuransi Kesehatan</span>
                                    </label>
                                </div>

                                <!-- Terms and Agreement -->
                                <div>
                                    <p class="mt-2">Saya telah membaca dan sepenuhnya dengan setiap pernyataan yang terdapat pada formulir ini dan menandatangani tanpa paksaan dan dengan kesadaran penuh</p>
                                </div>

                                <!-- Signature Section -->
                                <div class="grid grid-cols-2 gap-6">
                                    <!-- Signature Field -->
                                    <div>
                                        <label class="block font-semibold mb-2">TANDA TANGAN PENANGGUNG JAWAB SEBAGAI :</label>
                                        <div class="border border-gray-300 p-4 bg-white rounded-lg">
                                            <canvas id="signature-pad-penanggung" class="signature-pad w-full h-48 border"></canvas>
                                            <input type="hidden" name="signature_penanggung" id="signature_penanggung">
                                            <button type="button" id="clear-penanggung" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Clear</button>
                                        </div>
                                    </div>

                                    <!-- Officer Signature Field -->
                                    <div>
                                        <label class="block font-semibold mb-2">TANDA TANGAN PETUGAS</label>
                                        <div class="border border-gray-300 p-4 bg-white rounded-lg">
                                            <canvas id="signature-pad-petugas" class="signature-pad w-full h-48 border"></canvas>
                                            <input type="hidden" name="signature_petugas" id="signature_petugas">
                                            <button type="button" id="clear-petugas" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Clear</button>
                                        </div>
                                        <div class="mt-2">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file TTD</label>
                                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit and Upload Buttons -->
                                <hr>
                                <div class="flex justify-end space-x-4">
                                    <a href="#" id="cetak-pdf" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                        Cetak PDF
                                    </a> 
                                    <button id="save" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Simpan Data Dan Lanjutkan Ke Kunjungan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection()?>
<?=$this->section('js')?>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    var canvasPenanggung = document.getElementById('signature-pad-penanggung');
    var signaturePadPenanggung = new SignaturePad(canvasPenanggung);

    var canvasPetugas = document.getElementById('signature-pad-petugas');
    var signaturePadPetugas = new SignaturePad(canvasPetugas);
    // Clear Button for Penanggung Jawab
    document.getElementById('clear-penanggung').addEventListener('click', function () {
        signaturePadPenanggung.clear();
    });

    // Clear Button for Petugas
    document.getElementById('clear-petugas').addEventListener('click', function () {
        signaturePadPetugas.clear();
    });
    var penanggungDataUrl = signaturePadPenanggung.toDataURL();
    var petugasDataUrl = signaturePadPetugas.toDataURL();
    $('#signature_petugas').val(petugasDataUrl);
    $('#signature_penanggung').val(penanggungDataUrl);
    $('#cetak-pdf',).on('click', function () {
        // Get form data
        var formData = $('#form').serialize();

        // Open a new window with the generated URL, appending the form data as query parameters
        window.open('/consent/pdf?' + formData, '_blank');
    })
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Signature Pads
        var canvasPenanggung = document.getElementById('signature-pad-penanggung');
        var signaturePadPenanggung = new SignaturePad(canvasPenanggung);

        var canvasPetugas = document.getElementById('signature-pad-petugas');
        var signaturePadPetugas = new SignaturePad(canvasPetugas);

        // Clear Button for Penanggung Jawab
        document.getElementById('clear-penanggung').addEventListener('click', function () {
            signaturePadPenanggung.clear();
        });

        // Clear Button for Petugas
        document.getElementById('clear-petugas').addEventListener('click', function () {
            signaturePadPetugas.clear();
        });

        // Save Button
        document.getElementById('save').addEventListener('click', function () {
            if (signaturePadPenanggung.isEmpty() || signaturePadPetugas.isEmpty()) {
                alert('Tanda tangan belum lengkap.');
                return;
            }

            // Convert signatures to data URLs
            var penanggungDataUrl = signaturePadPenanggung.toDataURL();
            var petugasDataUrl = signaturePadPetugas.toDataURL();
            $('#signature_petugas').val(petugasDataUrl);
            $('#signature_penanggung').val(penanggungDataUrl);
            console.log('Penanggung Jawab Signature:', penanggungDataUrl);
            console.log('Petugas Signature:', petugasDataUrl);

            // Send the data URLs to the server or store them as needed
            // You can send them via an AJAX request or as part of a form submission
        });
    });

</script>
<?=$this->endSection()?>

