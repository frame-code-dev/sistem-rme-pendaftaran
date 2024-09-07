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
    <script>
        var urlProvinsi = "https://ibnux.github.io/data-indonesia/provinsi.json";
        var urlKabupaten = "https://ibnux.github.io/data-indonesia/kabupaten/";
        var urlKecamatan = "https://ibnux.github.io/data-indonesia/kecamatan/";
        var urlKelurahan = "https://ibnux.github.io/data-indonesia/kelurahan/";
        let provinsi_id = `<?=$pasien['provinsi'] ?>`
        let kabupaten_id = `<?=$pasien['kabupaten'] ?>`
        let kecamatan_id = `<?=$pasien['kecamatan'] ?>`
        let desa_id = `<?=$pasien['desa'] ?>`
        function clearOptions(id) {
            console.log("on clearOptions :" + id);

            //$('#' + id).val(null);
            $('#' + id).empty().trigger('change');
        }

        console.log('Load Provinsi...');
        $.getJSON(urlProvinsi, function (res) {

            res = $.map(res, function (obj) {
                obj.text = obj.nama
                return obj;
            });

            data = [{
                id: "",
                nama: "- Pilih Provinsi -",
                text: "- Pilih Provinsi -"
            }].concat(res);

            //implemen data ke select provinsi
            $("#select2-provinsi").select2({
                dropdownAutoWidth: true,
                width: '100%',
                data: data
            })

            if (provinsi_id) {
                $("#select2-provinsi").val(provinsi_id).trigger('change');
            }
        });

        var selectProv = $('#select2-provinsi');
        $(selectProv).change(function () {
            var value = $(selectProv).val();
            console.log(value);
            clearOptions('select2-kabupaten');

            if (value) {
                console.log("on change selectProv");

                var text = $('#select2-provinsi :selected').text();
                console.log("value = " + value + " / " + "text = " + text);

                console.log('Load Kabupaten di '+text+'...')
                $.getJSON(urlKabupaten + value + ".json", function(res) {

                    res = $.map(res, function (obj) {
                        obj.text = obj.nama
                        return obj;
                    });

                    data = [{
                        id: "",
                        nama: "- Pilih Kabupaten -",
                        text: "- Pilih Kabupaten -"
                    }].concat(res);

                    //implemen data ke select provinsi
                    $("#select2-kabupaten").select2({
                        dropdownAutoWidth: true,
                        width: '100%',
                        data: data
                    })
                    if (kabupaten_id) {
                        $("#select2-kabupaten").val(kabupaten_id).trigger('change');
                    }
                })
            }
        });

        var selectKab = $('#select2-kabupaten');
        $(selectKab).change(function () {
            var value = $(selectKab).val();
            clearOptions('select2-kecamatan');
            clearOptions('select2-desa');

            if (value) {
                console.log("on change selectKab");

                var text = $('#select2-kabupaten :selected').text();
                console.log("value = " + value + " / " + "text = " + text);

                console.log('Load Kecamatan di '+text+'...')
                $.getJSON(urlKecamatan + value + ".json", function(res) {

                    res = $.map(res, function (obj) {
                        obj.text = obj.nama
                        return obj;
                    });

                    data = [{
                        id: "",
                        nama: "- Pilih Kecamatan -",
                        text: "- Pilih Kecamatan -"
                    }].concat(res);

                    //implemen data ke select provinsi
                    $("#select2-kecamatan").select2({
                        dropdownAutoWidth: true,
                        width: '100%',
                        data: data
                    })

                    if (kecamatan_id) {
                        $("#select2-kecamatan").val(kecamatan_id).trigger('change');
                    }
                })
            }
        });

        $('#select2-kecamatan').change(function () {
            var value = $(this).val();
            clearOptions('select2-desa');

            console.log('Load Desa di ' + value + '...');
            if (value) {
                console.log("on change selectKec");
                $.getJSON(urlKelurahan + value + ".json", function (res) {
                    res = $.map(res, function (obj) {
                        obj.text = obj.nama
                        return obj;
                    });

                    var data = [{
                        id: "",
                        nama: "- Pilih Desa/Kelurahan -",
                        text: "- Pilih Desa/Kelurahan -"
                    }].concat(res);

                    $("#select2-desa").select2({
                        dropdownAutoWidth: true,
                        width: '100%',
                        data: data
                    })
                    if (desa_id) {
                        $("#select2-desa").val(desa_id).trigger('change');
                    }
                })
            }
        });
    </script>
