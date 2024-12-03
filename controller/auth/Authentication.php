<?php

class Authentication
{
    public function login($username, $password)
    {
        session_start();

        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'simonev_db';

        $connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        if (mysqli_connect_errno()) {
            exit('Error menyambungkan ke database. Error: ' . mysqli_connect_error());
        }

        if ($username == null || $password == null) {
            exit("<body>
            <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
            <script> 
                Swal.fire('Username atau pasword tidak boleh kosong')
            </script>
        </body>");
        }

        try {
            $stmt = $connect->prepare('SELECT id_pegawai, nama_pegawai, password, id_jabatan FROM tabel_pegawai WHERE username = ?');
            $stmt->bind_param('s', $username);

            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $namaKaryawan, $password, $idJabatan);
                $stmt->fetch();
                if ($_POST['password'] === $password) { // pakai if (password_verify($_POST['password'], $password)) { untuk pakai hash PHP            // Verification success! User has logged-in!
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['nama_pegawai'] = $namaKaryawan;
                    $_SESSION['username'] = $username;
                    $_SESSION['id_pegawai'] = $id;
                    $_SESSION['id_jabatan'] = $idJabatan;
                    if ($idJabatan == "1"){
                        header('location:./?url=monitoring');
                    }elseif ($idJabatan == "1000"){
                        header('location:./?url=admin_dashboard');
                    }
                    else{
                        header('location:./?url=realisasi_kinerja');
                    }
                } else {
                    echo "
                    <body>
                        <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
                        <script> 
                            Swal.fire({
                            text: 'Username atau Password salah. Silahkan coba kembali.',
                            icon: 'warning',
                            confirmButtonText: 'Kembali'
                            })
                        </script>
                    </body>
                        ";
                }
            } else {

                echo "
                <body>
                    <script src='assets/js/sweetalert/sweetalert2@11.js'></script>
                    <script> 
                        Swal.fire({
                            text: 'Username atau Password salah. Silahkan coba kembali.',
                            icon: 'warning',
                            confirmButtonText: 'Kembali'
                    })
                    </script>
                </body>
                    ";
            }

            $stmt->close();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
