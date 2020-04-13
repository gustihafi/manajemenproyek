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
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>APRO | Proyek</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">


</head>

<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                    <?php if($this->session->level == 'Karyawan'){
                        foreach($foto as $dt){ ?>
                        <span>
                        <img alt="image" class="img-circle img-md" src="<?php echo base_url('assets/images/'.$dt->foto); ?>"/>
                        </span>
                         <?php  }  
                        }else{ ?>
                            <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/profile_small.jpg" />
                             </span>
                        <?php } ?>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $this->session->fullname; ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $this->session->level; ?> <b class="caret"></b></span> </span> </a>
                             <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <?php if($this->session->level == 'Karyawan'){ ?>
                            <li><a href="<?php echo base_url('profil') ?>">Profil</a></li>
                            <hr>
                            <?php } ?>
                            <li><a href="#" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        APRO
                    </div>
                </li>
                <li>
                  <a href="<?php echo base_url('home') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                  </a>
                </li>

                <?php if($this->session->level == 'Karyawan'){ ?>
                <li>
                  <a href="<?php echo base_url('profil') ?>">
                    <i class="fa fa-id-card"></i> <span>Profil</span>
                  </a>
                </li>
                <?php } ?>
                

                <?php if($this->session->level == 'Admin' || $this->session->level == 'Owner'){ ?>
                <li>
                  <a href="<?php echo base_url('karyawan') ?>">
                    <i class="fa fa-users"></i> <span>Data Karyawan</span>
                  </a>
                </li>
                <?php } ?>

                <li class="active">
                    <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Master Project </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="active"><a href="<?php echo base_url('proyek') ?>">Data Project</a></li>
                        <?php $query = mysqli_query($koneksi, "SELECT status FROM tbl_proyek WHERE status='Open' ORDER BY status DESC LIMIT 1");
                        while($dt = mysqli_fetch_array($query)){
                            if($dt['status'] == "Open"){ ?>
                                <li><a href="<?php echo base_url('progres') ?>">Progress Project</a></li>
                         <?php   }
                        } ?>
                    </ul>
                </li>

                <?php if($this->session->level == 'Admin' || $this->session->level == 'Owner'){ ?>
                <li>
                  <a href="<?php echo base_url('instansi') ?>">
                    <i class="fa fa-building"></i> <span>Instansi</span>
                  </a>
                </li>
                <?php } ?>
                
                <?php if($this->session->level == 'Admin' || $this->session->level == 'Owner'){ ?>
                <li>
                  <a href="<?php echo base_url('histori') ?>">
                    <i class="fa fa-history"></i> <span>Histori</span>
                  </a>
                </li>
                <?php } ?>

                <?php if($this->session->level == 'Admin'){ ?>
                <li>
                  <a href="<?php echo base_url('akun') ?>">
                    <i class="fa fa-user"></i> <span>Akun</span>
                  </a>
                </li>
                <?php } ?>
                
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message" id="ucap"></span>
                </li>
                <span class="badge"><span id="clock"></span> |
                <!-- /*Selesai Menampilkan Waktu*/
                /*Menampilakan Hari*/ -->
                <?php
                $hari = date('l');
                /*$new = date('l, F d, Y', strtotime($Today));*/
                if ($hari=="Sunday") {
                 echo "Minggu";
                }elseif ($hari=="Monday") {
                 echo "Senin";
                }elseif ($hari=="Tuesday") {
                 echo "Selasa";
                }elseif ($hari=="Wednesday") {
                 echo "Rabu";
                }elseif ($hari=="Thursday") {
                 echo("Kamis");
                }elseif ($hari=="Friday") {
                 echo "Jum'at";
                }elseif ($hari=="Saturday") {
                 echo "Sabtu";
                }
                ?>,
                <!-- /*Selesai Menampilkan Hari*/ -->

                <!-- /*Menampilkan Tanggal*/ -->
                <?php
                $tgl =date('d');
                echo $tgl;
                $bulan =date('F');
                if ($bulan=="January") {
                 echo " Januari ";
                }elseif ($bulan=="February") {
                 echo " Februari ";
                }elseif ($bulan=="March") {
                 echo " Maret ";
                }elseif ($bulan=="April") {
                 echo " April ";
                }elseif ($bulan=="May") {
                 echo " Mei ";
                }elseif ($bulan=="June") {
                 echo " Juni ";
                }elseif ($bulan=="July") {
                 echo " Juli ";
                }elseif ($bulan=="August") {
                 echo " Agustus ";
                }elseif ($bulan=="September") {
                 echo " September ";
                }elseif ($bulan=="October") {
                 echo " Oktober ";
                }elseif ($bulan=="November") {
                 echo " November ";
                }elseif ($bulan=="December") {
                 echo " Desember ";
                }
                $tahun=date('Y');
                echo $tahun;
                ?>
                </span>
                <!-- /*Selesai Menampilkan Tanggal*/ -->
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data Proyek</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url('home') ?>">Home</a>
                        </li>
                        <li>
                            <a>Proyek</a>
                        </li>
                        <li class="active">
                            <strong>Data Proyek</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <?php if($this->session->level == 'Admin'): ?>
                <button class="btn btn-info btn-md" title="Tambah Data" data-target="#tambah" data-toggle="modal"><span class="fa fa-plus">Tambah Data</span></button>
                <?php endif; ?>
                <p><?php echo $this->session->flashdata('msg'); ?></p>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>PROYEK DISETUJUI</h3>
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
                      <th data-toggle="true">No.</th>
                      <th>Kode Proyek</th>
                      <th>Judul</th>
                      <th>Instansi</th>
                      <th data-hide="all">Contact Person</th>
                      <th data-hide="all">Telp CP</th>
                      <th>Status Proyek</th>
                      <th data-hide="all">Nominal</th>
                      <th data-hide="all">Keterangan</th>
                      <th data-hide="all">Tanggal Mulai</th>
                      <th data-hide="all">Tanggal Akhir</th>
                      <th data-hide="all">Deadline</th>
                      <th data-hide="all">Status</th>
                      <th>Ketua Tim</th>
                      <?php if($this->session->level == 'Admin'){ ?>
                      <th>Aksi</th>
                      <?php } ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no=0;
                    if(!empty($tbl_proyek)){
                      foreach ($tbl_proyek as $data) {
                      if($data->status_proyek == "Disetujui"){
                        $no++; $tgl_m = $data->tgl_mulai;
                    $tgl_a = $data->tgl_akhir; ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->kd_proyek; ?></td>
                      <td><?php echo $data->judul; ?></td>
                      <td><?php echo $data->nm_instansi; ?></td>
                      <td><?php echo $data->nm_cp; ?></td>
                      <td><?php echo $data->telp_cp; ?></td>
                      <td><?php echo $data->status_proyek; ?></td>
                      <td><?php echo rupiah($data->nominal); ?></td>
                      <td><?php echo $data->ket; ?></td>
                      <td><?php echo date("d F Y", strtotime($tgl_m)); ?></td>
                      <td><?php echo date("d F Y", strtotime($tgl_a)); ?></td>
                      <td><?php 
                            if($data->selisih < 20 && $data->selisih >= 10){ ?>
                            <span class="label label-warning"><?php echo $data->selisih; echo " Hari" ?></span>
                            <?php }elseif($data->selisih < 10 && $data->selisih >= 1){ ?>
                                <span class="label label-danger"><?php echo $data->selisih; echo " Hari" ?></span>
                                <?php  }elseif($data->selisih <= 0){ ?>
                                    <span class="label label-danger">Jatuh Tempo</span>
                               <?php }
                                elseif($data->selisih > 20){ ?>
                                    <p><?php echo $data->selisih; echo " Hari" ?></p>
                                    <?php  } ?>
                      </td>
                      <?php if($data->status == 'Open') { ?>
                      <td style="text-align: center;"><span class="badge bg-success"><?php echo $data->status; ?></span></td>
                      <?php }else{ ?>
                      <td style="text-align: center;"><span class="badge bg-danger"><?php echo $data->status; ?></span></td>
                      <?php } ?>
                      <td class="project-people">
                        <img src="<?php echo base_url('assets/images/').$data->foto; ?>" class="img-circle" title="<?php echo $data->nm_kar ?>">
                      </td>
                      <?php if($this->session->level == 'Admin'){ ?>
                      <td>
                        <div class="panel-heading">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data->kd_proyek; ?>" title="Edit"><span class="fa fa-edit"></span></button>

                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $data->kd_proyek; ?>"><span class="fa fa-trash" title="Hapus"></span></button>
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
                                <select class="form-control" name="status_proyek" id="sp">
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
                            <div class="form-group" id="tgl_m">
                                <label for="exampleInputEmail1">Tanggal Mulai</label>
                                <input name="tgl_mulai" type="date" class="form-control" value="<?php echo $data->tgl_mulai ?>" required>
                            </div>
                            <div class="form-group" id="tgl_a">
                                <label for="exampleInputEmail1">Tanggal Akhir</label>
                                <input name="tgl_akhir" type="date" class="form-control" value="<?php echo $data->tgl_akhir ?>" required>
                            </div>
                            <div class="form-group" id="status">
                                <label for="exampleInputEmail1">Status</label>
                                <select name="status" class="form-control">
                                  <option value="" <?php if($data->status_proyek == ""){ echo "selected";} ?>></option>
                                  <option value="Open" <?php if($data->status == "Open"){ echo "selected";} ?>>Open</option>
                                  <option value="Close" <?php if($data->status == "Close"){ echo "selected";} ?>>Close</option>
                                </select>
                            </div>
                            <div class="form-group" id="tim">
                                <label for="exampleInputEmail1">Ketua Tim</label>
                                <select data-placeholder="Pilih Karyawan" class="form-control" style="width:350px;" name="id_karyawan">
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
                          <td colspan="7">
                             <ul class="pagination pull-right"></ul>
                          </td>
                        </tr>
                    </tfoot>
                    </table>
                    </div>
                        </div>

                    </div>

                    <?php $this->load->view('proyek/v_proyek2') ?>

                </div>
            </div>
            </div>
            <div class="footer">
            <div class="pull-right">
                Version <strong>1.0.0</strong> Beta.
            </div>
            <div class="pull-left">
                <strong>Copyright</strong> CV. Fast Media Komputindo &copy; 2019
            </div>
            <div class="text-center">
                <?php
                $starttime = explode(' ', microtime());
                $starttime = $starttime[1] + $starttime[0];
                $load = microtime();
                $loadtime = explode(' ', microtime()); 
                $loadtime = $loadtime[0]+$loadtime[1]-$starttime; 

                echo "Page generated in ".round($load, 2)." seconds";
                echo " | ";
                echo "Peak memory usage: ".round(memory_get_peak_usage()/1048576, 2), "MB";
                ?>
            </div>
        </div>
            </div>

    <!-- Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Proyek</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <?php echo form_open('proyek/tambah_aksi') ?>
              <div class="form-group">
                <label for="exampleInputEmail1">Kode Proyek</label>
                <input type="text" name="kd_proyek" id="kd_proyek" class="form-control" placeholder="Isi Kode Proyek" value="<?= $kodeunik ?>" readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Judul Proyek</label>
                <input type="text" name="judul" class="form-control" placeholder="Isi Judul Proyek" required>
              </div>
              <hr>
              <label for="exampleInputEmail1">Instansi</label>
              <div class="form-group">
              <input type="hidden" name="id_instansi">
              <label for="exampleInputEmail1">Nama Instansi</label>
              <input type="text" name="nm_instansi" class="form-control" placeholder="Isi Nama Instansi" required>
              </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Telpon Instansi</label>
              <input type="text" name="telp_ins" class="form-control" placeholder="Isi Telp Instansi" id="telp2" required>
              <span id="pesan2"></span>
              </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Alamat Instansi</label>
              <textarea type="text" name="alamat_ins" class="form-control" placeholder="Isi Alamat Instansi" required></textarea>
              </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Email Instansi</label>
              <input type="email" name="email_ins" class="form-control" placeholder="Isi Email Instansi" required>
              </div>
              <hr>
              <label>Contact Person</label>
              <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <input type="text" name="nm_cp" class="form-control" placeholder="Isi Nama CP" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Telpon/HP</label>
                  <input type="text" name="telp_cp" class="form-control" placeholder="Isi Telpon" id="telp" required>
                  <span id="pesan"></span>
              </div>
              <hr>
              <div class="form-group">
                  <label for="exampleInputEmail1">Status Proyek</label>
                  <select class="form-control" name="status_proyek" id="statp">
                    <option value=""></option>
                    <option value="Penawaran">Penawaran</option>
                    <option value="Follow Up">Follow Up</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Biaya</label>
                  <input type="text" name="nominal" class="form-control" placeholder="Isi Biaya" id="biaya" required>
                  <span id="pb"></span>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <textarea name="ket" class="form-control" placeholder="Isi Keterangan Proyek" required></textarea>
              </div>

              <div class="form-group" id="tgl_mulai" hidden>
                <label for="exampleInputEmail1">Tanggal Mulai</label>
                <input name="tgl_mulai" type="date" class="form-control">
              </div>
              <div class="form-group" id="tgl_akhir" hidden>
                <label for="exampleInputEmail1">Tanggal Akhir</label>
                <input name="tgl_akhir" type="date" class="form-control">
              </div>

              <div class="form-group" id="stat" hidden>
                  <label for="exampleInputEmail1">Status</label>
                  <select name="status" class="form-control">
                    <option value=""></option>
                    <option value="Open">Open</option>
                    <option value="Close">Close</option>
                  </select>
              </div>
              <hr>
                <div class="form-group" id="team" hidden>
                <label class="exampleInputEmail">Ketua Tim</label>
                <select data-placeholder="Pilih Karyawan" class="form-control" name="id_karyawan">
                <option></option>
                  <?php foreach ($tbl_karyawan as $ds){ ?>
                        <option value="<?php echo $ds->id_karyawan ?>"><?php echo $ds->nm_kar ?></option>
                    <?php  } ?>
                </select>
                </div>

              <!-- <div class="form-group row">
                  <label for="exampleInputFoto2" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                  <input type="file" name="foto" class="form-control" id="exampleInputFoto2" required>
                </div>
              </div> -->
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

    <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin Logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih Logout untuk keluar dari Sistem.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/dataTables/datatables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Chosen -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.js"></script>

   <!-- JSKnob -->
   <script src="<?php echo base_url(); ?>assets/js/plugins/jsKnob/jquery.knob.js"></script>

   <!-- FooTable -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/footable/footable.all.min.js"></script>

   <!-- Input Mask-->
    <script src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>

   <!-- Data picker -->
   <script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

   <!-- NouSlider -->
   <script src="<?php echo base_url(); ?>assets/js/plugins/nouslider/jquery.nouislider.min.js"></script>

   <!-- Switchery -->
   <script src="<?php echo base_url(); ?>assets/js/plugins/switchery/switchery.js"></script>

    <!-- IonRangeSlider -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>

    <!-- MENU -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Color picker -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <!-- Clock picker -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/clockpicker/clockpicker.js"></script>

    <!-- Image cropper -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/cropper/cropper.min.js"></script>

    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- Date range picker -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>

    <!-- TouchSpin -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Tags Input -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- Dual Listbox -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

    <script type="text/javascript">        
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik 
    var salam = "";   
    var waktu = new Date();            //membuat object date berdasarkan waktu saat 
    var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
    var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
    var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
    if(sh >= 0 && sh <= 11){salam = "Selamat Pagi, <?php echo $this->session->fullname; ?>"}
    else{if(sh >= 12 && sh <= 14){salam = "Selamat Siang, <?php echo $this->session->fullname; ?>"}
    else{if(sh >= 15 && sh <= 18){salam = "Selamat Sore, <?php echo $this->session->fullname; ?>"}
    else{if(sh >= 19 && sh <= 23){salam = "Selamat Malam, <?php echo $this->session->fullname; ?>"}}}}
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    document.getElementById("ucap").innerHTML = (salam);
    }
    </script>
<script>
    $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });

    $(window).load(function(){
    $('#statp').change(function(){
      console.log($("#statp option:selected").val());
      if ($("#statp option:selected").val() == 'Disetujui'){
        $('#tgl_mulai').prop('hidden', false);
        $('#tgl_akhir').prop('hidden', false);
        $('#stat').prop('hidden', false);
        $('#team').prop('hidden', false);
      }else {
        $('#tgl_mulai').prop('hidden', 'true').value = "";
        $('#tgl_akhir').prop('hidden', 'true').value = "";
        $('#stat').prop('hidden', 'true').value = "";
        $('#team').prop('hidden', 'true').value = "";
      }
    });
  });

  $(window).load(function(){
    $('#sp').change(function(){
      console.log($("#sp option:selected").val());
      if ($("#sp option:selected").val() == 'Disetujui'){
        $('#tgl_m').prop('hidden', false);
        $('#tgl_a').prop('hidden', false);
        $('#status').prop('hidden', false);
        $('#tim').prop('hidden', false);
      }else {
        $('#tgl_m').prop('hidden', 'true').value = "";
        $('#tgl_a').prop('hidden', 'true').value = "";
        $('#status').prop('hidden', 'true').value = "";
        $('#tim').prop('hidden', 'true').value = "";
      }
    });
  });

  $(document).ready(function(){
      $("#telp").keypress(function(data){
        if(data.which!=8 && data.which!=0 && (data.which < 8 || data.which > 57))
        {
          $("#pesan").html("Hanya Boleh Angka").show().fadeOut("slow");
          return false;
        }
      });

      $("#biaya").keypress(function(data){
        if(data.which!=8 && data.which!=0 && (data.which < 8 || data.which > 57))
        {
          $("#pb").html("Hanya Boleh Angka").show().fadeOut("slow");
          return false;
        }
      });

      $("#telp2").keypress(function(data){
        if(data.which!=8 && data.which!=0 && (data.which < 8 || data.which > 57))
        {
          $("#pesan2").html("Hanya Boleh Angka").show().fadeOut("slow");
          return false;
        }
      });
    });
    </script>
    <script>
      $(document).ready(function(){
      $('#kd_proyek').blur(function(){
        $('#pd').html('<img style="margin-left:10px; width:10px" src="<?php echo base_url(); ?>assets/img/loading.gif">');
          var kd_proyek = $(this).val();
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>proyek/cek',
            data: 'kd_proyek='+kd_proyek,
            success: function(data){
              $('#pd').html(data);
            }
          })
      });
    });
    </script>
    <script>
        $(document).ready(function(){

            $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });

            var $image = $(".image-crop > img")
            $($image).cropper({
                aspectRatio: 1.618,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });

            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }

            $("#download").click(function() {
                window.open($image.cropper("getDataURL"));
            });

            $("#zoomIn").click(function() {
                $image.cropper("zoom", 0.1);
            });

            $("#zoomOut").click(function() {
                $image.cropper("zoom", -0.1);
            });

            $("#rotateLeft").click(function() {
                $image.cropper("rotate", 45);
            });

            $("#rotateRight").click(function() {
                $image.cropper("rotate", -45);
            });

            $("#setDrag").click(function() {
                $image.cropper("setDragMode", "crop");
            });

            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#data_2 .input-group.date').datepicker({
                startView: 1,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: "dd/mm/yyyy"
            });

            $('#data_3 .input-group.date').datepicker({
                startView: 2,
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $('#data_4 .input-group.date').datepicker({
                minViewMode: 1,
                keyboardNavigation: false,
                forceParse: false,
                forceParse: false,
                autoclose: true,
                todayHighlight: true
            });

            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            var elem = document.querySelector('.js-switch');
            var switchery = new Switchery(elem, { color: '#1AB394' });

            var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

            var elem_3 = document.querySelector('.js-switch_3');
            var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

            var elem_4 = document.querySelector('.js-switch_4');
            var switchery_4 = new Switchery(elem_4, { color: '#f8ac59' });
                switchery_4.disable();

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

            $('.demo1').colorpicker();

            var divStyle = $('.back-change')[0].style;
            $('#demo_apidemo').colorpicker({
                color: divStyle.backgroundColor
            }).on('changeColor', function(ev) {
                        divStyle.backgroundColor = ev.color.toHex();
                    });

            $('.clockpicker').clockpicker();

            $('input[name="daterange"]').daterangepicker();

            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

            $('#reportrange').daterangepicker({
                format: 'MM/DD/YYYY',
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: '12/31/2015',
                dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'right',
                drops: 'down',
                buttonClasses: ['btn', 'btn-sm'],
                applyClass: 'btn-primary',
                cancelClass: 'btn-default',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            }, function(start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });


            $(".touchspin1").TouchSpin({
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin2").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".touchspin3").TouchSpin({
                verticalbuttons: true,
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $('.dual_select').bootstrapDualListbox({
                selectorMinimalHeight: 160
            });


        });

        $('.chosen-select').chosen({width: "100%"});

        $("#ionrange_1").ionRangeSlider({
            min: 0,
            max: 5000,
            type: 'double',
            prefix: "$",
            maxPostfix: "+",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_2").ionRangeSlider({
            min: 0,
            max: 10,
            type: 'single',
            step: 0.1,
            postfix: " carats",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_3").ionRangeSlider({
            min: -50,
            max: 50,
            from: 0,
            postfix: "°",
            prettify: false,
            hasGrid: true
        });

        $("#ionrange_4").ionRangeSlider({
            values: [
                "January", "February", "March",
                "April", "May", "June",
                "July", "August", "September",
                "October", "November", "December"
            ],
            type: 'single',
            hasGrid: true
        });

        $("#ionrange_5").ionRangeSlider({
            min: 10000,
            max: 100000,
            step: 100,
            postfix: " km",
            from: 55000,
            hideMinMax: true,
            hideFromTo: false
        });

        $(".dial").knob();

        var basic_slider = document.getElementById('basic_slider');

        noUiSlider.create(basic_slider, {
            start: 40,
            behaviour: 'tap',
            connect: 'upper',
            range: {
                'min':  20,
                'max':  80
            }
        });

        var range_slider = document.getElementById('range_slider');

        noUiSlider.create(range_slider, {
            start: [ 40, 60 ],
            behaviour: 'drag',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });

        var drag_fixed = document.getElementById('drag-fixed');

        noUiSlider.create(drag_fixed, {
            start: [ 40, 60 ],
            behaviour: 'drag-fixed',
            connect: true,
            range: {
                'min':  20,
                'max':  80
            }
        });


    </script>
    <!-- Page-Level Scripts -->

</body>

</html>
