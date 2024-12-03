<head>

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php


if ($_GET['id_pegawai'] == null) {
    echo "
    <script>
    window.location.assign('./?url=admin-dashboard')
    </script>
    ";
}

$idKaryawan = $_GET['id_pegawai'];
spl_autoload_register(function ($class) {
    require_once 'controller/' . $class . '.php';
});

$wp = new AdminController();
// echo $id_pegawai;
// echo "haloo";

try {
    $dataSurat = $wp->deleteKaryawan($idKaryawan);
    
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
                    window.location.replace('./?url=admin_dashboard')
                }
            })
        </script>
    </body>
";
} catch (\Throwable $th) {
    throw $th;
}

?>