<?php
// KONEKSI DATABASE
$servername="localhost";
$user="root";
$pass="";
$db="manajemen_proyek";

$koneksi= mysqli_connect($servername, $user, $pass, $db);

if(!$koneksi){
	die ("Connection failed: ".mysqli_connect_error());
}
?>
                                                <div class="ibox-content">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="m-b-md">
                                                                <h2><?php echo $data->judul ?></h2>
                                                                <strong><?php echo $data->kd_proyek ?></strong>
                                                            </div>
                                                            <dl class="dl-horizontal">
                                                            <?php if($data->persentase != 100){ ?>
                                                                <dt>Status:</dt> <dd><span class="label label-primary"><?php echo $data->status ?></span></dd>
                                                            <?php } else{ ?>
                                                                <dt>Status:</dt> <dd><span class="label label-danger">Close</span></dd>
                                                          <?php }?>
                                                                <dt>Tanggal Akhir:</dt> <dd><?php echo date("d F Y", strtotime($data->tgl_akhir)); ?></dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <dl class="dl-horizontal">

                                                                <dt>Contact Person:</dt> <dd><?php echo $data->nm_cp ?></dd>
                                                                <dt>Telp CP:</dt> <dd><?php echo $data->telp_cp ?></dd>
                                                                <hr>
                                                                <dt>Instansi:</dt> <dd><a href="#" class="text-navy"> <?php echo $data->nm_instansi ?></a> </dd>
                                                                <dt>Email Instansi:</dt> <dd>  <?php echo $data->email_ins ?></dd>
                                                                <dt>Alamat Instansi:</dt> <dd>  <?php echo $data->alamat_ins ?></dd>
                                                            </dl>
                                                        </div>
                                                        <div class="col-lg-7" id="cluster_info">
                                                            <dl class="dl-horizontal" >
                                                            
                                                                <dt>Last Updated:</dt> <dd>
                                                                <?php 
                                                                    $kd_proyek = $data->kd_proyek;
                                                                    $query = mysqli_query($koneksi,"SELECT * FROM tbl_log_progres WHERE kd_proyek='$kd_proyek' AND aksi='UPDATE' ORDER BY id_log_progres DESC LIMIT 1");
                                                                    while($dt = mysqli_fetch_array($query)){
                                                                        if($dt['aksi'] == 'UPDATE'){
                                                                        echo $dt['tanggal'];
                                                                        }
                                                                    }?>
                                                                </dd>
                                                                <dt>Created:</dt> <dd> 	<?php 
                                                                    $kd_proyek = $data->kd_proyek;
                                                                    $query = mysqli_query($koneksi,"SELECT * FROM tbl_log_progres WHERE kd_proyek='$kd_proyek' GROUP BY aksi='INSERT' DESC LIMIT 1");
                                                                    while($dt = mysqli_fetch_array($query)){
                                                                    echo $dt['tanggal'];
                                                                    } ?> </dd>
                                                                <dt>Participants:</dt>
                                                            
                                                                <dd class="project-people">
                                                                 <img src="<?php echo base_url('assets/images/').$data->foto; ?>" class="img-circle" title="<?php echo $data->nm_kar ?>">
                                                                </dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <dl class="dl-horizontal">
                                                                <dt>Completed:</dt>
                                                                <dd>
                                                                    <div class="progress progress-striped active m-b-sm">
                                                                        <div style="width: <?php echo $data->persentase ?>%;" class="progress-bar"></div>
                                                                    </div>
                                                                    <small>Progress Project <strong><?php echo $data->persentase ?>%</strong>
                                                                    <?php if($data->persentase == 100){
                                                                        echo ". Selesai.</small>";
                                                                    }else{
                                                                        echo ". Sedang dalam pengerjaan.</small>";
                                                                    } ?>
                                                                </dd>
                                                            </dl>
                                                        </div>
                                                    </div>
                                                    <div class="row m-t-sm">
                                                        <div class="col-lg-12">
                                                        <div class="panel blank-panel">
                                                        <div class="panel-heading">
                                                            <div class="panel-options">
                                                                <ul class="nav nav-tabs">
                                                                    <li class="active"><a href="#tab-1" data-toggle="tab">Keterang Project</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div class="panel-body">
                                                        <?php 
                                                            $kd_proyek = $data->kd_proyek;
                                                            $query = mysqli_query($koneksi,"SELECT * FROM tbl_log_progres WHERE kd_proyek='$kd_proyek'");
                                                            while($dt = mysqli_fetch_array($query)){
                                                            ?>
                                                        <div class="tab-content">
                                                        <div class="tab-pane active" id="tab-1">
                                                            <div class="feed-activity-list">
                                                                    <div class="media-body ">
                                                                    <?php if($this->session->level == 'Karyawan' || $this->session->level == 'Admin'){
                                                                    if($data->persentase == 100){}else{ ?>
                                                                    <a href="<?php echo base_url('progres/hapusket/').$dt['id_log_progres']; ?>"><button type="button" class="close" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button></a>
                                                                    <?php }
                                                                    } ?>
                                                                        <small class="pull-right"></small>
                                                                        <strong><?php echo $dt['status_progres'] ?></strong> <br>
                                                                        <small class="text-muted"><?php echo $dt['tanggal'] ?></small>
                                                                        <div class="well">
                                                                            <?php echo $dt['ket'] ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <?php } ?>
                                                            <?php if($this->session->level == 'Karyawan' || $this->session->level == 'Admin'){
                                                                if($data->persentase == 100){}else{ ?>
                                                                <div class="feed-activity-list">
                                                                    <div class="media-body ">
                                                                        <small class="pull-right"></small>
                                                                        <strong>Keterangan</strong> <br>
                                                                        <small class="text-muted"><?php date_default_timezone_set('Asia/Makassar'); echo date('l, d-m-Y G:i'); ?></small>
                                                                        <div class="well">
                                                                            <?php echo form_open('progres/aksi_update') ?>
                                                                            <div class="form-group">
                                                                                <input type="hidden" name="id_progres" value="<?php echo $data->id_progres; ?>">
                                                                                <input type="hidden" name="kd_proyek" value="<?php echo $data->kd_proyek; ?>">
                                                                                <label>Status Progres</label>
                                                                                <select class="form-control" name="status_progres" required>
                                                                                    <option disable></option>
                                                                                    <option value="Pengumpulan Data">Pengumpulan Data</option>
                                                                                    <option value="Desain Interface">Desain Interface</option>
                                                                                    <option value="Implementasi">Implementasi</option>
                                                                                    <option value="Testing">Testing</option>
                                                                                    <option value="Masalah Bug">Masalah Bug</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">Persentase Proyek</label>
                                                                                <input class="form-control" type="number" name="persentase" required>
                                                                                <span>* Dalam bentuk persen<br><strong>Maks. 100%</strong></span>
                                                                            </div>

                                                                            <div class="form-group">
                                                                            <textarea placeholder="Keterangan" class="form-control" name="ket" required></textarea>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <input type="submit" class="btn btn-primary btn-sm" name="update" value="Simpan">
                                                                            <?php echo form_close(); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                            <?php }
                                                            } ?>
                                                                
                                                            </div>

                                                        </div>
                                                        
                                                        </div>

                                                        </div>

                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>