<?=$this->endSection()?>
<?=$this->section('content')?>
    <div class="p-4 sm:ml-64 h-screen">
        <div class="p-4 mt-14">
            <div class="head lg:flex grid grid-cols-1 justify-between w-full">
                <div class="heading flex-auto">
                    <p class="text-blue-950 font-sm text-xs">
                        Pendaftaran
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
            	<form action="<?= base_url('pendaftaran/edit/update/'. $pasien['id']) ?>" method="POST" class="w-full mx-auto space-y-4" enctype="multipart/form-data">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="border p-3">
                            <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                                <span class="font-semibold text-white uppercase">Identitas Pasien</span>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">No. RM<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan NO. RM" name="no_rm" id="no_rm" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value("no_rm",$pasien['no_rm']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.no_rm")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.no_rm") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">No. NIK<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan NO. NIK" name="no_nik" id="no_nik" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value("no_nik",$pasien['nik']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.no_nik")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.no_nik") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Pasien<span class="me-2 text-red-500">*</span></label>
                                    <select id="jenis_pasien" name="jenis_pasien" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option disabled hidden selected value=""> -- Pilih Jenis Pasien --</option>
                                        <option <?= 'BPJS' == set_value("jenis_pasien",$pasien['jenis_pasien']) ? "selected" : "" ?> value="BPJS">BPJS</option>
                                        <option <?= 'UMUM' == set_value("jenis_pasien",$pasien['jenis_pasien']) ? "selected" : "" ?> value="UMUM">UMUM</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.jenis_pasien")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.jenis_pasien") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">NO. BPJS<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan No BPJS" name="no_bpjs" id="no_bpjs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("no_bpjs",$pasien['no_bpjs']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.no_bpjs")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.no_bpjs") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Lengkap<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan Nama Lengkap" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("nama_lengkap",$pasien['nama_lengkap']) ?>">
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
                                    <input type="text" placeholder="Masukkan Tempat Lahir" name="tempat_lahir" id="tempat_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("tempat_lahir",$pasien['tempat_lahir']) ?>">
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
                                    <input type="text" datepicker datepicker-format="mm-dd-yyyy" name="tgl_lahir" id="tgl_lahir" placeholder="Masukkan Nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("tgl_lahir",date("m-d-Y",strtotime($pasien['tanggal_lahir']))) ?>" value="<?= set_value("tgl_lahir") ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.tgl_lahir")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.tgl_lahir") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Jenis Kelamin<span class="me-2 text-red-500">*</span></label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option disabled hidden selected value=""> -- Pilih Jenis Pasien --</option>
                                        <option <?= 'L' == set_value("jenis_kelamin",$pasien['jenis_kelamin']) ? "selected" : "" ?> value="L">Laki-Laki</option>
                                        <option <?= 'P' == set_value("jenis_kelamin",$pasien['jenis_kelamin']) ? "selected" : "" ?> value="P">Perempuan</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.jenis_kelamin")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.jenis_kelamin") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama KK<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan Nama KK" name="nama_kk" id="nama_kk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("nama_kk",$pasien['nama_kk']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.nama_kk")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.nama_kk") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">NO. KK<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan NO. KK" name="no_kk" id="no_kk" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                    value="<?= set_value("no_kk",$pasien['no_kk']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.no_kk")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.no_kk") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="border p-3"> 
                            <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                                <span class="font-semibold text-white uppercase">Identitas sosial</span>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Agama<span class="me-2 text-red-500">*</span></label>
                                    <select id="agama" name="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="0"> -- Pilih Agama -- </option>
                                        <option value="islam" <?=$pasien['agama'] == 'islam' ? 'selected' : '' ?>>Islam</option>
                                        <option value="kristen" <?=$pasien['agama'] == 'kristen' ? 'selected' : '' ?>>Kristen</option>
                                        <option value="katolik" <?=$pasien['agama'] == 'katolik' ? 'selected' : '' ?>>Katolik</option>
                                        <option value="hindu" <?=$pasien['agama'] == 'hindu' ? 'selected' : '' ?>>Hindu</option>
                                        <option value="buddha" <?=$pasien['agama'] == 'buddha' ? 'selected' : '' ?>>Buddha </option>
                                        <option value="khonghucu" <?=$pasien['agama'] == 'khonghucu' ? 'selected' : '' ?>>Khonghucu</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.agama")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.agama") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Golongan Darah<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan Golongan Darah" name="gol_darah" id="gol_darah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value("gol_darah",$pasien['gol_darah']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.gol_darah")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.gol_darah") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Pendidikan<span class="me-2 text-red-500">*</span></label>
                                    <select id="pendidikan" name="pendidikan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="0" <?= set_value('pendidikan',$pasien['pendidikan']) == '0' ? 'selected' : '0' ?>> -- Pilih Pendidikan ,$pasien['pendidikan']-- </option>
                                        <option value="TK" <?= set_value('pendidikan',$pasien['pendidikan']) == 'TK' ? 'selected' : 'TK' ?>> TK</option>
                                        <option value="SD" <?= set_value('pendidikan',$pasien['pendidikan']) == 'SD' ? 'selected' : 'SD'?>>  SD</option>
                                        <option value="SMP" <?= set_value('pendidikan',$pasien['pendidikan']) == 'SMP' ? 'selected' : 'SMP'?>>  SMP</option>
                                        <option value="SMA" <?= set_value('pendidikan',$pasien['pendidikan']) == 'SMA' ? 'selected' : 'SMA'?>>  SMA</option>
                                        <option value="D1" <?= set_value('pendidikan',$pasien['pendidikan']) == 'D1' ? 'selected' : 'D1'?>>  D1</option>
                                        <option value="D2" <?= set_value('pendidikan',$pasien['pendidikan']) == 'D2' ? 'selected' : 'D2'?>>  D2</option>
                                        <option value="D3" <?= set_value('pendidikan',$pasien['pendidikan']) == 'D3' ? 'selected' : 'D3'?>>  D3</option>
                                        <option value="D4" <?= set_value('pendidikan',$pasien['pendidikan']) == 'D4' ? 'selected' : 'D4'?>>  D4</option>
                                        <option value="S1" <?= set_value('pendidikan',$pasien['pendidikan']) == 'S1' ? 'selected' : 'S1'?>>  S1</option>
                                        <option value="S2" <?= set_value('pendidikan',$pasien['pendidikan']) == 'S2' ? 'selected' : 'S2'?>>  S2</option>
                                        <option value="S3" <?= set_value('pendidikan',$pasien['pendidikan']) == 'S3' ? 'selected' : 'S3'?>>  S3</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.pendidikan")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.pendidikan") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Pekerjaan<span class="me-2 text-red-500">*</span></label>
                                    <select id="pekerjaan" name="pekerjaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="0" <?= set_value('pekerjaan',$pasien['pekerjaan']) == '0' ? 'selected' : '' ?>>Pilih Status</option>
                                        <option value="PNS/TNI-POLRI" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'PNS/TNI-POLRI' ? 'selected' : ''?>>PNS/TNI-POLRI</option>
                                        <option value="Swasta" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'Swasta' ? 'selected' : ''?>>Swasta</option>
                                        <option value="Wiraswasta" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'Wiraswasta' ? 'selected' : ''?>>Wiraswasta</option>
                                        <option value="Petani" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'Petani' ? 'selected' : ''?>>Petani</option>
                                        <option value="Buruh" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'Buruh' ? 'selected' : ''?>>Buruh</option>
                                        <option value="Ibu Rumah Tangga" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'Ibu Rumah Tangga' ? 'selected' : ''?>>Ibu Rumah Tangga</option>
                                        <option value="Pelajar" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'Pelajar' ? 'selected' : ''?>>Pelajar</option>
                                        <option value="Tidak Bekerja" <?= set_value('pekerjaan',$pasien['pekerjaan']) == 'Tidak Bekerja' ? 'selected' : ''?>>Tidak Bekerja</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.pekerjaan")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.pekerjaan") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Status Nikah<span class="me-2 text-red-500">*</span></label>
                                    <select id="status_kawin" name="status_kawin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="0" <?= set_value('status_kawin',$pasien['status_nikah']) == '0' ? 'selected' : '' ?>> -- Pilih Status -- </option>
                                        <option value="1" <?= set_value('status_kawin',$pasien['status_nikah']) == '1' ? 'selected' : ''?>> Belum Menikah</option>
                                        <option value="2" <?= set_value('status_kawin',$pasien['status_nikah']) == '2' ? 'selected' : ''?>> Menikah</option>
                                        <option value="3" <?= set_value('status_kawin',$pasien['status_nikah']) == '3' ? 'selected' : ''?>> Duda</option>
                                        <option value="4" <?= set_value('status_kawin',$pasien['status_nikah']) == '4' ? 'selected' : ''?>> Janda</option>
                                    </select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.status_kawin")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.status_kawin") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-blue-800 p-3 my-4 border rounded-md">
                                <span class="font-semibold text-white uppercase">Identitas keluarga</span>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Ayah<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan Nama Ayah" name="nama_ayah" id="nama_ayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value("nama_ayah",$pasien['nama_ayah']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.nama_ayah")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.nama_ayah") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Nama Ibu<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan Nama Ibu" name="nama_ibu" id="nama_ibu" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value("nama_ibu",$pasien['nama_ibu']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.nama_ibu")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.nama_ibu") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2 border p-3">
                            <div class="bg-blue-800 p-3 mb-4 border rounded-md">
                                <span class="font-semibold text-white uppercase">Identitas Alamat Pasien</span>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Alamat Lengkap<span class="me-2 text-red-500">*</span></label>
                                    <textarea name="alamat_lengkap" id="" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan Alamat Lengkap"><?=$pasien['alamat_lengkap']?></textarea>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.alamat")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.alamat") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Provinsi<span class="me-2 text-red-500">*</span></label>
                                    <select name="provinsi" class="select2-data-array browser-default bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="select2-provinsi"></select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.provinsi")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.provinsi") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Kabupaten<span class="me-2 text-red-500">*</span></label>
                                    <select name="kabupaten" class="select2-data-array browser-default bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="select2-kabupaten"></select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.kabupaten")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.kabupaten") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Kecamatan<span class="me-2 text-red-500">*</span></label>
                                    <select name="kecamatan" class="select2-data-array browser-default bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="select2-kecamatan"></select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.kecamatan")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.kecamatan") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Desa/Kelurahan<span class="me-2 text-red-500">*</span></label>
                                    <select name="desa" class="select2-data-array browser-default bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="select2-desa"></select>
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.desa")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.desa") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Kode POS<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan Kode POS" name="kode_pos" id="kode_pos" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value("kode_pos",$pasien['kode_pos']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.kode_pos")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.kode_pos") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="col-span-2">
                                    <label for="" class="block mb-2 text-sm font-semibold text-gray-900">Keterangan Wilayah<span class="me-2 text-red-500">*</span></label>
                                    <input type="text" placeholder="Masukkan Keterangan Wilayah" name="ket_wilayah" id="ket_wilayah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                        value="<?= set_value("ket_wilayah",$pasien['keterangan_wilayah']) ?>">
                                    <div class="text-red-500 text-xs italic font-semibold">
                                        <?php if (session("errors.ket_wilayah")) : ?>
                                            <div class="text-red-500 text-sm">
                                                <?= session("errors.ket_wilayah") ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end align-middle content-center bg-gray-100 p-3 rounded-md">
                        <div>
                            <button class="bg-white text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" type="reset">Batal</button>
                        </div>
                        <div>
                            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">Simpan Data</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
<?=$this->endSection()?>