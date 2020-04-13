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

// TAMPILKAN DATA BARANG DAN HARGA
$karyawan=mysqli_query($koneksi, "SELECT * FROM tbl_karyawan");
$jsArray = "var fullname = new Array();\n"; 

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>APRO | Akun</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/profile_small.jpg" />
                             </span>
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

                <li>
                    <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Master Project </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="<?php echo base_url('proyek') ?>">Data Project</a></li>
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
                <li class="active">
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
                    <h2>Data Akun</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url('home') ?>">Home</a>
                        </li>
                        <li>
                            <a>Akun</a>
                        </li>
                        <li class="active">
                            <strong>Data Akun</strong>
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
                        <button class="btn btn-primary btn-md" title="Tambah Akun" data-target="#tambah" data-toggle="modal"><span class="fa fa-plus">Tambah Akun</span></button>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                    <th>No.</th>
	                  <th>Fullname</th>
                    <th>Email</th>
	                  <th>Level</th>
	                  <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
	                $no=0;
	                if(!empty($tampil)){
	                  foreach ($tampil as $data) {
	                    $no++; ?>
	                    <tr>
	                      <td><?php echo $no; ?></td>
	                      <td><?php echo $data->fullname; ?></td>
                        <td><?php echo $data->email; ?></td>
	                      <td>
                        <?php if($data->level == 'Admin'){ ?>
                        <span class="badge bg-primary"><?php echo $data->level; ?></span>
                        <?php }else{ ?>
                          <span class="badge"><?php echo $data->level; ?></span>
                      <?php  } ?>
                        </td>
                        <td>
	                        <div class="panel-heading">
                    		    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit<?php echo $data->id_user; ?>" title="Edit"><span class="fa fa-edit"></span></button>
                            <?php if($data->email != $this->session->email): ?>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?php echo $data->id_user; ?>"><span class="fa fa-trash" title="Hapus"></span></button>
                            <?php endif; ?>
                        	</div>
	                      </td>
	                    </tr>

	                    <!-- Modaledit -->
                    	<div id="edit<?php echo $data->id_user ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- konten modal-->
                          <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Akun</h4>
                            </div>
                            <!-- body modal -->
                            <div class="modal-body">
                              <?php echo form_open_multipart('akun/aksi_update') ?>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Fullname</label>
                                <input type="hidden" name="id_user" value="<?php echo $data->id_user ?>">
                                <input type="hidden" name="id_karyawan" value="<?php echo $data->id_karyawan ?>">
                                <input type="text" name="fullname" class="form-control" value="<?php echo $data->fullname; ?>" placeholder="Isi Nama Lengkap" required>
				                      </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $data->email; ?>" required>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Password Baru</label>
                                  <input type="password" name="password" class="form-control" placeholder="Password" >
                              </div>
                              <div class="form-group">
                              <input type="checkbox" name="passwordlama" value="<?php echo $data->password; ?>">Password Lama
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Level</label>
                                <select class="form-control" name="level">
                                  <option value="" <?php if($data->level == ""){ echo "selected";} ?>></option>
                                  <option value="Admin" <?php if($data->level == "Admin"){ echo "selected";} ?>>Admin</option>
                                  <option value="Owner" <?php if($data->level == "Owner"){ echo "selected";} ?>>Owner</option>
                                  <option value="Karyawan" <?php if($data->level == "Karyawan"){ echo "selected";} ?>>Karyawan</option>
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

                    <div class="modal fade" id="hapus<?php echo $data->id_user; ?>" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
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
                                        Apakah Yakin Ingin Hapus Data <b><?php echo $data->fullname;?></b>?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <a href="<?php echo base_url('akun/aksi_hapus/').$data->id_user; ?>" type="button" class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal hapus -->

	                    <?php  }
		                }else{
		                  ?> <tr><td align="center" colspan="7">Data Tidak Ada</td></tr>
		                 <?php } ?>
                    </tbody>
                    </table>
                        </div>

                    </div>
                </div>
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
          <h4 class="modal-title">Tambah Akun</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <?php echo form_open('akun/tambah_aksi') ?>
              <div class="form-group">
                <label for="exampleInputEmail1">Karyawan</label>
                <select class="form-control" name="id_karyawan" onchange="changeValue(this.value)" id="id_karyawan">
                <option></option>
                <?php if(mysqli_num_rows($karyawan)) {?>
		                <?php while($row_brg= mysqli_fetch_array($karyawan)) {?>
		                    <option value="<?php echo $row_brg["id_karyawan"]?>"> <?php echo $row_brg["nm_kar"]?> </option>
		                <?php $jsArray .= "fullname['" . $row_brg['id_karyawan'] . "'] = {fullname:'" . addslashes($row_brg['nm_kar']) . "'};\n"; } ?>
		            <?php } ?>
                </select>
                <span id="pesan"></span>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Fullname</label>
                  <input type="text" name="fullname" id="fullname" value="" class="form-control" placeholder="Isi Nama Lengkap" required>
                  <span>* untuk nama di akun</span>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="email" name="email"  onchange="changeValue(this.value)" id="email" class="form-control" placeholder="Isi Email" required>
                  <span id="pesan2"></span>
              </div>
              <div class="form-group">
                  <label for="exampleInputEmail1">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Isi Password" required>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Level</label>
                   <select class="form-control" name="level">
                   <option value=""></option>
                   <option value="Admin">Admin</option>
                   <option value="Owner">Owner</option>
                   <option value="Karyawan">Karyawan</option>
                   </select>
              </div>
        </div>
        <!-- footer modal -->
        <div class="modal-footer">
        <input type="submit" class="btn btn-success mr-2" name="simpan" value="Simpan">
        <?php echo form_close(); ?>
        <button type="reset" class="btn btn-danger" data-dismiss="modal">Batal</button> 
        </div>
      </div>
    </div>
</div>


    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>
    <!-- Jquery Validate -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.min.js"></script>

    <!-- Page-Level Scripts -->
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
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                ]
            });
        });

    </script>
    <script type="text/javascript">
    <?php echo $jsArray; ?>
    function changeValue(id_karyawan) {
      document.getElementById("fullname").value = fullname[id_karyawan].fullname;
    };
    </script>
    <script>
      $(document).ready(function(){
      $('#id_karyawan').blur(function(){
        $('#pesan').html('<img style="margin-left:10px; width:10px" src="<?php echo base_url(); ?>assets/img/loading.gif">');
          var id_karyawan = $(this).val();
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>akun/cek',
            data: 'id_karyawan='+id_karyawan,
            success: function(data){
              $('#pesan').html(data);
            }
          })
      });

      $('#email').blur(function(){
        $('#pesan2').html('<img style="margin-left:10px; width:10px" src="<?php echo base_url(); ?>assets/img/loading.gif">');
          var email = $(this).val();
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>akun/cek_email',
            data: 'email='+email,
            success: function(data){
              $('#pesan2').html(data);
            }
          })
      });
    });
    </script>

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
