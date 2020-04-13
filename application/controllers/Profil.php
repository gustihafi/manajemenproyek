<?php

class Profil extends CI_Controller
{
    public function __construct(){        
        parent::__construct();
        $this->load->model('m_akun');
        $this->load->model('m_proyek');
        $this->load->model('m_progres');
        if($this->session->userdata('status') != 'login'){
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                Harus Login!
              </div>');
			redirect('');
            }
            
            if($this->session->level != 'Karyawan'){
                $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Failed!</h4>
                    Hanya Karyawan yang bisa Akses Halaman Ini!
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
        $data['tampil'] = $this->m_akun->tampil();
        $data['foto'] = $this->m_akun->akun();
        // $data['count'] = $this->m_progres->count();
		// $data['notif'] = $this->m_progres->notif();
        $this->load->view('akun/v_profil',$data);
    }

    public function aksi_update(){
		$this->m_akun->update_profil();
		$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <h4><i class="icon fa fa-check"></i> Success</h4>
         Data Berhasil di Update
         </div>');
		redirect('profil');
    }
    
}