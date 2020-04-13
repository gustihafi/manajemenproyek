<?php 

/**
* 
*/
class M_instansi extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function tampil_ins(){
		$this->db->select('*');
		$this->db->group_by('nm_instansi');
		return $this->db->get('tbl_instansi')->result();
	}
}