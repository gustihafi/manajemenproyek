<?php

/**
* 
*/
class Progres extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_progres');
		$this->load->model('m_proyek');
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

	public function index(){
		// $kd_proyek = $this->input->post('kd_proyek');
		$data['tampil'] = $this->m_progres->tampil();
		$data['proyek'] = $this->m_progres->get_proyek();
		$data['histori'] = $this->m_progres->get_his();
		$data['kar'] = $this->m_progres->kar();
		// $data['count'] = $this->m_progres->count();
		// $data['notif'] = $this->m_progres->notif();
		$data['foto'] = $this->m_akun->akun();
		$this->load->view('progres/v_progres',$data);
	}

	public function cek(){
		$kd_proyek = $this->input->post('kd_proyek');
		$sql = $this->db->query("SELECT kd_proyek FROM tbl_progres WHERE kd_proyek='$kd_proyek'");
		$cek_kd = $sql->num_rows();
		if($cek_kd > 0){
			echo " &#10060; Data sudah ada";
		}else{
			echo " &#10004; Data bisa digunakan";
		}
	}

	public function tambah_aksi(){
		$this->m_progres->tambah_progres();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Success</h4>
         Data Berhasil di Simpan
         </div>');
		redirect('progres');
	}

	public function aksi_update(){
		$this->m_progres->update();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Success</h4>
         Data Berhasil di Update
         </div>');
		redirect('progres');
	}
	
	public function aksi_hapus($id_progres){
		$this->m_progres->delete($id_progres);
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                Data Berhasil di Hapus
              	</div>');
		redirect('progres');
	}

	public function hapusket($id_log_progres){
		$this->m_progres->hapus_ket($id_log_progres);
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                Data Berhasil di Hapus
              	</div>');
		redirect('progres');
	}
}