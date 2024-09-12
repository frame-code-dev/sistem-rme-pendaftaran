<?=$this->extend('layouts/app')?>
<?=$this->section('css')?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 0.35rem !important;
            border: 1px solid #d1d3e2;
            height: calc(1.95rem + 10px);
            background: #fff;
        }

        .select2-container--default .select2-selection--single:hover,
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--single.active {
            box-shadow: none;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px;

        }

        .select2-container--default .select2-selection--multiple {
            border-color: #eaeaea;
            border-radius: 0;
        }

        .select2-dropdown {
            border-radius: 0;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #3838eb;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #eaeaea;
            background: #fff;

        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            top: 5px;
        }
    </style>
<?=$this->endSection()?>
<?=$this->section('js')?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
            let umur = parseInt($('#umur').val());
            if (umur >= 18) {
                $('.tingkat_nyeri_anak_mst-show').addClass('hidden')
                $('.tingkat_nyeri_dewasa_mst-show').removeClass('hidden')
            }else{
                $('.tingkat_nyeri_anak_mst-show').removeClass('hidden')
                $('.tingkat_nyeri_dewasa_mst-show').addClass('hidden')
            }
            
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
                }else if(value >= 2 && value < 4) {
                    hasil_text = 'Sedikit Nyeri';
                }else if(value >= 4 && value < 6) {
                    hasil_text = 'Cukup Nyeri';
                }else if(value >= 6 && value < 8) {
                    hasil_text = 'Lumayan Nyeri';
                }else if(value >= 8 && value < 10) {
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
                }else if(value >= 1 && value < 3) {
                    hasil_text = 'Nyeri Ringan';
                }else if(value >= 4 && value < 7) {
                    hasil_text = 'Nyeri Sedang';
                }else if(value >= 8 && value < 10) {
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


            // Update total score display
            document.getElementById('total-score').textContent = totalScore;
        }
        function calculateScoreAnak(){
            let totalScore = 0;

            // Get selected radio buttons
            const bbRadio = document.querySelector('input[name="bb_anak"]:checked');
            const appetiteRadio = document.querySelector('input[name="bb_penurunan_anak"]:checked');

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
        var canvasDokter = document.getElementById('signature-pad-dokter');

        var signaturePadDokter = new SignaturePad(canvasDokter);
        document.getElementById('clear-dokter').addEventListener('click', function () {
            signaturePadDokter.clear();
        });

        var DokterDataUrl = signaturePadDokter.toDataURL();
        $('#signature_dokter').val(DokterDataUrl);
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
                } else if (step === 4) {
                $("#prevBtn").show();
                $("#nextBtn").hide();
                } else {
                $("#prevBtn").show();
                $("#nextBtn").show();
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
    <script>
        $(document).ready(function() {
            $('#cetak-bpjs').on('click', function() {
                let data = $('#form').serialize();

                $('#cetak-bpjs').attr('href', '<?= base_url('pemeriksaan/cetak-bpjs') ?>?' + data);

            })
            $('#cetak-rujukan').on('click',function(){
                let data = $('#form').serialize();
                let value = $('#jenis_keperluan option:selected').val();
                console.log(value);
                let url = '';
                if (value == 'Daftar kuliah') {
                    url = '<?= base_url('pemeriksaan/cetak-kuliah') ?>?' + data;
                }else if(value == 'Melamar Pekerjaan'){
                    url = '<?= base_url('pemeriksaan/cetak-kerja') ?>?' + data;
                }

                $('#cetak-rujukan').attr('href', url);
            })
           
        });

    </script>
    <!-- Script to toggle input fields for 'Lainnya' option -->
    <script>
        document.getElementById('assesmentLainnya').addEventListener('change', function () {
            var input = document.getElementById('assesmentLainnyaInput');
            input.classList.toggle('hidden', !this.checked);
        });

        document.getElementById('intervensiLainnya').addEventListener('change', function () {
            var input = document.getElementById('intervensiLainnyaInput');
            input.classList.toggle('hidden', !this.checked);
        });
    </script>
    <script>
        // Diagnosa sepuluh 
        let urlDiagnosaSepuluh = '<?= base_url('diagnosa/sepuluh') ?>'; 
        $(document).ready(function() {
            $('.diagnosaSelect10').select2({
                placeholder: 'Search for Diagnosa 10',
                width: 'resolve',
                ajax: {
                    url: '<?= base_url('diagnosa/sepuluh') ?>',  // Controller URL
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term  // Search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            }).on('select2:select',function(e){
                let selected = e.params.data;
                $('#diagnosa_sepluh_kode').val(selected.id);
                
            });
        });
        // diagnosa sembilan 
        let urlDiagnosaSembilan = '<?= base_url('diagnosa/sembilan') ?>'; 
        $(document).ready(function() {
            $('.tindakan').select2({
                placeholder: 'Search for Diagnosa 9',
                width: 'resolve',
                ajax: {
                    url: '<?= base_url('diagnosa/sembilan') ?>',  // Controller URL
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term  // Search term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            }).on('select2:select',function(e){
                let selected = e.params.data;
                $('#tindakan_kode').val(selected.id);
                
            });
        });
        
    </script>
<?=$this->endSection()?>
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
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Umur<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan Umur" name="umur" id="umur" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("umur",hitungUmur($pasien['tanggal_lahir'])) ?>">
                    </div>
                </div>
            </div>
            <div class="border p-3 mt-3">
                <div class="border p-3">
                    <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                        <span class="font-semibold text-white uppercase">S (Subjective)</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <!-- Jenis Keluhan Section -->
                        <div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <tbody class="border p-4 w-full">
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Jenis Keluhan</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <div class="mb-2">
                                                <?=ucwords($current_pemeriksaan_subject['jenis_keluhan'] ?? '-')?>
                                                <hr>
                                            </div>
                                            <?=$current_pemeriksaan_subject['complaint']?>
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Jenis Riwayat Penyakit</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <div class="mb-2">
                                                <?=ucwords($current_pemeriksaan_subject['type'])?>
                                                <hr>
                                            </div>
                                                <?=$current_pemeriksaan_subject['riwayat_text']?>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                    <!-- Faktor Resiko Section -->
                    <div class="mt-4">
                        <div class="bg-blue-900 text-white p-2 w-full">
                            <span class="font-semibold ">Faktor Resiko</span>
                        </div>
                        <hr>
                        <div class="grid grid-cols-1 gap-4 mt-2">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <tbody class="border p-4 w-full">
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Merokok</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_subject['smoking']?>
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Kurang Makan Sayur + Buah</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_subject['diet'])?></td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Stress</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_subject['stress'])?></td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Kurang Aktivitas Fisik</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_subject['physical_activity'])?></td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Konsumsi Alkohol</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_subject['alcohol_consumption'])?></td>
                                    </tr>
                                </tbody>
                            </table>
                      
                        </div>
                    </div>
                </div>
                <div class="border p-3 mt-3">
                    <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                        <span class="font-semibold text-white uppercase">O (Objective)</span>
                    </div>
                    <div class="grid grid-cols-3 gap-4 mb-3"">
                        <div class="border p-2" >
                            <!-- PEMERIKSAAN FISIK  -->
                            <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">PEMERIKSAAN FISIK</div>
                            <!-- Kondisi Umum -->
                            <div class="mb-3">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <tbody class="border p-4 w-full">
                                        <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <td width="20%" class="p-4">Kondisi Umum</td>
                                            <td width="1%">:</td>
                                            <td class="font-bold">
                                                <?=$current_pemeriksaan_object['kondisi_umum']?>
                                            </td>
                                        </tr>
                                        <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <td width="20%" class="p-4">Kesadarann</td>
                                            <td width="1%">:</td>
                                            <td class="font-bold"><?=ucwords($current_pemeriksaan_object['kesadaran_e'])?></td>
                                        </tr>
                                        <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <td width="20%" class="p-4">Tingkat Kesadaran</td>
                                            <td width="1%">:</td>
                                            <td class="font-bold"><?=ucwords($current_pemeriksaan_object['tingkat_kesadaran'])?></td>
                                        </tr>
                                    </tbody>
                                </table>
                               
                            </div>
                           
                        </div>
                        <div class="border p-2">
                            <!-- TANDA-TANDA VITAL (TTV)  -->
                            <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">TANDA-TANDA VITAL (TTV)</div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <tbody class="border p-4 w-full">
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Tekanan Darah</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_object['tekanan_darah']?> mmHg
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Nadi</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_object['nadi'])?> x/menit</td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Suhu</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_object['suhu'])?> C</td>
                                    </tr>
                             
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Respitory Rate (RR)</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_object['respiratory_rate'])?> x/menit</td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">SPO</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_object['spo2'])?> %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="border p-2">
                            <!-- ANTROPOMETRI  -->
                            <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">ANTROPOMETRI</div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <tbody class="border p-4 w-full">
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Berat Badan</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_object['berat_badan']?> kg
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Tinggi Badan</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_object['tinggi_badan'])?> CM</td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">IMT (BB/TB)</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_object['imt'])?> Hasil Hitung</td>
                                    </tr>
                             
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Lingkar Perut</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold"><?=ucwords($current_pemeriksaan_object['lingkar_perut'])?> CM</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="grid grid-cols-1 gap-4 mb-3">
                        <div class="border p-2">
                            <!-- SKALA NYERI  -->
                            <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">SKALA NYERI</div>
                            <div class="grid grid-cols-1 gap-4 mb-3">
                                <div>
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <tbody class="border p-4 w-full">
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Skala Nyeri</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['skala_nyeri']?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if($current_pemeriksaan_object['skala_nyeri'] == 'Anak Usia > 3 Tahun') : ?>
                                    <div id="tingkat_nyeri_anak-show" class="tingkat_nyeri_anak-show">
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <tbody class="border p-4 w-full">
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">Tingkat Nyeri Anak</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['tingkat_nyeri_anak']?>
                                                    </td>
                                                </tr>
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">Jenis Nyeri (Anak)</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['jenis_nyeri_anak']?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php else : ?>
                                    <div id="tingkat_nyeri_dewasa-show" class="tingkat_nyeri_dewasa-show">
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <tbody class="border p-4 w-full">
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">Tingkat Nyeri (Dewasa)</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['tingkat_nyeri_dewasa']?>
                                                    </td>
                                                </tr>
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">Jenis Nyeri (Dewasa)</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['jenis_nyeri_dewasa']?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <tbody class="border p-4 w-full">
                                        <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <td width="20%" class="p-4">Lokasi Nyeri</td>
                                            <td width="1%">:</td>
                                            <td class="font-bold">
                                                <?=$current_pemeriksaan_object['lokasi_nyeri']?>
                                            </td>
                                        </tr>
                                        <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <td width="20%" class="p-4">Rasa Nyeri</td>
                                            <td width="1%">:</td>
                                            <td class="font-bold">
                                                <?=$current_pemeriksaan_object['rasa_nyeri']?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                           
                                <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2 mt-2">MALNUTRITION SCREEN TOOLS TEST (MST)</div>
                                <?php if(hitungUmur($pasien['tanggal_lahir']) <= 18) :  ?> 
                                    <div id="tingkat_nyeri_anak_mst-show" class="tingkat_nyeri_anak_mst-show">
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <tbody class="border p-4 w-full">
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">1. Apakah pasien tampak kurus?</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['bb']?>
                                                    </td>
                                                </tr>
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">2. Apakah terdapat penurunan BB selama 1 bulan terakhir?</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['bb_penurunan_anak']?>
                                                    </td>
                                                </tr>
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">3. Apakah terdapat salah satu dari kondisi tersebut ?</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['condition']?>
                                                    </td>
                                                </tr>
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4">Total Skor</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?php $hitung = (int) $current_pemeriksaan_object['bb'] + (int) $current_pemeriksaan_object['bb_penurunan_anak'] + (int) $current_pemeriksaan_object['condition'];
                                                        ?>
                                                        <?=$hitung?>
                                                    </td>
                                                </tr>
                                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <td width="20%" class="p-4"> Diare > 5x/hari dan /atau muntah > 3x/hari dalam seminggu terakhir</td>
                                                    <td width="1%">:</td>
                                                    <td class="font-bold">
                                                        <?=$current_pemeriksaan_object['appetite']?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                      
                                    </div>
                                <?php else : ?>
                                    <div id="tingkat_nyeri_dewasa_mst-show" class="tingkat_nyeri_dewasa_mst-show hidden">
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <tbody class="border p-4 w-full">
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">1. Apakah pasien mengalami penurunan BB yang tidak diinginkan selama 6 bulan terakhir?</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['bb']?>
                                                </td>
                                            </tr>
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">2. Apakah asupan makanan berkurang karena tidak ada nafsu makan?</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['appetite']?>
                                                </td>
                                            </tr>
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">3. Apakah terdapat penyakit atau keadaan yang mengakibatkan pasien beresiko mengalami malnutrisi?</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['condition']?>
                                                </td>
                                            </tr>
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Total Skor</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?php $hitung = (int) $current_pemeriksaan_object['bb'] + (int) $current_pemeriksaan_object['appetite'];
                                                    ?>
                                                    <?=$hitung?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                        
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="grid grid-cols-1 gap-4 mb-3">
                        <div class="border p-2">
                            <!-- STATUS GENERALIS  -->
                            <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">STATUS GENERALIS</div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <tbody class="border p-4 w-full">
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Kepala/Leher</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_object['kepala']?>
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Thorax</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_object['thorax']?>
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Abdomen</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_object['abdomen']?>
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Ekstremitas</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_object['ekstremitas']?>
                                        </td>
                                    </tr>
                                    <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <td width="20%" class="p-4">Lainnya</td>
                                        <td width="1%">:</td>
                                        <td class="font-bold">
                                            <?=$current_pemeriksaan_object['lainnya']?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    
                        </div>
                    </div>
                    <hr>
                    <div class="grid grid-cols-1 gap-4 mb-3">
                        <div class="border p-2">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <!-- STATUS PSIKOSOSIOSPIRITUAL  -->
                                    <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">STATUS PSIKOSOSIOSPIRITUAL</div>
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <tbody class="border p-4 w-full">
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Status Mental</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['status_mental']?>
                                                </td>
                                            </tr>
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Respon Emosi</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['respon_emosi']?>
                                                </td>
                                            </tr>
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Bahasa</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['bahasa']?>
                                                </td>
                                            </tr>
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Kebutuhan Spiritual</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['kebutuhan_spiritual']?>
                                                </td>
                                            </tr>
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Hubungan Pasien Dengan Keluarga</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['hubungan_dengan_keluarga']?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <div class="bg-blue-900 text-white p-2 w-full font-semibold mb-2">PEMERIKSAAN LABORATORIUM</div>
                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                        <tbody class="border p-4 w-full">
                                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <td width="20%" class="p-4">Tindak Lanjut</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$current_pemeriksaan_object['tindak_lanjut']?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border p-3 mt-3">
                    <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                        <span class="font-semibold text-white uppercase">A (Assesment)</span>
                    </div>
                    <div class="mb-3">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody class="border p-4 w-full">
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Assesment Keperawatan</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['assesment_keperawatan']?>, <?=$current_dokter['assesment_keperawatan_lainnya']?> 
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Intervensi Keperawatan</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['intervensi_keperawatan']?>,<?=$current_dokter['intervensi_keperawatan_lainnya']?> 
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Jenis Diagnosa | Kode Diagnosa</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['diagnosa_sepluh']?> |  <?=$current_dokter['diagnosa_sepluh_kode']?> 
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Jenis Kasus</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['diagnosa_kasus']?>
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Jenis Tindakan | Kode ICD 9 CM</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                    <?=$current_dokter['tindakan']?> |  <?=$current_dokter['tindakan_kode']?> 
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Jenis Kasus</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['tindakan_kasus']?>
                                    </td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <div class="border p-3 mt-3">
                    <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                        <span class="font-semibold text-white uppercase">P (Planning)</span>
                    </div>
                    <div class="mb-3">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <tbody class="border p-4 w-full">
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Jenis Keperluan</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['jenis_keperluan']?>
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Dokter Pemeriksa</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['dokter_pemeriksa']?>
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Penglihatan</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['jenis_penglihatan']?> 
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Pendengaran</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['jenis_pendengaran']?>
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Rencana Pemulangan</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                    <?=$current_dokter['status_pasien_keluar']?>
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Kesadaran</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['kesadaran']?>
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Rujukan Internal</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['rujukan_internal']?>
                                    </td>
                                </tr>
                                <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <td width="20%" class="p-4">Rujukan Eksternal</td>
                                    <td width="1%">:</td>
                                    <td class="font-bold">
                                        <?=$current_dokter['rujukan_eksternal']?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

             
            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>
