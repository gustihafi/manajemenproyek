<?php

/**
* 
*/
class Karyawan extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_karyawan');
		$this->load->model('m_proyek');
		if($this->session->userdata('status') != 'login'){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Harus Login!
              </div>');
			redirect('');
			}

			elseif($this->session->level == "Karyawan"){
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
		$data['tbl_karyawan'] = $this->m_karyawan->tampil_karyawan();
		// $data['tbl_proyek'] = $this->m_proyek->tampil_proyek();
		$this->load->view('karyawan/v_karyawan', $data);
	}

	public function tambah_aksi(){
		// $config['upload_path']		= 'images/';
		// $config['allowed_types']	= 'jpg|png|jpeg';
		// $config['max_size']			= 2048;
		// $config['overwrite']		= true;

		// $this->load->library('upload', $config);
		// if(!$this->upload->do_upload('foto')){
		// 	$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
  //               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  //               <h4><i class="icon fa fa-ban"></i> Failed!</h4>
  //               Data gagal di simpan
  //             </div>');
		// 	echo "<script>history.go(-1) </script>";
		// }else{
		// 	$nm_kar		= $this->input->post('nm_kar');
		// 	$file 		= $this->upload->data();
		// 	$foto		= $file['file_name'];
		// 	$telp_kar	= $this->input->post('telp_kar');
		// 	$alamat_kar	= $this->input->post('alamat_kar');

		// 	$this->m_karyawan->tambah_karyawan(array(
		// 		'nm_kar'		=> $nm_kar,
		// 		'foto'			=> $foto,
		// 		'telp_kar'		=> $telp_kar,
		// 		'alamat_kar'	=> $alamat_kar
		// 		));
		// 	$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
  //               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  //               <h4><i class="icon fa fa-check"></i> Success</h4>
  //               Data Berhasil di Simpan
  //             </div>');
		// 	redirect('admin/karyawan');
		// }
		
			$this->m_karyawan->tambah_karyawan();
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                Data Berhasil di Simpan
              </div>');
			redirect('karyawan');
		
	}

	public function aksi_update(){
		$this->m_karyawan->update();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                Data Berhasil di Update
              </div>');
			redirect('karyawan');
	}

	public function aksi_hapus($id_karyawan){
		$this->m_karyawan->delete($id_karyawan);
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success</h4>
                Data Berhasil di Hapus
              </div>');
			redirect('karyawan');
	}
}