<head>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php


if ($_GET['id_kinerja'] == null) {
    echo "
    <script>
    window.location.assign('./?url=admin_kinerja')
    </script>
    ";
}

$idKinerja = $_GET['id_kinerja'];
spl_autoload_register(function ($class) {
    require_once 'controller/' . $class . '.php';
});

$wp = new AdminController();
// echo $id_pegawai;
// echo "haloo";

try {
    $dataKinerja = $wp->deleteKinerja($idKinerja);
    
    echo "    
    <body>
    <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
        <script>
            Swal.fire({
                title: 'Data Berhasil Dihapus!',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Kembali'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace('./?url=admin_kinerja')
                }
            })
        </script>
    </body>
";
} catch (\Throwable $th) {
    throw $th;
}

?>