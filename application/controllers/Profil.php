<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
        $this->load->model('M_Profil');
        $check = $this->M_Home->checkSessionLogin($this->session->userdata('sisule_cms_session_id'))->result();
        if ($this->session->userdata('sisule_cms_status') != 'login') {
            $this->session->sess_destroy();
            redirect(base_url('Welcome'));
        } else if ($check[0]->nomor_session != $this->session->userdata('sisule_cms_session_id')) {
            $this->session->sess_destroy();
            redirect(base_url('Welcome'));
        } else if ($check[0]->status != '1') {
            $this->session->sess_destroy();
            redirect(base_url('Welcome'));
        }
    }
    public function message($tipe, $pesan)
    {
        $this->session->set_flashdata('message', '<div class="alert alert-' . $tipe . ' alert-dismissible fade show text-capitalize text-white" role="alert">
                ' . $pesan . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }
    public function perbaharuiprofil()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required|is_unique[tbl_login.username]');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        if ($this->form_validation->run() ==  FALSE) {
            $this->message('warning', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->M_Profil->perbaharuiProfil() > 0) {
                $this->message('success', 'berhasil memperbaharui profil');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->message('danger', 'gagal memperbaharui profil');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
}