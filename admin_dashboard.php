                       
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                <h1 class="h3 text-gray-800">Monitoring dan Evaluasi</h1>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 



                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">Jumlah Pegawai</h4>

                                        <div class=" col">
                                            <div class="card shadow-none m-0 border-start">
                                                <div class="card-body text-center">
                                                <?php
                                                        require_once 'controller/AdminController.php';

                                                        $class = new AdminController();

                                                        $totalkaryawan = $class->totalKaryawan()[0];
                                                    ?>
                                                    <i class="dripicons-user-group text-muted" style="font-size: 50px;"></i>
                                                    <h2><span><?php echo $totalkaryawan['COUNT(*)']?></span></h2>
                                                    <h2 class="text-muted font-15 mb-0"><span>Orang</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row-->

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->

                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-3">Data Pegawai</h4>

                                        <div class="row mb-2">
                                            <div class="col-sm-4">
                                                <a href="?url=admin-input-pegawai" class="btn btn-danger mb-2"><i class="mdi mdi-plus-circle me-2"></i> Tambah Pegawai</a>
                                            </div>
                                        </div>
                                        <table id="selection-datatable" class="table table-striped dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Karyawan</th>
                                                <th>NIP</th>
                                                <th>Golongan/Pangkat</th>
                                                <th>Jabatan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            require_once 'controller/AdminController.php';

                                            $class = new AdminController();
                                            $dataKaryawan = $class->getKaryawan();
                                                if ($dataKaryawan != null) {
                                                    $i = 1;
                                                    foreach ($dataKaryawan as $data) {
                                            ?>
                                           <tr>
                                           <td><?php echo $i++ ;?></td>                         
                                           <td><?php echo $data['nama_pegawai']; ?></td>
                                                                    <td><?php echo $data['nip']; ?></td>
                                                                    <td><?php echo $data['golongan']; ?></td>
                                                                    
                                                                    <td><?php
                                                                    {
                                                                        echo  $data['nama_jabatan'];
                                                                    }

                                                                    ?></td>
                                                                    <td class="table-action" style="width: 90px;">
                                                                        <a href="?url=admin-edit-pegawai&id_pegawai=<?php echo $data['id_pegawai']; ?>" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                                                                        <a href="#" onclick="confirmDelete(<?php echo $data['id_pegawai']; ?>)" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div> <!-- end row-->


    <script src="assets/js/sweetalert/sweetalert2@11.js"></script>
    <script>
    function confirmDelete(idKaryawan) {
        Swal.fire({
            title: 'Hapus Karyawan?',
            text: "Apakah Anda yakin ingin menghapus Karyawan dengan ID " + idKaryawan + "? Data yang telah dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e03131',
            cancelButtonColor: '#868e96',
            confirmButtonText: 'Ya, Hapus Data.',
            cancelButtonText: "Batalkan"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace("admin-hapus-pegawai.php?id_pegawai=" + idKaryawan)
            }
        })
    }
</script>