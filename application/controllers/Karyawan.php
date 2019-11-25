<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
        $this->load->model('M_Karyawan');
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
        $this->session->set_flashdata('message', '<div class="alert alert-' . $tipe . ' alert-dismissible fade fade-in show text-capitalize text-white" role="alert">
                ' . $pesan . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }
    public function aksi_upload()
    {
        $config['upload_path']          = 'assets/image/pns';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = '40000';
        $config['overwrite']            = TRUE;
        $new_name                       = $this->session->userdata('sisule_cms_nip') . $_FILES["fileToUpload"]['name'];
        $config['file_name']            = $new_name;
        $this->upload->initialize($config);
        $this->upload->do_upload();

        $cek    = $this->M_Karyawan->cekRegisteredNip('tbl_karyawan', $this->input->post('nip'))->result();
        $cek_id = null;
        if ($cek != null) {
            $cek_id = $cek[0]->id_instansi;
        }
        $cek_instansi_user  = $this->M_Karyawan->cekRegisteredNip('tbl_login', $this->session->userdata('sisule_cms_nip'))->result();
        $cek_instansi_user  = $cek_instansi_user[0]->id_instansi;

        if ($cek_id == $cek_instansi_user || $cek_id == null) {
            if ($this->input->post('image') == null) {
                $this->message('danger', 'Data Tidak Disimpan Karena Tidak menyertakan file foto karyawan');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $nip    = $this->input->post('nip');
                $nip    = str_replace(" ", "", $nip);
                $nip1   = substr($nip, 0, 8);
                $nip2   = substr($nip, 8, 6);
                $nip3   = substr($nip, 14, 1);
                $nip4   = substr($nip, 15, 3);
                $nip_final  = $nip1 . " " . $nip2 . " " . $nip3 . " " . $nip4;
                $cek        = $this->M_Karyawan->checkImagePejabat($nip_final)->result();
                if ($cek != null) {
                    $image = $this->input->post('image');
                    $image_name = "./assets/image/pns/" . $image;
                    if (!file_exists($image_name)) {
                        if (!$this->upload->do_upload('fileToUpload')) {
                            $error = array('error' => $this->upload->display_errors());
                            $this->message('danger', $error['error']);
                            redirect($_SERVER['HTTP_REFERER']);
                        } else {
                            if ($image == $cek[0]->image) {
                                $file = "./assets/image/pns/" . $cek[0]->image;
                                unlink($file);
                                $this->upload->data('fileToUpload');
                            }
                            $this->addKaryawan();
                        }
                    } else {
                        $this->upload->data('fileToUpload');
                        $this->addKaryawan();
                    }
                } else {
                    if (!$this->upload->do_upload('fileToUpload')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->message('danger', $error['error']);
                        redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        $this->upload->data('fileToUpload');
                        $this->addKaryawan();
                    }
                }
            }
        } else {
            $this->message('danger', 'Tidak dapat mendaftarkan karyawan yang terdaftar diinstansi lain');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function addKaryawan()
    {
        if ($this->input->post('submit') == 'Kirim') {
            $this->form_validation->set_rules('nip',        'nip',      'trim|required|min_length[18]|max_length[21]|is_unique[tbl_karyawan.nip]|regex_match[/[0-9]+$/]');
            $this->form_validation->set_rules('nama',       'nama',     'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('pangkat',    'pangkat',  'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('golongan',   'golongan', 'trim|required|min_length[4]|max_length[5]');
            if ($this->form_validation->run() === false) {
                $this->message('warning', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                if ($this->M_Karyawan->addKaryawan() > 0) {
                    $this->message('success', 'berhasil menyimpan data karyawan');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->message('danger', 'gagal menyimpan data karyawan');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } elseif ($this->input->post('submit') == "Perbaharui") {
            $this->form_validation->set_rules('nip',        'nip',      'trim|required|min_length[18]|max_length[21]|regex_match[/[0-9]+$/]');
            $this->form_validation->set_rules('nama',       'nama',     'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('pangkat',    'pangkat',  'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('golongan',   'golongan', 'trim|required|min_length[4]|max_length[5]');
            if ($this->form_validation->run() === false) {
                $this->message('warning', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                if ($this->M_Karyawan->updateKaryawan() > 0) {
                    $this->message('success', 'berhasil memperbaharui data karyawan');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->message('danger', 'gagal memperbaharui data karyawan');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
    }
    public function getKaryawan()
    {
        $catch['pejabat'] = $this->M_Karyawan->getKaryawan($_POST['id'])->result();
        if ($catch > 0) {
            echo json_encode($catch);
        } else {
            echo json_encode("data kosong");
        }
    }
    public function deleteKaryawan($param)
    {
        $image = $this->M_Karyawan->getImageName($param)->result();
        if ($this->M_Karyawan->deleteKaryawan($param) > 0) {
            if ($image > 0) {
                $file = "./assets/image/pns/" . $image[0]->image;
                unlink($file);
            }
            $this->message('success', 'berhasil menghapus data karyawan');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function createAccount()
    {
        $this->form_validation->set_rules('username',  'username', 'trim|required|min_length[3]|max_length[30]|is_unique[tbl_login.username]');
        $this->form_validation->set_rules('password',  'password', 'trim|required|min_length[5]|max_length[30]');
        if ($this->form_validation->run() == FALSE) {
            $this->message('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->M_Karyawan->createAccount() > 0) {
                $this->message('success', 'berhasil membuat akun');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->message('danger', 'nip sudah digunakan');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    public function getAccountKaryawan()
    {
        $catch['account']   = $this->M_Karyawan->getAccountKaryawan($_POST['id_account'])->result();
        $catch['nip']       = $this->M_Karyawan->getDetailKaryawan($_POST['id_account'])->result();
        if ($catch > 0) {
            echo json_encode($catch);
        } else {
            echo json_encode("data kosong");
        }
    }
}