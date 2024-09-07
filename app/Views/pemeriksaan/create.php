<?=$this->extend('layouts/app')?>
<?=$this->section('js')?>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($('input[name="skala_nyeri"]:checked').val() == 'anak') {
                $('.tingkat_nyeri_anak-show').removeClass('hidden')
                $('.tingkat_nyeri_dewasa-show').addClass('hidden')
            }else{
                $('.tingkat_nyeri_dewasa-show').removeClass('hidden')
                $('.tingkat_nyeri_anak-show').addClass('hidden')
            }

            $('input[name="skala_nyeri"]').on('change', function() {
                if ($('input[name="skala_nyeri"]:checked').val() == 'anak') {
                    $('.tingkat_nyeri_anak-show').removeClass('hidden')
                    $('.tingkat_nyeri_dewasa-show').addClass('hidden')
                }else{
                    $('.tingkat_nyeri_dewasa-show').removeClass('hidden')
                    $('.tingkat_nyeri_anak-show').addClass('hidden')
                }
            })
        })

        $('#tingkat_nyeri_anak').on('keyup', function() {
            // Skala Nyeri Anak : 0 (Tidak Nyeri) 2 (Sedikit Nyeri) 4 (Cukup Nyeri) 6 (Lumayan Nyeri) 8 (Sangat Nyeri) 10 (Sangat Amat Nyeri)
            let value = parseInt($(this).val());
            let hasil_text = ''
            if (isNaN(value)) {
                value = 0;
            }else{
                if (value > 0 && value < 2) {
                    hasil_text = 'Tidak Nyeri';
                }else if(value > 2 && value < 4) {
                    hasil_text = 'Sedikit Nyeri';
                }else if(value > 4 && value < 6) {
                    hasil_text = 'Cukup Nyeri';
                }else if(value > 6 && value < 8) {
                    hasil_text = 'Lumayan Nyeri';
                }else if(value > 8 && value < 10) {
                    hasil_text = 'Sangat Nyeri';
                }else if(value >= 10) {
                    hasil_text = 'Sangat Amat Nyeri';
                }else{
                    hasil_text = 'Tidak Ditemukan';
                }
            }

            $('#jenis_nyeri_anak').val(hasil_text);
        })
        $('#tingkat_nyeri_dewasa').on('keyup', function() {
            let value = parseInt($(this).val());
            let hasil_text = ''
            if (isNaN(value)) {
                value = 0;
            }else{
                if (value > 0 && value < 1) {
                    hasil_text = 'Tidak Nyeri';
                }else if(value > 1 && value < 3) {
                    hasil_text = 'Nyeri Ringan';
                }else if(value > 4 && value < 7) {
                    hasil_text = 'Nyeri Sedang';
                }else if(value > 8 && value < 10) {
                    hasil_text = 'Nyeri Berat';
                }else{
                    hasil_text = 'Tidak Ditemukan';
                }
            }

            $('#jenis_nyeri_dewasa').val(hasil_text);
        })
        // Skala Nyeri Dewasa : 0 (Tidak Nyeri) 1-3 (Nyeri Ringan) 4-7 (Nyeri Sedang) 8-10 (Nyeri Berat) 
        function toggleSelect(element, selectId) {
            const select = document.getElementById(selectId);
            if (element.checked) {
                select.classList.remove('hidden');
            } else {
                select.classList.add('hidden');
            }
        }
        function calculateScore() {
            let totalScore = 0;

            // Get selected radio buttons
            const bbRadio = document.querySelector('input[name="bb"]:checked');
            const appetiteRadio = document.querySelector('input[name="appetite"]:checked');
            const conditionRadio = document.querySelector('input[name="condition"]:checked');

            // Add scores from the first question (weight loss)
            if (bbRadio) {
                if (bbRadio.value === "1") {
                const bbSelect = document.querySelector('#bb-options select');
                totalScore += parseInt(bbSelect.value);
                } else {
                totalScore += parseInt(bbRadio.value);
                }
            }

            // Add scores from the second question (appetite loss)
            if (appetiteRadio) {
                totalScore += parseInt(appetiteRadio.value);
            }

            // Add scores from the third question (underlying condition)
            if (conditionRadio) {
                totalScore += parseInt(conditionRadio.value);
            }

            // Update total score display
            document.getElementById('total-score').textContent = totalScore;
        }
        function calculateScoreAnak(){
            let totalScore = 0;

            // Get selected radio buttons
            const bbRadio = document.querySelector('input[name="bb_anak"]:checked');
            const appetiteRadio = document.querySelector('input[name="bb_penurunan_anak"]:checked');
            const conditionRadio = document.querySelector('input[name="condition_anak"]:checked');

            // Add scores from the first question (weight loss)
            // if (bbRadio) {
            //     if (bbRadio.value === "1") {
            //     const bbSelect = document.querySelector('#bb-options select');
            //     totalScore += parseInt(bbSelect.value);
            //     } else {
            //     totalScore += parseInt(bbRadio.value);
            //     }
            // }
            if (bbRadio) {
                totalScore += parseInt(bbRadio.value);
            }
            // Add scores from the second question (appetite loss)
            if (appetiteRadio) {
                totalScore += parseInt(appetiteRadio.value);
            }

            // Add scores from the third question (underlying condition)
            if (conditionRadio) {
                totalScore += parseInt(conditionRadio.value);
            }

            // Update total score display
            document.getElementById('total-score-anak').textContent = totalScore;
        }

        $('#berat_badan').on('keyup', function() { 
            calculateMT()
        })

        $('#tinggi_badan').on('keyup', function() { 
            calculateMT()
        })
          
        function calculateMT(){
            let value_berat = parseInt($('input[name="berat_badan"]').val());
            let value_tinggi = parseInt($('input[name="tinggi_badan"]').val());
            let value = value_berat / ((value_tinggi / 100) * (value_tinggi / 100));
            
            $('input[name="hasil_bt"]').val(parseFloat(value).toFixed(2));
        }
    </script>
    <script>
        var canvasPerawat = document.getElementById('signature-pad-perawat');
        var signaturePadPerawat = new SignaturePad(canvasPerawat);
        document.getElementById('clear-perawat').addEventListener('click', function () {
            signaturePadPerawat.clear();
        });
        var PerawatDataUrl = signaturePadPerawat.toDataURL();
        $('#signature_perawat').val(PerawatDataUrl);
    </script>
    <script>
        $(document).ready(function() {
            let currentStep = 1;

            function showStep(step) {
                // Hide all steps
                $("#tahap-1, #tahap-2, #tahap-3, #tahap-4").hide();

                // Show the current step
                $(`#tahap-${step}`).show();

                // Update button visibility
                if (step === 1) {
                $("#prevBtn").hide();
                $("#nextBtn").show();
                $("#saveBtn").hide();
                } else if (step === 4) {
                $("#prevBtn").show();
                $("#nextBtn").hide();
                $("#saveBtn").show();
                } else {
                $("#prevBtn").show();
                $("#nextBtn").show();
                $("#saveBtn").hide();
                }
            }

            $("#nextBtn").click(function() {
                if (currentStep < 4) {
                currentStep++;
                showStep(currentStep);
                }
            });

            $("#prevBtn").click(function() {
                if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
                }
            });

            // Initialize the first step
            showStep(currentStep);
        });

    </script>
