<h1 class="h3 mb-4 text-gray-800">Realisasi Kinerja</h1>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="mt-3">
          <div class="table-responsive">
            <table class="table table-centered table-nowrap mb-0">
              <thead class="table-light">
                <tr>
                  <th class="border-0">Sasaran</th>
                  <th class="border-0">Indikator</th>
                  <th class="border-0">Target</th>
                  <th class="border-0">realisasi</th>
                  <th class="border-0">Status</th>
                  <th class="border-0" style="width: 80px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  
                  require_once 'controller/UserController.php';
                  $idkaryawan=@$_SESSION['id_pegawai'];
                  $user = new UserController();

                  $data = $user->getKinerja($idkaryawan)[0];
                ?>
               
                <tr>
                  <td>
                    <span class="font-14"><?php echo $data['sasaran'] ?></span>
                  </td>
                  <td>
                    <span class="font-14"><?php echo $data['indikator'] ?></span>
                  </td>
                  <td>
                    <span class="font-14"><?php echo $data['target'] ?> Dokumen</span>
                  </td>
                  <td><?php echo $data['realisasi'] ?> Dokumen</td>
                  <td>
                  <?php if ( $data['status'] == "kosong"){
                            echo "<span class='badge bg-danger'>Kosong</span>";
                        } 
                        else if ( $data['status'] == "proses"){
                            echo "<span class='badge bg-warning'>Proses</span>";
                        }
                        else if ( $data['status'] == "perbaiki"){
                            echo "<span class='badge bg-warning'>Perbaiki</span>";
                        }
                        else if ( $data['status'] == "selesai"){
                            echo "<span class='badge bg-success'>Selesai</span>";
                        }
                        ?>
                  </td>
                  <td class="table-action">
                    <center><a href="?url=uploadfile" class="action-icon">
                      <i class="mdi mdi-eye"></i
                    ></a></center>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- end .mt-3-->
      </div>
    </div>
  </div>
</div>
