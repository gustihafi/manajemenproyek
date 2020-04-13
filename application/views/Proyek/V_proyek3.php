<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>APRO | Proyek</title>

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">

    <!-- FooTable -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/profile_small.jpg" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
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
                <li>
                  <a href="<?php echo base_url('karyawan') ?>">
                    <i class="fa fa-users"></i> <span>Data Karyawan</span>
                  </a>
                </li>

                <li class="active">
                    <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Master Project </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="active"><a href="<?php echo base_url('proyek') ?>">Data Project</a></li>
                        <li><a href="<?php echo base_url('progres') ?>">Progress Project</a></li>
                    </ul>
                </li>

                <li>
                  <a href="<?php echo base_url('instansi') ?>">
                    <i class="fa fa-building"></i> <span>Instansi</span>
                  </a>
                </li>

                <li>
                  <a href="<?php echo base_url('history') ?>">
                    <i class="fa fa-history"></i> <span>History</span>
                  </a>
                </li>

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
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Aplikasi Manajemen Proyek.</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
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
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
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
                <p><?php echo $this->session->flashdata('msg'); ?></p>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <button class="btn btn-info btn-md" title="Tambah Data" data-target="#tambah" data-toggle="modal"><span class="fa fa-plus">Tambah Data</span></button>
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
                      <th>Tim</th>
	                  <th>Aksi</th>
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
                      <td><p><?php 
                                      $tgl_m = new DateTime();
                                      $tgl_a = new DateTime($data->tgl_akhir);
                                      $dl = $tgl_a->diff($tgl_m);
                                      echo $dl->days; echo " Hari" ?></p>
                      </td>
                      <?php if($data->status == 'Open') { ?>
                      <td style="text-align: center;"><span class="badge bg-success"><?php echo $data->status; ?></span></td>
                      <?php }else{ ?>
                      <td style="text-align: center;"><span class="badge bg-danger"><?php echo $data->status; ?></span></td>
                      <?php } ?>
                      <td><img src="<?php echo base_url('assets/images/').$data->foto; ?>" class="img-md img-circle"></td>
	                      <td>
	                    <div class="panel-heading">
                    		<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data->kd_proyek; ?>" title="Edit"><span class="fa fa-edit"></span></button>

                    		<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $data->kd_proyek; ?>"><span class="fa fa-trash" title="Hapus"></span></button>
                    	</div>
	                      </td>
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
                                <label for="exampleInputEmail1">Tim</label>
                                <?php 
                                foreach ($tbl_proyek as $dt); ?>
                                <select class="form-control" name="id_karyawan" required>
                                  <option value="<?php echo $dt->id_karyawan ?>"><?php echo $dt->nm_kar ?></option>
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
        <!-- </div> -->
        <div class="footer">
            <div class="pull-right">
                Version <strong>1.0.0</strong> Beta.
            </div>
            <div>
                <strong>Copyright</strong> CV. Fast Media Komputindo &copy; 2019
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/plugins/dataTables/datatables.min.js"></script>

    <!-- FooTable -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/footable/footable.all.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>

    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/select2/select2.full.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
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
    });

  $(document).ready(function(){
      $("#telp2").keypress(function(data){
        if(data.which!=8 && data.which!=0 && (data.which < 8 || data.which > 57))
        {
          $("#pesan2").html("Hanya Boleh Angka").show().fadeOut("slow");
          return false;
        }
      });
    });

  $(document).ready(function(){
    $('.select2').select2({

    });
  });
    </script>



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
                <input type="text" name="kd_proyek" class="form-control" placeholder="Isi Judul Proyek" maxlength="5" required>
                <span>Maksimal 5 Karakter</span>
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
                  <input type="text" name="nominal" class="form-control" placeholder="Isi Biaya" required>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <textarea name="ket" class="form-control" placeholder="Isi Keterangan Proyek" required></textarea>
              </div>
              <div class="form-group" id="tgl_mulai" hidden>
                  <label for="exampleInputEmail1">Tanggal Mulai</label>
                  <input name="tgl_mulai" type="date" class="form-control" >
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
                <div class="form-group" id="team" hidden>
                  <label for="exampleInputEmail1">Tim</label>
                  <select class="form-control" name="id_karyawan">
                  <option value=""></option>
                  <?php 
                 foreach ($tbl_karyawan as $dt) { ?>
                  <option value="<?php echo $dt->id_karyawan ?>"><?php echo $dt->nm_kar ?></option>
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

</body>

</html>
