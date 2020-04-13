<?php

/**
* M_progres
*/
class M_progres extends CI_Model
{
	
	public function tampil(){
		$this->db->select('*,DATEDIFF(DATE_ADD(tgl_akhir, INTERVAL 0 DAY), CURDATE()) as selisih');
		$this->db->from('tbl_progres a');
		$this->db->join('tbl_proyek d','d.kd_proyek=a.kd_proyek');
		$this->db->join('tbl_karyawan e','e.id_karyawan=d.id_karyawan');
		$this->db->join('tbl_instansi c','c.id_instansi=d.id_instansi');
		$this->db->order_by('d.judul');
		return $this->db->get()->result();
	}

	public function histori(){
		$this->db->select('*,DATEDIFF(DATE_ADD(tgl_akhir, INTERVAL 0 DAY), CURDATE()) as selisih');
		$this->db->from('tbl_log_progres a');
		$this->db->join('tbl_proyek d','d.kd_proyek=a.kd_proyek');
		$this->db->join('tbl_instansi c','c.id_instansi=d.id_instansi');
		$this->db->order_by('d.judul');
		return $this->db->get()->result();
	}

	public function kar(){
		$this->db->select('*,DATEDIFF(DATE_ADD(tgl_akhir, INTERVAL 0 DAY), CURDATE()) as selisih');
		$this->db->from('tbl_progres a');
		$this->db->join('tbl_proyek d','d.kd_proyek=a.kd_proyek');
		$this->db->join('tbl_karyawan e','e.id_karyawan=d.id_karyawan');
		$this->db->join('tbl_instansi c','c.id_instansi=d.id_instansi');
		$this->db->where('d.id_karyawan',$this->session->id_karyawan);
		$this->db->group_by('d.id_karyawan',$this->session->id_karyawan);
		$this->db->order_by('d.judul');
		return $this->db->get()->result();
	}

	// public function notif(){
	// 	$this->db->where('id_karyawan',$this->session->id_karyawan);
	// 	return $this->db->get('notif')->result();
	// }

	// public function count(){
	// 	$this->db->select('COUNT(pesan) as pesan');
	// 	$this->db->from('notif');
	// 	$this->db->where('id_karyawan',$this->session->id_karyawan);
	// 	return $this->db->get()->result();
	// }

	public function get_proyek(){
		return $this->db->get('tbl_proyek')->result();
	}

	public function get_his(){
		return $this->db->get('tbl_log_progres')->result();
	}

	public function total_pro(){
		$this->db->select("count(tbl_progres.kd_proyek) as tpro, MONTHNAME(tbl_proyek.create_by) as bulan");
		$this->db->from('tbl_progres');
		$this->db->join('tbl_proyek', 'tbl_progres.kd_proyek=tbl_proyek.kd_proyek');
		$this->db->where("MONTH(tbl_proyek.create_by)=MONTH(DATE(NOW()))");
		return $this->db->get()->result();
	}

	public function total_pro2(){
		$this->db->select("count(tbl_progres.kd_proyek) as tpro, MONTHNAME(tbl_proyek.create_by) as bulan");
		$this->db->from('tbl_progres');
		$this->db->join('tbl_proyek', 'tbl_progres.kd_proyek=tbl_proyek.kd_proyek');
		$this->db->where("MONTH(tbl_proyek.create_by)=MONTH(DATE(NOW())) AND tbl_proyek.id_karyawan=".$this->session->id_karyawan);
		return $this->db->get()->result();
	}

	public function tambah_progres(){
		$post = $this->input->post();

		$data = array(
			"kd_proyek" => $post['kd_proyek'],
			"tgl_meet"	=> $post['tgl_meet'],
			"status_progres"	=> $post['status_progres'],
			"persentase" => $post['persentase'],
			"ket"		=> $post['ket']
		);
		$this->db->insert('tbl_progres', $data);
	}

	public function update(){
		$post = $this->input->post();
		$date = date("Y-m-d");
		$data = array(
			"kd_proyek" 		=> $post['kd_proyek'],
			"tgl_meet"			=> $date,
			"status_progres"	=> $post['status_progres'],
			"persentase" 		=> $post['persentase'],
			"ket"				=> $post['ket']
		);
		$this->db->update('tbl_progres', $data, array('id_progres' => $post['id_progres']));
	}

	public function delete($id_progres){
		return $this->db->delete('tbl_progres', array("id_progres" => $id_progres));
	}

	public function hapus_ket($id_log_progres){
		return $this->db->delete('tbl_log_progres', array('id_log_progres' => $id_log_progres));
	}
}