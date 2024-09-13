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
        print();
        window.onafterprint = function() {
            window.location.href = "<?=base_url('rekam-medis/kunjungan-laporan')?>";
        };
    </script>
</head>

<body class="">
    <div class="w-full mx-auto bg-whitep-6">
        <div class="flex justify-between content-center items-center">
            <div>
                <img src="<?=base_url('img/logo.jpg')?>" width="150px" height="150px" alt="">
            </div>
            <div class="mx-4 text-center w-full self-center">
                <h1 class="font-bold text-lg uppercase">Laporan Kunjungan Pasien</h1>
                <h1 class="font-bold text-lg uppercase">Unit Rawat Jalan</h1>
                <h1 class="font-bold text-lg uppercase">PUSKESMAS BESUKI</h1>
            </div>
            <div>
                <img src="<?=base_url('img/logo-2.png')?>" width="200px" height="200px" alt="">
            </div>
        </div>
        <hr>
        <div class="my-3">
            <h6 class="text-start text-md font-bold">PERIODE : <?=$start?> - <?=$end?></h6>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500  px-4 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  border">
                <tr>
                    <th class="px-4 py-3 border">No</th>
                    <th scope="col" class="px-4 py-3 border">NO. RM</th>
                    <th scope="col" class="px-4 py-3 border">Nama Lengkap</th>
                    <th scope="col" class="px-4 py-3 border">L/P</th>
                    <th scope="col" class="px-4 py-3 border">Jenis Pasien</th>
                    <th scope="col" class="px-4 py-3 border">Umur</th>
                    <th scope="col" class="px-4 py-3 border">Jenis Kunjungan</th>
                    <th scope="col" class="px-4 py-3 border">Tujuan Pelayanan</th>
                    
                </tr>
                <tbody>
                    <?php $no = 1;
                    foreach ($data as $row) : ?>
                        <tr class="bg-white border-b ">
                            <td class="px-4 py-3 border"><?= $no++ ?></td>
                            <td class="px-4 py-3 border"><?= $row['no_rm'] ?></td>
                            <td class="px-4 py-3 border"><?= $row['nama_lengkap'] ?></td>
                            <td class="px-4 py-3 border"><?= $row['jenis_kelamin'] ?></td>
                            <td class="px-4 py-3 border"><?= $row['jenis_pasien'] ?></td>
                            <td class="px-4 py-3 border"><?= hitungUmur($row['tanggal_lahir']) ?></td>
                            <td class="px-4 py-3 border"><?= $row['status_kunjungan'] ?></td>
                            <td class="px-4 py-3 border"><?= $row['poli'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </thead>
        </table>
       
    </div>
</body>

</html>
