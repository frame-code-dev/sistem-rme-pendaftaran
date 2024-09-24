<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak CPPT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-family: 'Tinos', serif;
            font: 12pt;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        /* p, table, ol{
            font-size: 13.5pt;
        } */
        @media print {
            * {
                -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
                color-adjust: exact !important;                 /*Firefox*/     /*Firefox*/
            }
            html, body {
                width: 210mm;
                height: 297mm;
            }
            .no-print, .no-print *
            {
                display: none !important;
            }
        /* ... the rest of the rules ... */
        }
    </style>
    <script>
        window.print();
        window.onafterprint = function() {
            window.close();
        };
    </script>
</head>

<body class="">
    <div class="w-full mx-auto bg-white p-6">
            <div class="flex justify-between content-center items-center">
                <div>
                    <img src="<?=base_url('img/logo.jpg')?>" class="w-full" alt="">
                </div>
                <div class="mx-4 text-center w-full self-start">
                    <h1 class="text-lg">PEMERINTAH KABUPATEN SITUBONDO</h1>
                    <h1 class="text-lg">DINAS KESEHATAN</h1>
                    <h1 class="font-bold text-lg">UPT PUSKESMAS BESUKI</h1>
                    <p class="text-xs">Jl. Garuda No. 199 Telp. (0338) 891 335 Langkap - Besuki</p>
                    <p class="text-xs">puskesmasbesukiberlin@gmail.com</p>
                    <h5 class="font-bold">SITUBONDO 68356</h5>
                </div>
                <div>
                    <img src="<?=base_url('img/logo-2.png')?>" class="w-full" alt="">
                </div>
            </div>
            <hr>
            <div class="flex justify-between mt-5">
                <div class="" style="width: 100%;">
                    <h6 class="text-center text-md font-bold">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI (CPPT)</h6>
                </div>
                <div class="w-1/2 text-end">
                    <span class="font-bold">No Rekam Medis</span>
                    <p class="text-sm font-bold"><?=$data['no_rm']?></p>
                </div>
            </div>
            <div class="my-5 grid grid-cols-2 gap-2">
                <div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody class="border p-4 w-full">
                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap">
                                <td width="20%" class="p-4">Nama Lengkap</td>
                                <td width="1%">:</td>
                                <td class="font-bold">
                                    <?=$data['nama_lengkap']?>
                                </td>
                            </tr>
                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap">
                                <td width="20%" class="p-4">Alamat Lengkap</td>
                                <td width="1%">:</td>
                                <td class="font-bold">
                                    <?=$data['alamat_lengkap']?> kg
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody class="border p-4 w-full">
                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap">
                                <td width="20%" class="p-4">Umur</td>
                                <td width="1%">:</td>
                                <td class="font-bold">
                                    <?=hitungUmur($data['tanggal_lahir'])?> - <?=$data['jenis_kelamin']?>
                                </td>
                            </tr>
                            <tr class="px-4 py-3 border font-medium text-gray-900 whitespace-nowrap">
                                <td width="20%" class="p-4">Alergi</td>
                                <td width="1%">:</td>
                                <td class="font-bold">
                                    <?=$data['alergi']?> <?=$data['alergi_lainnya'] ?? '-'?>  
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-5">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500  px-4 border">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  border">
                        <tr>
                            <th class=border">Tgl/Jam : Tgl Pelayanan</th>
                            <th scope="col" class=border">PPA (Dokter/Dokter Gigi)</th>
                            <th scope="col" class=border">Hasil Pemeriksaan/Analisa/Rencana Penatalaksanaan dengan SOAP </th>
                            <th scope="col" class=border">Intruksi PPA</th>
                            <th scope="col" class=border">Tgl/Jam</th>
                            <th scope="col" class=border">PPA (Bidan/Perawat)</th>
                            <th scope="col" class=border">Hasil Pemeriksaan/Analisa/Rencana Penatalaksanaan dengan SOAP/ADIME</th>
                            <th scope="col" class=border">Intruksi PPA</th>
                            <th scope="col" class=border">Review / Verifikasi</th>
                            
                        </tr>
                        <tbody>
                            <tr class="bg-white border">
                                <td class="border"><?=date('d-m-Y', strtotime($data['tanggal_dokter'])).'/'.date('H:i:s', strtotime($data['tanggal_dokter'])) ?></td>
                                <td class="border">
                                    <?=$data['nama_dokter']?>
                                </td>
                                <td class="border">
                                    A : <?=$data['diagnosa_sepluh_kode'] ?> - <?=$data['diagnosa_sepluh'] ?>
                                    <div class="flex w-full">
                                        P : <?php 
                                            $obat = data_obat($id_kunjungan);
                                            foreach ($obat as $key => $value) {
                                                echo $value['nama'];
                                            }
                                        ?> + <?= $data['status_pasien_keluar'] ?>

                                    </div>
                                </td>
                                <td class="border">
                                    <img class="border" src="<?=base_url('signature/'.$data['foto_dokter'])?>" alt="">
                                    <?=$data['nama_dokter']?>
                                </td>
                                <td class="border">
                                    <?=date('d-m-Y', strtotime($data['created_at'])).'/'.date('H:i:s', strtotime($data['created_at'])) ?>
                                </td>
                                <td class="border">
                                    <?=$data['nama_pemeriksa']?>
                                </td>
                                <td class="border">
                                    S : <?=$data['jenis_keluhan']?> <br>
                                    O : 
                                    <table class="">
                                        <tbody class="border w-full">
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap">
                                                <td width="20%" class="">Tekanan Darah</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                    <?=$data['tekanan_darah']?> mmHg
                                                </td>
                                            </tr>
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap ">
                                                <td width="20%" class="">Nadi</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold"><?=ucwords($data['nadi'])?> x/menit</td>
                                            </tr>
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap ">
                                                <td width="20%" class="">Suhu</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold"><?=ucwords($data['suhu'])?> C</td>
                                            </tr>
                                        
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap ">
                                                <td width="20%" class="">Respitory Rate (RR)</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold"><?=ucwords($data['respiratory_rate'])?> x/menit</td>
                                            </tr>
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap ">
                                                <td width="20%" class="">SPO</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold"><?=ucwords($data['spo2'])?> %</td>
                                            </tr>
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap ">
                                                <td width="20%" class="">BB</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold">
                                                        <?=$data['berat_badan']?> kg
                                                </td>
                                            </tr>
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap ">
                                                <td width="20%" class="">TB</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold"><?=ucwords($data['tinggi_badan'])?> CM</td>
                                            </tr>
                                            <tr class=" border font-medium text-gray-900 whitespace-nowrap ">
                                                <td width="20%" class="">IMT</td>
                                                <td width="1%">:</td>
                                                <td class="font-bold"><?=ucwords($data['imt'])?> Hasil Hitung</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </td>
                                <td class="border">
                                    <img class="border" src="<?=base_url('signature/'.$data['ttd_name'])?>" alt="">
                                    <?=$data['nama_pemeriksa']?>
                                </td>
                                <td class="border">
                                </td>
                            </tr>
                            
                        </tbody>
                    </thead>
                </table>
            </div>
    </div>
</body>

</html>
