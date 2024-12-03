<?php

class AdminController {
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

    public function totalKaryawan()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM tabel_pegawai");
        $stmt->execute();
        return $this->fetch($stmt);
    }


    public function getKaryawan()
    {
        $stmt = $this->db->prepare("SELECT * from tabel_pegawai JOIN tabel_jabatan on tabel_pegawai.id_jabatan = tabel_jabatan.id_jabatan ");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function editKaryawan($idkaryawan, $nama,$nip,$golongan,$id_jabatan, $username, $password)
    {
        $kinerja = $this->takeKinerja($id_jabatan)[0];
        $id_kinerja = $kinerja['id_kinerja'];
        if ($id_kinerja != NULL){
        try {
            $sqlDatakaryawan = "UPDATE tabel_pegawai SET nama_pegawai = ?, nip = ?, golongan = ?, id_jabatan = ?, username = ?, password = ? WHERE id_pegawai = '$idkaryawan'";
            $stmtDatakaryawan = $this->db->prepare($sqlDatakaryawan);
            $stmtDatakaryawan->execute([$nama,$nip,$golongan,$id_jabatan, $username, $password]);
            if ($stmtDatakaryawan) {
                $sqlKinerja = "UPDATE tabel_proses SET id_jabatan = ?, id_kinerja = ? WHERE id_pegawai = '$idkaryawan'";
                $stmtkinerja = $this->db->prepare($sqlKinerja);
                $stmtkinerja->execute([$id_jabatan,$id_kinerja]);
                echo " <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
                        <script>
                        Swal.fire({
                                title: 'Data Berhasil Ditambah!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.assign('./?url=admin_dashboard&edit_data=true')
                                }
                            })
                        </script>
                        ";
            }
           
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }else{
        echo " <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
                        <script>
                        Swal.fire({
                                title: 'Indikator Kinerja untuk Jabatan ini belum diinputkan!',
                                icon: 'failed',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.assign('./?url=admin_kinerja')
                                }
                            })
                        </script>
                        ";
    }
    }

    public function deleteKaryawan($idKaryawan)
    {
        try {
            $sqlProses = "DELETE FROM tabel_proses WHERE id_pegawai = ?";
            $stmtProses = $this->db->prepare($sqlProses);
            $stmtProses->execute([$idKaryawan]);
            if ($stmtProses){
                $sqlKaryawan = "DELETE FROM tabel_pegawai WHERE id_pegawai = ?";
                $stmtKaryawan = $this->db->prepare($sqlKaryawan);
                $stmtKaryawan->execute([$idKaryawan]);
            }
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

    public function getIdKaryawan($idkaryawan)
    {
        $stmt = $this->db->prepare("SELECT * from tabel_pegawai JOIN tabel_jabatan on tabel_pegawai.id_jabatan = tabel_jabatan.id_jabatan  WHERE id_pegawai = '$idkaryawan'");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function getJabatan()
    {
        $stmt = $this->db->prepare("SELECT * FROM tabel_jabatan ");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function getLastId()
    {
        $stmt = $this->db->prepare("SELECT id_pegawai FROM tabel_pegawai ORDER BY id_pegawai DESC LIMIT 1");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function inputDataUser($id_pegawai,$id_jabatan, $nip, $nama, $golongan, $username, $password)
    {
        try {
            // $sqlDataPegawai = "INSERT INTO tabel_pegawai (nama_pegawai, tempat_lahir, tanggal_lahir, nip, pangkat, gaji_lama, surat_keputusan, nomor_surat, tanggal_surat, gaji_baru, masa_kerja, terhitungMulai) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sqlDataUser = "INSERT INTO tabel_pegawai (id_pegawai, id_jabatan, nip,nama_pegawai, golongan,username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtDatauser = $this->db->prepare($sqlDataUser);
            $stmtDatauser->execute([$id_pegawai, $id_jabatan, $nip,$nama, $golongan,$username, $password]);

            if ($stmtDatauser) {
                return $this->inputDataproses(
                    $id_jabatan, 
                    $id_pegawai
                );
            }
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }
    public function takeKinerja($id_jabatan)
    {
        $stmt = $this->db->prepare("SELECT id_kinerja FROM tabel_kinerja WHERE id_jabatan= '$id_jabatan'");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function inputDataproses($id_jabatan, $id_pegawai)
    {

        $kinerja = $this->takeKinerja($id_jabatan)[0];
        $id_kinerja = $kinerja['id_kinerja'];
        try {
            $sqlDataProses = "INSERT INTO tabel_proses (id_jabatan, id_pegawai, id_kinerja, realisasi, status ) VALUES (?,?,?,0,'kosong')";
            $stmtDataproses = $this->db->prepare($sqlDataProses);
            $stmtDataproses->execute([$id_jabatan, $id_pegawai, $id_kinerja]);
            if ($stmtDataproses) {
                echo "
                <script>
                window.location.assign('./?url=admin_dashboard')
                </script>
                ";
            }
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

    public function editDataUser ($nama, $nip, $golongan,$jabatan,$password)
    {
        try {
            $sqlDataSekolah = "UPDATE tabel_user SET nama = ?, nip = ?, golongan = ?, jabatan = ?, password = ? WHERE nama = '$nama'";
            $stmtDataSekolah = $this->db->prepare($sqlDataSekolah);
            $stmtDataSekolah->execute([$nama, $nip, $golongan,$jabatan,$password]);
            // header('location:./?url=list_sekolah&edit_data=true');
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

// ===========================================KINERJA==================================================

    public function getKinerja()
    {
        $stmt = $this->db->prepare("SELECT * from tabel_kinerja JOIN tabel_jabatan on tabel_kinerja.id_jabatan = tabel_jabatan.id_jabatan ");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function editKinerja($id_kinerja,$sasaran,$indikator,$target,$id_jabatan)
    {
        try {
            $sqlDatakinerja = "UPDATE tabel_kinerja SET id_kinerja = ?, sasaran = ?, indikator = ?, target = ?, id_jabatan = ? WHERE id_kinerja = '$id_kinerja'";
            $stmtDatakinerja = $this->db->prepare($sqlDatakinerja);
            $stmtDatakinerja->execute([$id_kinerja,$sasaran,$indikator,$target,$id_jabatan]);
           echo " <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
           <script>
           Swal.fire({
                   title: 'Data Berhasil Ditambah!',
                   icon: 'success',
                   showCancelButton: false,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'OK'
               }).then((result) => {
                   if (result.isConfirmed) {
                       window.location.assign('./?url=admin_kinerja&edit_data=true')
                   }
               })
           </script>
           ";
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

    public function deleteKinerja($idKinerja)
    {
        try {
            $sqlKaryawan = "DELETE FROM tabel_kinerja WHERE id_kinerja = ?";
            $stmtKaryawan = $this->db->prepare($sqlKaryawan);
            $stmtKaryawan->execute([$idKinerja]);
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

    public function getIdKinerja($idkinerja)
    {
        $stmt = $this->db->prepare("SELECT * from tabel_kinerja JOIN tabel_jabatan on tabel_kinerja.id_jabatan = tabel_jabatan.id_jabatan  WHERE id_kinerja = '$idkinerja'");
        $stmt->execute();
        return $this->fetch($stmt);
    }

    public function inputKinerja($id_jabatan, $sasaran, $indikator, $target)
    {
        try {
            $sqlDataKinerja = "INSERT INTO tabel_kinerja (id_jabatan, sasaran, indikator, target) VALUES (?, ?, ?, ?)";
            $stmtDatakinerja = $this->db->prepare($sqlDataKinerja);
            $stmtDatakinerja->execute([$id_jabatan, $sasaran, $indikator, $target]);

            if ($stmtDatakinerja) {
                echo "
                <script>
                window.location.assign('./?url=admin_kinerja')
                </script>
                ";
            }
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

    public function editAkun ($idkaryawan, $nama, $nip, $golongan,$username,$password)
    {
        try {
            $sqlDataSekolah = "UPDATE tabel_pegawai SET id_pegawai = ?, nama_pegawai = ?, nip = ?, golongan = ?, username = ?, password = ? WHERE id_pegawai = '$idkaryawan'";
            $stmtDataSekolah = $this->db->prepare($sqlDataSekolah);
            $stmtDataSekolah->execute([$idkaryawan, $nama, $nip, $golongan,$username,$password]);
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
                       window.location.assign('./?url=')
                   }
               })
           </script>
           ";

        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }








    // public function editDataSekolah ($idSekolah, $nama, $email, $password)
    // {
    //     try {
    //         $sqlDataSekolah = "UPDATE tabel_user SET nama_sekolah = ?, email = ?, password = ? WHERE id_sekolah = '$idSekolah'";
    //         $stmtDataSekolah = $this->db->prepare($sqlDataSekolah);
    //         $stmtDataSekolah->execute([$nama, $email, $password]);
    //         // header('location:./?url=list_sekolah&edit_data=true');
    //     } catch (\Throwable $th) {
    //         echo "Error! " . $th;
    //     }
    // }
    
    public function deleteSekolah($idSekolah)
    {
        try {
            $sqlSekolah = "DELETE FROM tabel_user WHERE id_sekolah = ?";
            $stmtSekolah = $this->db->prepare($sqlSekolah);
            $stmtSekolah->execute([$idSekolah]);
        } catch (\Throwable $th) {
            echo "Error! " . $th;
        }
    }

    public function totalPegawai()
    {
        $ttp = $this->db->prepare("SELECT COUNT(nip) FROM tabel_pegawai");
        $ttp->execute();
        return $this->fetch($ttp);
    }

    public function totalSchool()
    {
        $tts = $this->db->prepare("SELECT COUNT(id_sekolah) FROM tabel_user WHERE role ='sekolah'");
        $tts->execute();
        return $this->fetch($tts);
    }

    public function updateSandi($idSekolah, $newpassword)
    {
        $stmtt = $this->db->prepare("UPDATE tabel_user SET password=? WHERE id_sekolah = '$idSekolah'");
        $stmtt->execute([$newpassword]);
    }

    public function getLaporan()
    {
        $argm = $this->db->prepare("SELECT * FROM tabel_pegawai JOIN tabel_user on tabel_pegawai.id_sekolah = tabel_user.id_sekolah ");
        $argm->execute();
        return $this->fetch($argm);
    }

}