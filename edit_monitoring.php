<?php

$getIdproses = $_GET['id_proses'];
spl_autoload_register(function ($class) {
    require_once 'controller/' . $class . '.php';
});

$wp = new UserController();
$datakinerja = $wp->getIdProses($getIdproses )[0]; 
if (isset($_POST['simpan'])) { 
  $status = $_POST['status']; 
  $catatan = $_POST['catatan'];
  $idproses = $_POST['id_proses'];

  $wp->evaluasiKin($idproses, $status, $catatan); 
  } 
       
?>

<div class="container">
<br />
<h1 class="h3 mb-4 text-gray-800">Monitoring dan Evaluasi</h1>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
          <form method="POST"  action="?url=edit_monitoring&id_proses=<?php echo $getIdproses; ?>" >
            <div class="row mb-3">
            <label for="example-select" class="col-3 col-form-label">Pilih Status</label>
                <div class="col-9">
                    <select class="form-select" id="example-select" name="status" required>
                        <option selected disabled value="">Pilih Status</option>
                        <option value="perbaiki">Perbaiki</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                                                        <input
                                                        type="hidden"
                                                        value="<?php echo $datakinerja['id_proses'] ?>"
                                                        class="form-control"
                                                        id="id_kinerja"
                                                        name="id_proses"
                                                        />
                                                    </div>
            <div class="row mb-3">
            <label for="exampleFormControlTextarea1" class="col-3 col-form-label">Catatan</label>
                <div class="col-9">
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="catatan" rows="3"><?php echo $datakinerja['catatan'] ?></textarea>
                </div>
            </div>
            <div class="justify-content-end row">
                <div class="col-9">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a class="btn btn-danger" href="?url=monitoring">Batal</a>
                </div>
                
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>