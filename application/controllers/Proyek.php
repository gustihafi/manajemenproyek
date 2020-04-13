<?php

/**
* 
*/
class Proyek extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('status') != 'login'){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Harus Login!
              </div>');
			redirect('auth');
			}
			
			if($this->session->level == 'Karyawan'){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4><i class="icon fa fa-ban"></i> Failed!</h4>
					Hanya Admin dan Owner yang bisa Akses Halaman Ini!
				  </div>');
				$this->session->unset_userdata('email');
				$this->session->unset_userdata('fullname');
				$this->session->unset_userdata('level');
				$this->session->unset_userdata('id_karyawan');
				$this->session->unset_userdata('status');
				redirect('');
			}
		$this->load->model('m_proyek');
		$this->load->model('m_progres');
		$this->load->model('m_akun');
		$this->load->helper('rupiah_helper');
	}

	public function index(){
		$data['tbl_karyawan'] = $this->m_proyek->get_kar();
		$data['tbl_instansi'] = $this->m_proyek->get_ins();
		$data['tbl_proyek'] = $this->m_proyek->tampil_proyek();
		$data['get'] = $this->m_proyek->get2();
		// $data['notif'] = $this->m_progres->notif();
		$data['kodeunik'] = $this->m_proyek->kode_unik();
		// $data['status'] = $this->m_proyek->tampil_stts();
		$data['foto'] = $this->m_akun->akun();
		$data['tbl_proyek2'] = $this->m_proyek->tampil_proyek2();
		$data['progres'] = $this->m_progres->tampil();
		$this->load->view('proyek/v_proyek', $data);
	}

	public function cek(){
		$kd_proyek = $this->input->post('kd_proyek');
		$sql = $this->db->query("SELECT kd_proyek FROM tbl_proyek WHERE kd_proyek='$kd_proyek'");
		$cek_kd = $sql->num_rows();
		if($cek_kd > 0){
			echo " &#10060; Kode Proyek sudah ada";
		}else{
			echo " &#10004; Kode Proyek bisa digunakan";
		}
	}

	public function tambah_aksi(){
		$this->m_proyek->tambah_proyek();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Success</h4>
         Data Berhasil di Simpan
         </div>');
		redirect('proyek');
	}

	public function aksi_update(){
		$this->m_proyek->update_proyek();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Success</h4>
         Data Berhasil di Update
         </div>');
		redirect('proyek');
	}

	public function aksi_hapus($kd_proyek){
		$this->m_proyek->delete($kd_proyek);
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                Data Berhasil di Hapus
              </div>');
			redirect('proyek');
	}
}

?>