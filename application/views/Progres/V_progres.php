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
$proyek=mysqli_query($koneksi, "SELECT * FROM tbl_proyek WHERE status='Open'");
$jsArray = "var judul = new Array();\n"; 

?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>APRO | Progres Projects list</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png') ?>">

    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- TouchSpin -->
    <link href="<?php echo base_url(); ?>assets/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

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
                    <?php if($this->session->level == 'Admin' || $this->session->level == 'Owner'): ?>
                        <li><a href="<?php echo base_url('proyek') ?>">Data Project</a></li>
                    <?php endif; ?>
                        <?php $query = mysqli_query($koneksi, "SELECT status FROM tbl_proyek WHERE status='Open' ORDER BY status DESC LIMIT 1");
                        while($dt = mysqli_fetch_array($query)){
                            if($dt['status'] == "Open"){ ?>
                                <li class="active"><a href="<?php echo base_url('progres') ?>">Progress Project</a></li>
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
                        <i class="fa fa-bell"></i>  <span class="label label-primary">
                        <!-- <?php foreach($count as $data){
                            echo $data->pesan;
                        } ?> -->
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                    <li>
                            <a href="#">
                                <div>
                                    Notifikasi
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo base_url('progres'); ?>">
                                <div>
                                
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
                <div class="col-sm-4">
                    <h2>Progress Project</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url('home') ?>">Home</a>
                        </li>
                        <li class="active">
                            <strong>Progress Project</strong>
                        </li>
                    </ol>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">

                    <div class="ibox">
                    <p><?php echo $this->session->flashdata('msg'); ?></p>
                        <div class="ibox-title">
                            <h5>Data Progress Project</h5>
                            <div class="ibox-tools">
                            <?php if($this->session->level == 'Admin'){ ?>
                                <a class="btn btn-primary btn-xs" title="Tambah Data" data-target="#tambah" data-toggle="modal">Create Progres</a>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm" ><i class="fa fa-refresh"></i> Refresh</button>
                                </div>
                                <div class="col-md-11">
                                    <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                </div>
                            </div>

                            <div class="project-list">

                                <table class="table table-hover table-responsive">
                                    <tbody>
                                    <?php
                                    if($this->session->level == 'Karyawan'){
                                        $get = $kar;
                                    }else{
                                        $get = $tampil;
                                    }
                                    foreach ($get as $data) {
                                        if($data->status == "Open"){

                                    ?>
                                    <tr>
                                        <td class="project-status">
                                            <?php if($data->status_progres == "Masalah Bug"){ ?>
                                                <span class="label label-warning"><?php echo $data->status_progres ?></span>
                                                <?php }elseif($data->persentase == 100){ ?>
                                                <span class="label label-success">Finished</span>
                                            <?php }else{ ?>
                                            <span class="label label-info"><?php echo $data->status_progres ?></span>
                                                <?php } ?>
                                        </td>
                                        <td class="project-title">
                                            <a href="project_detail.html"><?php echo $data->judul ?></a><br>
                                            <strong><p><?php echo $data->nm_instansi ?></p></strong>
                                            <!-- <br/> -->
                                            <small>Create by <?php echo $data->create_by ?></small><br>
                                            <?php if($data->selisih < 20 && $data->selisih >= 10){ ?>
                                            <span class="label label-warning">Deadline: <?php echo $data->selisih; echo " Hari" ?></span>
                                            <?php }elseif($data->selisih < 10 && $data->selisih >= 1){ ?>
                                                <span class="label label-danger">Deadline: <?php echo $data->selisih; echo " Hari" ?></span>
                                                <?php  }elseif($data->selisih <= 0){ ?>
                                                    <span class="label label-danger">Deadline: 0 Hari</span>
                                            <?php }
                                                elseif($data->selisih > 20){ ?>
                                                    <p>Deadline: <?php echo $data->selisih; echo " Hari" ?></p>
                                                    <?php  } ?>
                                        </td>
                                        <td class="project-completion">
                                                <small>Completion with: <?php echo $data->persentase ?>%</small>
                                                <div class="progress progress-striped progress-mini active">
                                                    <div style="width: <?php echo $data->persentase ?>%;" class="progress-bar"></div>
                                                </div>
                                        </td>
                                        <td class="project-people">
                                            <img src="<?php echo base_url('assets/images/').$data->foto; ?>" class="img-circle" title="<?php echo $data->nm_kar ?>">
                                        </td>
                                        <td class="project-actions">
                                            <?php if($this->session->level == 'Owner'){ ?>
                                                <a data-target="#view<?php echo $data->id_progres?>" data-toggle="modal" class="btn btn-white btn-sm">
                                                <i class="fa fa-folder"></i> Preview </a>
                                           <?php }elseif($this->session->level == 'Karyawan' || $this->session->level == 'Admin'){ 
                                               if($data->persentase == 100){ ?>
                                                <a data-target="#view<?php echo $data->id_progres?>" data-toggle="modal" class="btn btn-white btn-sm">
                                                <i class="fa fa-folder"></i> view </a>
                                                <?php  }else{ ?>
                                                <a data-target="#view<?php echo $data->id_progres?>" data-toggle="modal" class="btn btn-white btn-sm">
                                                <i class="fa fa-pencil"></i> Edit </a>
                                              <?php  } ?>
                                            
                                         <?php  } ?> 
                                            
                                            <?php if($this->session->level == 'Admin'){ ?>
                                            <a data-target="#hapus<?php echo $data->id_progres?>" data-toggle="modal" class="btn btn-white btn-sm"><i class="fa fa-trash"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus -->

                            <div class="modal fade" id="hapus<?php echo $data->id_progres; ?>" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true"
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
                                            <a href="<?php echo base_url('progres/aksi_hapus/').$data->id_progres; ?>" type="button" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal hapus -->

                                    <!-- View Modal -->
                                <div class="modal inmodal fade" id="view<?php echo $data->id_progres?>" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Progres Project Detail</h4>
                                            
                                        </div>
                                        <div class="modal-body">
                                        <div class="ibox">
                                            <?php include('v_modaldetail.php'); ?>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <?php }else{
                                        echo "<tr><td> Data Tidak Ada </td></tr>";
                                    }
                                } ?>
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

        <!-- Modal Tambah -->
<div id="tambah" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- konten modal-->
      <div class="modal-content">
        <!-- heading modal -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Progress Proyek</h4>
        </div>
        <!-- body modal -->
        <div class="modal-body">
          <?php echo form_open('progres/tambah_aksi') ?>
              <div class="form-group">
                <label for="exampleInputEmail1">Kode Proyek</label>
                <select class="form-control" name="kd_proyek" onchange="changeValue(this.value)" id="kd_proyek">
                <option></option>
                <?php if(mysqli_num_rows($proyek)) {?>
		                <?php while($row_brg= mysqli_fetch_array($proyek)) {?>
		                    <option value="<?php echo $row_brg["kd_proyek"]?>"> <?php echo $row_brg["kd_proyek"]?> </option>
		                <?php $jsArray .= "judul['" . $row_brg['kd_proyek'] . "'] = {judul:'" . addslashes($row_brg['judul']) . "'};\n"; } ?>
		            <?php } ?>
                </select>
                <span id="pd"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Judul Proyek</label>
                <input type="text" class="form-control" placeholder="Judul Proyek" value="" name="judul" id="judul" readonly>
              </div>
              <hr>
              <label for="exampleInputEmail1">Progress</label>
              <div class="form-group">
              <input type="hidden" name="id_progres">
              <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Meeting/Rapat</label>
                <input name="tgl_meet" type="date" class="form-control">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Persentase Proyek</label>
                <input class="touchspin2" type="text" name="persentase">
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <select name="status_progres" class="form-control">
                    <option value=""></option>
                    <option value="Pengumpulan Data">Pengumpulan Data</option>
                    <option value="Desain Interface">Desain Interface</option>
                    <option value="Implementasi">Implementasi</option>
                    <option value="Testing">Testing</option>
                    <option value="Masalah Bug">Masalah Bug</option>
                  </select>
              </div>

              <div class="form-group">
                  <label for="exampleInputEmail1">Keterangan</label>
                  <textarea name="ket" class="form-control" placeholder="Isi Keterangan Proyek" required></textarea>
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

    <script src="<?php echo base_url(); ?>assets/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

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
    function changeValue(kd_proyek) {
      document.getElementById("judul").value = judul[kd_proyek].judul;
    };
    </script>
    <script>
      $(document).ready(function(){
      $('#kd_proyek').blur(function(){
        $('#pd').html('<img style="margin-left:10px; width:10px" src="<?php echo base_url(); ?>assets/img/loading.gif">');
          var kd_proyek = $(this).val();
          $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>progres/cek',
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

            $('#loading-example-btn').click(function () {
                btn = $(this);
                simpleLoad(btn, true)

                // Ajax example
//                $.ajax().always(function () {
//                    simpleLoad($(this), false)
//                });

                simpleLoad(btn, false)
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

        });
        

        function simpleLoad(btn, state) {
            if (state) {
                btn.children().addClass('fa-spin');
                btn.contents().last().replaceWith(" Loading");
            } else {
                setTimeout(function () {
                    btn.children().removeClass('fa-spin');
                    btn.contents().last().replaceWith(" Refresh");
                }, 2000);
            }
        }
    </script>
</body>

</html>
