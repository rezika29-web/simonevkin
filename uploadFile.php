<div class="container">
<br>
<br>
<!-- File Upload -->
<h3>Upload Realisasi</h3>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <!-- <div class="col-md-4"> -->
                <form action="/" method="post" class="dropzone " id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"
                    data-upload-preview-template="#uploadPreviewTemplate">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
                    </div>

                    <?php
                  
                    require_once 'controller/UserController.php';
                    $idkaryawan=@$_SESSION['id_pegawai'];
                    $user = new UserController();

                    $data = $user->getKinerja($idkaryawan)[0];
                    ?>

                    <div class="dz-message needsclick">
                        <i class="h1 text-muted dripicons-cloud-upload"></i>
                        <h3>Drop files here or click to upload.</h3>
                        <span class="text-muted font-13">(This is just a demo dropzone. Selected files are
                            <strong>not</strong> actually uploaded.)</span>
                    </div>
                </form>

                <!-- Preview -->
                <div class="dropzone-previews mt-3" id="file-previews"></div>

                <!-- file preview template -->
                <div class="d-none" id="uploadPreviewTemplate">
                    <div class="card mt-1 mb-0 shadow-none border">
                        <div class="p-2">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                                </div>
                                <div class="col ps-0">
                                    <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                                    <p class="mb-0" data-dz-size></p>
                                </div>
                                <div class="col-auto">
                                    <!-- Button -->
                                    <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                        <i class="dripicons-cross"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                
                <hr class="m-4">             
                <div class="row justify-content-md-center">
                    <div class="col col-lg-8 font-16 text-center text-dark col-md-4">
                    <h3>Catatan</h3>
                        <i class="mdi mdi-format-quote-open font-20"></i> <?php echo $data['catatan'] ?>
                    </div>
                </div>

                <hr class="m-4">
            <br><br>
             </div>
        </div>
    </div>
</div>
</div>