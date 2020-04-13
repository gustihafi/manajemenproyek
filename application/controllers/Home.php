<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Home extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('m_proyek');
		$this->load->model('m_progres');
		$this->load->model('m_akun');
		if($this->session->userdata('status') != 'login'){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Harus Login!
              </div>');
			redirect('');
			}
	}

	public function index()
	{
		$data['total_setuju'] = $this->m_proyek->get_setuju();
		$data['total_tolak'] = $this->m_proyek->get_tolak();
		$data['total_p'] = $this->m_proyek->get_p();
		$data['total_f'] = $this->m_proyek->get_f();
		$data['tpro'] = $this->m_progres->total_pro();
		$data['tpro2'] = $this->m_progres->total_pro2();
		// $data['count'] = $this->m_progres->count();
		// $data['notif'] = $this->m_progres->notif();
		$data['tbl_proyek'] = $this->m_proyek->tampil_proyek();
		$data['foto'] = $this->m_akun->akun();
		$this->load->view('v_dashboard',$data);
	}
}