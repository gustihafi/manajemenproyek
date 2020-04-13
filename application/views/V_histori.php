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

    <title>APRO | Histori</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!-- FooTable -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/footable/footable.core.css" rel="stylesheet">

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
                <li class="active">
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
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
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
                    <a href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Histori</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url('home') ?>">Home</a>
                        </li>
                        <li>
                            <a>Histori</a>
                        </li>
                        <li class="active">
                            <strong>Histori</strong>
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
                       <h2>Proyek</h2>
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
                    <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
                        <div class="table-responsive">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8" data-filter=#filter >
                    <thead>
                    <tr>
                    <th data-toggle="true">Kode Proyek</th>
                    <th>Judul</th>
                    <th>Nama Instansi</th>
                    <th>Nama CP</th>
                    <th data-hide="all">Telpon CP</th>
                    <th>Status Proyek</th>
                    <th data-hide="all">Keterangan Proyek</th>
                    <th data-hide="all">Nominal</th>
                    <th data-hide="all">Tanggal Mulai</th>
                    <th data-hide="all">Tanggal Akhir</th>
                    <th data-hide="all">Deadline</th>
                    <th>Tim</th>
                    <th>Tanggal Histori</th>
                    <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(!empty($proyek)){
                            foreach ($proyek as $data) {
                    ?>
                    <tr>
                        <td><?php echo $data->kd_proyek; ?></td>
                        <td><?php echo $data->judul; ?></td>
                        <td><?php echo $data->nm_instansi; ?></td>
                        <td><?php echo $data->nm_cp; ?></td>
                        <td><?php echo $data->telp_cp; ?></td>
                        <td><?php echo $data->status_proyek; ?></td>
                        <td><?php echo $data->ket; ?></td>
                        <td><?php echo $data->nominal; ?></td>
                        <td><?php echo $data->tgl_mulai; ?></td>
                        <td><?php echo $data->tgl_akhir; ?></td>
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
                        <td><img src="<?php echo base_url('assets/images/').$data->foto; ?>" class="img-md" title="<?php echo $data->nm_kar; ?>"></td>
                        <td><?php echo $data->tanggal; ?></td>
                        <td><?php echo $data->aksi; ?></td>
                    </tr>
                    <?php  }
		                }else{
		                  ?> <tr><td align="center" colspan="8">Data Tidak Ada</td></tr>
		                 <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="8">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                    </table>
                        </div>
                    
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       <h2>Progres</h2>
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
                    <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
                        <div class="table-responsive">
                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter >
                    <thead>
                    <tr>
                    <th>Kode Proyek</th>
                    <th>Judul</th>
                    <th>Task</th>
                    <th>Status Progres</th>
                    <th>Tanggal Meet</th>
                    <th>Keterangan</th>
                    <th>Tanggal Histori</th>
                    <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        if(!empty($progres)){
                            foreach ($progres as $data) {
                    ?>
                    <tr>
                        <?php
                        if($data->persentase == 100):
                        ?>
                        <td><span class="label label-primary"><?php echo $data->kd_proyek ?></span></td>
                        <?php else: ?>
                        <td><?php echo $data->kd_proyek; ?></td>
                        <?php endif; ?>
                        <td><?php echo $data->judul; ?></td>
                        <td>
                        <div class="progress progress-striped progress-mini active">
                            <div style="width: <?php echo $data->persentase ?>%;" class="progress-bar" title="<?php echo $data->persentase ?>%"></div>
                        </div>
                        </td>
                        <td><?php echo $data->status_progres; ?></td>
                        <td><?php echo $data->tgl_meet; ?></td>
                        <td><?php echo $data->ket; ?></td>
                        <td><?php echo $data->tanggal; ?></td>
                        <td><?php echo $data->aksi; ?></td>
                    </tr>
                    <?php  }
		                }else{
		                  ?> <tr><td align="center" colspan="8">Data Tidak Ada</td></tr>
		                 <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="8">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
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
    <!-- Jquery Validate -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/validate/jquery.validate.min.js"></script>
    <!-- FooTable -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/footable/footable.all.min.js"></script>
    <!-- Peity -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/peity/jquery.peity.min.js"></script>
    <!-- Peity -->
    <script src="<?php echo base_url(); ?>assets/js/demo/peity-demo.js"></script>

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
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

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
