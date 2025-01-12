<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan 10 Besar Penyakit</title>
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
            window.location.href = "<?=base_url('rekam-medis/laporan-penyakit')?>";
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
                <h1 class="font-bold text-lg uppercase">Laporan 10 Besar Penyakit</h1>
                <h1 class="font-bold text-lg uppercase">Unit Rawat Jalan</h1>
                <h1 class="font-bold text-lg uppercase">PUSKESMAS BESUKI</h1>
            </div>
            <div>
                <img src="<?=base_url('img/logo-2.png')?>" width="200px" height="200px" alt="">
            </div>
        </div>
        <hr>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500  px-4 border">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50  border">
                <tr>
                    <th class="px-4 py-3 border">No</th>
                    <th scope="col" class="px-4 py-3 border">Diagnosa</th>
                    <th scope="col" class="px-4 py-3 border">Jumlah</th>
                    
                </tr>
                <tbody>
                        <?php $no = 1;
                            foreach ($data as $row) : ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-3"><?= $no++ ?></td>
                                <td class="px-4 py-3"><?= $row['kode_penyakit'] ?></td>
                                <td class="px-4 py-3"><?= $row['diagnosa_nama'] ?></td>
                                <td class="px-4 py-3"><?= $row['jumlah'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                </tbody>
            </thead>
        </table>
       
    </div>
</body>

</html>
