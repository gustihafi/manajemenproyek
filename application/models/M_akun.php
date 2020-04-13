<?php

class M_akun extends CI_Model
{
    public function tampil(){
        $this->db->select('*');
        $this->db->from('tbl_user');
        // $this->db->join('tbl_karyawan b','a.id_karyawan=b.id_karyawan');
        return $this->db->get()->result();
    }

    public function tambah(){
        $post = $this->input->post();

		$data = array(
			"id_karyawan" => $post['id_karyawan'],
			"fullname"	=> $post['fullname'],
			"email"	=> $post['email'],
			"password" => md5($post['password']),
			"level"		=> $post['level']
		);
		$this->db->insert('tbl_user', $data);
    }

    public function update(){
        $post = $this->input->post();

		
		$this->id_karyawan  = $post['id_karyawan'];
		$this->fullname	    = $post['fullname'];
		$this->email	    = $post['email'];
			if(!empty($post['password'])){
                $this->password = md5($post['password']);
            }else{
                $this->password	= $post['passwordlama'];
            }
		$this->level        = $post['level'];
		
		$this->db->update('tbl_user', $this, array('id_user' => $post['id_user']));
    }

    private function _uploadImage(){
		$config['upload_path']		= 'assets/images/';
		$config['allowed_types']	= 'jpg|png|jpeg';
		$config['file_name']		= $this->input->post('nm_kar');
		$config['max_size']			= 2048;
		$config['overwrite']		= true;

		$this->load->library('upload', $config);
		if($this->upload->do_upload('foto')){
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

    public function update_profil(){
        $post = $this->input->post();

        if(!empty($_FILES['foto']['name'])){
        $datakar = array(
            "nm_kar" => $post['nm_kar'],
            "jk"    => $post['jk'],
            "foto" 	=> $this->_uploadImage(),
            "telp_kar" => $post['telp_kar'],
            "alamat_kar"	=> $post['alamat_kar']
        );
        }else{
            $datakar = array(
            "nm_kar" => $post['nm_kar'],
            "jk"    => $post['jk'],
            "foto" 	=> $post['old_foto'],
            "telp_kar" => $post['telp_kar'],
            "alamat_kar" => $post['alamat_kar']
            );
        }
        // update karyawan
        $this->db->update('tbl_karyawan', $datakar, array('id_karyawan' => $post['id_karyawan']));
        
        // pembatas

        if(!empty($post['password'])){
            $data = array(
                "id_karyawan"   => $post['id_karyawan'],
                "fullname"      => $post['nm_kar'],
                "email"         => $post['email'],
                "password"      => md5($post['password']),
                "level"         => "karyawan"
            );
        }else{
            $data = array(
                "id_karyawan"   => $post['id_karyawan'],
                "fullname"      => $post['nm_kar'],
                "email"         => $post['email'],
                "password"      => $post['passwordlama'],
                "level"         => "Karyawan"
            );
        }
	// update user
		$this->db->update('tbl_user', $data, array('id_user' => $post['id_user']));
    }

    public function delete($id_user){
        return $this->db->delete('tbl_user', array("id_user" => $id_user));
    }

    public function akun(){
        $id_karyawan = $this->session->id_karyawan;

        $this->db->select('*');
        $this->db->from('tbl_user a');
        $this->db->join('tbl_karyawan b','b.id_karyawan=a.id_karyawan');
        $this->db->where('b.id_karyawan='.$id_karyawan);
        return $this->db->get()->result();
    }
}
