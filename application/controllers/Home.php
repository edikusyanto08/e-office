<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
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

    public function index()
    {
        if ($this->session->userdata('sisule_cms_hak') == "superadmin" || $this->session->userdata('sisule_cms_hak') == "admin") {
            redirect(base_url('home/instansi'));
        } elseif ($this->session->userdata('sisule_cms_hak') == 'staf') {
            redirect(base_url('home/suratmasuk'));
        } else {
            $this->session->sess_destroy();
            redirect(base_url('Welcome'));
        }
    }
    public function template()
    {
        $data['message']        = $this->session->flashdata('message');
        $data['profile']        = $this->M_Home->getProfilPejabat($this->session->userdata('sisule_cms_nip'))->result();
        $data['agendaris']      = $this->M_Home->getInfoAgendaris($this->session->userdata('sisule_cms_nip'))->result();
        $data['login']          = $this->M_Home->getInforLogin($this->session->userdata('sisule_cms_nip'))->result();


        if ($data['agendaris'] != null) {
            $data['count_disposisi']    = $this->M_Home->countAllDisposisi()->result();
            $data['countSuratPerintah'] = $this->M_Home->countAllSuratPerintah()->result();
        } else {
            $data['countSuratPerintah'] = $this->M_Home->countSuratPerintah()->result();
            $data['count_disposisi']    = $this->M_Home->countDisposisi()->result();
        }
        $data['countSuratMasuk']    = $this->M_Home->countSuratMasuk()->result();
        $data['countAgenda']        = $this->M_Home->countAgenda()->result();
        $data['countNotaDinas']     = $this->M_Home->countNotaDinas()->result();
        $data['countSampah']        = $this->M_Home->countSampah()->result();

        return $data;
    }
    public function template2()
    {
        $data['message']        = $this->session->flashdata('message');
        $data['profile']        = $this->M_Home->getProfilPejabat($this->session->userdata('sisule_cms_nip'))->result();
        $data['agendaris']          = $this->M_Home->getInfoAgendaris($this->session->userdata('sisule_cms_nip'))->result();
        $data['penerima']           = $this->M_Home->listPenerimaSuratMasuk()->result();

        if ($data['agendaris'] != null) {
            $data['count_disposisi']    = $this->M_Home->countAllDisposisi()->result();
            $data['countSuratPerintah'] = $this->M_Home->countAllSuratPerintah()->result();
        } else {
            $data['countSuratPerintah'] = $this->M_Home->countSuratPerintah()->result();
            $data['count_disposisi']    = $this->M_Home->countDisposisi()->result();
        }
        $data['countSuratMasuk']    = $this->M_Home->countSuratMasuk()->result();
        $data['countAgenda']        = $this->M_Home->countAgenda()->result();
        $data['countNotaDinas']     = $this->M_Home->countNotaDinas()->result();
        $data['countSampah']        = $this->M_Home->countSampah()->result();

        return $data;
    }

    public function template3()
    {
        $data['message']        = $this->session->flashdata('message');
        $data['profile']        = $this->M_Home->getProfilPejabat($this->session->userdata('sisule_cms_nip'))->result();
        $data['agendaris']      = $this->M_Home->getInfoAgendaris($this->session->userdata('sisule_cms_nip'))->result();
        $data['login']          = $this->M_Home->getInforLogin($this->session->userdata('sisule_cms_nip'))->result();

        return $data;
    }

    public function template4()
    {
        $data['message']    = $this->session->flashdata('message');
        $data['profile']    = $this->M_Home->getProfilPejabat($this->session->userdata('sisule_cms_nip'))->result();
        $data['login']      = $this->M_Home->getInforLogin($this->session->userdata('sisule_cms_nip'))->result();

        return $data;
    }

    // surat
    public function suratMasuk()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template();

        $row = $this->M_Home->getBarisSuratMasuk();
        $config['base_url']     = base_url() . 'home/suratmasuk';
        $config['total_rows']   = $row;
        $config['per_page']         = 10;
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
        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['surat']                  = $this->M_Home->getAllSuratMasuk($config['per_page'], $start)->result();
            $data['pembuat_surat_masuk']    = $this->M_Home->getPembuatSuratMasuk()->result();
            $data['penerima_surat_masuk']   = $this->M_Home->getPenerimaSuratMasuk()->result();
        } else {
            $data['surat']                  = null;
            $data['pembuat_surat_masuk']    = null;
            $data['penerima_surat_masuk']   = null;
        }
        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/suratmasuk', $data);
        $this->load->view('core/loaders-js');
    }

    public function suratDisposisi()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template();

        // paginasi
        $row = $this->M_Home->getBarisDisposisi();
        $config['base_url']     = base_url() . 'home/suratdisposisi';
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

        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            if ($data['agendaris'] == null) {
                $data['disposisi']          = $this->M_Home->getAllSuratDisposisiForPembuat($config['per_page'], $start)->result();
                $data['pembuat_disposisi']  = $this->M_Home->getPembuatDisposisi()->result();
            } else {
                $data['disposisi']          = $this->M_Home->getAllSuratDisposisiForAgendaris($config['per_page'], $start)->result();
                $data['pembuat_disposisi']  = $this->M_Home->getAllPembuatDisposisi()->result();
            }
            $data['alldisposisi']       = $this->M_Home->getAllSuratDisposisiForAgendaris($config['per_page'], $start)->result();
            $data['agendaris']          = $this->M_Home->getStatusUserAsAgendaris()->result();
            $data['penerima_disposisi'] = $this->M_Home->getPenerimaDisposisi()->result();
            $data['getStatusPenerimaSuratDisposisi'] = $this->M_Home->getStatusPenerimaSuratDisposisi()->result();
            $data['max']                = $this->M_Home->getJumlahMaxAtasan()->result();
            $data['redisposisi']        = $this->M_Home->cariPenerimaDisposisi()->result();
        } else {
            $data['disposisi']          = null;
            $data['penerima_disposisi'] = null;
            $data['pembuat_disposisi']  = null;
            $data['max']                = null;
            $data['redisposisi']        = null;
        }

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/suratdisposisi', $data);
        $this->load->view('core/loaders-js');
    }

    public function suratPerintah()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template();
        // paginasi
        $row = $this->M_Home->getBarisSuratPerintah();
        $config['base_url']     = base_url() . 'home/suratperintah';
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

        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            if ($data['agendaris'] != null) {
                $data['surat_perintah']     = $this->M_Home->getAllSuratPerintah($config['per_page'], $start)->result();
                $data['pembuat_perintah']   = $this->M_Home->getAllPembuatSuratPerintah()->result();
            } else {
                $data['surat_perintah']     = $this->M_Home->getSuratPerintah($config['per_page'], $start)->result();
                $data['pembuat_perintah']   = $this->M_Home->getPembuatSuratPerintah()->result();
                $data['penerima_perintah']  = $this->M_Home->getPenerimaSuratPerintah()->result();
            }
            $data['all_sp']     = $this->M_Home->getAllSuratPerintah($config['per_page'], $start)->result();
        } else {
            $data['surat_perintah']     = null;
            $data['pembuat_perintah']   = null;
        }

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/suratperintah', $data);
        $this->load->view('core/loaders-js');
    }

    public function suratNotaDinas()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template();

        // paginasi
        $row = $this->M_Home->getBarisNotaDinas();
        $config['base_url'] = base_url() . 'home/notadinas';
        $config['total_rows'] = $row;
        $config['per_page'] = 10;
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

        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['notaDinas']          = $this->M_Home->getNotaDinas($config['per_page'], $start)->result();
            $data['penulisNotaDinas']   = $this->M_Home->getPenulisNotaDinas()->result();
            $data['pembuatNotaDinas']   = $this->M_Home->getPembuatNotaDinas()->result();
        } else {
            $data['notaDinas']          = null;
            $data['penulisNotaDinas']   = null;
            $data['pembuatNotaDinas']   = null;
        }
        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/suratnotadinas', $data);
        $this->load->view('core/loaders-js');
    }

    public function sampah()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template();
        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['sampah']                 = $this->M_Home->getSuratMasukDitangguhkan()->result();
            $data['penerima_surat_masuk']   = $this->M_Home->getPenerimaSuratMasukDitangguhkan()->result();
        } else {
            $data['sampah']                 = null;
            $data['penerima_surat_masuk']   = null;
        }
        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/sampah', $data);
        $this->load->view('core/loaders-js');
    }
    public function Pengagendaan()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template();
        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['penerima']           = $this->M_Home->listPenerimaSuratMasuk()->result();
            $data['agendaris']          = $this->M_Home->getInfoAgendaris($this->session->userdata('sisule_cms_nip'))->result();
            $data['agenda_surat']       = $this->M_Home->getAllSuratDisposisiNeededAgenda()->result();
        } else {
            $data['penerima']           = null;
            $data['agendaris']          = null;
            $data['agenda_surat']       = null;
        }
        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/pengagendaan', $data);
        $this->load->view('core/loaders-js');
    }
    public function suratkeluar()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template3();
        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['suratkeluar']    = $this->M_Home->getAllSuratKeluar()->result();
            $data['pembuat']        = $this->M_Home->getPembuatSurat()->result();
            $data['agendaris']      = $this->M_Home->getAgendaris()->result();
            $data['pembuatsurat']   = $this->M_Home->getInfoPembuatSuratKeluar()->result();
            $data['atasan']         = $this->M_Home->getInfoAtasanPembuatSuratKeluar()->result();
            $data['cek_status_karyawan'] = $cek_status_karyawan;
        } else {
            $data['suratkeluar']    = null;
            $data['pembuat']        = null;
            $data['agendaris']      = null;
            $data['pembuatsurat']   = null;
            $data['atasan']         = null;
            $data['cek_status_karyawan'] = null;
        }
        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/suratkeluar', $data);
        $this->load->view('core/loaders-js');
    }
    public function formSuratMasuk()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template2();

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/form-surat-masuk', $data);
        $this->load->view('core/loaders-js');
    }
    public function updateSuratMasuk($param)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template2();
        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['surat']              = $this->M_Home->getSuratMasuk($param)->result();
        } else {
            $data['surat']              = null;
        }
        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/form-update-surat-masuk', $data);
        $this->load->view('core/loaders-js');
    }

    public function formnotadinas($param)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template2();
        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['bidang']         = $this->M_Home->getBidangForNotaDinas($param)->result();
            $data['info_file']      = $this->M_Home->getInfoFileDisposisi($param)->result();
            $data['nota_dinas']     = $this->M_Home->getInfoNotaDinas($param)->result();
        } else {
            $data['bidang']         = null;
            $data['info_file']      = null;
            $data['nota_dinas']     = null;
        }

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/form-surat-disposisi', $data);
        $this->load->view('core/loaders-js');
    }

    public function formupdatenotadinas($param)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template2();

        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['bidang']         = $this->M_Home->getBidangForNotaDinas($param)->result();
            $data['info_file']      = $this->M_Home->getInfoFileDisposisi($param)->result();
            $data['nota_dinas']     = $this->M_Home->getInfoNotaDinas($param)->result();
            $data['lampiran']       = $this->M_Home->getLampiranNotaDinas($param)->result();
        } else {
            $data['bidang']         = null;
            $data['info_file']      = null;
            $data['nota_dinas']     = null;
            $data['lampiran']       = null;
        }
        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/form-surat-nota-dinas', $data);
        $this->load->view('core/loaders-js');
    }

    public function formSuratPerintah($param)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template2();
        $cek_status_karyawan = $this->M_Home->checkStatusKaryawan()->result();
        if ($cek_status_karyawan != null) {
            $data['slug']           = $param;
            $data['agenda_surat']   = $this->M_Home->getAgendaSurat($param)->result();
        } else {
            $data['slug']           = null;
            $data['agenda_surat']   = null;
        }

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/form-surat-perintah', $data);
        $this->load->view('core/loaders-js');
    }
    // instansi
    public function instansi($param = 0)
    {
        $data = $this->template4();

        $data['countInstansi']  = $this->M_Home->countInstansi()->result();
        $data['param']      = $param;
        $data['instansi']   = $this->M_Home->getDetailInstansi()->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/instansi', $data);
        $this->load->view('core/loaders-js');
    }
    public function forminstansi($param = 0)
    {
        $data = $this->template4();
        $data['param']          = $param;

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/input-instansi', $data);
        $this->load->view('core/loaders-js');
    }
    public function Bidang()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();
        // paginasi
        $row = $this->M_Home->getBarisBidang();
        $config['base_url']     = base_url() . 'home/bidang';
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

        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $data['bidang']     = $this->M_Home->getBidangAsAdmin($config['per_page'], $start)->result();
            $data['pasif']      = $this->M_Home->getBidangKosong()->result();
            $data['karyawan']   = $this->M_Home->getKaryawanPengangguran()->result();
            $data['atasan']     = $this->M_Home->getPejabatStruktural()->result();
        }
        // $data['bidang']             = $this->M_Home->getBidang($config['per_page'], $start)->result();
        $data['countBidang']    = $this->M_Home->countBidang()->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/bidang', $data);
        $this->load->view('core/loaders-js');
    }
    public function karyawan()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();
        // paginasi
        $row = $this->M_Home->getBarisKaryawan();
        $config['base_url']     = base_url() . 'home/karyawan';
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

        $data['karyawan']       = $this->M_Home->getKaryawan($config['per_page'], $start)->result();
        $data['countKaryawan']  = $this->M_Home->countKaryawan()->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/karyawan', $data);
        $this->load->view('core/loaders-js');
    }
    public function user()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        if ($this->session->userdata('sisule_cms_hak') == 'superadmin') {
            $data['message']    = $this->session->flashdata('message');
            $data['profile']    = $this->M_Home->getProfilPejabat($this->session->userdata('sisule_cms_nip'))->result();
            $data['login']      = $this->M_Home->getInforLogin($this->session->userdata('sisule_cms_nip'))->result();
            $data['unregistered']   = $this->M_Home->unregisteredUser()->result();

            $data['countUser']  = $this->M_Home->getCountUser()->result();

            $this->load->view('core/loaders-css');
            $this->load->view('core/organisasi/user', $data);
            $this->load->view('core/loaders-js');
        } elseif ($this->session->userdata('sisule_cms_hak') == 'admin') {
            redirect(base_url('home/instansi'));
        } else {
            redirect(base_url('home/suratmasuk'));
        }
    }
    public function formuser($param = 0)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data['message']    = $this->session->flashdata('message');
        $data['profile']    = $this->M_Home->getProfilPejabat($this->session->userdata('sisule_cms_nip'))->result();
        $data['login']      = $this->M_Home->getInforLogin($this->session->userdata('sisule_cms_nip'))->result();

        $data['param']      = $param;
        $data['instansi']   = $this->M_Home->getInstansiTanpaUser()->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/input-user', $data);
        $this->load->view('core/loaders-js');
    }
    public function formupdateuser($param = 0)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $data['param']              = $param;
        $data['user']               = $this->M_Home->getDetailUser($param)->result();
        $data['instansi']           = $this->M_Home->getInfoInstansi()->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/update-user', $data);
        $this->load->view('core/loaders-js');
    }
    public function formupdateusertanpainstansi($param = 0)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $data['param']              = $param;
        $data['instansi']           = $this->M_Home->getInstansiTanpaUser()->result();
        $data['user']               = $this->M_Home->getDetailUserTanpaInstansi($param)->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/update-user-tanpa-instansi', $data);
        $this->load->view('core/loaders-js');
    }
    // profil user
    public function profil()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $data['bidang']     = $this->M_Home->getBidangKaryawan($this->session->userdata('sisule_cms_nip'))->result();
        $data['instansi']   = $this->M_Home->getInstansiProfilKaryawan($this->session->userdata('sisule_cms_nip'))->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/organisasi/profil', $data);
        $this->load->view('core/loaders-js');
    }
    public function panduan()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $this->load->view('core/loaders-css');
        $this->load->view('core/app/panduan', $data);
        $this->load->view('core/loaders-js');
    }
    public function lapor()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data['message']    = $this->session->flashdata('message');
        $data['profile']    = $this->M_Home->getProfilPejabat($this->session->userdata('sisule_cms_nip'))->result();
        $data['login']      = $this->M_Home->getInforLogin($this->session->userdata('sisule_cms_nip'))->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/app/lapor', $data);
        $this->load->view('core/loaders-js');
    }
    public function formlapor()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $this->load->view('core/loaders-css');
        $this->load->view('core/app/form/form-lapor', $data);
        $this->load->view('core/loaders-js');
    }
    public function statistik()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template();
        $data['countMailSampah']    = $this->M_Home->countMailSampah($this->session->userdata('sisule_cms_nip'))->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/statistik', $data);
        $this->load->view('core/loaders-js');
        $this->load->view('core/loaders-diagram');
    }
    public function kalender()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/kalender', $data);
        $this->load->view('core/loaders-js');
    }
    public function tracking()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $row = $this->M_Home->getBarisSuratMasuk();
        $config['base_url']     = base_url() . 'home/tracking';
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

        $data['surat']                  = $this->M_Home->getAllSuratMasuk($config['per_page'], $start)->result();
        $data['penerima_surat_masuk']   = $this->M_Home->getPenerimaSuratMasuk()->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/tracking', $data);
        $this->load->view('core/loaders-js');
    }
    public function logout()
    {
        $this->M_Home->sess_destroy($this->session->userdata('diskominfo_cms_session_id'));
        $this->session->sess_destroy();
        $this->session->unset_userdata('status');
        redirect(base_url('home'));
    }
    public function formsuratkeluar()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/form-surat-keluar', $data);
        $this->load->view('core/loaders-js');
    }
    public function prosessuratkeluar($param)
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $data['prosessuratkeluar']  = $this->M_Home->getSuratKeluar($param)->result();
        $data['penerimasurat']      = $this->M_Home->getPenerimaSuratKeluar($param)->result();
        $data['surat_keluar']       = $this->M_Home->getSuratKeluar($param)->result();
        $data['pembuat']            = $this->M_Home->getPembuatSuratKeluar($param)->result();
        $data['atasan']             = $this->M_Home->getInfoDetailAtasanPembuatSuratKeluar($param)->result();
        $data['agendaris']          = $this->M_Home->getInfoAgendarisUser($this->session->userdata('sisule_cms_nip'))->result();
        $data['surat_keluar_masuk'] = $this->M_Home->getSuratKeluarMasuk($param)->result();

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/proses-surat-keluar', $data);
        $this->load->view('core/loaders-js');
    }
    public function reviewsuratkeluar()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $cek = $this->M_Home->infoInstansi($this->session->userdata('sisule_cms_instansi'))->result();
            if ($cek[0]->nama_instansi == null || $cek[0]->singkatan == null || $cek[0]->alamat == null || $cek[0]->telepon == null || $cek[0]->email == null || $cek[0]->fax == null) {
                redirect(base_url('home/instansi'));
            }
        }
        $data = $this->template4();

        $this->load->view('core/loaders-css');
        $this->load->view('core/mail/review-surat-keluar', $data);
        $this->load->view('core/loaders-js');
    }
}