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
            $('input[name="tindak_lanjut"]').on('change',function(){
                if ($(this).val() == 'ya') {
                    $('#jenis_pemeriksaan_show').removeClass('hidden')
                }else{
                    $('#form_isian_show_klinik').addClass('hidden');
                    $('#form_isian_show_imonologi').addClass('hidden');
                    $('#form_isian_show_faces').addClass('hidden');
                    $('#form_isian_show_urine').addClass('hidden');
                    $('#form_isian_show_microbiologi').addClass('hidden');
                    $('#jenis_pemeriksaan_show').addClass('hidden')

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
                if (value > 0 && value <= 2) {
                    hasil_text = 'Tidak Nyeri';
                }else if(value >= 2 && value <= 4) {
                    hasil_text = 'Sedikit Nyeri';
                }else if(value >= 4 && value <= 6) {
                    hasil_text = 'Cukup Nyeri';
                }else if(value >= 6 && value <= 8) {
                    hasil_text = 'Lumayan Nyeri';
                }else if(value >= 8 && value <= 10) {
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
                }else if(value >= 1 && value <= 3) {
                    hasil_text = 'Nyeri Ringan';
                }else if(value >= 4 && value <= 7) {
                    hasil_text = 'Nyeri Sedang';
                }else if(value >= 8 && value <= 10) {
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
        var canvasPerawat = document.getElementById('signature-pad-perawat');
        var canvasDokter = document.getElementById('signature-pad-dokter');

        var signaturePadPerawat = new SignaturePad(canvasPerawat);
        document.getElementById('clear-perawat').addEventListener('click', function () {
            signaturePadPerawat.clear();
        });

        var signaturePadDokter = new SignaturePad(canvasDokter);
        document.getElementById('clear-dokter').addEventListener('click', function () {
            signaturePadDokter.clear();
        });


        var PerawatDataUrl = signaturePadPerawat.toDataURL();
        $('#signature_perawat').val(PerawatDataUrl);

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
            $('.js-example-basic-multiple').select2({
                placeholder:'-- Pilih --',
                width: 'resolve',
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let value = $('#jenis_pemeriksaan').val();
            if (value == '' || value == null) {
                $('#form_isian_show_klinik').addClass('hidden');
                $('#form_isian_show_hematologi').addClass('hidden');
                $('#form_isian_show_imonologi').addClass('hidden');
                $('#form_isian_show_faces').addClass('hidden');
                $('#form_isian_show_urine').addClass('hidden');
                $('#form_isian_show_microbiologi').addClass('hidden');
            }
            $('#jenis_pemeriksaan').on('change',function(){
                let value = $(this).val();
                switch (value) {
                    case 'Klinik Kimia':
                        $('#form_isian_show_klinik').removeClass('hidden');
                        $('#form_isian_show_hematologi').addClass('hidden');
                        $('#form_isian_show_imonologi').addClass('hidden');
                        $('#form_isian_show_faces').addClass('hidden');
                        $('#form_isian_show_urine').addClass('hidden');
                        $('#form_isian_show_microbiologi').addClass('hidden');
                        break;
                    case 'Hematologi':
                        $('#form_isian_show_klinik').addClass('hidden');
                        $('#form_isian_show_hematologi').removeClass('hidden');
                        $('#form_isian_show_imonologi').addClass('hidden');
                        $('#form_isian_show_faces').addClass('hidden');
                        $('#form_isian_show_urine').addClass('hidden');
                        $('#form_isian_show_microbiologi').addClass('hidden');
                        break;
                    case 'Imonologi':
                        $('#form_isian_show_klinik').addClass('hidden');
                        $('#form_isian_show_hematologi').addClass('hidden');
                        $('#form_isian_show_imonologi').removeClass('hidden');
                        $('#form_isian_show_faces').addClass('hidden');
                        $('#form_isian_show_urine').addClass('hidden');
                        $('#form_isian_show_microbiologi').addClass('hidden');
                        break;
                    case 'Faces':
                        $('#form_isian_show_klinik').addClass('hidden');
                        $('#form_isian_show_hematologi').addClass('hidden');

                        $('#form_isian_show_imonologi').addClass('hidden');
                        $('#form_isian_show_faces').addClass('hidden');
                        $('#form_isian_show_urine').removeClass('hidden');
                        $('#form_isian_show_microbiologi').addClass('hidden');
                        break;
                    case 'Urine':
                        $('#form_isian_show_klinik').addClass('hidden');
                        $('#form_isian_show_hematologi').addClass('hidden');

                        $('#form_isian_show_imonologi').addClass('hidden');
                        $('#form_isian_show_faces').addClass('hidden');
                        $('#form_isian_show_urine').removeClass('hidden');
                        $('#form_isian_show_microbiologi').addClass('hidden');    
                        break;
                    case 'Microbiologi':
                        $('#form_isian_show_klinik').addClass('hidden');
                        $('#form_isian_show_hematologi').addClass('hidden');

                        $('#form_isian_show_imonologi').addClass('hidden');
                        $('#form_isian_show_faces').addClass('hidden');
                        $('#form_isian_show_urine').addClass('hidden');
                        $('#form_isian_show_microbiologi').removeClass('hidden');
                        break;
                    default:
                        $('#form_isian_show_klinik').addClass('hidden');
                        $('#form_isian_show_hematologi').addClass('hidden');

                        $('#form_isian_show_imonologi').addClass('hidden');
                        $('#form_isian_show_faces').addClass('hidden');
                        $('#form_isian_show_urine').addClass('hidden');
                        $('#form_isian_show_microbiologi').addClass('hidden');
                        break;
                }
                // form_isian_show_klinik
                // form_isian_show_imonologi
                // form_isian_show_faces
                // form_isian_show_urine
                // form_isian_show_microbiologi
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#alergi').on('change',function(){
                let value = $(this).val();
                if (value == 'Lain-Lain') {
                    $('#alergi_lainnya').removeClass('hidden');
                }else{
                    $('#alergi_lainnya').addClass('hidden');

                }
            })
        })
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
                    <div class="">
                        <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Umur<span class="me-2 text-red-500">*</span></label>
                        <input type="text" placeholder="Masukkan Umur" name="umur" id="umur" readonly class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                            value="<?= set_value("umur",hitungUmur($pasien['tanggal_lahir'])) ?>">
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
                            <button <?=in_groups('perawat') ? "" : "disabled" ?> class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">S (Subjective)</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button <?=in_groups('perawat') ? "" : "disabled" ?> class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">O (Objective)</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button <?=in_groups('dokter') ? "" : "disabled" ?> class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab" aria-controls="settings" aria-selected="false">A (Assesment)</button>
                        </li>
                        <li role="presentation">
                            <button <?=in_groups('dokter') ? "" : "disabled" ?> class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="contacts-styled-tab" data-tabs-target="#styled-contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">P (Planning)</button>
                        </li>
                    </ul>
                </div>
                <div id="default-styled-tab-content">
                    <form action="<?=base_url('pemeriksaan/store')?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $pasien['pasien_id'] ?>" name="id_pasien" >
                        <input type="hidden" value="<?= $pasien['id'] ?>" name="id_kunjungan" >
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
                                    <textarea name="keluhan_text" class="w-full h-20 border border-gray-300 rounded p-2" placeholder="Masukkan data"></textarea>
                                
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
                                    <textarea name="riwayat_text" class="w-full h-20 border border-gray-300 rounded p-2" placeholder="Masukkan data"></textarea>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <div class="font-semibold">Alergi</div>
                                        <div class="flex items-center mt-2">
                                            <select name="alergi" id="alergi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="0"> -- Pilih Alergi --</option>
                                                <option value="Obat">Obat</option>
                                                <option value="Makanan">Makanan</option>
                                                <option value="Lain-Lain">Lain-Lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="alergi_lainnya" class="hidden">
                                        <div class="font-semibold">Alergi Lainnya</div>
                                        <input type="text" class="border border-gray-300 rounded p-2 w-full mt-2" name="alergi_lainnya" placeholder="Masukkan Data" />

                                    </div>

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
                                                    <option value="0"> -- Pilih Kesadaran --</option>
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
                                            <input type="text" class="border border-gray-300 rounded p-2 w-full" name="tingkat_kesadaran" placeholder="Masukkan Data" />
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
                                            <div id="tingkat_nyeri_anak_mst-show" class="tingkat_nyeri_anak_mst-show">
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
                                                        <input type="radio" name="condition_anak" value="Ya" class="mr-2" > 
                                                        Ya
                                                        </label>
                                                        <label class="flex items-center">
                                                        <input type="radio" name="condition_anak" value="Tidak" class="mr-2" > 
                                                        Tidak
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
                                            <div id="tingkat_nyeri_dewasa_mst-show" class="tingkat_nyeri_dewasa_mst-show hidden">
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
                                                            <input type="radio" name="bb" value="2" class="mr-2" onclick="calculateScore()"> 
                                                            Tidak Yakin/Tidak Tahu/Baju Terasa Longgar (Skor 2)
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
                                                        <input type="radio" name="condition" value="Ya" class="mr-2"> 
                                                        Ya
                                                        </label>
                                                        <label class="flex items-center">
                                                        <input type="radio" name="condition" value="Tidak" class="mr-2"> 
                                                        Tidak
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
                                                <div class="mb-4 hidden" id="jenis_pemeriksaan_show">
                                                    <div class="mb-3">
                                                        <label class="block mb-2 text-sm font-semibold text-gray-900">Jenis Pemeriksaan</label>
                                                        <select name="jenis_pemeriksaan" id="jenis_pemeriksaan"  class="w-full border border-gray-300 rounded p-2">
                                                            <option> -- Pilih -- </option>
                                                            <option value="Klinik Kimia">Klinik Kimia</option>
                                                            <option value="Hematologi">Hematologi</option>
                                                            <option value="Imonologi">Imonologi</option>
                                                            <option value="Urine">Urinalisa (Urine)</option>
                                                            <option value="Microbiologi">Microbiologi</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label class="block mb-2 text-sm font-semibold text-gray-900">Form Isian</label>
                                                        <div class="hidden" id="form_isian_show_klinik">
                                                            <select name="form_isian[]" multiple='multiple'  id="form_isian_klinik" style="width: 100%;" class="w-full border border-gray-300 rounded p-2 js-example-basic-multiple">
                                                                <option value=""> -- Pilih --</option>
                                                                <option value="gula_darah-Gula Darah (GDA)">Gula Darah (GDA)</option>
                                                                <option value="kolesterol_total-Kolesterol Total">Kolesterol Total</option>
                                                                <option value="trigliserida-Trigliserida">Trigliserida</option>
                                                                <option value="asam_urat-Asam Urat / Uric Acid">Asam Urat / Uric Acid</option>
                                                                <option value="sgot-SGOT">SGOT</option>
                                                                <option value="spgt-SPGT">SPGT</option>
                                                                <option value="ureum-UREUM">UREUM</option>
                                                                <option value="bun-BUN">BUN</option>
                                                                <option value="kreatinin-Kreatinin">Kreatinin</option>
                                                                <option value="hdl-HDL">HDL</option>
                                                                <option value="ldl-LDL">LDL</option>
                                                            </select>
                                                        </div>
                                                         <div class="hidden" id="form_isian_show_hematologi">
                                                            <select name="form_isian[]" multiple='multiple'  id="form_isian_hematologi" style="width: 100%;" class="w-full border border-gray-300 rounded p-2 js-example-basic-multiple">
                                                                <option value=""> -- Pilih --</option>
                                                                <option value="darah_lengkap-Darah lengkap">Darah lengkap</option>
                                                                <option value="eosinofil-Eosinofil">Eosinofil</option>
                                                                <option value="basofil-Basofil">Basofil</option>
                                                                <option value="stab-Stab">Stab</option>
                                                                <option value="segmen-Segmen">Segmen</option>
                                                                <option value="limfosit-Limfosit">Limfosit</option>
                                                                <option value="monosit-Monosit">Monosit</option>
                                                            </select>
                                                        </div>
                                                        <div class="hidden" id="form_isian_show_imonologi">
                                                            <select name="form_isian[]" multiple='multiple'  id="form_isian_imonologi" style="width: 100%;" class="w-full border border-gray-300 rounded p-2 js-example-basic-multiple">
                                                                <option value=""> -- Pilih --</option>
                                                                <option value="golongan_darah-Golongan Darah">Golongan Darah</option>
                                                                <option value="tes_kehamilan-Tes Kehamilan">Tes Kehamilan</option>
                                                                <option value="widal-WIDAL">WIDAL</option>
                                                                <option value="hbsag-HbsAg">HbsAg</option>
                                                                <option value="sifilis-Sifilis">Sifilis</option>
                                                                <option value="hiv-HIV">HIV</option>
                                                            </select>
                                                        </div>
                                                        <!-- <div class="hidden" id="form_isian_show_faces">
                                                            <select name="form_isian[]" multiple='multiple'  id="form_isian_faces" style="width: 100%;" class="w-full border border-gray-300 rounded p-2 js-example-basic-multiple">
                                                                <option value=""> -- Pilih --</option>
                                                                <option value="konsistensi-Konsistensi">Konsistensi</option>
                                                                <option value="warna-Warna">Warna</option>
                                                                <option value="darah-Darah">Darah</option>
                                                                <option value="lendir-Lendir">Lendir</option>
                                                                <option value="eritrosit-Eritrosit">Eritrosit</option>
                                                                <option value="lekosit-Lekosit">Lekosit</option>
                                                                <option value="cysta-Cysta">Cysta</option>
                                                                <option value="amoeba-Amoeba">Amoeba</option>
                                                                <option value="telur_cacing-Telur Cacing">Telur Cacing</option>
                                                                <option value="lainnya-Lainnya">Lainnya</option>
                                                            </select>
                                                        </div> -->
                                                        <div class="hidden" id="form_isian_show_urine">
                                                            <select name="form_isian[]" multiple='multiple'  id="form_isian_urine" style="width: 100%;" class="w-full border border-gray-300 rounded p-2 js-example-basic-multiple">
                                                                <option value=""> -- Pilih --</option>
                                                                <option value="warna-Warna">Warna</option>
                                                                <option value="ph-Ph">Ph</option>
                                                                <option value="berat_jenis-Berat Jenis">Berat Jenis</option>
                                                                <option value="protein-Protein">Protein</option>
                                                                <option value="glukosa-Glukosa">Glukosa</option>
                                                                <option value="bilirubin-Bilirubin">Bilirubin</option>
                                                                <option value="urobilin-Urobilin">Urobilin</option>
                                                                <option value="keton-Keton">Keton</option>
                                                                <option value="nitrit-Nitrit">Nitrit</option>
                                                                <option value="leukosit-leukosit">leukosit</option>
                                                                <option value="sedimen_urin-Sedimen Urin">Sedimen Urin</option>

                                                               
                                                            </select>
                                                        </div>
                                                        <div class="hidden" id="form_isian_show_microbiologi">
                                                            <select name="form_isian[]" multiple='multiple'  id="form_isian_micro" style="width: 100%;" class="w-full border border-gray-300 rounded p-2 js-example-basic-multiple">
                                                                <option value=""> -- Pilih --</option>
                                                                <option value="fases_lengkap-Fases Lengkap">Fases Lengkap</option>
                                                                <option value="bta-BTA/TCM">BTA/TCM</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="mb-2">
                                                        <label class="block font-semibold mb-2">TANDA TANGAN PERAWAT</label>
                                                        <hr>
                                                    </div>
                                                    <div class="border border-gray-300 p-4 bg-white rounded-lg">
                                                        <canvas id="signature-pad-perawat" class="signature-pad w-full h-48 border"></canvas>
                                                        <input type="hidden" name="signature_perawat" id="signature_perawat">
                                                        <button type="button" id="clear-perawat" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Clear</button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file TTD</label>
                                                        <input name="file_ttd" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between mt-4">
                                <button type="button" id="prevBtn" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" style="display:none;">Previous</button>
                                <button type="button" id="nextBtn" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Next</button>
                                <button type="submit" id="saveBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="display:none;">Save</button>
                            </div>
                        </div>
                    </form>

                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
                            <div class="grid grid-cols-3 gap-4">
                                <!-- Assessment Keperawatan -->
                                <div class="border p-2">
                                    <div class="mb-2">
                                        <h2 class="font-bold text-lg mb-2">Assesment Keperawatan</h2>
                                        <hr>
                                    </div>
                                    <div class="space-y-2">
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Bersihan Jalan Nafas Tidak Efektif" class="mr-2">Bersihan Jalan Nafas Tidak Efektif</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Perubahan Nutrisi Kurang dari Kebutuhan" class="mr-2">Perubahan Nutrisi Kurang dari Kebutuhan</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Keseimbangan Cairan dan Elektrolit" class="mr-2">Keseimbangan Cairan dan Elektrolit</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Gangguan Komunikasi Verbal" class="mr-2">Gangguan Komunikasi Verbal</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Pola Nafas Tidak Efektif" class="mr-2">Pola Nafas Tidak Efektif</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Resiko Infeksi atau Sepsis" class="mr-2">Resiko Infeksi atau Sepsis</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Gangguan Integritas Kulit dan Jaringan" class="mr-2">Gangguan Integritas Kulit dan Jaringan</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Gangguan Pola Tidur" class="mr-2">Gangguan Pola Tidur</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Nyeri Akut" class="mr-2">Nyeri Akut</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Intoleransi Aktivitas" class="mr-2">Intoleransi Aktivitas</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Gangguan Mobilitas" class="mr-2">Gangguan Mobilitas</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Cemas" class="mr-2">Cemas</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Hipotermi atau Hipertermi" class="mr-2">Hipotermi atau Hipertermi</label><br>
                                        <label><input type="checkbox" name="assesment_keperawatan[]" value="Lainnya" id="assesmentLainnya" class="mr-2">Lainnya</label>
                                        <input type="text" name="assesment_keperawatan_lainnya" id="assesmentLainnyaInput" class="hidden border border-gray-300 rounded p-2 w-full mt-2" placeholder="Masukkan Assesment Lainnya">
                                    </div>
                                </div>
                                <!-- Intervensi Keperawatan -->
                                <div class="border p-2">
                                    <div class="mb-2">
                                        <h2 class="font-bold text-lg mb-2">Intervensi Keperawatan</h2>
                                        <hr>
                                    </div>
                                    <div class="space-y-2">
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk menjaga pola makan sedikit tapi sering" class="mr-2">Menganjurkan pasien untuk menjaga pola makan sedikit tapi sering</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk minum" class="mr-2">Menganjurkan pasien untuk minum</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk minum air hangat" class="mr-2">Menganjurkan pasien untuk minum air hangat</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk membatasi aktivitas" class="mr-2">Menganjurkan pasien untuk membatasi aktivitas</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk relaksasi" class="mr-2">Menganjurkan pasien untuk relaksasi</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk teknik distraksi relaksasi" class="mr-2">Menganjurkan pasien untuk teknik distraksi relaksasi</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk batuk efektif" class="mr-2">Menganjurkan pasien untuk batuk efektif</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk kompres air hangat" class="mr-2">Menganjurkan pasien untuk kompres air hangat</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk istirahat cukup" class="mr-2">Menganjurkan pasien untuk istirahat cukup</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Menganjurkan pasien untuk rawat luka teraktur" class="mr-2">Menganjurkan pasien untuk rawat luka teraktur</label><br>
                                        <label><input type="checkbox" name="intervensi_keperawatan[]" value="Lainnya" id="intervensiLainnya" class="mr-2">Lainnya</label>
                                        <input type="text" name="intervensi_keperawatan_lainnya" id="intervensiLainnyaInput" class="hidden border border-gray-300 rounded p-2 w-full mt-2" placeholder="Masukkan Intervensi Lainnya">
                                    </div>
                                </div>
                                <!-- Diagnosa & Tindakan -->
                                <div>
                                    <!-- Diagnosa -->
                                    <div class="border p-2">
                                        <div class="mb-2">
                                            <h2 class="font-bold text-lg mb-2">DIAGNOSA</h2>
                                            <hr>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Jenis Diagnosa</label>
                                            <select id="diagnosaSelect10" name="diagnosa_sepluh" class="diagnosaSelect10 w-full border border-gray-300 rounded p-2" style="width: 100%;"></select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Kode ICD 10</label>
                                            <input type="text" name="diagnosa_sepluh_kode" id="diagnosa_sepluh_kode" class="w-full border border-gray-300 rounded p-2" readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Jenis Kasus</label>
                                            <select name="diagnosa_kasus" class="w-full border border-gray-300 rounded p-2">
                                                <option> -- Pilih -- </option>
                                                <option value="kasus baru">Kasus Baru</option>
                                                <option value="kasus lama">Kasus Lama</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <!-- Tindakan -->
                                    <div class="border p-2 mt-2">
                                        <div class="mb-2">
                                            <h2 class="font-bold text-lg mb-2">TINDAKAN</h2>
                                            <hr>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Jenis Tindakan</label>
                                            <select name="tindakan" class="tindakan w-full border border-gray-300 rounded p-2" style="width: 100%;"></select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Kode ICD 9 CM</label>
                                            <input type="text" name="tindakan_kode" id="tindakan_kode" class="w-full border border-gray-300 rounded p-2">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Jenis Kasus</label>
                                            <select id="tindakan_kasus" name="tindakan_kasus" class="w-full border border-gray-300 rounded p-2">
                                                <option> -- Pilih -- </option>
                                                <option value="kasus baru">Kasus Baru</option>
                                                <option value="kasus lama">Kasus Lama</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-contacts" role="tabpanel" aria-labelledby="contacts-tab">
                            <div class="grid grid-cols-3 gap-4">
                                <!-- Surat Keterangan Sehat -->
                                <div class="border p-3 rounded-md col-span-2">
                                    <div class="mb-4">
                                        <h2 class="text-lg font-bold mb-4">Surat Keterangan Sehat</h2>
                                        <hr>
                                    </div>
    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Nama</label>
                                            <input type="text" name="nama" class="w-full border border-gray-300 rounded p-2" value="<?= set_value("nama",$pasien['nama_lengkap']) ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="w-full border border-gray-300 rounded p-2" value="<?= set_value("tempat_lahir",$pasien['tempat_lahir']) ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="w-full border border-gray-300 rounded p-2" value="<?= set_value("tanggal_lahir",$pasien['tanggal_lahir']) ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Laki-Laki" <?=$pasien['jenis_kelamin'] == 'L' ? 'selected' : '' ?> >Laki-Laki</option>
                                                <option value="Perempuan" <?=$pasien['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" class="w-full border border-gray-300 rounded p-2" value="<?= set_value("pekerjaan",$pasien['pekerjaan']) ?>">
                                        </div>
                                        <div class="block mb-2 text-sm font-semibold text-gray-900">
                                            <label class="block mb-2">Alamat</label
                                            <input type="text" name="alamat" class="w-full border border-gray-300 rounded p-2" value="<?= set_value("alamat",$pasien['alamat_lengkap']) ?>">
                                        </div>
                                    </div>
    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="mb-4">
                                            <label class="block mb-2">Jenis Keperluan</label>
                                            <select name="jenis_keperluan" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Daftar kuliah">Daftar kuliah</option>
                                                <option value="Melamar Pekerjaan">Melamar Pekerjaan</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Dokter Pemeriksa</label>
                                            <select name="dokter_pemeriksa" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Dr. A">Dr. A</option>
                                                <option value="Dr. B">Dr. B</option>
                                            </select>
                                        </div>
                                    </div>
    
                                    <button class="bg-red-500 text-white rounded p-2 flex items-center">
                                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10l-6 6m0 0l-6-6m6 6V3" />
                                        </svg>
                                        CETAK
                                    </button>
                                </div>
                                <!-- Rencana Pemulangan -->
                                <div class="">
                                    <div class="border p-3 rounded-md">
                                        <h2 class="text-lg font-bold mb-4">Rencana Pemulangan</h2>
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Status Pasien Keluar</label>
                                            <select name="status_pasien_keluar" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Berobat Jalan">Berobat Jalan</option>
                                                <option value="Kontrol">Kontrol</option>
                                            </select>
                                        </div>
        
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Kesadaran</label>
                                            <select name="kesadaran" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Compas Mentis">Compas Mentis</option>
                                                <option value="Apatis">Apatis</option>
                                                <option value="Delirium">Delirium</option>
                                            </select>
                                        </div>
        
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Rujukan Internal</label>
                                            <div>
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="rujukan_internal" value="Poli" class="mr-2"> Poli
                                                </label>
                                                <label class="inline-flex items-center ml-4">
                                                    <input type="radio" name="rujukan_internal" value="UGD" class="mr-2"> UGD
                                                </label>
                                            </div>
                                            <div class="mt-2">
                                                <select name="rujukan_internal_poli" class="w-full border border-gray-300 rounded p-2">
                                                    <option value=""> -- Pilih -- </option>
                                                    <option value="Poli Umum">Poli Umum</option>
                                                    <option value="Poli Gigi">Poli Gigi</option>
                                                    <option value="Poli KIA">Poli KIA</option>
                                                </select>
                                            </div>
                                        </div>
        
                                        <div class="mb-4">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="rujukan_eksternal" value="Ya" class="mr-2"> Rujukan Eksternal
                                            </label>
                                            <select name="rujukan_eksternal_detail" class="w-full border border-gray-300 rounded p-2 mt-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="RS A">RS A</option>
                                                <option value="RS B">RS B</option>
                                            </select>
                                            <input type="text" name="alasan_rujukan" placeholder="Alasan Rujukan" class="w-full border border-gray-300 rounded p-2 mt-2">
                                        </div>
        
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Keterangan</label>
                                            <p class="text-sm text-gray-700">Kode 0: Diagnosa diluar kompetensi</p>
                                            <p class="text-sm text-gray-700">Kode 1: Diagnosa ada dalam kompetensi, ada keterbatasan kemampuan/kapasitas</p>
                                        </div>
        
                                        <button class="bg-blue-500 text-white rounded p-2 flex items-center">
                                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 10l-6 6m0 0l-6-6m6 6V3" />
                                            </svg>
                                            CETAK
                                        </button>
                                    </div>
                                    <!-- Tanda Tangan Dokter -->
                                    <div class="border p-3 rounded-md shadow-md mt-3">
                                        <h2 class="text-lg font-bold mb-4">Tanda Tangan Dokter</h2>
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
                        </div>
                   
                </div>

            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>
