<?=$this->extend('layouts/app')?>
<?=$this->section('js')?>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
    var canvasDokter = document.getElementById('signature-pad-dokter');
    var signaturePadDokter = new SignaturePad(canvasDokter);
    document.getElementById('clear-dokter').addEventListener('click', function () {
        signaturePadDokter.clear();
    });
    var DokterDataUrl = signaturePadDokter.toDataURL();
    $('#signature_dokter').val(DokterDataUrl);
</script>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="p-4 sm:ml-64 h-screen">
    <div class="p-4 mt-14">
        <div class="head lg:flex grid grid-cols-1 justify-between w-full">
            <div class="heading flex-auto">
                <p class="text-blue-950 font-sm text-xs">
                    Pemeriksaan
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
                        <a href="<?=base_url('pemeriksaan-lab')?>" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Pemeriksaan Lab</a>
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
            <form action="<?= base_url('pemeriksaan-lab/create/store') ?>" method="POST" class="w-full mx-auto space-y-4" enctype="multipart/form-data">
                <input type="text" name="id_kunjungan" value="<?= $data['id'] ?>" hidden>
                <div class="grid grid-cols-2 gap-3">
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Pemeriksaan<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan Jenis Pemeriksaaan" name="jenis_pemeriksaan" id="jenis_pemeriksaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                        value="<?= set_value("jenis_pemeriksaan",$data['jenis_pemeriksaaan']) ?>">
                        <div class="text-red-500 text-xs italic font-semibold">
                            <?php if (session("errors.jenis_pemeriksaan")) : ?>
                                <div class="text-red-500 text-sm">
                                    <?= session("errors.jenis_pemeriksaan") ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                  
                </div>
                <hr>
                <?php if($data['jenis_pemeriksaaan'] == 'Klinik Kimia') : ?>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Klinik Kimia + Hematologi -->
                        <?php $no = 1;
                        foreach ($form_isian as $row) : ?>
                            <?php if($row['value'] == 'Gula Darah (GDA)') : ?>
                            <div class="col-span-2 gap-3 mb-3 border p-3">
                                <div class="mb-4">
                                    <h1 class="text-lg font-semibold">Gula Darah (GDA)</h1>
                                   
                                    <hr>
                                </div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="">
                                        <label for="GDA" class="block mb-2 text-sm font-semibold text-gray-900">
                                            GDA<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan GDA" 
                                            name="gda" id="gda" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('gda') ?>">
                                        <small class="text-red-500">Nilai Normal : < 150</small>
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.gda")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.gda") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="BSN" class="block mb-2 text-sm font-semibold text-gray-900">
                                            BSN<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan BSN" 
                                            name="bsn" id="bsn" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('bsn') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.bsn")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.bsn") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="2JPP" class="block mb-2 text-sm font-semibold text-gray-900">
                                        2JPP<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan 2JPP" 
                                            name="jpp" id="jpp" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('jpp') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.jpp")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.jpp") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else :?>
                                <div class="">
                                    <label for="<?=$row['nama']?>" class="block mb-2 text-sm font-semibold text-gray-900">
                                        <?=$row['value']?><span class="me-2 text-red-500">*</span>
                                    </label>
                                    <input type="text" placeholder="Masukkan <?=$row['value']?>" 
                                        name="<?=$row['nama']?>" id="<?=$row['value']?>" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value($row['nama']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors." . $row['nama'])) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors." . $row['nama']) ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </div>
                <?php elseif($data['jenis_pemeriksaaan'] == 'Imonologi') : ?>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Klinik Kimia + Hematologi -->
                        <?php $no = 1;
                        foreach ($form_isian as $row) : ?>
                            <?php if ($row['value'] == 'Golongan Darah') : ?>
                                <div class="">
                                    <label for="<?=$row['nama']?>" class="block mb-2 text-sm font-semibold text-gray-900">
                                        <?=$row['value']?><span class="me-2 text-red-500">*</span>
                                    </label>
                                    <input type="text" placeholder="Masukkan <?=$row['value']?>" 
                                        name="<?=$row['nama']?>" id="<?=$row['value']?>" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value($row['nama']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors." . $row['nama'])) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors." . $row['nama']) ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                    <?php if($row['value'] == 'HbsAg' || $row['value'] == 'Sifilis' || $row['value'] == 'HIV') : ?>
                                        <div class="">
                                            <label for="" class="block mb-2 text-sm font-semibold text-gray-900"><?=$row['value']?><span class="me-2 text-red-500">*</span></label>
                                            <select name="<?=$row['nama']?>" id="<?=$row['nama']?>"  class="w-full border border-gray-300 rounded p-2">
                                                <option> -- Pilih -- </option>
                                                <option value="Reaktif">Reaktif</option>
                                                <option value="Non Reaktif">Non Reaktif</option>
                                            </select>
                                            <div class="text-red-500 text-xs italic font-semibold">
                                                <?php if (session("errors.".$row['nama'])) : ?>
                                                    <div class="text-red-500 text-sm">
                                                        <?= session("errors".$row['nama']) ?>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <?php if($row['value'] == 'WIDAL') : ?>
                                            <div class="col-span-2 gap-3 mb-3 border p-3">
                                                <div class="mb-4">
                                                    <h1 class="text-lg font-semibold">WIDAL</h1>
                                                    <hr>
                                                </div>
                                                <div class="grid grid-cols-2 gap-3">
                                                    <div class="">
                                                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Thypi O<span class="me-2 text-red-500">*</span></label>
                                                        <select name="salmonella_o" id="salmonella_o"  class="w-full border border-gray-300 rounded p-2">
                                                            <option> -- Pilih -- </option>
                                                            <option value="Positif"> Positif  </option>
                                                            <option value="Negatif"> Negatif  </option>
                                                        </select>
                                                        <div class="text-red-500 text-xs italic font-semibold">
                                                            <?php if (session("errors.salmonella_o")) : ?>
                                                                <div class="text-red-500 text-sm">
                                                                    <?= session("errors.salmonella_o") ?>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Thypi H<span class="me-2 text-red-500">*</span></label>
                                                        <select name="salmonella_h" id="salmonella_h"  class="w-full border border-gray-300 rounded p-2">
                                                            <option> -- Pilih -- </option>
                                                            <option value="Positif"> Positif  </option>
                                                            <option value="Negatif"> Negatif  </option>
                                                        </select>
                                                    
                                                        <div class="text-red-500 text-xs italic font-semibold">
                                                            <?php if (session("errors.salmonella_h")) : ?>
                                                                <div class="text-red-500 text-sm">
                                                                    <?= session("errors.salmonella_h") ?>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Parathypi A<span class="me-2 text-red-500">*</span></label>
                                                        <select name="parathypi_a" id="parathypi_a"  class="w-full border border-gray-300 rounded p-2">
                                                            <option> -- Pilih -- </option>
                                                            <option value="Positif"> Positif  </option>
                                                            <option value="Negatif"> Negatif  </option>
                                                        </select>
                                                        <div class="text-red-500 text-xs italic font-semibold">
                                                            <?php if (session("errors.parathypi_a")) : ?>
                                                                <div class="text-red-500 text-sm">
                                                                    <?= session("errors.parathypi_a") ?>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Salmonella Parathypi B<span class="me-2 text-red-500">*</span></label>
                                                        <select name="parathypi_b" id="parathypi_b"  class="w-full border border-gray-300 rounded p-2">
                                                            <option> -- Pilih -- </option>
                                                            <option value="Positif"> Positif  </option>
                                                            <option value="Negatif"> Negatif  </option>
                                                        </select>
                                                    
                                                        <div class="text-red-500 text-xs italic font-semibold">
                                                            <?php if (session("errors.parathypi_b")) : ?>
                                                                <div class="text-red-500 text-sm">
                                                                    <?= session("errors.parathypi_b") ?>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php else :?>
                                        <div class="">
                                            <label for="" class="block mb-2 text-sm font-semibold text-gray-900"><?=$row['value']?><span class="me-2 text-red-500">*</span></label>
                                            <select name="<?=$row['nama']?>" id="<?=$row['nama']?>"  class="w-full border border-gray-300 rounded p-2">
                                                <option> -- Pilih -- </option>
                                                <option value="Negatif"> Negatif </option>
                                                <option value="Positif"> Positif </option>
                                            </select>
                                            <div class="text-red-500 text-xs italic font-semibold">
                                                <?php if (session("errors.".$row['nama'])) : ?>
                                                    <div class="text-red-500 text-sm">
                                                        <?= session("errors".$row['nama']) ?>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <?php endif;?>
                                        
                                    <?php endif;?>
                                
                                   
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php elseif($data['jenis_pemeriksaaan'] == 'Urine') : ?>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Klinik Kimia + Hematologi -->
                        <?php $no = 1;
                        foreach ($form_isian as $row) : ?>
                            <div class="">
                                <label for="<?=$row['nama']?>" class="block mb-2 text-sm font-semibold text-gray-900">
                                    <?=$row['value']?><span class="me-2 text-red-500">*</span>
                                </label>
                                <input type="text" placeholder="Masukkan <?=$row['value']?>" 
                                    name="<?=$row['value']?>" id="<?=$row['value']?>" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value($row['value']) ?>">
                                <div class="text-red-500 text-xs italic font-semibold">
                                    <?php if (session("errors." . $row['value'])) : ?>
                                        <div class="text-red-500 text-sm">
                                            <?= session("errors." . $row['value']) ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif($data['jenis_pemeriksaaan'] == 'Microbiologi') : ?>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Fases Lengkap -->
                        <?php $no = 1;
                        foreach ($form_isian as $row) : ?>
                            <?php if($row['value'] == 'Fases Lengkap') : ?>
                            <div class="col-span-2 gap-3 mb-3 border p-3">
                                <div class="mb-4">
                                    <h1 class="text-lg font-semibold">Fases Lengkap</h1>
                                    <hr>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <!-- Faces -->
                                    <div class="border p-3">
                                        <div class="cols-span-2 w-full bg-gray-50 rounded-lg border border-gray-200">
                                            <span class="block mb-2 text-sm font-semibold text-gray-900">MIKROSKOPIS</span>
                                        </div>
                                        <div class="grid grid-cols-1 gap-3">
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Konsistensi<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Konsistensi" name="konsistensi" id="konsistensi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("konsistensi") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.konsistensi")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.konsistensi") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Warna<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Warna" name="warna" id="warna" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("warna") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.warna")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.warna") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Bau<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Bau" name="bau" id="bau" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("bau") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.bau")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.bau") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Darah<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Darah" name="darah" id="darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("darah") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.darah")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.darah") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Lendir<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Lendir" name="lendir" id="lendir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("lendir") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.lendir")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.lendir") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border p-3">
                                        <div class="cols-span-2 w-full bg-gray-50 rounded-lg border border-gray-200">
                                            <span class="block mb-2 text-sm font-semibold text-gray-900">MAKROSKOPIS</span>
                                        </div>
                                        <div class="grid grid-cols-1 gap-3">
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Eritrosit<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Eritrosit" name="eritrosit" id="eritrosit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("eritrosit") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.eritrosit")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.eritrosit") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Lekosit<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Lekosit" name="lekosit" id="lekosit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("lekosit") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.lekosit")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.lekosit") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Telur Cacing<span class="me-2 text-red-500">*</span></label>
                                                <input type="text" placeholder="Masukkan Telur Cacing" name="telur_cacing" id="telur_cacing" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                value="<?= set_value("telur_cacing") ?>">
                                                <div class="text-red-500 text-xs italic font-semibold">
                                                    <?php if (session("errors.telur_cacing")) : ?>
                                                        <div class="text-red-500 text-sm">
                                                            <?= session("errors.telur_cacing") ?>
                                                        </div>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else :?>
                                <div class="">
                                    <label for="<?=$row['nama']?>" class="block mb-2 text-sm font-semibold text-gray-900">
                                        <?=$row['value']?><span class="me-2 text-red-500">*</span>
                                    </label>
                                    <select name="<?=$row['nama']?>" id="<?=$row['nama']?>"  class="w-full border border-gray-300 rounded p-2">
                                        <option> -- Pilih -- </option>
                                        <option value="Negatif"> Negatif </option>
                                        <option value="Positif"> Positif </option>
                                    </select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors." . $row['nama'])) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors." . $row['nama']) ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </div>
                <?php elseif($data['jenis_pemeriksaaan'] == 'Hematologi') : ?>
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Klinik Kimia + Hematologi -->
                        <?php $no = 1;
                        foreach ($form_isian as $row) : ?>
                            <?php if($row['value'] == 'Darah lengkap') : ?>
                            <div class="col-span-2 gap-3 mb-3 border p-3">
                                <div class="mb-4">
                                    <h1 class="text-lg font-semibold">Darah lengkap</h1>
                                    <hr>
                                </div>
                                <div class="grid grid-cols-3 gap-3">
                                    <div class="">
                                        <label for="GDA" class="block mb-2 text-sm font-semibold text-gray-900">
                                            Hemoglobin (Hb)<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan Hemoglobin (Hb)" 
                                            name="hemoglobin" id="hemoglobin" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('hemoglobin') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.hemoglobin")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.hemoglobin") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="Hematokrit" class="block mb-2 text-sm font-semibold text-gray-900">
                                            Hematokrit<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan Hematokrit" 
                                            name="hematokrit" id="hematokrit" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('hematokrit') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.hematokrit")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.hematokrit") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="Hitung Eritrosit" class="block mb-2 text-sm font-semibold text-gray-900">
                                        Hitung Eritrosit<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan Hitung Eritrosit" 
                                            name="hitung_eritrosit" id="hitung_eritrosit" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('hitung_eritrosit') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.hitung_eritrosit")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.hitung_eritrosit") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="Hitung Leukosit" class="block mb-2 text-sm font-semibold text-gray-900">
                                        Hitung Leukosit<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan Hitung Leukosit" 
                                            name="hitung_leukosit" id="hitung_leukosit" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('hitung_leukosit') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.hitung_leukosit")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.hitung_leukosit") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="Hitung Trombosit" class="block mb-2 text-sm font-semibold text-gray-900">
                                        Hitung Trombosit<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan Hitung Trombosit" 
                                            name="hitung_trombosit" id="hitung_trombosit" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('hitung_trombosit') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.hitung_trombosit")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.hitung_trombosit") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                    <div class="">
                                        <label for="Diff Count" class="block mb-2 text-sm font-semibold text-gray-900">
                                        Diff Count<span class="me-2 text-red-500">*</span>
                                        </label>
                                        <input type="text" placeholder="Masukkan Diff Count" 
                                            name="diff_count" id="diff_count" 
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                            value="<?= set_value('diff_count') ?>">
                                        <div class="text-red-500 text-xs italic font-semibold">
                                            <?php if (session("errors.diff_count")) : ?>
                                                <div class="text-red-500 text-sm">
                                                    <?= session("errors.diff_count") ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else :?>
                                <div class="">
                                    <label for="<?=$row['nama']?>" class="block mb-2 text-sm font-semibold text-gray-900">
                                        <?=$row['value']?><span class="me-2 text-red-500">*</span>
                                    </label>
                                    <input type="number" placeholder="Masukkan <?=$row['value']?>" 
                                        name="<?=$row['nama']?>" id="<?=$row['value']?>" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value($row['nama']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors." . $row['nama'])) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors." . $row['nama']) ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <span>Pemeriksaan Lab Tidak Ditemukan</span>
                <?php endif; ?>
                <!-- Tanda Tangan Dokter -->
                <div class="border p-3 rounded-md shadow-md mt-3">
                    <h2 class="text-lg font-bold mb-4">Tanda Tangan Petugas Lab</h2>
                    <div class="border border-gray-300 p-4 bg-white rounded-lg">
                        <canvas id="signature-pad-dokter" class="signature-pad w-full h-48 border"></canvas>
                        <input type="hidden" name="signature_dokter" id="signature_dokter">
                        <button type="button" id="clear-dokter" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Clear</button>
                    </div>
                    <div class="border mt-3">
                        <input type="file" name="tanda_tangan_dokter" class="w-full border border-gray-300 rounded p-2 mt-2">
                        <button class="bg-orange-500 text-white rounded p-2 mt-4 w-full">Upload</button>
                    </div>
                </div>
                <div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md mt-4">
                    <div>
                        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Simpan</button>
                    </div>
                    <div>
                        <button class="bg-white text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" type="reset">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?=$this->endSection()?>