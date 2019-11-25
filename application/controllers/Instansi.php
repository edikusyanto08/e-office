<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instansi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
        $this->load->model('M_Instansi');
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
    public function buatinstansi()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'superadmin') {
            $this->M_Instansi->checkExistInstansi($this->input->post('id_instansi'))->result();
            if ($_POST['submit'] == 'Perbaharui') {
                $this->form_validation->set_rules('id_instansi',    'Kode Instansi',    'trim|required|min_length[3]|max_length[3]|regex_match[/[0-9]+$/]');
                $this->form_validation->set_rules('nama_instansi',  'Nama Instansi',    'trim|required|min_length[10]|max_length[100]|is_unique[tbl_instansi.nama_instansi]');
                $this->form_validation->set_rules('singkatan',      'Singkatan',        'trim|required|min_length[3]|max_length[100]');
                if ($this->form_validation->run() == FALSE) {
                    $this->message('warning', validation_errors());
                    redirect(base_url('home/instansi'));
                } else {
                    if ($this->M_Instansi->perbaharuiinstansi() > 0) {
                        $this->message('success', 'berhasil memperbaharui instansi');
                        redirect(base_url('home/instansi'));
                    } else {
                        $this->message('danger', 'gagal memperbaharui instansi');
                        redirect(base_url('home/forminstansi'));
                    }
                }
            } elseif ($_POST['submit'] == 'Simpan') {
                $this->form_validation->set_rules('id_instansi',    'Kode Instansi',    'trim|required|min_length[3]|max_length[3]|is_unique[tbl_instansi.id_instansi]|regex_match[/[0-9]+$/]');
                $this->form_validation->set_rules('nama_instansi',  'Nama Instansi',    'trim|required|min_length[10]|max_length[100]|is_unique[tbl_instansi.id_instansi]');
                $this->form_validation->set_rules('singkatan',      'Singkatan',        'trim|required|min_length[3]|max_length[100]|is_unique[tbl_instansi.id_instansi]');
                if ($this->form_validation->run() == FALSE) {
                    $this->message('warning', validation_errors());
                    redirect(base_url('home/instansi'));
                } else {
                    if ($this->M_Instansi->buatinstansi() > 0) {
                        $this->message('success', 'berhasil membuat instansi');
                        redirect(base_url('home/instansi'));
                    } else {
                        $this->message('danger', 'gagal membuat instansi');
                        redirect(base_url('home/forminstansi'));
                    }
                }
            }
        } elseif ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $this->form_validation->set_rules('nama_instansi',  'nama_instansi',    'trim|required|min_length[10]|max_length[100]');
            $this->form_validation->set_rules('singkatan',      'singkatan',        'trim|required|min_length[3]|max_length[100]');
            $this->form_validation->set_rules('alamat',         'alamat',           'trim|required|min_length[5]|max_length[500]');
            $this->form_validation->set_rules('telepon',        'telepon',          'trim|required|min_length[8]|max_length[15]|regex_match[/^[0-9,()]+$/]');
            $this->form_validation->set_rules('email',          'email',            'trim|required|valid_email');
            $this->form_validation->set_rules('fax',            'fax',              'trim|required|min_length[5]|max_length[15]|regex_match[/^[0-9,]+$/]');
            if ($this->form_validation->run() == FALSE) {
                $this->message('warning', validation_errors());
                redirect(base_url('home/instansi'));
            } else {
                if ($this->M_Instansi->perbaharuiinstansi() > 0) {
                    $this->message('success', 'berhasil memperbaharui instansi');
                    redirect(base_url('home/instansi'));
                } else {
                    $this->message('danger', 'gagal memperbaharui instansi');
                    redirect(base_url('home/forminstansi'));
                }
            }
        }
    }
    function numeric_wcomma($str)
    {
        return preg_match('/^[0-9,]+$/', $str);
    }
    public function hapusinstansi()
    {
        if ($this->M_Instansi->hapusinstansi($_POST['id']) > 0) {
            echo 'success';
        } else {
            echo 'gagal';
        }
    }
    public function getinstansi()
    {
        $data['instansi'] = $this->M_Instansi->getinstansi($_POST['id_instansi'])->result();
        if ($data > 0) {
            echo json_encode($data);
        } else {
            echo json_encode("data kosong");
        }
    }
    public function listinstansi()
    {
        $output = null;
        // paginasi
        $row = $this->M_Instansi->getBarisInstansi();
        $config['base_url']     = base_url() . 'home/instansi';
        $config['total_rows']   = $row;
        $config['per_page']     = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = "<ul class='pagination justify-content-center pagination-sm'>";
        $config['full_tag_close']   = "</ul>";
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $start = $this->uri->segment(3);
        $this->pagination->initialize($config);

        $data = $this->M_Instansi->listinstansi($config['per_page'], $start);
        $loop = $data->num_rows();
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
                    <tr class="text-capitalize">
                        <td class="text-dark" style="font-size: 15px;">
                            ' . $d_result[$i]["id_instansi"] . " - " . $d_result[$i]["nama_instansi"] . ' - <span class="text-uppercase">' . $d_result[$i]["singkatan"] . '</span><br>
                            <div style="margin-bottom: -25px; color:#ff704d; font-size: 12px;">' . $d_result[$i]["alamat"] . ' - ' . $d_result[$i]["telepon"] . ' ' . $d_result[$i]["email"] . ' ' .  $d_result[$i]["fax"]  . '</div><br>
                            <a href="' . base_url("home/forminstansi/" . $d_result[$i]["id_instansi"]) . '" style="text-decoration: none; font-size: 12px;">perbaharui</a>
                            <button data-toggle="tooltip" data-placement="top" title="Hapus instansi" class="text-black-50 btn btn-sm hapusinstansi" id="hapusinstansi" style="text-decoration: none; font-size: 12px;"data-id="' . $d_result[$i]["id_instansi"] . '">Hapus</button>
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
                        belum ada instansi
                    </td>
                </tr>
            ';
        }
        echo $output;
    }
    public function cariinstansi()
    {
        $output = null;
        $data   = $this->M_Instansi->cariinstansi($_POST['id']);
        $loop   = $data->num_rows();
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
                    <tr class="text-capitalize">
                        <td class="text-dark" style="font-size: 15px;">
                            ' . $d_result[$i]["id_instansi"] . " - " . $d_result[$i]["nama_instansi"] . ' - <span class="text-uppercase">' . $d_result[$i]["singkatan"] . '</span><br>
                            <div style="margin-bottom: -25px; color:#ff704d; font-size: 12px;">' . $d_result[$i]["alamat"] . ' - ' . $d_result[$i]["telepon"] . ' ' . $d_result[$i]["email"] . ' ' .  $d_result[$i]["fax"]  . '</div><br>
                            <a href="' . base_url("home/forminstansi/" . $d_result[$i]["id_instansi"]) . '" style="text-decoration: none; font-size: 12px;">perbaharui</a>
                            <button data-toggle="tooltip" data-placement="top" title="Hapus instansi" class="text-black-50 btn btn-sm hapusinstansi" id="hapusinstansi" style="text-decoration: none; font-size: 12px;"data-id="' . $d_result[$i]["id_instansi"] . '">Hapus</button>
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
                        not found...
                    </td>
                </tr>
            ';
        }
        echo $output;
    }
}