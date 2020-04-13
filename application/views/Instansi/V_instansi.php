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

    <title>APRO | Instansi</title>
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
                <li class="active">
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
                        
                    </ul>
                </li>


                <li>
                    <a data-toggle="modal" data-target="#logoutModal">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Data Instansi</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url('home') ?>">Home</a>
                        </li>
                        <li>
                            <a>Instansi</a>
                        </li>
                        <li class="active">
                            <strong>Data Instansi</strong>
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
	                  <th>Nama Instansi</th>
                      <th>Alamat Instansi</th>
	                  <th>Telpon Instansi</th>
	                  <th>Email Instansi</th>
	                  <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
	                $no=0;
	                if(!empty($tbl_instansi)){
	                  foreach ($tbl_instansi as $data) {
	                    $no++; ?>
	                    <tr>
	                      <td><?php echo $no; ?></td>
	                      <td><?php echo $data->nm_instansi; ?></td>
                          <td><?php echo $data->alamat_ins; ?></td>
	                      <td><?php echo $data->telp_ins; ?></td>
	                      <td><?php echo $data->email_ins; ?></td>
	                      <td>
	                    <div class="panel-heading">
                    		<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#detail<?php echo $data->id_instansi; ?>" title="Edit"><span class="fa fa-eye"></span></button>

                            <!-- Modaledit -->
                        <div id="detail<?php echo $data->id_instansi ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- konten modal-->
                          <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Detail Instansi</h4>
                            </div>
                            <!-- body modal -->
                            <div class="modal-body">
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Nama Instansi</label>
                                      <p><?php echo $data->nm_instansi ?></p>
                                  </div><br>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Alamat Instansi</label>
                                      <p><?php echo $data->alamat_ins ?></p>
                                  </div><br>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Telpon Instansi</label>
                                      <p><?php echo $data->telp_ins ?></p>
                                  </div><br>
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email Instansi</label>
                                      <p><?php echo $data->email_ins ?></p>
                                  </div>
                            </div>
                            <!-- footer modal -->
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                            </div>
                          </div>
                        </div>
                    </div>

                    	</div>
	                      </td>
	                    </tr>

	                    
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



    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

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
                    { extend: 'copy'}
                    
                ]

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
