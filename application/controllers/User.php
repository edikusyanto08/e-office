<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
        $this->load->model('M_User');
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
        $this->session->set_flashdata('message', '<div class="text-white alert alert-' . $tipe . ' alert-dismissible fade show text-capitalize" role="alert">
                ' . $pesan . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function listUser()
    {
        $output     = null;
        $data       = $this->M_User->listUser();
        $loop       = $data->num_rows();
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $loop       = $data->num_rows();
            $output .= '
            <table class="table table-borderless table-sm">
                <tbody>
            ';
            for ($i = 0; $i < $loop; $i++) {
                $output .= '
                    <tr>
                        <td style="width: 7%;">
                            <img src="../assets/image/pns/' .  $d_result[$i]["image"] . '" alt=" " style="width: 40px; height: 40px;" class="img rounded-circle">
                        </td>
                        <td class="text-dark" style="font-size: 14px; line-height: 20px;">
                            ' . $d_result[$i]["nama"] . ' - ' . $d_result[$i]["nip"]   . '<div class="mt-1" style="color:#ff704d; font-size: 14px; ">' . $d_result[$i]["username"] . ' / ' . $d_result[$i]["hak"] . ' - <span class="text-capitalize">' . $d_result[$i]["nama_instansi"] . '</span></div>' . '
                            <a class="text-capitalize btn btn-sm btn-primary mt-1 font-weight-bold btn-custome" href="' . base_url("home/formupdateuser/" . $d_result[$i]["user_id"]) . '" style="font-size: 12px;">perbaharui</a>
                            <a data-toggle="tooltip" data-placement="top" title="Hapus user" class="text-black-50 btn btn-sm hapususer font-weight-bold btn-custome" style="font-size: 12px;"data-id="' . $d_result[$i]["user_id"] . '">Hapus</a>
                        </td>
                    </tr>
                    ';
            }
            $output .= '
            </tbody>
            </table>
            ';
        } else {
            $output .= '
                <tr>
                    <td class="text-capitalize text-center">
                        belum ada user
                    </td>
                </tr>
            ';
        }
        echo $output;
    }
    public function listUserTanpaInstansi()
    {
        $output     = null;
        $data       = $this->M_User->listUserTanpaInstansi();
        $loop       = $data->num_rows();
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $loop       = $data->num_rows();
            $output .= '
            <table class="table table-borderless table-sm">
                <tbody>
            ';
            for ($i = 0; $i < $loop; $i++) {
                $output .= '
                    <tr>
                        <td class="text-dark" style="font-size: 14px;">
                            '  . $d_result[$i]["nip"]   . '<div class="mt-1" style="color:#ff704d; font-size: 12px; margin-bottom: -4px;">' . $d_result[$i]["username"] . ' / ' . $d_result[$i]["hak"] . ' - <span class="text-capitalize">' . $d_result[$i]["nama_instansi"] . '</span></div>' . '
                            <a class="text-capitalize" href="' . base_url("home/formupdateusertanpainstansi/" . $d_result[$i]["user_id"]) . '" style="font-size: 12px;">perbaharui</a>
                            <button data-toggle="tooltip" data-placement="top" title="Hapus user" class="text-black-50 btn btn-sm hapususer" style="font-size: 12px;"data-id="' . $d_result[$i]["user_id"] . '">Hapus</button>
                        </td>
                    </tr>
                    ';
            }
            $output .= '
            </tbody>
            </table>
            ';
            echo $this->pagination->create_links();
        } else {
            $output .= '
                <tr>
                    <td class="text-capitalize text-center">
                        belum ada user
                    </td>
                </tr>
            ';
        }
        echo $output;
    }

    public function buatuser()
    {
        $this->form_validation->set_rules('nip',        'nip',      'trim|required|min_length[18]|max_length[21]|is_unique[tbl_login.nip]|regex_match[/[0-9]+$/]');
        $this->form_validation->set_rules('username',   'username', 'trim|required|min_length[3]|max_length[30]|is_unique[tbl_login.username]');
        $this->form_validation->set_rules('password',   'password', 'trim|required|min_length[5]|max_length[30]');
        $this->form_validation->set_rules('instansi',   'instansi', 'trim|required');
        $this->form_validation->set_rules('hak',        'hak',      'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->message('warning', validation_errors());
            redirect(base_url('home/formuser'));
        } else {
            if ($this->M_User->buatUser() > 0) {
                $this->message('success', 'berhasil membuat akun baru');
                redirect(base_url('home/user'));
            } else {
                $this->message('danger', 'gagal membuat akun baru');
                redirect(base_url('home/formuser'));
            }
        }
    }
    public function hapususer()
    {
        if ($this->M_User->hapusUser($_POST['id']) > 0) {
            echo 'sukses';
        } else {
            echo 'gagal';
        }
    }

    public function perbaharuiuser()
    {
        $this->form_validation->set_rules('nip',        'nip',      'trim|required|min_length[18]|max_length[21]|regex_match[/[0-9]+$/]');
        $this->form_validation->set_rules('username',   'username', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('password',   'password', 'trim|required|min_length[5]');
        if ($this->form_validation->run() == FALSE) {
            $this->message('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->M_User->updateUser($this->input->post('user_id')) > 0) {
                $this->message('success', 'berhasil memperbaharui data akun');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->message('danger', 'gagal memperbaharui data akun');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function cariuser()
    {
        $output     = null;
        $data       = $this->M_User->cariuser($_POST['id']);
        $loop       = $data->num_rows();
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $loop       = $data->num_rows();
            $output .= '
            <table class="table table-borderless table-sm">
                <tbody>
            ';
            for ($i = 0; $i < $loop; $i++) {
                $output .= '
                    <tr>
                    <td style="width: 7%;">
                        <img src="../assets/image/pns/' .  $d_result[$i]["image"] . '" alt=" " style="width: 40px; height: 40px;" class="img rounded-circle">
                        </td>
                        <td class="text-dark" style="font-size: 14px;">
                            ' . $d_result[$i]["nama"] . ' - ' . $d_result[$i]["nip"]   . '<div class="mt-1" style="color:#ff704d; font-size: 12px; margin-bottom: -4px;">' . $d_result[$i]["username"] . ' / ' . $d_result[$i]["hak"] . ' - <span class="text-capitalize">' . $d_result[$i]["nama_instansi"] . '</span></div>' . '
                            <a class="text-capitalize mb-1" href="' . base_url("home/formupdateuser/" . $d_result[$i]["user_id"]) . '" style="font-size: 12px;">perbaharui</a>
                            <button data-toggle="tooltip" data-placement="top" title="Hapus user" class="text-black-50 btn btn-sm hapususer" style="font-size: 12px;" data-id="' . $d_result[$i]["user_id"] . '">Hapus</button>
                        </td>
                    </tr>
                    ';
            }
            $output .= '
            </tbody>
            </table>
            ';
        } else {
            $output .= '
                <tr>
                    <td class="text-capitalize text-center">
                        belum ada user
                    </td>
                </tr>
            ';
        }
        echo $output;
    }
    public function cariuserunregistered()
    {
        $output     = null;
        $data       = $this->M_User->cariuserunregistered($_POST['id']);
        $loop       = $data->num_rows();
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $loop       = $data->num_rows();
            $output .= '
            <table class="table table-borderless table-sm">
                <tbody>
            ';
            for ($i = 0; $i < $loop; $i++) {
                $output .= '
                    <tr>
                        <td class="text-dark" style="font-size: 14px;">
                            '  . $d_result[$i]["nip"]   . '<div class="mt-1" style="color:#ff704d; font-size: 12px; margin-bottom: -4px;">' . $d_result[$i]["username"] . ' / ' . $d_result[$i]["hak"] . ' - <span class="text-capitalize">' . $d_result[$i]["nama_instansi"] . '</span></div>' . '
                            <a class="text-capitalize" href="' . base_url("home/formupdateusertanpainstansi/" . $d_result[$i]["user_id"]) . '" style="font-size: 12px;">perbaharui</a>
                            <button data-toggle="tooltip" data-placement="top" title="Hapus user" class="text-black-50 btn btn-sm hapususer" style="font-size: 12px;"data-id="' . $d_result[$i]["user_id"] . '">Hapus</button>
                        </td>
                    </tr>
                    ';
            }
            $output .= '
            </tbody>
            </table>
            ';
        } else {
            $output .= '
                <tr>
                    <td class="text-capitalize text-center">
                        belum ada user
                    </td>
                </tr>
            ';
        }
        echo $output;
    }
}