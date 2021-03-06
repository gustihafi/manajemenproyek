<?php

/**
* 
*/
class Instansi extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_proyek');
		$this->load->model('m_instansi');
		if($this->session->userdata('status') != 'login'){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Harus Login!
              </div>');
			redirect('');
			}

			if($this->session->level == 'Karyawan'){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Failed!</h4>
					Hanya Admin & Owner yang bisa Akses Halaman Ini!
				  </div>');
				  $this->session->unset_userdata('email');
				  $this->session->unset_userdata('fullname');
				  $this->session->unset_userdata('level');
				  $this->session->unset_userdata('id_karyawan');
				  $this->session->unset_userdata('status');
				  redirect('');
			}
	}

	public function index(){
		$data['tbl_instansi'] = $this->m_instansi->tampil_ins();
		$data['tbl_proyek'] = $this->m_proyek->tampil_proyek();
		$this->load->view('instansi/v_instansi',$data);
	}
}