<?php

$getIdKaryawan = $_GET['id_pegawai'];
spl_autoload_register(function ($class) {
    require_once 'controller/' . $class . '.php';
});

$wp = new AdminController();
$datakaryawan = $wp->getIdKaryawan($getIdKaryawan)[0]; 
if (isset($_POST['update'])) { 
  $nama = $_POST['nama']; 
  $nip = $_POST['nip'];
  $golongan = $_POST['golongan']; 
  $username = $_POST['username']; 
  $password = $_POST['password']; 
  $idkaryawan = $_POST['id_pegawai'];
  
  $wp->editAkun( $idkaryawan,$nama,$nip,$golongan, $username, $password ); 
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
                                            <h4 class="mt-2">Data Diri Anda</h4>

                                            <p class="text-muted mb-4">Silahkan Lengkapi Data Diri Anda</p>
                                            <form
                      method="POST"
                      action="?url=myakun&id_pegawai=<?php echo $getIdKaryawan; ?>"
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
                        href="?url="
                        >Batal</a
                      >
                      <!-- end row -->
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
