                  <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>PROYEK DALAM PENAWARAN & FOLLOW UP</h3>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <table class="footable table table-stripped table-hover toggle-arrow-tiny">
                    <thead>
                <tr>
                  <th>No.</th>
                  <th>Judul</th>
                  <th>Instansi</th>
                  <th data-hide="all">Contact Person</th>
                  <th data-hide="all">Telp CP</th>
                  <th>Status Proyek</th>
                  <th data-hide="all">Nominal</th>
                  <th data-hide="all">Keterangan</th>
                  <th data-hide="all">Status</th>
                  <?php if($this->session->level == 'Admin'){ ?>
                  <th>Aksi</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                if(!empty($tbl_proyek2)){
                  foreach ($tbl_proyek2 as $data) {
                    if($data->status_proyek == "Penawaran" || $data->status_proyek == "Follow Up"){
                    $no++;
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->judul; ?></td>
                      <td><?php echo $data->nm_instansi; ?></td>
                      <td><?php echo $data->nm_cp; ?></td>
                      <td><?php echo $data->telp_cp; ?></td>
                      <td><?php echo $data->status_proyek; ?></td>
                      <td><?php echo rupiah($data->nominal); ?></td>
                      <td><?php echo $data->ket; ?></td>
                      <?php if($data->status == 'Open') { ?>
                      <td style="text-align: center;"><span class="badge bg-primary"><?php echo $data->status; ?></span></td>
                      <?php }else{ ?>
                      <td style="text-align: center;"><span class="badge bg-danger"><?php echo $data->status; ?></span></td>
                      <?php } ?>
                      <?php if($this->session->level == 'Admin'){ ?>
                      <td width="15%">
                    <div class="panel-heading">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data->kd_proyek; ?>" title="Edit"><span class="fa fa-edit"></span></button>

                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $data->kd_proyek; ?>"><span class="fa fa-trash"></span></button>
                    </div>
                    </td>
                      <?php } ?>
                    </tr>

                    <!-- Modaledit -->
                    <div id="edit<?php echo $data->kd_proyek ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- konten modal-->
                          <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Proyek</h4>
                            </div>
                            <!-- body modal -->
                            <div class="modal-body">
                              <?php echo form_open('proyek/aksi_update') ?>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Kode Proyek</label>
                              <input type="text" name="kd_proyek" class="form-control" placeholder="Isi Judul Proyek" value="<?php echo $data->kd_proyek ?>" readonly>
                            </div>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Judul Proyek</label>
                                <input type="text" name="judul" class="form-control" placeholder="Isi Judul Proyek" value="<?php echo $data->judul ?>" required>
                            </div>
                            <hr>
                            <label for="exampleInputEmail1">Instansi</label>
                            <div class="form-group">
                            <input type="hidden" name="id_instansi" value="<?php echo $data->id_instansi ?>">
                            <label for="exampleInputEmail1">Nama Instansi</label>
                            <input type="text" name="nm_instansi" class="form-control" placeholder="Isi Nama Instansi" value="<?php echo $data->nm_instansi ?>" required>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Telpon Instansi</label>
                            <input type="text" name="telp_ins" class="form-control" placeholder="Isi Telp Instansi" value="<?php echo $data->telp_ins ?>" required>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Alamat Instansi</label>
                            <textarea type="text" name="alamat_ins" class="form-control" placeholder="Isi Alamat Instansi" required><?php echo $data->alamat_ins ?></textarea>
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">Email Instansi</label>
                            <input type="email" name="email_ins" class="form-control" placeholder="Isi Email Instansi" value="<?php echo $data->email_ins ?>" required>
                            </div>
                            <hr>
                            <label>Contact Person</label>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" name="nm_cp" class="form-control" placeholder="Isi Nama CP" value="<?php echo $data->nm_cp ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telpon/HP</label>
                                <input type="text" name="telp_cp" class="form-control" placeholder="Isi Telpon" value="<?php echo $data->telp_cp ?>" required>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status Proyek</label>
                                <select class="form-control" name="status_proyek" id="sp3">
                                  <option value="" <?php if($data->status_proyek == ""){ echo "selected";} ?>></option>
                                  <option value="Penawaran" <?php if($data->status_proyek == "Penawaran"){ echo "selected";} ?>>Penawaran</option>
                                  <option value="Follow Up" <?php if($data->status_proyek == "Follow Up"){ echo "selected";} ?>>Follow Up</option>
                                  <option value="Disetujui" <?php if($data->status_proyek == "Disetujui"){ echo "selected";} ?>>Disetujui</option>
                                  <option value="Ditolak" <?php if($data->status_proyek == "Ditolak"){ echo "selected";} ?>>Ditolak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Biaya</label>
                                <input type="text" name="nominal" class="form-control" placeholder="Isi Biaya" value="<?php echo $data->nominal ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Keterangan</label>
                                <textarea name="ket" class="form-control" placeholder="Isi Keterangan Proyek" required><?php echo $data->ket ?></textarea>
                            </div>
                            <div class="form-group" id="tgl_m3">
                                <label for="exampleInputEmail1">Tanggal Mulai</label>
                                <input name="tgl_mulai" type="date" class="form-control">
                            </div>
                            <div class="form-group" id="tgl_a3">
                                <label for="exampleInputEmail1">Tanggal Akhir</label>
                                <input name="tgl_akhir" type="date" class="form-control">
                            </div>
                            <div class="form-group" id="status3">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control">
                                  <option value="" <?php if($data->status_proyek == ""){ echo "selected";} ?>></option>
                                  <option value="Open" <?php if($data->status == "Open"){ echo "selected";} ?>>Open</option>
                                  <option value="Close" <?php if($data->status == "Close"){ echo "selected";} ?>>Close</option>
                                </select>
                            </div>
                            <div class="form-group" id="tim3">
                                <label for="exampleInputEmail1">Tim</label>
                                <select class="form-control" name="id_karyawan">
                                <option value=""></option>
                                  <?php foreach ($tbl_karyawan as $ds){ ?>
                                  <option value="<?php echo $ds->id_karyawan ?>"><?php echo $ds->nm_kar ?></option>
                                  <?php  } ?>
                                </select>
                            </div>
                            </div>
                            <!-- footer modal -->
                            <div class="modal-footer">
                            <input type="submit" class="btn btn-success mr-2" name="simpan" value="Simpan">
                            <?php echo form_close(); ?>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button> 
                            </div>
                          </div>
                        </div>
                    </div>

                    <!-- Modal Hapus -->

                    <div class="modal fade" id="hapus<?php echo $data->kd_proyek; ?>" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
                     data-backdrop="static">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticModalLabel">Hapus Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Apakah Yakin Ingin Hapus Project <b><?php echo $data->judul;?></b>?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <a href="<?php echo base_url('proyek/aksi_hapus/').$data->kd_proyek; ?>" type="button" class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal hapus -->

                <?php  }
              }
                }else{
                  ?> <tr><td align="center" colspan="7">Data Tidak Ada</td></tr>
                 <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <td colspan="6">
                             <ul class="pagination pull-right"></ul>
                          </td>
                        </tr>
                    </tfoot>
                    </table>
                    </div>
                        </div>

                    </div>

                    <!-- Data Ditolak -->
                    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>PROYEK DITOLAK</h3>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                        <table class="footable table table-stripped table-hover toggle-arrow-tiny">
                    <thead>
                  <tr>
                  <th>No.</th>
                  <th>Judul</th>
                  <th>Instansi</th>
                  <th data-hide="all">Contact Person</th>
                  <th data-hide="all">Telp CP</th>
                  <th>Status Proyek</th>
                  <th data-hide="all">Nominal</th>
                  <th data-hide="all">Keterangan</th>
                  <th data-hide="all">Status</th>
                  <?php if($this->session->level == 'Admin'){ ?>
                  <th>Aksi</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $no=0;
                if(!empty($tbl_proyek2)){
                  foreach ($tbl_proyek2 as $data) {
                    if($data->status_proyek == "Ditolak"){
                    $no++;
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->judul; ?></td>
                      <td><?php echo $data->nm_instansi; ?></td>
                      <td><?php echo $data->nm_cp; ?></td>
                      <td><?php echo $data->telp_cp; ?></td>
                      <td><?php echo $data->status_proyek; ?></td>
                      <td><?php echo rupiah($data->nominal); ?></td>
                      <td><?php echo $data->ket; ?></td>
                      <?php if($data->status == 'Open') { ?>
                      <td style="text-align: center;"><span class="badge bg-primary"><?php echo $data->status; ?></span></td>
                      <?php }else{ ?>
                      <td style="text-align: center;"><span class="badge bg-danger"><?php echo $data->status; ?></span></td>
                      <?php } ?>
                      <?php if($this->session->level == 'Admin'){ ?>
                      <td width="15%">
                    <div class="panel-heading">
                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $data->kd_proyek; ?>" title="Detail"><span class="fa fa-trash"></span></button>
                    </div>
                    </td>
                      <?php } ?>
                    </tr>

                    <!-- Modal Hapus -->

                    <div class="modal fade" id="hapus<?php echo $data->kd_proyek; ?>" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
                     data-backdrop="static">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticModalLabel">Hapus Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Apakah Yakin Ingin Hapus Project <b><?php echo $data->judul;?></b>?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <a href="<?php echo base_url('proyek/aksi_hapus/').$data->kd_proyek; ?>" type="button" class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal hapus -->

                <?php  }
              } 
                }else{ ?>
                      <tr><td align="center" colspan="7">Data Tidak Ada</td></tr>
                   <?php  } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                          <td colspan="6">
                             <ul class="pagination pull-right"></ul>
                          </td>
                        </tr>
                    </tfoot>
                    </table>
                    </div>
                        </div>

                    </div>