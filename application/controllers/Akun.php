<?php

class Akun extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('m_akun');
        if($this->session->userdata('status') != 'login'){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Harus Login!
              </div>');
			redirect('');
            }elseif($this->session->level != 'Admin'){
              $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                  Hanya Admin yang bisa Akses Halaman Akun!
                </div>');
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('fullname');
                $this->session->unset_userdata('level');
                $this->session->unset_userdata('id_karyawan');
                $this->session->unset_userdata('status');
                redirect('');
          }
    }

    public function cek(){
		$id_karyawan = $this->input->post('id_karyawan');
		$sql = $this->db->query("SELECT id_karyawan FROM tbl_user WHERE id_karyawan='$id_karyawan'");
		$cek_kd = $sql->num_rows();
		if($cek_kd > 0){
			echo " &#10060; Data sudah ada";
		}else{
			echo " &#10004; Data bisa digunakan";
		}
    }

    public function cek_email(){
		$email = $this->input->post('email');
		$sql = $this->db->query("SELECT email FROM tbl_user WHERE email='$email'");
		$cek_kd = $sql->num_rows();
		if($cek_kd > 0){
			echo " &#10060; Email sudah ada!";
        }elseif($email == ""){
            echo " &#10060; Email tidak boleh kosong!";
        }
        else{
			echo " &#10004; Email bisa digunakan";
		}
    }

    public function index(){
        $data['tampil'] = $this->m_akun->tampil();
        $this->load->view('akun/v_akun',$data);
    }

    public function tambah_aksi(){
		$this->m_akun->tambah();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Success</h4>
         Data Berhasil di Simpan
         </div>');
		redirect('akun');
    }
    
    public function aksi_update(){
		$this->m_akun->update();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Success</h4>
         Data Berhasil di Update
         </div>');
		redirect('akun');
    }
    
    public function aksi_hapus($id_user){
		$this->m_akun->delete($id_user);
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                Data Berhasil di Hapus
              	</div>');
		redirect('akun');
	}
}

