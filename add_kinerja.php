<body>
    <br><br>
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
                                            <h4 class="mt-2">Input Data Kinerja</h4>

                                            <p class="text-muted mb-4">Silahkan Input Data Kinerja</p>
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
                                                            <label for="billing-address" class="form-label">Sasaran<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="input sasaran" id="sasaran" name="sasaran" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Indikator<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="input indikator" id="indikator" name="indikator" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Target<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="input target" id="target" name="target" required>
                                                        </div>
                                                    </div>
                                                </div> <!-- end row -->

                                                <button type="submit" class="btn btn-success" name="submit">Tambahkan</button>
                                                <a type="button" class="btn btn-danger" href="?url=admin_kinerja">Batal</a> <!-- end row -->
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
    $sasaran = $_POST['sasaran'];
    $indikator = $_POST['indikator']; 
    $target = $_POST['target'];

    $wp->inputKinerja(
        $id_jabatan, 
        $sasaran,
        $indikator, 
        $target
    );
}
?>
</body>
