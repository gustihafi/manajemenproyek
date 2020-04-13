<?php

/**
* 
*/
class M_login extends CI_Model
{
	public function login($post){
		$this->db->select('*');
		$this->db->from('tbl_user');
		$this->db->where('email', $post['email']);
		$this->db->where('password', md5($post['password']));
		return $query = $this->db->get();
	}

	public function get_id($id_user){
		return $this->db->get_where('tbl_user', array('id_user' => $id_user))->row();
	}
}

?>