<?=$this->endSection()?>
<?=$this->section('content')?>
<div class="p-4 sm:ml-64 h-screen">
    <div class="p-4 mt-14">
        <div class="head lg:flex grid grid-cols-1 justify-between w-full">
            <div class="heading flex-auto">
                <p class="text-blue-950 font-sm text-xs">
                    Pemeriksaaan
                </p>
                <h2 class="font-bold tracking-tighter text-2xl text-theme-text">
                    <?=esc($title)?>
                </h2>
            </div>
        </div>
        <div class="card bg-white p-5 mt-4 border rounded-md w-full relative">
            <div class="border p-3">
                <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                    <span class="font-semibold text-white uppercase">Identitas Pasien</span>
                </div>
                <input type="hidden" name="id" value="<?= $pasien['id'] ?>">
                <div class="grid grid-cols-2 gap-3">
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">No. RM<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan NO. RM" name="no_rm" id="no_rm" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("no_rm",$pasien['no_rm']) ?>">
                    </div>
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">No. NIK<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan NO. NIK" name="no_nik" id="no_nik" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("no_nik",$pasien['nik']) ?>">
                    </div>
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Pasien<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan Jenis Pasien" name="jenis_pasien" id="jenis_pasien" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("jenis_pasien",$pasien['jenis_pasien']) ?>">
                    </div>
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">No. BPJS<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan NO. BPJS" name="no_bpjs" id="no_bpjs" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("no_bpjs",$pasien['no_bpjs']) ?>">
                    </div>
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Lengkap<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" id="nama_lengkap" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("nama_lengkap",$pasien['nama_lengkap']) ?>">
                    </div>
                  
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tanggal Lahir<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan Tanggal Lahir" name="tgl_lahir" id="tgl_lahir" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("tgl_lahir",$pasien['tanggal_lahir']) ?>">
                    </div>
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Kelamin<span class="me-2 text-red-500">*</span></label>
                        <select id="jenis_kelamin" name="jenis_kelamin"  disabled class="select2 bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option <?= 'L' == set_value("jenis_kelamin",$pasien['jenis_kelamin']) ? "selected" : "" ?> value="L">Laki-Laki</option>
                            <option <?= 'P' == set_value("jenis_kelamin",$pasien['jenis_kelamin']) ? "selected" : "" ?> value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="border p-3 mt-3">
                <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                    <span class="font-semibold text-white uppercase">Form Pemeriksaaan Pasien</span>
                </div>
                
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">S (Subjective)</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">O (Objective)</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">A (Assesment)</button>
                        </li>
                        <li role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">P (Planning)</button>
                        </li>
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <!-- Jenis Keluhan Section -->
                            <div>
                                <div class="mb-2">
                                    <span class="font-semibold">Jenis Keluhan</span>
                                </div>
                                <div class="flex items-center mb-2 space-x-4">
                                    <label class="flex items-center">
                                    <input type="radio" value="Utama" name="jenis_keluhan" class="mr-2"> Utama
                                    </label>
                                    <label class="flex items-center">
                                    <input type="radio" value="Tambahan" name="jenis_keluhan" class="mr-2"> Tambahan
                                    </label>
                                </div>
                                <textarea class="w-full h-20 border border-gray-300 rounded p-2" placeholder="Masukkan data"></textarea>
                               
                            </div>
                            <div>
                                <div class="mb-2">
                                    <span class="font-semibold">Jenis Riwayat Penyakit</span>
                                </div>
                                <div class="flex items-center mb-2 space-x-4">
                                    <label class="flex items-center">
                                    <input type="radio" name="jenis_riwayat" value="Dahulu" class="mr-2"> Dahulu
                                    </label>
                                    <label class="flex items-center">
                                    <input type="radio" name="jenis_riwayat" value="Sekarang" class="mr-2"> Sekarang
                                    </label>
                                    <label class="flex items-center">
                                    <input type="radio" name="jenis_riwayat" value="Keluarga" class="mr-2"> Keluarga
                                    </label>
                                    <label class="flex items-center">
                                    <input type="radio" name="jenis_riwayat" value="Pengobatan" class="mr-2"> Pengobatan
                                    </label>
                                </div>
                                <textarea class="w-full h-20 border border-gray-300 rounded p-2" placeholder="Masukkan data"></textarea>
                              
                            </div>
                        </div>
                        <!-- Faktor Resiko Section -->
                        <div class="mb-4">
                            <div class="bg-blue-900 text-white p-2 w-full">
                                <span class="font-semibold ">Faktor Resiko</span>
                            </div>
                            <hr>
                            <div class="grid grid-cols-2 gap-4 mt-2">
                            <!-- Left column -->
                            <div>
                                <div class="flex items-center mb-2 space-x-4">
                                <span class="font-bold">Merokok : </span>
                                <label class="flex items-center">
                                    <input type="radio" value="Ya" name="merokok" class="mr-2"> Ya
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" value="Tidak" name="merokok" class="mr-2"> Tidak
                                </label>
                                </div>
                                <div class="flex items-center mb-2 space-x-4">
                                <span class="font-bold">Kurang Makan Sayur + Buah : </span>
                                <label class="flex items-center">
                                    <input type="radio" value="Ya" name="kurang_makan" class="mr-2"> Ya
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" value="Tidak" name="kurang_makan" class="mr-2"> Tidak
                                </label>
                                </div>
                                <div class="flex items-center mb-2 space-x-4">
                                <span class="font-bold">Stress :</span>
                                <label class="flex items-center">
                                    <input type="radio" value="Ya" name="stress" class="mr-2"> Ya
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" value="Tidak" name="stress" class="mr-2"> Tidak
                                </label>
                                </div>
                            </div>
                            <!-- Right column -->
                            <div>
                                <div class="flex items-center mb-2 space-x-4">
                                <span class="font-bold">Kurang Aktivitas Fisik : </span>
                                <label class="flex items-center">
                                    <input type="radio" value="Ya" name="aktivitas_fisik" class="mr-2"> Ya
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" value="Tidak" name="aktivitas_fisik" class="mr-2"> Tidak
                                </label>
                                </div>
                                <div class="flex items-center mb-2 space-x-4">
                                <span class="font-bold">Konsumsi Alkohol : </span>
                                <label class="flex items-center">
                                    <input type="radio" value="Ya" name="alkohol" class="mr-2"> Ya
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" value="Tidak" name="alkohol" class="mr-2"> Tidak
                                </label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                        <div class="mb-4">
                            <div class="grid grid-cols-3 gap-4 mb-3" id="tahap-1">
                                <div class="border p-2" >
                                    <!-- PEMERIKSAAN FISIK  -->
                                    <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">PEMERIKSAAN FISIK</div>
                                    <!-- Kondisi Umum -->
                                    <div class="mb-3">
                                        <div class="font-semibold">Kondisi Umum</div>
                                        <div class="flex items-center space-x-4 mt-2">
                                            <label class="flex items-center">
                                                <input type="radio" value="Baik" name="kondisi_umum" class="mr-2"> Baik
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" value="Sedang" name="kondisi_umum" class="mr-2"> Sedang
                                            </label>
                                            <label class="flex items-center">
                                                <input type="radio" value="Lemah" name="kondisi_umum" class="mr-2"> Lemah
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Kesadaran -->
                                    <div class="mb-3">
                                        <div class="font-semibold">Kesadaran</div>
                                        <div class="flex items-center mt-2">
                                            <select name="tipe_kesadaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option> -- Pilih Kesadaran --</option>
                                                <option value="A">A</option>
                                                <option value="V">V</option>
                                                <option value="M">M</option>
                                                <option value="C">C</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Tingkat Kesadaran -->
                                    <div class="mb-3">
                                        <div class="font-semibold">Tingkat Kesadaran</div>
                                        <div class="flex items-center mt-2">
                                        <input type="text" class="border border-gray-300 rounded p-2 w-full" placeholder="Masukkan Data" />
                                        </div>
                                    </div>
                                </div>
                                <div class="border p-2">
                                    <!-- TANDA-TANDA VITAL (TTV)  -->
                                    <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">TANDA-TANDA VITAL (TTV)</div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">Tekanan Darah : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="tekanan_darah" type="text" id="website-admin" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">mmHg</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">Nadi : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="nadi" type="text" id="website-admin" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">x/menit</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">Suhu : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="suhu" type="text" id="website-admin" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">C</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">Respitory Rate (RR) : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="respitory_rate" type="text" id="website-admin" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">x/menit</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">SPO : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="spo" type="text" id="website-admin" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">%</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="border p-2">
                                    <!-- ANTROPOMETRI  -->
                                    <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">ANTROPOMETRI</div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">Berat Badan : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="berat_badan" type="text" id="berat_badan" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">kg</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">Tinggi Badan : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="tinggi_badan" type="text" id="tinggi_badan" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">CM</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">IMT (BB/TB) : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="hasil_bt" type="text" id="hasil_bt" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">Hasil Hitung</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center mb-2 space-x-4">
                                        <div class="w-1/2">
                                            <span class="font-bold">Lingkar Perut : </span>
                                        </div>
                                        <div class="flex w-full">
                                            <input name="lingkar_perut" type="text" id="website-admin" class="rounded-none rounded-s-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Data">
                                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-s-0 border-gray-300 rounded-e-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                                <span class="text-gray-500 dark:text-gray-400">CM</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="grid grid-cols-1 gap-4 mb-3" id="tahap-2" style="display: none;">
                                <div class="border p-2">
                                    <!-- SKALA NYERI  -->
                                    <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">SKALA NYERI</div>
                                    <div class="grid grid-cols-1 gap-4 mb-3">
                                        <div>
                                            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Skala Nyeri</label>
                                            <div class="flex items-center mb-2 space-x-4">
                                                <label class="flex items-center">
                                                    <input type="radio" name="skala_nyeri" class="mr-2" value="anak" checked> Anak Usia > 3 Tahun
                                                </label>
                                                <label class="flex items-center">
                                                    <input type="radio" name="skala_nyeri" value="dewasa" class="mr-2"> Dewasa
                                                </label>
                                            </div>
                                        </div>
                                        <div id="tingkat_nyeri_anak-show" class="tingkat_nyeri_anak-show">
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tingkat Nyeri Anak</label>
                                                <input type="number" min="0" maxlength="2" placeholder="Masukkan Data" value="<?= set_value("tingkat_nyeri_anak") ?>" name="tingkat_nyeri_anak" id="tingkat_nyeri_anak" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            </div>
                                            <div>
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Nyeri (Anak)</label>
                                                <input type="text" placeholder="Masukkan Data" value="<?= set_value("jenis_nyeri_anak") ?>" name="jenis_nyeri_anak" id="jenis_nyeri_anak" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            </div>
                                            <div class="border mt-2 p-2">
                                                <span class="font-medium text-xs text-gray-400">Skala Nyeri Anak : 0 (Tidak Nyeri) 2 (Sedikit Nyeri) 4 (Cukup Nyeri) 6 (Lumayan Nyeri) 8 (Sangat Nyeri) 10 (Sangat Amat Nyeri)</span>
                                            </div>
                                        </div>
                                        <div id="tingkat_nyeri_dewasa-show" class="tingkat_nyeri_dewasa-show hidden">
                                            <div class="mb-2">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Tingkat Nyeri (Dewasa)</label>
                                                <input type="number" min="0" max="10" placeholder="Masukkan Data" value="<?= set_value("tingkat_nyeri_dewasa") ?>" name="tingkat_nyeri_dewasa" id="tingkat_nyeri_dewasa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            </div>
                                            <div>
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Nyeri (Dewasa)</label>
                                                <input type="text" placeholder="Masukkan Data" value="<?= set_value("jenis_nyeri_dewasa") ?>" name="jenis_nyeri_dewasa" id="jenis_nyeri_dewasa" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            </div>
                                            <div class="border mt-2 p-2">
                                                <span class="font-medium text-xs text-gray-400">Skala Nyeri Dewasa : 0 (Tidak Nyeri) 1-3 (Nyeri Ringan) 4-7 (Nyeri Sedang) 8-10 (Nyeri Berat) </span>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Lokasi Nyeri</label>
						                    <input type="text" placeholder="Masukkan Data" value="<?= set_value("lokasi_nyeri") ?>" name="lokasi_nyeri" id="lokasi_nyeri" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        </div>
                                        <div>
                                            <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Rasa Nyeri</label>
                                            <div class="flex items-center flex-wrap space-y-2 mt-2">
                                                <div class="mt-2">
                                                    <label class="flex items-center mr-4">
                                                    <input type="radio" name="rasa_nyeri" value="Tajam" class="mr-2"> Tajam
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="flex items-center mr-4">
                                                    <input type="radio" value="Nyeri Tumpul" name="rasa_nyeri" class="mr-2"> Nyeri Tumpul
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="flex items-center mr-4">
                                                    <input type="radio" value="Nyeri Ditekan" name="rasa_nyeri" class="mr-2"> Nyeri Ditekan
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="flex items-center mr-4">
                                                    <input type="radio" value="Nyeri Terus" name="rasa_nyeri" class="mr-2"> Nyeri Terus-Menerus
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="flex items-center mr-4">
                                                    <input type="radio" value="Nyeri Berdenyut" name="rasa_nyeri" class="mr-2"> Nyeri Berdenyut
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="flex items-center mr-4">
                                                    <input type="radio" value="Nyeri Kram" name="rasa_nyeri" class="mr-2"> Nyeri Kram
                                                    </label>
                                                </div>
                                                <div>
                                                    <label class="flex items-center">
                                                    <input type="radio" value="Nyeri Dilema" name="rasa_nyeri" class="mr-2"> Nyeri Dilema
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2 mt-2">MALNUTRITION SCREEN TOOLS TEST (MST)</div>
                                        <div id="tingkat_nyeri_anak-show" class="tingkat_nyeri_anak-show">
                                            <!-- Question 1 -->
                                            <div class="mb-4 border p-3">
                                                <div class="mb-4">
                                                    <label class="block font-semibold mb-2">1. Apakah pasien tampak kurus?</label>
                                                    <div class="space-y-2">
                                                        <label class="flex items-center">
                                                        <input type="radio" name="bb_anak" value="0" class="mr-2" onclick="calculateScoreAnak()"> 
                                                        Ya (Skor 0)
                                                        </label>
                                                        <label class="flex items-center">
                                                        <input type="radio" name="bb_anak" value="1" class="mr-2" onclick="calculateScoreAnak()"> 
                                                        Tidak (Skor 1)
                                                        </label>
                                                       
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-4">
                                                    <label class="block font-semibold mb-2">2. Apakah terdapat penurunan BB selama 1 bulan terakhir?</label>
                                                    <span>Berdasarkan penilaian obyektif data BB di KMS/pernyataaan obyektif orang tua pasien</span>
                                                    <label class="block font-semibold mb-2">Atau untuk bayi < 1 tahun, apakah BB tidak naik selama 3 bulan terakhir?</label>
                                                    <div class="space-y-2">
                                                        <label class="flex items-center">
                                                        <input type="radio" name="bb_penurunan_anak" value="0" class="mr-2" onclick="calculateScoreAnak()"> 
                                                        Ya (Skor 0)
                                                        </label>
                                                        <label class="flex items-center">
                                                        <input type="radio" name="bb_penurunan_anak" value="1" class="mr-2" onclick="calculateScoreAnak()"> 
                                                        Tidak (Skor 1)
                                                        </label>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Question 3 -->
                                            <div class="mb-4">
                                                <label class="block font-semibold mb-2">3. Apakah terdapat salah satu dari kondisi tersebut ?</label>
                                                <span class="mb-2">Diare > 5x/hari dan /atau muntah > 3x/hari dalam seminggu terakhir</span>
                                                <span class="mb-2">Asupan makanan berkurang 1 minggu terakhir </span>
                                                <div class="space-y-2">
                                                    <label class="flex items-center">
                                                    <input type="radio" name="condition_anak" value="0" class="mr-2" onclick="calculateScoreAnak()"> 
                                                    Ya (Skor 0)
                                                    </label>
                                                    <label class="flex items-center">
                                                    <input type="radio" name="condition_anak" value="1" class="mr-2" onclick="calculateScoreAnak()"> 
                                                    Tidak (Skor 1)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="border bg-gray-200 p-2 w-full">
                                                <div class="flex items-center">
                                                    <label class="font-bold mr-4">TOTAL SKOR: </label>
                                                    <span id="total-score-anak" class="text-lg font-semibold">0</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="tingkat_nyeri_dewasa-show" class="tingkat_nyeri_dewasa-show hidden">
                                            <!-- Question 1 -->
                                            <div class="mb-4 border p-3">
                                                <div class="mb-4">
                                                    <label class="block font-semibold mb-2">1. Apakah pasien mengalami penurunan BB yang tidak diinginkan selama 6 bulan terakhir?</label>
                                                    <div class="space-y-2">
                                                        <label class="flex items-center">
                                                        <input type="radio" name="bb" value="0" class="mr-2" onclick="calculateScore()"> 
                                                        Tidak ada penurunan BB (Skor 0)
                                                        </label>
                                                        <label class="flex items-center">
                                                        <input type="radio" name="bb" value="0" class="mr-2" onclick="calculateScore()"> 
                                                        Tidak Yakin/Tidak Tahu/Baju Terasa Longgar (Skor 0)
                                                        </label>
                                                        <label class="flex items-center">
                                                        <input type="radio" name="bb" value="1" class="mr-2" onclick="toggleSelect(this, 'bb-options'); calculateScore()"> 
                                                        Ya, BB turun :
                                                        </label>
                                                        <div id="bb-options" class="hidden ml-6">
                                                        <select class="border border-gray-300 rounded p-2" onchange="calculateScore()">
                                                            <option value="1">1 - 5 kg (Skor 1)</option>
                                                            <option value="2">6 - 10 kg (Skor 2)</option>
                                                            <option value="3">11 - 15 kg (Skor 3)</option>
                                                            <option value="4">> 15 kg (Skor 4)</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <!-- Question 2 -->
                                                <div class="mb-4">
                                                <label class="block font-semibold mb-2">2. Apakah asupan makanan berkurang karena tidak ada nafsu makan?</label>
                                                <div class="space-y-2">
                                                    <label class="flex items-center">
                                                    <input type="radio" name="appetite" value="1" class="mr-2" onclick="calculateScore()"> 
                                                    Ya (Skor 1)
                                                    </label>
                                                    <label class="flex items-center">
                                                    <input type="radio" name="appetite" value="0" class="mr-2" onclick="calculateScore()"> 
                                                    Tidak (Skor 0)
                                                    </label>
                                                </div>
                                                </div>
                                            </div>
                                             <!-- Question 3 -->
                                            <div class="mb-4">
                                                <label class="block font-semibold mb-2">3. Apakah terdapat penyakit atau keadaan yang mengakibatkan pasien beresiko mengalami malnutrisi?</label>
                                                <p class="text-sm">(DM/CKD/Infeksi Kronis/Gangguan Fungsi Tiroid/Kanker/Lainnya)</p>
                                                <div class="space-y-2">
                                                    <label class="flex items-center">
                                                    <input type="radio" name="condition" value="2" class="mr-2"> 
                                                    Ya (Skor 2)
                                                    </label>
                                                    <label class="flex items-center">
                                                    <input type="radio" name="condition" value="0" class="mr-2"> 
                                                    Tidak (Skor 0)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="border bg-gray-200 p-2 w-full">
                                                <div class="flex items-center">
                                                    <label class="font-bold mr-4">TOTAL SKOR: </label>
                                                    <span id="total-score" class="text-lg font-semibold">0</span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="grid grid-cols-1 gap-4 mb-3" id="tahap-3" style="display: none;">
                                <div class="border p-2">
                                    <!-- STATUS GENERALIS  -->
                                    <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">STATUS GENERALIS</div>
                                    <div class="grid grid-cols-3 gap-4 mb-4">
                                        <div>
                                            <label for="kepala" class="block text-sm font-medium text-gray-700">Kepala/Leher</label>
                                            <input type="text" placeholder="Masukkan Data" id="kepala" name="kepala" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="thorax" class="block text-sm font-medium text-gray-700">Thorax</label>
                                            <input type="text" placeholder="Masukkan Data" id="thorax" name="thorax" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="abdomen" class="block text-sm font-medium text-gray-700">Abdomen</label>
                                            <input type="text" placeholder="Masukkan Data" id="abdomen" name="abdomen" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="ekstremitas" class="block text-sm font-medium text-gray-700">Ekstremitas</label>
                                            <input type="text" placeholder="Masukkan Data" id="ekstremitas" name="ekstremitas" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <label for="lainnya" class="block text-sm font-medium text-gray-700">Lainnya</label>
                                            <input type="text" placeholder="Masukkan Data" id="lainnya" name="lainnya" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <div class="grid grid-cols-1 gap-4 mb-3" id="tahap-4" style="display: none;">
                                <div class="border p-2">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <!-- STATUS PSIKOSOSIOSPIRITUAL  -->
                                            <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">STATUS PSIKOSOSIOSPIRITUAL</div>
                                            <div class="mb-3">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Status Mental</label>
                                                <select id="status_mental" name="status_mental" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option disabled hidden selected value=""> -- Pilih Status Mental --</option>
                                                    <option <?= 'Orientasi Baik' == set_value("status_mental") ? "selected" : "" ?> value="Orientasi Baik">Orientasi Baik</option>
                                                    <option <?= 'Disorientasi' == set_value("status_mental") ? "selected" : "" ?> value="Disorientasi">Disorientasi</option>
                                                    <option <?= 'Gelisah' == set_value("status_mental") ? "selected" : "" ?> value="Gelisah">Gelisah</option>
                                                    <option <?= 'Tidak Respon' == set_value("status_mental") ? "selected" : "" ?> value="Tidak Respon">Tidak Respon</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Respon Emosi</label>
                                                <select id="respon_emosi" name="respon_emosi" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option disabled hidden selected value=""> -- Pilih Respon Emosi --</option>
                                                    <option <?= 'Tenang' == set_value("respon_emosi") ? "selected" : "" ?> value="Tenang">Orientasi Baik</option>
                                                    <option <?= 'Takut' == set_value("respon_emosi") ? "selected" : "" ?> value="Takut">Disorientasi</option>
                                                    <option <?= 'Tegang' == set_value("respon_emosi") ? "selected" : "" ?> value="Tegang">Gelisah</option>
                                                    <option <?= 'Marah' == set_value("respon_emosi") ? "selected" : "" ?> value="Marah">Marah</option>
                                                    <option <?= 'Sedih' == set_value("respon_emosi") ? "selected" : "" ?> value="Sedih">Sedih</option>
                                                    <option <?= 'Menangis' == set_value("respon_emosi") ? "selected" : "" ?> value="Menangis">Menangis</option>
                                                    <option <?= 'Gelisah' == set_value("respon_emosi") ? "selected" : "" ?> value="Gelisah">Gelisah</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Bahasa</label>
                                                <select id="bahasa" name="bahasa" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option disabled hidden selected value=""> -- Pilih Bahasa --</option>
                                                    <option <?= 'Indonesia' == set_value("bahasa") ? "selected" : "" ?> value="Indonesia">Indonesia</option>
                                                    <option <?= 'Jawa' == set_value("bahasa") ? "selected" : "" ?> value="Jawa">Jawa</option>
                                                    <option <?= 'Lainnya' == set_value("bahasa") ? "selected" : "" ?> value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Kebutuhan Spiritual</label>
                                                <select id="kebutuhan_spiritual" name="kebutuhan_spiritual" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option disabled hidden selected value=""> -- Pilih Kebutuhan Spiritual --</option>
                                                    <option <?= 'Cukup' == set_value("kebutuhan_spiritual") ? "selected" : "" ?> value="Cukup">Cukup</option>
                                                    <option <?= 'Tinggi' == set_value("kebutuhan_spiritual") ? "selected" : "" ?> value="Tinggi">Tinggi</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Hubungan Pasien Dengan Keluarga</label>
                                                <select id="hubungan_dengan_keluarga" name="hubungan_dengan_keluarga" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option disabled hidden selected value=""> -- Pilih Hubungan Pasien Dengan Keluarga --</option>
                                                    <option <?= 'Baik' == set_value("hubungan_dengan_keluarga") ? "selected" : "" ?> value="Baik">Baik</option>
                                                    <option <?= 'Tidak Baik' == set_value("hubungan_dengan_keluarga") ? "selected" : "" ?> value="Tidak Baik">Tidak Baik</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">PEMERIKSAAN LABORATORIUM</div>
                                            <div>
                                                <div class="mb-2">
                                                    <span class="font-semibold">Tindak Lanjut</span>
                                                </div>
                                                <div class="flex items-center mb-2 space-x-4">
                                                    <label class="flex items-center">
                                                    <input type="radio" name="tindak_lanjut" value="ya" class="mr-2"> Ya
                                                    </label>
                                                    <label class="flex items-center">
                                                    <input type="radio" name="tindak_lanjut" value="tidak" class="mr-2"> Tidak
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block font-semibold mb-2">TANDA TANGAN Perawat</label>
                                                <div class="border border-gray-300 p-4 bg-white rounded-lg">
                                                    <canvas id="signature-pad-perawat" class="signature-pad w-full h-48 border"></canvas>
                                                    <input type="hidden" name="signature_perawat" id="signature_perawat">
                                                    <button type="button" id="clear-perawat" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Clear</button>
                                                </div>
                                                <div class="mt-2">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file TTD</label>
                                                    <input name="input_file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-between mt-4">
                            <button id="prevBtn" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" style="display:none;">Previous</button>
                            <button id="nextBtn" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Next</button>
                            <button id="saveBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="display:none;">Save</button>
                        </div>
                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">

                    </div>
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Contacts tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>
