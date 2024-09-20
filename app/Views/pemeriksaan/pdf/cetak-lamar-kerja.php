<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Lamar Kerja</title>
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
        <div class="flex justify-center my-3">
            <div class="text-center" style="width: 100%;">
                <h6 class="text-center text-md font-bold">SURAT KETERANGAN BERBADAN SEHAT</h6>
                <span class="text-center text-md font-bold">NOMOR : 810 / 542 / 431. 201. 7. 3 / 2024</span>
            </div>
        </div>
        <span>Yang bertanda tangan di bawah ini, Dokter Puskesmas Besuki, mengingat sumpah / janji dokter dengan ini menerangkan dengan sebenarnya bahwa :</span>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
            <tbody class=" w-full">
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Nama</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['no_rm'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Tempat/Tgl Lahir</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$pasien['tempat_lahir']?> / <?=$pasien['tanggal_lahir']?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Jenis Kelamin</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['jenis_kelamin'])?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Pekerjaan</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$pasien['pekerjaan']?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="">Tempat Tinggal</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$pasien['alamat_lengkap']?></td>
                </tr>
            </tbody>
        </table>
      
        <p>Telah diperiksa dengan teliti atas permintaannya sendiri dan saat ini yang bersangkutan tidak ada keluhan maka pasien <b>Berbadan Sehat</b>.</p><br>
        <p>Surat keterangan ini diberikan untuk keperluan :</p>
        <p>Semua keterangan yang diberikan diatas benar-benar menurut pengetahuan kami,  untuk dipergunakan sebagaimana mestinya,</p>
     
        <div class="my-4 flex justify-between">
            <div>
                <span>Yang Bersangkutan,</span>
                <br>
                <br>
                <br>
                <br>
                <br>
                <span>(.....................................................................)</span>
            </div>
            <div>
                <span>Situbondo, <?=date('d-m-Y')?></span><br>
                <span>Dokter Pemeriksa</span>
                <br>
                <br>
                <br>
                <span>dr. Yoan Natalia L.A</span><br>
                <span>NIP. 19741222N2003122003</span>
            </div>
        </div>
        <div class="my-4 flex justify-start">
            <div>
                <span class="font-bold">Keterangan :</span> <br>
                <span class=""><b>Tekanan Darah :</b> : <?=$pemeriksaan_objective['tekanan_darah']?></span><br>
                <span class=""><b>Tinggi Badan </b> : <?=$pemeriksaan_objective['tinggi_badan']?></span><br>
                <span class=""><b>Berat Badan</b> : <?=$pemeriksaan_objective['berat_badan']?></span><br>
                <span class=""><b>Golongan Darah </b> : <?=$pasien['gol_darah']?></span><br>
                <span class=""><b>Penglihatan </b> : <?=$request['jenis_penglihatan']?></span><br>
                <span class=""><b>Pendengaran </b> : <?=$request['jenis_pendengaran']?></span><br>
            </div>  
        </div>
    </div>
</body>

</html>
