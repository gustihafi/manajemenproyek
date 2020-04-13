<?php

/**
* 
*/
class Menu extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_proyek');
	}

	public function index(){
		$data['tbl_karyawan'] = $this->m_proyek->get_kar();
		$this->load->view('menu',$data);
	}
}