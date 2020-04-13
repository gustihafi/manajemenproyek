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

    <title>APRO | Profil</title>
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
                    <div class="dropdown profile-element"> 
                    <?php if($this->session->level == 'Karyawan'){
                        foreach($foto as $dt){ ?>
                        <span>
                        <img alt="image" class="img-circle img-md" src="<?php echo base_url('assets/images/'.$dt->foto); ?>"/>
                        </span>
                         <?php  } ?>
                         
                        <?php }else{ ?>
                                    <span>
                                    <img alt="image" class="img-circle" src="<?php echo base_url(); ?>assets/img/profile_small.jpg" />
                                    </span>
                        <?php } ?>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
                            <?php foreach($foto as $dt){ 
                                echo $dt->fullname; 
                            }?>
                            </strong>
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
                <li class='active'>
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
                    <?php if($this->session->level == 'Admin' || $this->session->level == 'Owner'): ?>
                        <li><a href="<?php echo base_url('proyek') ?>">Data Project</a></li>
                    <?php endif; ?>
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
                    <i class="fa fa-history"></i> <span>History\i</span>
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
                                <!-- <?php foreach($notif as $data){ ?>
                                    <i class="fa fa-tasks fa-fw"></i> <?php echo $data->pesan; ?>
                                <?php } ?> -->
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
                    <h2>Profil</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url('home') ?>">Home</a>
                        </li>
                        <li>
                            <a>Karyawan</a>
                        </li>
                        <li class="active">
                            <strong>Profil</strong>
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
                <div class="col-lg-12">
                <div class="contact-box center-version">

                    <a href="<?php echo base_url('profil') ?>">
                    <?php 
                        foreach($foto as $dt){ ?>
                        <img alt="image" class="img-circle" src="<?php echo base_url('assets/images/'.$dt->foto); ?>">                        

                        <h3 class="m-b-xs"><strong><?php echo $dt->nm_kar ?></strong></h3>

                        <div class="font-bold"><?php echo $this->session->level ?></div>
                        <address class="m-t-md">
                            <strong>Jenis Kelamin</strong><br>
                            <?php echo $dt->jk ?><br><br>

                            <strong>Alamat</strong><br>
                            <?php echo $dt->alamat_kar ?><br>
                            <abbr title="Telp">Telp:</abbr> <?php echo $dt->telp_kar ?><br>
                            <abbr title="Email">Email:</abbr> <?php echo $dt->email ?>
                        </address>

                    </a>                    
                    <div class="contact-box-footer">
                        <div class="m-t-xs btn-group text-center">
                            <a class="btn btn-xs btn-white" data-toggle="modal" data-target="#edit<?php echo $dt->id_karyawan ?>"><i class="fa fa-pencil"></i> Edit </a>
                        </div>
                    </div>

                    <!-- Modaledit -->
                    <div id="edit<?php echo $dt->id_karyawan ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- konten modal-->
                          <div class="modal-content">
                            <!-- heading modal -->
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Profil</h4>
                            </div>
                            <!-- body modal -->
                            <div class="modal-body">
                              <?php echo form_open_multipart('profil/aksi_update') ?>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Fullname</label>
                                <input type="hidden" name="id_user" value="<?php echo $dt->id_user ?>">
                                <input type="hidden" name="id_karyawan" value="<?php echo $dt->id_karyawan ?>">
                                <input type="text" name="nm_kar" class="form-control" value="<?php echo $dt->nm_kar; ?>" placeholder="Isi Nama Lengkap" required>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Kelamin</label>
                                <select class="form-control" name="jk">
                                  <option value="" <?php if($dt->jk == ""){ echo "selected";} ?>></option>
                                  <option value="Laki-Laki" <?php if($dt->jk == "Laki-Laki"){ echo "selected";} ?>>Laki-Laki</option>
                                  <option value="Perempuan" <?php if($dt->jk == "Perempuan"){ echo "selected";} ?>>Perempuan</option>
                                </select>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Alamat</label>
                                  <textarea type="text" name="alamat_kar" class="form-control" placeholder="Alamat" required><?php echo $dt->alamat_kar; ?></textarea>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Telpon</label>
                                  <input type="number" name="telp_kar" class="form-control" placeholder="Telpon" value="<?php echo $dt->telp_kar; ?>" required>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $dt->email; ?>" required>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Password Baru</label>
                                  <input type="password" name="password" class="form-control" placeholder="Password" >
                              </div>
                              <div class="form-group">
                              <input type="checkbox" name="passwordlama" value="<?php echo $dt->password; ?>">Password Lama
                              </div>

                                <div class="form-group row">
                                    <label for="exampleInputFoto2" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                    <img src="<?php echo base_url('assets/images/').$dt->foto ?>" class="img-md">
                                      <input type="file" name="foto" class="form-control" id="exampleInputFoto2">
                                      <input type="hidden" name="old_foto" value="<?php echo $dt->foto ?>">
                                    </div>
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
                    <?php } ?>

                    </div>
                        </div>
                    </div>
                </div>
            </div>
        
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
                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
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
