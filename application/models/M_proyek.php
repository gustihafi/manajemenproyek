<?php

/**
* 
*/
class M_proyek extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function tampil_proyek(){
		$this->db->select('*,DATEDIFF(DATE_ADD(tgl_akhir, INTERVAL 0 DAY), CURDATE()) as selisih');
		$this->db->from('tbl_proyek a');
		$this->db->join('tbl_instansi c','c.id_instansi=a.id_instansi');
		$this->db->join('tbl_karyawan d','d.id_karyawan=a.id_karyawan');
		$this->db->order_by('a.judul');
		return $this->db->get()->result();
	}

	public function kode_unik(){
		$this->db->select('RIGHT(tbl_proyek.kd_proyek,2) as kode', FALSE);
		$this->db->order_by('kd_proyek','DESC');
		$this->db->limit(1);
		$query = $this->db->get('tbl_proyek');
		if($query->num_rows() > 0){
			$data = $query->row();
			$kode = intval($data->kode) + 1;
		}else{
			$kode = 1;
		}

		$kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodejadi = "P".$kodemax;
		return $kodejadi;
	}

	public function get2(){
		return $this->db->get('tbl_proyek')->result();
	}

	public function histori2(){
		return $this->db->get('tbl_log_proyek')->result();
	}

	public function histori(){
		$this->db->select('*,DATEDIFF(DATE_ADD(tgl_akhir, INTERVAL 0 DAY), CURDATE()) as selisih');
		$this->db->from('tbl_log_proyek a');
		$this->db->join('tbl_instansi c','c.id_instansi=a.id_instansi');
		$this->db->join('tbl_karyawan d','d.id_karyawan=a.id_karyawan');
		$this->db->order_by('a.tanggal');
		return $this->db->get()->result();
	}

	public function tampil_proyek2(){
		$this->db->select('*');
		$this->db->from('tbl_proyek a');
		$this->db->join('tbl_instansi c','c.id_instansi=a.id_instansi');
		$this->db->order_by('a.judul');
		return $this->db->get()->result();
	}

	public function get_setuju(){
		$this->db->select("count(status_proyek) as total, MONTHNAME(create_by) as bulan");
		$this->db->where("status_proyek='Disetujui' AND MONTH(create_by)=MONTH(DATE(NOW()))");
		return $this->db->get('tbl_proyek')->result();
	}

	public function get_tolak(){
		$this->db->select("count(status_proyek) as total, MONTHNAME(create_by) as bulan");
		$this->db->where("status_proyek='Ditolak' AND MONTH(create_by)=MONTH(DATE(NOW()))");
		return $this->db->get('tbl_proyek')->result();
	}

	public function get_p(){
		$this->db->select("count(status_proyek) as total_p, MONTHNAME(create_by) as bulan");
		$this->db->where("status_proyek='Penawaran' AND MONTH(create_by)=MONTH(DATE(NOW()))");
		return $this->db->get('tbl_proyek')->result();
	}	

	public function get_f(){
		$this->db->select("count(status_proyek) as total_f, MONTHNAME(create_by) as bulan");
		$this->db->where("status_proyek='Follow Up' AND MONTH(create_by)=MONTH(DATE(NOW()))");
		return $this->db->get('tbl_proyek')->result();
	}	

	public function get_ins(){
		return $this->db->get('tbl_instansi')->result();
	}

	public function get_kar(){
		return $this->db->get('tbl_karyawan')->result();
	}

	public function tambah_proyek(){
		$post 			= $this->input->post();

		$datains = array(
			"id_instansi"	=> $post['id_instansi'],
			"nm_instansi"	=> $post['nm_instansi'],
			"alamat_ins"	=> $post['alamat_ins'],
			"telp_ins"		=> $post['telp_ins'],
			"email_ins"		=> $post['email_ins']
			);
		$this->db->insert('tbl_instansi', $datains);

		$id_ins = $this->db->insert_id();
		$date = date("Y-m-d");
		$dataproyek = array(
			"kd_proyek"		=> $post['kd_proyek'],
			"judul" 		=> $post['judul'],
			"id_instansi" 	=> $id_ins,
			"nm_cp" 		=> $post['nm_cp'],
			"telp_cp" 		=> $post['telp_cp'],
			"status_proyek" => $post['status_proyek'],
			"ket"			=> $post['ket'],
			"nominal" 		=> $post['nominal'],
			"tgl_mulai" 	=> $post['tgl_mulai'],
			"tgl_akhir" 	=> $post['tgl_akhir'],
			"status" 		=> $post['status'],
			"id_karyawan" 	=> $post['id_karyawan'],
			"create_by"		=> $date
		);

		$this->db->insert('tbl_proyek', $dataproyek);
	}

	public function update_proyek(){
		$post 			= $this->input->post();

		$datains = array(
			"nm_instansi"	=> $post['nm_instansi'],
			"alamat_ins"	=> $post['alamat_ins'],
			"telp_ins"		=> $post['telp_ins'],
			"email_ins"		=> $post['email_ins']
			);
		$this->db->update('tbl_instansi', $datains, array('id_instansi' => $post['id_instansi']));

		$data = array(
			"judul" 		=> $post['judul'],
			"id_instansi" 	=> $post['id_instansi'],
			"nm_cp" 		=> $post['nm_cp'],
			"telp_cp" 		=> $post['telp_cp'],
			"status_proyek" => $post['status_proyek'],
			"ket"			=> $post['ket'],
			"nominal" 		=> $post['nominal'],
			"tgl_mulai" 	=> $post['tgl_mulai'],
			"tgl_akhir" 	=> $post['tgl_akhir'],
			"status" 		=> $post['status'],
			"id_karyawan" 	=> $post['id_karyawan']
		);
		$this->db->update('tbl_proyek', $data, array('kd_proyek' => $post['kd_proyek']));
	}

	public function delete($kd_proyek){
		return $this->db->delete('tbl_proyek', array("kd_proyek" => $kd_proyek));
	}
}