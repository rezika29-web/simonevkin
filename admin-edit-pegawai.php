<?php

$getIdKaryawan = $_GET['id_pegawai'];

// if ($getIdSekolah == null) {
//     header('location:?url=list_sekolah');
// }

spl_autoload_register(function ($class) {
    require_once 'controller/' . $class . '.php';
});

$wp = new AdminController();
$datakaryawan = $wp->getIdKaryawan($getIdKaryawan)[0]; 
if (isset($_POST['update'])) { 
  $nama = $_POST['nama']; 
  $nip = $_POST['nip'];
  $golongan = $_POST['golongan']; 
  $id_jabatan = $_POST['jabatan']; 
  $username = $_POST['username']; 
  $password = $_POST['password']; 
  $idkaryawan = $_POST['id_pegawai'];
  
  $wp->editKaryawan( $idkaryawan,$nama,$nip,$golongan,$id_jabatan, $username, $password ); 
  } 
       
?>

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
                  <div class="col-lg-8">
                    <h4 class="mt-2">Data Data Pegawai</h4>

                    <p class="text-muted mb-4">
                      Silahkan Edit Data Karyawan Berikut
                    </p>

                    <form
                      method="POST"
                      action="?url=admin-edit-pegawai&id_pegawai=<?php echo $getIdKaryawan; ?>"
                    >
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="billing-address" class="form-label"
                              >Nama<span class="text-danger">*</span></label
                            >
                            <input
                              required
                              value="<?php echo $datakaryawan['nama_pegawai'] ?>"
                              class="form-control"
                              type="text"
                              placeholder="Nama"
                              id="nama"
                              name="nama"
                            />
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="billing-address" class="form-label"
                              >NIP<span class="text-danger">*</span></label
                            >
                            <input
                              required
                              value="<?php echo $datakaryawan['nip'] ?>"
                              class="form-control"
                              type="text"
                              placeholder="NIP"
                              id="nip"
                              name="nip"
                            />
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="billing-address" class="form-label"
                              >Golongan<span class="text-danger">*</span></label
                            >
                            <input
                              required
                              value="<?php echo $datakaryawan['golongan'] ?>"
                              class="form-control"
                              type="text"
                              placeholder="Golongan"
                              id="golongan"
                              name="golongan"
                            />
                          </div>
                        </div>
                        <div class="col-12">
                                                        <div class="mb-3">
                                                            <label for="example-select" class="col-3 col-form-label">Pilih Jabatan<span class="text-danger">*</span></label>
                                                                <select  data-live-search="true" class="form-select" id="example-select" name="jabatan">                                                 
                                                                    <option selected disabled value="">==Pilih Jabatan==</option>
                                                                    <option selected ="true" value="<?php echo $datakaryawan['id_jabatan'] ?>"><?php echo $datakaryawan['nama_jabatan'] ?></option>
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
                            <label for="billing-address" class="form-label"
                              >Username<span class="text-danger">*</span></label
                            >
                            <input
                              required
                              value="<?php echo $datakaryawan['username'] ?>"
                              class="form-control"
                              type="text"
                              placeholder="Username"
                              id="username"
                              name="username"
                            />
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="mb-3">
                            <label for="billing-address" class="form-label"
                              >Password<span class="text-danger">*</span></label
                            >
                            <input
                              required
                              value="<?php echo $datakaryawan['password'] ?>"
                              class="form-control"
                              type="password"
                              placeholder="Password"
                              id="password"
                              name="password"
                            />
                          </div>
                        </div>
                        

                        <div class="col-12">
                          <div class="mb-3">
                            <input
                              type="hidden"
                              value="<?php echo $datakaryawan['id_pegawai'] ?>"
                              class="form-control"
                              id="id_pegawai"
                              name="id_pegawai"
                            />
                          </div>
                        </div>
                      </div>
                      <!-- end row -->

                      <!-- <div class="row mt-4">
                                                                <div class="col-sm-6">
                                                                    <a href="apps-ecommerce-shopping-cart.html" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">
                                                                        <i class="mdi mdi-arrow-left"></i> Kembali </a>
                                                                </div> 
                                                                <div class="col-sm-6">
                                                                    <div class="text-sm-end">
                                                                        <a href="apps-ecommerce-checkout.html" class="btn btn-danger">
                                                                            <i class="mdi mdi-truck-fast me-1"></i> Simpan </a>
                                                                    </div>
                                                                </div> 
                                                            </div> -->
                      <button
                        type="update"
                        class="btn btn-success"
                        name="update"
                      >
                        Edit
                      </button>
                      <a
                        type="button"
                        class="btn btn-danger"
                        href="?url=admin_dashboard"
                        >Batal</a
                      >
                      <!-- end row -->
                    </form>
                  </div>
                </div>
                <!-- end row-->
              </div>
            </div>
            <!-- end tab content-->
          </div>
          <!-- end card-body-->
        </div>
        <!-- end card-->
      </div>
      <!-- end col -->
    </div>
    <!-- end row-->
  </div>
