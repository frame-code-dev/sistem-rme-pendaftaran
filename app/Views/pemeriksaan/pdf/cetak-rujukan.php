<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Informed Consent</title>
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
    <div class="w-full mx-auto bg-white p-6 rounded-lg">
        <div class="flex justify-between content-center items-center">
            <div>
                <img src="<?=base_url('img/logo.jpg')?>"  width="150" height="150" alt="">
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
                <img src="<?=base_url('img/logo-2.png')?>"  width="200" height="200" alt="">
            </div>
        </div>
        <hr>
        <div class="flex justify-center">
            <div class="" style="width: 100%;">
                <h6 class="text-center text-md font-bold">SURAT RUJUKAN</h6>
            </div>
        </div>
        
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
            <tbody class=" w-full">
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">No.RM</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Jenis Pasien</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$pasien['jenis_pasien']?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">No. Kartu</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'])?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Tanggal</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$pasien['tanggal_lahir']?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Jam</td>
                    <td width="1%">:</td>
                    <td class="font-bold">1221</td>
                </tr>
            </tbody>
        </table>
        <div class="my-4 flex justify-end">
            <div>
                <span>Kepada Yth.</span><br>
                <span>Di</span>
            </div>
        </div>
        <p>Mohon bantuan perawatan dan pengobatan selanjutnya penderita :</p>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
            <tbody class=" w-full">
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Nama</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Jenis Kelamin</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Umur</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Alamat</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Anamnesa</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Pemeriksaan Fisik</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Pemeriksaan Penunjang</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Diagnosa (ICD 10)</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Pengobatan yang dilakukan atau diberikan</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Alasan dirujuk </td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
            </tbody>
        </table>
        <div class="my-4 flex justify-between">
            <div>
                <span>Penerima</span>
                <br>
                <br>
                <br>
                <span>(.....................................................................)</span>
            </div>
            <div>
                <span>Pengirim</span>
                <br>
                <br>
                <br>
                <span>(.....................................................................)</span>
            </div>
        </div>
        <div class="my-4 flex justify-start">
            <div>
                <span class="font-bold">Keterangan :</span> <br>
                <span class="">Form Rangkap 3 :</span><br>
                <span class=""><b>Lembar 1</b> : disertakan ke pasien</span><br>
                <span class=""><b>Lembar 2</b> : dikirim ke Dinas Kesehatan Kab. Situbondo</span><br>
                <span class=""><b>Lembar 3</b> : Arsip Monev</span><br>
            </div>
        </div>
    </div>
</body>

</html>
