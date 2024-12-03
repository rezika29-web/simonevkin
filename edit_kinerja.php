<?php

$getIdKinerja = $_GET['id_kinerja'];
spl_autoload_register(function ($class) {
    require_once 'controller/' . $class . '.php';
});

$wp = new AdminController();
$datakinerja = $wp->getIdKinerja($getIdKinerja)[0]; 
if (isset($_POST['update'])) { 
  $sasaran = $_POST['sasaran']; 
  $indikator = $_POST['indikator'];
  $target= $_POST['target']; 
  $id_jabatan = $_POST['id_jabatan'];
  $id_kinerja = $_POST['id_kinerja'];
  
  $wp->editKinerja( $id_kinerja,$sasaran,$indikator,$target,$id_jabatan); 
  } 
       
?>
        <!-- Start Content-->
        <br><br>
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
                                            <form method="POST"  action="?url=edit_kinerja&id_kinerja=<?php echo $getIdKinerja; ?>" >
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="col-3 col-form-label">Pilih Jabatan<span class="text-danger">*</span></label>
                                                            <select  data-live-search="true" class="form-select input-lg" id="example-select" name="id_jabatan">
                                                                <option value="" selected disabled>-- Pilih jabatan --</option>
                                                                <option selected="true" value="<?php echo $datakinerja['id_jabatan']  ;?>"><?php echo $datakinerja['nama_jabatan'] ?></option>
                                                        
                                                        <?php
                                                        require_once 'controller/AdminController.php';

                                                        $class = new AdminController();



                                                        $jabtanKaryawan = $class->getJabatan();

                                                        if ($jabtanKaryawan != null) {
                                                            $i = 1;
                                                            foreach ($jabtanKaryawan as $jbt) {

                                                        ?>
                                                                    <option value="<?php echo $i++ ?>"><?php echo $jbt['nama_jabatan'] ?></option>
                                                                    <?php
                                                            }}
                                                            ?>
                                                                </select>
                                                        </div>
                                                    </div>
                            
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Sasaran<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="input sasaran" id="sasaran" name="sasaran" value="<?php echo $datakinerja['sasaran'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Indikator<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="input indikator" id="indikator" name="indikator" value="<?php echo $datakinerja['indikator'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="billing-address" class="form-label">Target<span class="text-danger">*</span></label>
                                                            <input class="form-control" type="text" placeholder="input target" id="target" name="target" value="<?php echo $datakinerja['target'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                    <div class="mb-3">
                                                        <input
                                                        type="hidden"
                                                        value="<?php echo $datakinerja['id_kinerja'] ?>"
                                                        class="form-control"
                                                        id="id_kinerja"
                                                        name="id_kinerja"
                                                        />
                                                    </div>
                                                </div> <!-- end row -->

                                                <button type="submit" class="btn btn-success" name="update">Edit</button>
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
</body>
