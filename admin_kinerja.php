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
                        <th width="500px">Sasaran</th>
                        <th width="500px">Indikator</th>
                        <th>Target</th>
                        <th>Jabatan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                                            require_once 'controller/AdminController.php';

                                            $class = new AdminController();
                                            $dataKinerja = $class->getKinerja();
                                                if ($dataKinerja != null) {
                                                    $i = 1;
                                                    foreach ($dataKinerja as $data) {
                                            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $data['sasaran']; ?></td>
                        <td><?php echo $data['indikator']; ?></td>
                        <td><?php echo $data['target']; ?></td>
                        <td><?php echo $data['nama_jabatan']; ?></td>
                        <td class="table-action" style="width: 90px;">
                          <a href="?url=edit_kinerja&id_kinerja=<?php echo $data['id_kinerja']; ?>" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                          <a href="#" onclick="confirmDelete(<?php echo $data['id_kinerja']; ?>)" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
