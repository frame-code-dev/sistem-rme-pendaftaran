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
            window.location.href = "<?= base_url('consent/create/'.$pasien['id']) ?>";
        };
    </script>
</head>

<body class="">
    <div class="w-full mx-auto bg-white p-6 rounded-lg shadow-lg">
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
        <div class="flex justify-between">
            <div class="" style="width: 100%;">
                <h6 class="text-center text-md font-bold">PERSETUJUAN UMUM (GENERAL INFORMED CONSENT)</h6>
                <h6 class="text-center text-md font-bold mb-4">PASIEN/KELUARGA DIMOHON MEMBACA, MEMAHAMI DAN MENGISI INFORMASI BERIKUT</h6>
            </div>
            <div class="w-1/2 text-end">
                <span class="font-bold">No Rekam Medis</span>
            </div>
        </div>
        
        <p class="font-medium text-gray-900 whitespace-nowrap">Yang Bertanda tangan dibawah ini :</p>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
            <tbody class="p-2 w-full">
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Nama</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($request['nama_lengkap'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Tanggal Lahir</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$request['tgl_lahir']?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Alamat</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($request['alamat_lengkap'])?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Nomor Telepon</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$request['no_hp']?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Hubungan Dengan Pasien</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($request['hubungan_pasien'])?></td>
                </tr>
            </tbody>
        </table>
        <div class="mt-2">
            <p class="font-medium text-gray-900 whitespace-nowrap">Adalah Penanggung jawab untuk pasien :</p>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 px-4">
            <tbody class="p-2 w-full">
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Nama </td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($pasien['nama_lengkap'] ?? '-')?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Tanggal Lahir</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=$pasien['tanggal_lahir']?></td>
                </tr>
                <tr class="font-medium text-gray-900 whitespace-nowrap">
                    <td width="20%" class="p-2">Perawatan</td>
                    <td width="1%">:</td>
                    <td class="font-bold"><?=ucwords($request['jenis_perawatan'])?></td>
                </tr>
            </tbody>
        </table>
        <div class="space-y-4">
            <div>
                <p class="font-medium text-gray-900 whitespace-nowrap">Dengan ini menyatakan persetujuan :</p>
            </div>
            <div class="space-y-2">
                <h2 class="font-bold">I. HAK DAN KEWAJIBAN PASIEN</h2>
                <p>Saya telah mendapat informasi tentang Hak dan Kewajiban Pasien di UPT Puskesmas Besuki melalui leaflet/banner yang disediakan oleh petugas dan saya memiliki hak untuk mengambil bagian dalam keputusan mengenai: penyakit saya, perawatan medis, serta rencana pengobatan.</p>
            </div>

            <div class="space-y-2">
                <h2 class="font-bold">II. PERSETUJUAN PELAYANAN KESEHATAN</h2>
                <p>Saya menyetujui dan memberikan persetujuan untuk mendapat pelayanan kesehatan di Puskesmas Besuki dan dengan ini saya meminta dan memberikan kuasa kepada Tenaga Kesehatan di Puskesmas Besuki untuk memberikan pelayanan kesehatan berupa pemeriksaan fisik, prosedur diagnostik/terapi/pengobatan medis lainnya sesuai pertimbangan Tenaga Kesehatan Puskesmas Besuki yang diperlukan atau disarankan selama pelayanan kesehatan terhadap saya.</p>
            </div>

            <div class="space-y-2">
                <h2 class="font-bold">III. PRIVASI</h2>
                <ol class="ps-5 mt-2 space-y-1 list-decimal list-inside">
                    <li>Saya memberi kuasa kepada Tenaga Kesehatan Puskesmas Besuki untuk menjaga privasi dan kerahasiaan penyakit saya selama menjalani pelayanan kesehatan</li>
                    <li>Saya <?=$request['privasi_khusus']?> privasi khusus.<?=$request['permintaan_privasi_khusus']?> </li>
                    <li>Saya <?=$request['akses_keluarga']?> Tenaga Kesehatan Puskesmas Besuki memberi akses bagi keluarga, <?=$pasien['nama_lengkap']?>, serta orang lain yang akan menengok/menemui saya bila saya dirawat.</li>
                </ol>
            </div>

            <div class="space-y-2">
                <h2 class="font-bold">IV. PERSETUJUAN PELEPASAN INFORMASI</h2>
                <p>Saya memberikan persetujuan untuk memberikan informasi tentang diagnosis, kondisi medis, rencana pengobatan dan perawatan, indikasi tindakan, pengobatan, hasil pengobatan maupun perawatan, risiko dan komplikasi, serta informasi lain yang saya terima kepada:</p>
                <ol class="ps-5 mt-2 space-y-1 list-decimal list-inside">
                    <li>Perusahaan asuransi kesehatan atau pihak lain yang menjamin pembiayaan saya.</li>
                    <li>Pihak berwajib yang memerlukan informasi kesehatan saya.</li>
                </ol>
            </div>
            <div class="space-y-2">
                <h2 class="font-bold">V. BARANG PRIBADI</h2>
                <p>Saya setuju untuk tidak membawa barang-barang berharga yang tidak diperlukan (seperti perhiasan, alat elektronik/gadget, dll) selama menjalani pelayanan kesehatan di Puskesmas Besuki.</p>
            </div>

            <div class="space-y-2">
                <h2 class="font-bold">VI. KEWAJIBAN PEMBAYARAN</h2>
                <p>Saya menyatakan setuju/tidak setuju sebagai wali atau sebagai pasien, bahwa sesuai pertimbangan pelayanan yang diberikan kepada pasien, maka saya wajib untuk membayar total biaya pelayanan dengan cara bayar <?=$request['cara_bayar']?>.</p>
                <p class="ml-4">[ ] Setuju &nbsp;&nbsp;&nbsp;&nbsp; [ ] Tidak Setuju</p>
            </div>
            <p class="mt-12 text-end">Besuki, <?=date('Y-m-d')?></p>
            <div class="flex justify-between py-5 my-5">
                <div>
                    <h1>Pasien/Keluarga/Penanggung Jawab *</h1>
                    <div class="my-5 py-5"></div>
                    <div>
                        <p class="mt-8">...............................................................</p>
                    </div>
                </div>
                <div>
                    <h1>Saksi</h1>
                    <div class="my-5 py-5"></div>
                    <div>
                        <p class="mt-8">...............................................................</p>
                    </div>
                </div>
                <div>
                    <h1>Petugas Puskesmas Besuki</h1>
                    <div class="my-5 py-5"></div>
                    <div>
                        <p class="mt-8">...............................................................</p>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <span class="">* Lingkari yang dipilih</span>
            </div>
            <span>Jika pasien berumur kurang dari 21 tahun dan belum menikah yang bertanda tangan adalah keluarga/wali</span>
        </div>
    </div>
</body>

</html>
