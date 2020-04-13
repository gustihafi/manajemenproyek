<?php

/**
* 
*/
class M_karyawan extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function tampil_karyawan(){
		return $this->db->get('tbl_karyawan')->result();
	}

	public function view_by($id_karyawan){
		$this->db->where('id_karyawan', $id_karyawan);
		return $this->db->get('tbl_karyawan')->row();
	}

	// public function tambah_karyawan($data){
	// 	$this->db->insert('tbl_karyawan', $data);
	// }

	private function _uploadImage(){
		$config['upload_path']		= 'assets/images/';
		$config['allowed_types']	= 'jpg|png|jpeg';
		$config['file_name']		= $this->nm_kar;
		$config['max_size']			= 2048;
		$config['overwrite']		= true;

		$this->load->library('upload', $config);
		if($this->upload->do_upload('gambar')){
			return $this->upload->data("file_name");
		}else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Data gagal di simpan
              </div>');
			echo "<script>history.go(-1) </script>";
		}
	}

	public function _deleteImage($id_karyawan){
		$karyawan 	= $this->view_by($id_karyawan);
		if ($karyawan->foto != ""){
			$filename 	= explode(".", $karyawan->foto)[0];
			return array_map('unlink', glob(FCPATH."assets/images/$filename.*"));
		}

	}

	public function tambah_karyawan(){
		$post	= $this->input->post();
		$this->nm_kar 		= $post['nm_kar'];
		$this->jk			= $post['jk'];
		$this->foto 		= $this->_uploadImage();
		$this->telp_kar		= $post['telp_kar'];
		$this->alamat_kar	= $post['alamat_kar'];
		$this->db->insert('tbl_karyawan', $this);
	}

	public function update(){
		$post = $this->input->post();
		$this->nm_kar			= $post['nm_kar'];
		$this->jk				= $post['jk'];

		if(!empty($_FILES['foto']['name'])){
			$this->foto 	= $this->_uploadImage();
		}else{
			$this->foto 	= $post['old_foto'];
		}

		$this->telp_kar		= $post['telp_kar'];
		$this->alamat_kar	= $post['alamat_kar'];
		$this->db->update('tbl_karyawan', $this, array('id_karyawan' => $post['id_karyawan']));
	}

	public function delete($id_karyawan){
		$this->_deleteImage($id_karyawan);
		return $this->db->delete('tbl_karyawan', array("id_karyawan" => $id_karyawan));
	}

}

?>