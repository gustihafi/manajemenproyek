<?php

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	public function login(){
		$post = $this->input->post(null,TRUE);
		if(isset($post['login'])){
			$query = $this->m_login->login($post);
			if($query->num_rows() > 0){
				$row = $query->row();
				$params = array(
					'id_user' => $row->id_user,
					'fullname' => $row->fullname,
					'level' => $row->level,
					'email' => $row->email,
					'id_karyawan' => $row->id_karyawan,
					'status' => "login"
					);
				if($row->level == 'Admin'){
				$this->session->set_userdata($params);
				echo "<script>window.location='".base_url('home')."';</script>";
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <h4><i class="icon fa fa-check"></i> Success</h4>
	                Selamat Datang '.$row->fullname.' Login berhasil Sebagai '.$row->level.
	              '</div>');
			}elseif($row->level == 'Owner'){
				$this->session->set_userdata($params);
				echo "<script>window.location='".base_url('home')."';</script>";
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <h4><i class="icon fa fa-check"></i> Success</h4>
	                Selamat Datang '.$row->fullname.' Login berhasil Sebagai '.$row->level.
	              '</div>');
			}elseif($row->level == 'Karyawan'){
				$this->session->set_userdata($params);
				echo "<script>window.location='".base_url('home')."';</script>";
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <h4><i class="icon fa fa-check"></i> Success</h4>
	                Selamat Datang '.$row->fullname.' Login berhasil Sebagai '.$row->level.
	              '</div>');
			}
		}else{
				echo "<script>history.go(-1) </script>";
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Email atau Password Salah!
              </div>');
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('fullname');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('id_karyawan');
		$this->session->unset_userdata('status');

		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	    <h4><i class="icon fa fa-check"></i> Success</h4>
	     Logout Berhasil
		 </div>');
		redirect('');
	}
}

?>