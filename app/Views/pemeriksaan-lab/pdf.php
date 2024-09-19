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
        <div class="mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
                <tbody class=" w-full">
                    <tr class="font-medium text-gray-900 whitespace-nowrap">
                        <td width="20%" class="">Tanggal Pelayanan</td>
                        <td width="1%">:</td>
                        <td class="font-bold"><?=$current_data['tanggal_kunjungan']?></td>
                    </tr>
                    <tr class="font-medium text-gray-900 whitespace-nowrap">
                        <td width="20%" class="">No RM</td>
                        <td width="1%">:</td>
                        <td class="font-bold"><?=$current_data['no_rm']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="grid grid-cols-2 gap-3 mb-4">
            <div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
                    <tbody class=" w-full">
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">Nama</td>
                            <td width="1%">:</td>
                            <td class="font-bold"><?=$current_data['nama_lengkap']?></td>
                        </tr>
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">UMUR</td>
                            <td width="1%">:</td>
                            <td class="font-bold"><?=hitungUmur($current_data['tanggal_lahir'])?></td>
                        </tr>
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">Alamat</td>
                            <td width="1%">:</td>
                            <td class="font-bold"><?=$current_data['alamat_lengkap']?></td>
                        </tr>
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">Jenis Kelamin</td>
                            <td width="1%">:</td>
                            <td class="font-bold"><?=$current_data['jenis_kelamin']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
                    <tbody class=" w-full">
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">Status Pasien</td>
                            <td width="1%">:</td>
                            <td class="font-bold"><?=$current_data['status_kunjungan']?></td>
                        </tr>
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">Dokter Pengirim</td>
                            <td width="1%">:</td>
                            <td class="font-bold"><?=$current_data['nama_dokter_pemeriksa']?></td>
                        </tr>
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">Poli Pengirim</td>
                            <td width="1%">:</td>
                            <td class="font-bold"><?=$current_data['poli']?></td>
                        </tr>
                        <tr class="font-medium text-gray-900 whitespace-nowrap">
                            <td width="20%" class="">Penanggung Jawab</td>
                            <td width="1%">:</td>
                            <td class="font-bold">dr. Yoan Natalia L.A</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <h1 class="text-lg font-bold text-center uppercase">Hasil PEMERIKSAAN Laboratorium</h1>
        <div class="mt-3">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500  px-4 border">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  border">
                    <tr>
                        <th class="px-4 py-3 border">Jenis Pemeriksaan</th>
                        <th scope="col" class="px-4 py-3 border">Detail Pemeriksaan</th>
                        <th scope="col" class="px-4 py-3 border">Nilai Normal</th>
                        <th scope="col" class="px-4 py-3 border">Hasil</th>
                        
                    </tr>
                    <tbody>
                        <?php $no = 1;
                        foreach ($detail_pemeriksaan as $row) : ?>
                            <tr class="bg-white border-b ">
                                <td class="px-4 py-3 border"><?= $row['jenis_pemeriksaan'] ?></td>
                                <td class="px-4 py-3 border"><?= $row['nama'] ?></td>
                                <td class="px-4 py-3 border"><?= $row['nilai_normal'] ?? '-' ?></td>
                                <td class="px-4 py-3 border"><?= $row['hasil'] ?? '-' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </thead>
            </table>
        </div>
        
        <div class="my-4 flex justify-between">
            <div>

            </div>
            <div>
                <span>Situbondo, <?=date('d-m-Y')?></span><br>
                <span>Pemeriksa</span>
                <br>
                <br>
                <br>
                <span><?=$current_data['nama_pemeriksa']?></span><br>
                <span>NIP. 19741222N2003122003</span>
            </div>
        </div>
        
    </div>
</body>

</html>
