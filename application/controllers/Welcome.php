<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
        $this->load->model('M_Welcome');
        $this->session->set_userdata('sisule_cms_title', 'E-Office | Kabupaten Ciamis');
        if ($this->session->userdata('sisule_cms_status') == 'login') {
            redirect(base_url('home'));
        } elseif (($this->session->userdata('sisule_cms_hak') == 'superadmin') || ($this->session->userdata('sisule_cms_hak') == 'admin') || ($this->session->userdata('sisule_cms_hak') == 'staf')) {
            redirect(base_url('home'));
        }
    }

    public function message($tipe, $pesan)
    {
        $this->session->set_flashdata('message', '<div class="alert alert-' . $tipe . ' alert-dismissible fade show text-capitalize" style="text-size: 8px;" role="alert">
                ' . $pesan . '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>');
    }

    public function index()
    {
        $message['message']     = $this->session->flashdata('message');
        $str        = 'abcdefghijklmnopqrstuvwxyz';
        $shuffled   = str_shuffle($str);
        $shuffled   = substr($shuffled, 0, 5);
        $vals = array(
            'word'          => $shuffled,
            'img_path'      => 'assets/image/captcha/',
            'img_url'       => base_url() . 'assets/image/captcha/',
            'font_path'     => FCPATH . 'assets/fonts/texb.ttf',
            'img_width'     => '140',
            'img_height'    => 40,
            'expiration'    => 120,
            'word_length'   => 4,
            'font_size'     => 18,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'colors'            => array(
                'background'    => array(255, 255, 255),
                'border'        => array(255, 255, 255),
                'text'          => array(0,     0, 0),
                'grid'          => array(255, 120, 40)
            )
        );
        $files = glob('assets/image/captcha/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
        $this->session->unset_userdata('captchaword');

        $cap = create_captcha($vals);
        $message['captcha'] = $cap['image']; 
        $array_cap = array(
            'time' => date('Y-m-d H:i:s'),
            'word' => $cap['word']
        );
        $this->session->set_userdata('captchaword', $array_cap);

        $this->load->view('loaders-css');
        $this->load->view('index', $message);
        $this->load->view('loaders-js');
    }

    public function authentication()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('captcha', 'captcha', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->message('danger', 'kesalahan dalam input data');
            redirect(base_url('Home'));
        } else {
            $userdata   = $this->session->userdata('captchaword');
            $cekCaptcha = $this->M_Welcome->checkCaptcha();
            $check = $this->M_Welcome->login()->result();
            if ($userdata['word'] == $this->input->post('captcha') && $cekCaptcha) {
                if (count($check) > 0) {
                    $this->M_Welcome->resetSession($check[0]->nip);
                    $session_login = $this->M_Welcome->writeSessionLogin($check[0]->nip)->result(); //ok
                    if (count($session_login) > 0) {
                        $satuan_kerja = $this->M_Welcome->checkagendaris($check[0]->nip)->result();
                        if($satuan_kerja == null){
                            $satuan_kerja[0]->agendaris = 0;
                            $satuan_kerja[0]->kode_struktur_organisasi = 0;
                        }
                        $data_session = array(
                            'sisule_cms_user_id'        => $check[0]->user_id,
                            'sisule_cms_username'       => $check[0]->username,
                            'sisule_cms_status'         => 'login',
                            'sisule_cms_hak'            => $check[0]->hak,
                            'sisule_cms_session_id'     => $session_login[0]->nomor_session,
                            'sisule_cms_nip'            => $check[0]->nip,
                            'sisule_cms_instansi'       => $check[0]->id_instansi,
                            'sisule_cms_agendaris'      => $satuan_kerja[0]->agendaris,
                            'sisule_cms_satuan_kerja'   => $satuan_kerja[0]->kode_struktur_organisasi
                        );
                        $this->session->set_userdata($data_session);
                        if (($this->session->userdata('sisule_cms_hak') == 'superadmin') || ($this->session->userdata('sisule_cms_hak') == 'sekretariat') ||
                        ($this->session->userdata('sisule_cms_hak') == 'staf')) {
                            redirect(base_url('home'));
                        } else {
                            $this->message('danger', 'Invalid Hak Akses');
                            redirect(base_url('welcome'));
                        }
                    } else {
                        $this->message('danger', 'Invalid input');
                        redirect(base_url('welcome'));
                    }
                } else {
                    $this->message('danger', 'invalid username & password');
                    redirect(base_url('welcome'));
                }
            } else {
                $this->message('danger', 'Invalid Captcha.');
                redirect(base_url('welcome'));
            }
        }
    }
    public function downloadManualBook()
    {
        force_download('assets/dokumen/Tutorial_Penggunaan_SIPUDIN.pdf', null);
    }
}