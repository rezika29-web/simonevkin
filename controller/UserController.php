<?php

class UserController{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=simonev_db', "root", "");
    }

    public function fetch($query)
    {
        while ($fetch = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $fetch;
        }
        return @$data;
    }

    public function getKinerja($idkaryawan)
    {
        $stmt = $this->db->prepare("SELECT * FROM tabel_proses JOIN tabel_kinerja on tabel_proses.id_kinerja = tabel_kinerja.id_kinerja  WHERE id_pegawai = '$idkaryawan'");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function getKinerjaStaff($idjabatan)
    {
        $stmt = $this->db->prepare("SELECT * FROM tabel_proses JOIN tabel_pegawai ON tabel_proses.id_pegawai=tabel_pegawai.id_pegawai JOIN tabel_kinerja ON tabel_proses.id_kinerja=tabel_kinerja.id_kinerja JOIN tabel_jabatan ON tabel_proses.id_jabatan=tabel_jabatan.id_jabatan WHERE tabel_proses.id_jabatan = '$idjabatan'");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function getIdProses($idproses)
    {
        $stmt = $this->db->prepare("SELECT * from tabel_proses  WHERE id_proses = '$idproses'");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function evaluasiKin($idproses, $status, $catatan)
    {
        try {
            $sqlDatakinerja = "UPDATE tabel_proses SET id_proses = ?, status = ?, catatan = ? WHERE id_proses = '$idproses'";
            $stmtDatakinerja = $this->db->prepare($sqlDatakinerja);
            $stmtDatakinerja->execute([$idproses, $status, $catatan]);
           echo " <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
           <script>
           Swal.fire({
                   title: 'Data Berhasil Diperbarui!',
                   icon: 'success',
                   showCancelButton: false,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'OK'
               }).then((result) => {
                   if (result.isConfirmed) {
                       window.location.assign('./?url=monitoring&edit_data=true')
                   }
               })
           </script>
           ";
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

    
}
?>