<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=
    $segment = service('uri')->getSegment(1);
    ?>
    <title>Dashboard - <?= ucwords($segment) ?></title>
    
    <!-- Tailwind CSS -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.tailwindcss.css">
    <link rel="stylesheet" href="http://localhost:3479/resources/app.css">
    
    <!-- select 2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- FONT AWESOME  -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <?= $this->renderSection('css') ?>
</head>
<body>
    <?=$this->include('layouts/components/topbar')?>
    <?=$this->include('layouts/components/sidebar')?>
    <?= $this->renderSection('content') ?>
    <!-- Vite HMR -->
    <!-- <script type="module" src="http://localhost:3479/@vite/client"></script> -->
    <script type="module" src="http://localhost:3479/resources/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // update status
        $(document).ready(function() {
            $('.update-modal').click(function() {
                var id = $(this).data('user');
                $('#id').val(id);
            })
        })
        function deleteConfirm(event) {
            console.log(event);
            Swal.fire({
                title: 'Konfirmasi hapus data!',
                text: 'Apakah anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus',
                confirmButtonColor: 'red'
            }).then(dialog => {
                if (dialog.isConfirmed) {
                    window.location.assign(event);
                }
            });
        }
        // Datatable
        // $('#datatable').DataTable({
        //     responsive: true,
        //     ordering: false,
        //     "oLanguage": {
        //         "sEmptyTable": "Maaf data belum tersedia."
        //     },
        //     "columnDefs": [{
        //         // "defaultContent": "",
        //         // "targets": "_all"
        //     }]
        // });
        $('.datatable').DataTable({
            responsive: true,
            ordering: false,
            "oLanguage": {
                "sEmptyTable": "Maaf data belum tersedia."
            },
            "columnDefs": [{
                // "defaultContent": "",
                // "targets": "_all"
            }]
        });
    </script>
    <script>
        // Create the performance observer.
        const po = new PerformanceObserver((list) => {
        for (const entry of list.getEntries()) {
            // Logs all server timing data for this response
            console.log('Server Timing', entry.serverTiming);
        }
        });

        // Start listening for `navigation` entries to be dispatched.
        po.observe({type: 'navigation', buffered: true});
    </script>
<?= $this->renderSection('js') ?>
    <?php
        $session = \Config\Services::session();
        $status_error = $session->get('status_error');
        $status_success = $session->get('status_success');
    ?>
    <?php if ($status_success) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: <?= json_encode($session->getFlashdata('message')) ?>
                })
            });
        </script>
    <?php endif; ?>
    <?php if ($status_error) : ?>
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: '<?= $session->getFlashdata('error') ?>'
            })
        </script>
    <?php endif ?>
</body>

</html>