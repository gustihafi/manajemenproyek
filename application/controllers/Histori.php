<?php

class Histori extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('m_proyek');
        $this->load->model('m_progres');
        $this->load->helper('rupiah');

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
    }

    public function index(){
        $data['proyek'] = $this->m_proyek->histori();
        $data['proyek2'] = $this->m_proyek->histori2();
        $data['progres'] = $this->m_progres->histori();
        $this->load->view('v_histori', $data);
    }
}
