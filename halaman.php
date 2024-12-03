<?php
if (isset($_GET['url'])){
    $url=$_GET['url'];

    switch($url){
        case 'admin_dashboard':
            include 'admin_dashboard.php';
        break;
        case 'admin-input-pegawai':
            include 'admin-input-pegawai.php';
        break;
        case 'admin-edit-pegawai':
            include 'admin-edit-pegawai.php';
        break;
        case 'admin-hapus-pegawai':
            include 'admin-hapus-pegawai.php';
            
        case 'realisasi_kinerja':
            include 'realisasi_kinerja.php';
        break;

        case 'laporan':
            include 'laporan.php';
        break;

        case 'uploadfile':
            include 'uploadFile.php';
        break;

        case 'monitoring':
            include 'monitoring.php';
        break;
        
        case 'edit_monitoring':
            include 'edit_monitoring.php';
        break;

        case 'detail_monitoring':
            include 'detail_monitoring.php';
        break;

        case 'admin_kinerja':
            include 'admin_kinerja.php';
        break;

        case 'add_kinerja':
            include 'add_kinerja.php';
        break;

        case 'edit_kinerja':
            include 'edit_kinerja.php';
        break;

        case 'myakun':
            include 'myAkun.php';
        break;

    }
}

?>