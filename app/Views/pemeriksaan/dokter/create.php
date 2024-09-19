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
    <script>
        $(document).ready(function() {
            $('#addBtn').click(function() {
            var formRow = `
                        <div class="row form-row my-3 grid grid-cols-4 content-center gap-3">
                            <div class="form-group col-md-4">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Obat<span class="me-2 text-red-500">*</span></label>
                                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 obat-select" name="obat[]" required>
                                    <option value="">Pilih Obat</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Dosis Obat<span class="me-2 text-red-500">*</span></label>
                                <input type="text" placeholder="Masukkan Data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="dosis_obat[]">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Aturan Minuman Obat<span class="me-2 text-red-500">*</span></label>
                                <select name="aturan_obat[]" class="w-full border border-gray-300 rounded p-2">
                                    <option value=""> -- Pilih -- </option>
                                    <option value="1 Kali"> 1 Kali</option>
                                    <option value="2 Kali">2 Kali</option>
                                    <option value="3 Kali">3 Kali</option>
                                    <option value="4 Kali">4 Kali</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2 flex align-bottom content-end items-end">
                                <button type="button" class="bg-white text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 remove-btn">Hapus</button>
                            </div>
                        </div>
            `;

            $('#formContainer').append(formRow);

            // Mendapatkan data obat dan mengisi dropdown di form baru
            let url = `<?=base_url('rekam-medis/data-obat')?>`
            console.log('qwqg');
            
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var obatSelect = $('.obat-select:last');
                    obatSelect.empty();
                    obatSelect.append('<option value="">Pilih Obat</option>');

                    $.each(response, function(key, value) {
                        obatSelect.append('<option value="' + value.id + '">' + value.nama + '</option>');
                    });
                }
            });
        });

        // Menghapus form ketika tombol "Remove" ditekan
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('.form-row').remove();
        });
        })
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
                $('#diagnosa_sepluh_nama').val(selected.text);
                
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
                $('#tindakan_nama').val(selected.text);
                
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
                <?php if (session("errors")) : ?>
                    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Danger</span>
                        <div>
                            <span class="font-medium">Terjadi Kesalahan:</span>
                            <ul class="mt-1.5 list-disc list-inside">
                                <?php foreach (session("errors") as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                <?php endif ?>
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab" data-tabs-toggle="#default-styled-tab-content" data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500" data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300" role="tablist">
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab" data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">S (Subjective)</button>
                        </li>
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">O (Objective)</button>
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
                      
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
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
                            <div class="mb-4">
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
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            <div class="mb-4">
                                <div class="grid grid-cols-3 gap-4 mb-3" id="tahap-1">
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
                                <div class="grid grid-cols-1 gap-4 mb-3" id="tahap-2" style="display: none;">
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
                                <div class="grid grid-cols-1 gap-4 mb-3" id="tahap-3" style="display: none;">
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
                                <div class="grid grid-cols-1 gap-4 mb-3" id="tahap-4" style="display: none;">
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
                            <div class="flex justify-between mt-4">
                                <button type="button" id="prevBtn" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" style="display:none;">Previous</button>
                                <button type="button" id="nextBtn" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Next</button>
                            </div>
                        </div>
                    <form action="<?=base_url('pemeriksaan/store-dokter')?>" id="form" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $pasien['pasien_id'] ?>" name="id_pasien" >
                        <input type="hidden" value="<?= $pasien['id'] ?>" name="id_kunjungan" >
                        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel" aria-labelledby="settings-tab">
                            <div class="grid grid-cols-2 gap-4 mb-3">
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
                                    <input type="hidden" name="diagnosa_sepluh_nama" id="diagnosa_sepluh_nama" class="w-full border border-gray-300 rounded p-2" readonly>
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

                                <!-- PENGOBATAN/TERAPI -->
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
                                        <input type="hidden" name="tindakan_nama" id="tindakan_nama" class="w-full border border-gray-300 rounded p-2">
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
                                <div class="border p-2 mt-2">
                                    <div class="mb-2 flex justify-between">
                                        <h2 class="font-bold text-lg mb-2">PENGOBATAN/TERAPI</h2>
                                        <div>
											<button type="button" 
													class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
													id="addBtn">
												<svg class="w-3.5 h-3.5 me-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
													<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
												</svg>
												Tambah
											
											</button>
										</div>
                                    </div>
                                    <hr>
                                    <div id="formContainer">
										<div class="row form-row my-3 grid grid-cols-4 content-center gap-3">
											<div class="form-group col-md-4">
												<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Obat<span class="me-2 text-red-500">*</span></label>
												<select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 obat-select" name="obat[]" required>
													<option value="">Pilih Obat</option>
													<?php foreach ($obat as $item): ?>
														<option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
													<?php endforeach; ?>
												
												</select>
											</div>
											<div class="form-group col-md-3">
												<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Dosis Obat<span class="me-2 text-red-500">*</span></label>
												<input type="text" placeholder="Masukkan Data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" name="dosis_obat[]">
											</div>
											<div class="form-group col-md-3">
												<label for="" class="block mb-2 text-sm font-semibold text-gray-900">Aturan Minuman Obat<span class="me-2 text-red-500">*</span></label>
                                                <select name="aturan_obat[]" class="w-full border border-gray-300 rounded p-2">
                                                    <option value=""> -- Pilih -- </option>
                                                    <option value="1 Kali"> 1 Kali</option>
                                                    <option value="2 Kali">2 Kali</option>
                                                    <option value="3 Kali">3 Kali</option>
                                                    <option value="4 Kali">4 Kali</option>
                                                </select>
                                            </div>
											
											<div class="form-group col-md-2 flex align-bottom content-end items-end">
												<button type="button" class="bg-white text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 remove-btn">Hapus</button>
											</div>
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
                                            <label class="block mb-2">Alamat</label>
                                            <input type="text" name="alamat" class="w-full border border-gray-300 rounded p-2" value="<?= set_value("alamat",$pasien['alamat_lengkap']) ?>">
                                        </div>
                                    </div>
    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Jenis Keperluan</label>
                                            <select name="jenis_keperluan" id="jenis_keperluan" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Daftar kuliah">Daftar kuliah</option>
                                                <option value="Melamar Pekerjaan">Melamar Pekerjaan</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Dokter Pemeriksa</label>
                                            <select name="dokter_pemeriksa" id="dokter_pemeriksa" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <?php foreach ($dokter as $item): ?>
                                                    <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Penglihatan</label>
                                            <select name="jenis_penglihatan" id="jenis_penglihatan" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Baik">Baik</option>
                                                <option value="Tidak Baik">Tidak Baik</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Pendengaran</label>
                                            <select name="jenis_pendengaran" id="jenis_pendengaran" class="w-full border border-gray-300 rounded p-2">
                                                <option value=""> -- Pilih -- </option>
                                                <option value="Baik">Baik</option>
                                                <option value="Tidak Baik">Tidak Baik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <div>

                                            <a href="#" id="cetak-rujukan" target="_blank" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                
                                                <svg class="w-3.5 h-3.5 me-2 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                                                </svg>
                                                CETAK
                                            </a>
                                        </div>
                                    </div>
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
                                                <option value="RS Besuki">RS Besuki</option>
                                                <option value="RSUD Abd Rahem">RSUD Abd</option> 
                                                <option value="RS Elizabet">RS Elizabet</option>
                                                <option value="RS Waluyojati">RS Waluyojati</option>
                                                <option value="RS Rizani">RS Rizani</option>
                                                <option value="RS Bayangkara bws">RS Bayangkara bws</option>
                                                <option value="RS Mata">RS Mata</option>
                                            </select>
                                            <input type="text" name="alasan_rujukan" placeholder="Alasan Rujukan" class="w-full border border-gray-300 rounded p-2 mt-2">
                                        </div>
        
                                        <div class="mb-4">
                                            <label class="block mb-2 text-sm font-semibold text-gray-900">Keterangan</label>
                                            <p class="text-sm text-gray-700">Kode 0: Diagnosa diluar kompetensi</p>
                                            <p class="text-sm text-gray-700">Kode 1: Diagnosa ada dalam kompetensi, ada keterbatasan kemampuan/kapasitas</p>
                                        </div>
        
                                        <a href="#" id="cetak-bpjs" target="_blank" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                
                                            <svg class="w-3.5 h-3.5 me-2 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                                            </svg>

                                            CETAK
                                        </a>
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
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?=$this->endSection()?>
