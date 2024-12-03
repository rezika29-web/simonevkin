    <body>
        <!-- Start Content-->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">



                            <!-- Steps Information -->
                            <div class="tab-content">

                                <!-- Billing Content-->
                                <div class="tab-pane show active" id="billing-information">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="mt-2">Input Data Pegawai</h4>

                                            <p class="text-muted mb-4">Silahkan Input Data Karyawan Baru</p>
                                            <form method="POST" >
                                                <div class="form-row">


                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="col-3 col-form-label">Pilih Jabatan<span class="text-danger">*</span></label>
                                                                <select  data-live-search="true" class="form-select" id="example-select" name="id_jabatan">                                                 
                                                                    <option selected disabled value="">Pilih Jabatan</option>
                                                                                                                     <?php

                                                        require_once 'controller/AdminController.php';

                                                        $class = new AdminController();



                                                        $jabtanKaryawan = $class->getJabatan();
                                                        $lastid = $class->getLastId()[0];


                                                        if ($jabtanKaryawan != null) {
                                                            foreach ($jabtanKaryawan as $jbt) {

                                                        ?>
                                                                    <option value="<?php echo $jbt['id_jabatan'] ?>"><?php echo $jbt['nama_jabatan'] ?></option>
                                                                    <?php
                                                            }}
                                                            ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                    <div class="mb-3">
                                                        <input
                                                        type="hidden"
                                                        value="<?php echo $lastid['id_pegawai']+1 ?>"
                                                        class="form-control"
                                                        id="id_pegawai"
                                                        name="id_pegawai"
                                                        />
                                                    </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">NIP<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="NIP" id="nip" name="nip" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Nama<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="Nama" id="nama" name="nama" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Golongan<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="Golongan" id="golongan" name="golongan" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Username<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="Username" id="username" name="username" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Password<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="password" placeholder="Password" id="password" name="password" required>
                                                        </div>
                                                    </div>
                                                
                                                

                                                    </div> <!-- end row -->

                                                <button type="submit" class="btn btn-success" name="submit">Tambahkan</button>
                                                <a type="button" class="btn btn-danger" href="?url=admin_dashboard">Batal</a> <!-- end row -->
                                            </form>
                                        </div>     
                                    </div> <!-- end row-->
                                </div>
                            </div> <!-- end tab content-->

                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->
        <?php
if (isset($_POST['submit'])) {

    spl_autoload_register(function ($class) {
        require_once 'controller/' . $class . '.php';
    });

    $wp = new AdminController();

    $id_jabatan = $_POST['id_jabatan'];
    $id_pegawai = $_POST['id_pegawai'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama']; 
    $golongan = $_POST['golongan'];
    $username = $_POST['username']; 
    $password =  $_POST['password'];

    $wp->inputDataUser(
        $id_pegawai,
        $id_jabatan, 
        $nip,
        $nama, 
        $golongan,
        $username, 
        $password
    );

}

?>
  
    </body>
