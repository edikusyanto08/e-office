<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
        $this->load->model('M_Bidang');
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
    public function getBidangKerja()
    {
        $catch['bidang'] = $this->M_Bidang->getBidang($_POST['id'])->result();
        $catch['atasan'] = $this->M_Bidang->getAtasan($_POST['id'])->result();
        if ($catch > 0) {
            echo json_encode($catch);
        } else {
            echo json_encode("data kosong");
        }
    }
    public function message($tipe, $pesan)
    {
        $this->session->set_flashdata('message', '<div class="alert alert-' . $tipe . ' alert-dismissible fade fade-in show text-capitalize text-white" role="alert">
                ' . $pesan . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }
    public function addBidangKerja()
    {
        if ($this->input->post('tipe') == 'struktural') {
            $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        } else {
            $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        }
        if ($this->form_validation->run() == false) {
            $this->message('danger', 'kesalahan dalam input data');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->M_Bidang->addBidang() > 0) {
                $this->message('success', 'berhasil menambahkan bidang kerja baru');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->message('danger', 'gagal menambahkan bidang kerja baru');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function ubahPejabatBidang()
    {
        if ($this->M_Bidang->updatePejabatBidang($this->input->post('id')) > 0) {
            $this->message('success', 'berhasil memperbaharui penggunaan sistem');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->message('danger', 'gagal memperbaharui penggunaan sistem');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function hapusBidangKerja($param)
    {
        if ($this->M_Bidang->deleteBidangKerja($param) > 0) {
            $this->message('success', 'berhasil menghapus bidang kerja');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function updateBidangKerja()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[5]|max_length[200]');
        if ($this->form_validation->run() === false) {
            $this->message('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->M_Bidang->updateBidangKerja($this->input->post('id')) > 0) {
                $this->message('success', 'berhasil memperbaharui jabatan');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->message('danger', 'gagal memperbaharui jabatan');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
}