<br>
<h1 class="h3 text-gray-800">Indikator Kinerja </h1>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row mb-2">
          <div class="col-sm-4">
            <a href="?url=add_kinerja" class="btn btn-danger mb-2"
              ><i class="uil-plus me-2"></i>Data Kinerja</a>
          </div>
        </div>
            <table id="selection-datatable" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th width="500px">Sasaran</th>
                        <th width="500px">Indikator</th>
                        <th>Target</th>
                        <th>Realisasi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                                            require_once 'controller/UserController.php';

                                            $class = new UserController();
                                            $plus=1;
                                            $idjabatan=$_SESSION['id_jabatan'].$plus;
                                            $dataKinerja = $class->getKinerjaStaff($idjabatan);
                                                if ($dataKinerja != null) {
                                                    $i = 1;
                                                    foreach ($dataKinerja as $data) {
                                            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['nama_pegawai']; ?></td>
                        <td><?php echo $data['sasaran']; ?></td>
                        <td><?php echo $data['indikator']; ?></td>
                        <td><?php echo $data['target']; ?></td>
                        <td><?php echo $data['realisasi']; ?></td>
                        <td>
                        <?php if ( $data['status'] == "kosong"){
                            echo "<span class='badge bg-danger'>Kosong</span>";
                        } 
                        else if ( $data['status'] == "proses"){
                            echo "<span class='badge bg-warning'>Proses</span>";
                        }
                        else if ( $data['status'] == "perbaiki"){
                            echo "<span class='badge bg-danger'>Perbaiki</span>";
                        }
                        else if ( $data['status'] == "selesai"){
                            echo "<span class='badge bg-success'>Selesai</span>";
                        }
                        ?>
                        </td>
                        <td class="table-action">
                          <a href="?url=detail_monitoring" class="action-icon">
                            <i class="mdi mdi-eye"></i
                          ></a>
                          <a href="?url=edit_monitoring&&id_proses=<?php echo $data['id_proses']; ?>" class="action-icon">
                            <i class="mdi mdi-square-edit-outline"></i
                          ></a>
                        </td>
                    </tr>
                    <?php 
                                                }
                                              }else {
                                                ?> 
                                                <tr>
                                                    <td colspan="11" class="text-center h5 py-3">Data tidak ditemukan.</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<script src="assets/js/sweetalert/sweetalert2@11.js"></script>
    <script>
    function confirmDelete(idKinerja) {
        Swal.fire({
            title: 'Hapus Kinerja?',
            text: "Apakah Anda yakin ingin menghapus Kinerja dengan ID " + idKinerja + "? Data yang telah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e03131',
            cancelButtonColor: '#868e96',
            confirmButtonText: 'Ya, Hapus Data.',
            cancelButtonText: "Batalkan"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace("hapus_kinerja.php?id_kinerja=" + idKinerja)
            }
        })
    }
</script>
