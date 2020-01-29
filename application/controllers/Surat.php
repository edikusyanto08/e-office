<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_Home');
        $this->load->model('M_Surat');
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
    public function simpanSuratMasuk()
    {
        if (count($_FILES['userfile']['name']) < 1) {
            $this->message('danger', 'Tidak Ada file yang diunggah atau Ukuran File terlalu besar');
            redirect($_SERVER['HTTP_REFERER']);
        } elseif ($this->input->post('tujuan') == 0) {
            $this->message('danger', 'Belum menentukan penerima surat');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->form_validation->set_rules("asal_surat",     "asal_surat",   "trim|required|min_length[5]|max_length[500]");
            $this->form_validation->set_rules("nomor_surat",    "nomor_surat",  "trim|required|min_length[5]");
            $this->form_validation->set_rules("waktu",          "waktu",        "trim|required|min_length[10]");
            $this->form_validation->set_rules("tujuan",         "tujuan",       "trim|required");
            $this->form_validation->set_rules("perihal",        "perihal",      "trim|required|min_length[5]|max_length[1000]");
            $this->form_validation->set_rules("start",          "start",        "trim|required|min_length[10]");
            $this->form_validation->set_rules("end",            "end",          "trim|required|min_length[10]");
            $this->form_validation->set_rules("waktu_kegiatan",         "waktu_kegiatan",       "trim|required|min_length[5]");
            $this->form_validation->set_rules("tempat_pelaksanaan",     "tempat_pelaksanaan",   "trim|required");
            if ($this->form_validation->run() === FALSE) {
                $this->message('danger', validation_errors());
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $slug = $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat'));
                if ($this->M_Surat->saveSuratMasuk($slug)) {
                    $dataInfo   = array();
                    $files      = $_FILES;
                    $cpt        = count($_FILES['userfile']['name']);
                    $config     = array();
                    $config['upload_path']      = 'assets/file/surat-masuk';
                    $config['allowed_types']    = 'jpg|png|jpeg|jpg';
                    $config['max_size']         = 2000;
                    $config['overwrite']        = FALSE;
                    $this->upload->initialize($config);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['userfile']['name']     = date('m-d-Y-H-i') . str_replace(' ', '-', $this->session->userdata('sisule_cms_nip')) . $files['userfile']['name'][$i];
                        $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                        $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                        $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                        $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                        $this->upload->do_upload();
                        $dataInfo[] = $this->upload->data();
                        $data = array(
                            'nomor_surat'   => $this->input->post('nomor_surat'),
                            'slug_surat'    => $slug,
                            'nama_file'     => $dataInfo[$i]['file_name']
                        );
                        $this->M_Surat->insertFileSuratMasuk($data);
                    }
                    $this->message('success', 'Surat masuk berhasil di digitalisasi');
                    redirect(base_url('home/suratmasuk'));
                } else {
                    $this->message('success', 'Surat masuk gagal di digitalisasi');
                    redirect(base_url('home/suratmasuk'));
                }
            }
        }
    }

    public function updatesuratmasuk()
    {
        $this->form_validation->set_rules("asal_surat",     "asal_surat",   "trim|required|min_length[5]|max_length[500]");
        $this->form_validation->set_rules("nomor_surat",    "nomor_surat",  "trim|required|min_length[5]");
        $this->form_validation->set_rules("waktu",          "waktu",        "trim|required|min_length[10]");
        $this->form_validation->set_rules("perihal",        "perihal",      "trim|required|min_length[5]|max_length[1000]");
        $this->form_validation->set_rules("start",          "start",        "trim|required|min_length[10]");
        $this->form_validation->set_rules("end",            "end",          "trim|required|min_length[10]");
        $this->form_validation->set_rules("waktu_kegiatan",         "waktu_kegiatan",       "trim|required|min_length[5]");
        $this->form_validation->set_rules("tempat_pelaksanaan",     "tempat_pelaksanaan",   "trim|required");
        if ($this->form_validation->run() == FALSE) {
            $this->message('warning', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $update_surat = $this->M_Surat->updateSuratMasuk();
            if ($update_surat > 0) {
                $this->message('success', 'Surat masuk berhasil diperbaharui');
                redirect(base_url('home/suratmasuk'));
            } else {
                if ($update_surat == 0) {
                    $this->message('danger', 'Surat masuk tidak berhasil diperbaharui : Nomor Surat Telah Digunakan Oleh Surat Masuk Lainnya.');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->message('danger', 'Surat masuk tidak berhasil diperbaharui ');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
    }

    public function deleteSuratMasukSementara($param)
    {
        if ($this->M_Surat->deleteSuratMasukSementara($param) > 0) {
            $this->message('success', 'Surat masuk dipindahkan ke tong sampah.');
            redirect(base_url('home/suratmasuk'));
        } else {
            $this->message('danger', 'Hapus Surat Masuk Gagal Dilakukan.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function deleteSuratMasuk()
    {
        $param = $_POST['slug'];
        $data['file']   = $this->M_Surat->getFileName($param)->result();
        $cek            = $this->M_Surat->checkNotaDinasWasCreated($param)->result();
        $data['nota']   = $this->M_Surat->getFileNotaDinasForDelete($param)->result();
        if ($cek != null) {
            if ($data['nota'] != null) {
                for ($j = 0; $j < count($data['nota']); $j++) {
                    $nota_dinas = "assets/file/nota-dinas/" .  $data['nota'][$j]->nama_file;
                    unlink($nota_dinas);
                }
            }
        }
        $data['surat_masuk']    = $this->M_Surat->getFileSuratMasuk($param)->result();
        if ($data['surat_masuk'] != null) {
            for ($i = 0; $i < count($data['file']); $i++) {
                if (file_exists('assets/file/surat-masuk/' . $data['file'][$i]->nama_file)) {
                    $file = "assets/file/surat-masuk/" . $data['file'][$i]->nama_file;
                    unlink($file);
                }
            }
            if ($this->M_Surat->deleteSuratMasuk($param) > 0) {
                $this->message('success', 'Surat Masuk Telah Dihapus.');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->message('danger', 'Hapus Surat Masuk Gagal Dilakukan.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->message('danger', 'Surat Masuk Tidak Ditemukan');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function downloadSuratMasuk($param)
    {
        $data = $this->M_Surat->getFile($param)->result();
        echo count($data);
        if ($data > 0) {
            for ($i = 0; $i < count($data); $i++) {
                force_download('assets/file/surat-masuk/' .  $data[$i]->nama_file, null);
            }
        }
        $this->message('warning', ' Kesalahan System. Please Contact System Adminitrator!');
        redirect(base_url('home/containSuratMasuk'));
    }
    public function getFileSuratMasuk($param = null)
    {
        $mpdf           = new \Mpdf\Mpdf(['format' => 'Legal']);
        $surat          = $this->M_Surat->checkFileSuratMasuk($param)->result();
        if ($surat != null) {
            $data['file'] = $this->M_Surat->getFileSuratMasuk($param)->result();
            $data['instansi']       = $this->M_Surat->getInstansiForSuratKeluar($param)->result();
            $data['surat_masuk']   = $this->M_Surat->getSuratMasukUntukDidownload($param)->result();
            $data['penerima_surat'] = $this->M_Surat->getDetailPenerimaSuratKeluar($param)->result();
            $html = $this->load->view('core/mail/file-surat-masuk', $data, true);
            $surat_masuk    = $this->load->view('core/mail/template-surat-masuk', $data, true);
            $lampiran       = $this->load->view('core/mail/lampiran-penerima-surat-keluar', $data, true);
            // cek apakah nomor surat keluar dan surat masuk sama
            $cek = $this->M_Surat->checkSuratKeluarMasuk($param)->result();
            if ($cek != null) {
                // $mpdf->WriteHTML($surat_masuk);
                $mpdf->SetHTMLHeader('
                <table width="100%">
                    <tr>
                        <td width="10%" align="center"></td>
                        <td width="80%" style="text-align: right; color: grey; font-size: 12px;"></td>
                    </tr>
                </table>');
                if (count($data['penerima_surat']) > 1) {
                    $mpdf->AddPage();
                    $mpdf->WriteHTML($lampiran);
                }
                $mpdf->AddPage();
            }
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="10%"></td>
                        <td width="10%" align="center"></td>
                        <td width="80%" style="text-align: right; color: grey; font-size: 12px;">&copy; Pemerintahan Kabupaten Ciamis - ' . date("Y") . '.</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);
            $mpdf->Output('Surat Masuk - ' . $data['file'][0]->nomor_surat . '.pdf', 'I');
        } else {
            show_404();
        }
    }
    function getPageCount()
    {
        return count($this->pages);
    }
    public function getFileSuratKeluar($param = null)
    {
        $surat          = $this->M_Surat->checkFileSuratKeluar($param)->result();
        if ($surat != null) {
            $data['file']           = $this->M_Surat->getFileSuratKeluar($param)->result();
            $data['instansi']       = $this->M_Surat->getInstansiForSuratKeluar($param)->result();
            $data['surat_keluar']   = $this->M_Surat->getSuratKeluar($param)->result();
            $data['penerima_surat'] = $this->M_Surat->getDetailPenerimaSuratKeluar($param)->result();
            $mpdf           = new \Mpdf\Mpdf(['format' => 'Legal']);
            $html = $this->load->view('core/mail/file-surat-keluar', $data, true);
            $surat_keluar   = $this->load->view('core/mail/template-surat-keluar', $data, true);
            $lampiran       = $this->load->view('core/mail/lampiran-penerima-surat-keluar', $data, true);
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="10%"></td>
                        <td width="10%" align="center"></td>
                        <td width="80%" style="text-align: right; color: grey; font-size: 12px;">&copy;Pemerintahan Kabupaten Ciamis - ' . date("Y") . '</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($surat_keluar);
            $mpdf->SetHTMLHeader('
            <table width="100%">
                <tr>
                    <td width="10%" style="text-align: left; color: grey; font-size: 12px;">Lampiran</td>
                    <td width="10%" align="center"></td>
                    <td width="80%" style="text-align: right; color: grey; font-size: 12px;"></td>
                </tr>
            </table>');
            if (count($data['penerima_surat']) > 1) {
                $mpdf->AddPage();
                $mpdf->WriteHTML($lampiran);
            }
            $mpdf->AddPage();
            $mpdf->WriteHTML($html);
            $mpdf->Output('Surat Keluar - ' . $data['file'][0]->nomor_surat . '.pdf', 'I');
        } else {
            show_404();
        }
    }
    public function getsuratmasuk()
    {
        $catch['surat_masuk']   = $this->M_Surat->getsuratmasuk($_POST['id'])->result();
        $data                   = $this->M_Surat->getCountDokumen($_POST['id'])->result();
        $catch['dokumen']       = count($data);
        $catch['penerima']      = $this->M_Surat->getAllPenerimaDisposisi($_POST['id'])->result();
        $catch['disposisi']     = $this->M_Surat->getPreviewDisposisi($_POST['id'])->result();
        if ($catch > 0) {
            echo json_encode($catch);
        } else {
            echo json_encode("data kosong");
        }
    }
    public function getListPenerimaDisposisi()
    {
        $data       = $this->M_Surat->getAllPenerimaDisposisi($_POST['id']);
        $output     = null;
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $looping    = $data->num_rows();
            $output     .= '<div class="table-responsive table-sm">
                        <table class="table table-borderless">
                        ';
            for ($i = 0; $i < $looping; $i++) {
                $output .= '<tr>
                            <td> ' . $d_result[$i]["nama"] . '</td>
                            <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm deletePenerimaDisposisi text-danger" data-id="' . $d_result[$i]['kode_struktur_organisasi'] . '" style="margin-top: -10px;"><i class="fas fa-times"></i></a></button></td>

                        </tr>
                    ';
            }
        } else {
            $output = "<p class='text-center'>Data Not Found</p>";
        }
        echo $output;
    }
    public function deletePenerimaDisposisi()
    {
        $data       = $this->M_Surat->deletePenerimaDisposisi($_POST['nip'], $_POST['no_surat']);
        $output     = null;
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $looping    = $data->num_rows();
            $output     .= '<div class="table-responsive table-sm">
                        <table class="table table-borderless">
                        ';
            for ($i = 0; $i < $looping; $i++) {
                $output .= '<tr>
                            <td> ' . $d_result[$i]["nama"] . '</td>
                            <td class="text-center">
                            <button type="button" class="btn btn-default btn-sm deletePenerimaDisposisi text-danger" data-id="' . $d_result[$i]['kode_struktur_organisasi'] . '" style="margin-top: -10px;"><i class="fas fa-times"></i></a></button></td>

                        </tr>
                    ';
            }
        } else {
            $output = "<p class='text-center'>Data Not Found</p>";
        }
        echo $output;
    }

    public function restoreFileSampah($param)
    {
        if ($this->M_Surat->restoreFileSampah($param) > 0) {
            $this->message('success', 'Surat masuk berhasil di restore.');
            redirect(base_url('home'));
        } else {
            $this->message('danger', ' Hapus Surat Masuk Gagal Dilakukan.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function cariPNS()
    {
        $data       = $this->M_Surat->searchPNS($_POST['id']);
        $output     = null;
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $looping    = $data->num_rows();
            $output     .= '<div class="table-responsive table-sm">
                        <table class="table table bordered">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Pejabat</th>
                                <th class="text-center">Aksi</th>
                            </tr>';
            for ($i = 0; $i < $looping; $i++) {
                $output .= '<tr>
                            <td><img src="' . base_url("assets/image/pns/" . $d_result[$i]["image"]) . '" style="width:35px; border-radius: 100%;" alt=""></td>
                            <td> ' . $d_result[$i]["nama"] . ' - <span class="text-capitalize">' . $d_result[$i]["nama_bidang"] . '</span></td>
                            <td class="text-center"><button type="button" class="btn btn-light btn-sm saveOnDisposisi" data-id="' . $d_result[$i]['kode_struktur_organisasi'] . '"><i class="fa fa-plus" style="margin-left: 5px;"></i></a></button></td>
                        </tr>
                    ';
            }
        } else {
            $output = "<p class='text-center'>Data Not Found</p>";
        }
        echo $output;
    }
    public function cariPNSSuratKeluar()
    {
        $data       = $this->M_Surat->searchPNSSuratKeluar($_POST['id']);
        $output     = null;
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $looping    = $data->num_rows();
            $output     .= '<div class="table-responsive table-sm">
                        <table class="table table bordered">
                            <tr>
                                <th>#</th>
                                <th>Nama Pejabat</th>
                                <th class="text-center">Aksi</th>
                            </tr>';
            for ($i = 0; $i < $looping; $i++) {
                $output .= '<tr>
                            <td><img src="' . base_url("assets/image/pns/" . $d_result[$i]["image"]) . '" style="width:35px; height: 35px; border-radius: 100%;" alt=""></td>
                            <td> ' . $d_result[$i]["nama_instansi"] . ' - <span class="text-capitalize">' . $d_result[$i]["nama_bidang"] . '</span> - '.  $d_result[$i]["nama"].'</td>
                            <td class="text-center"><button type="button" class="btn btn-light btn-sm saveOnDisposisi" data-id="' . $d_result[$i]['kode_struktur_organisasi'] . '"><i class="fa fa-plus" style="margin-left: 5px;"></i></a></button></td>
                        </tr>
                    ';
            }
        } else {
            $output = "<p class='text-center'>Data Not Found</p>";
        }
        echo $output;
    }
    public function tambahPenerimaDisposisi()
    {
        $data       = $this->M_Surat->getPenerimaDisposisi($_POST['id'])->result();
        $jabatan    = $this->M_Surat->getJabatanPenerimaDisposisi($_POST['id'])->result();
        if ($data > 0) {
            echo json_encode($data);
            if ($this->session->userdata('session_user_penerima_disposisi')) {
                $dataLama   = $this->session->userdata('session_user_penerima_disposisi');
                $dataLama   = json_encode($dataLama);
                $dataLama   = json_decode($dataLama, true);
                $dataKu     = json_encode($data);
                $dataKu     = json_decode($dataKu, true);
                $dataJabatanKu  = json_encode($jabatan);
                $dataJabatanKu  = json_decode($dataJabatanKu, true);
                $i              = count($dataLama);
                $arrayBaru[$i++] = array(
                    'kode_struktur_organisasi'       => $dataKu[0]['kode_struktur_organisasi'],
                    'nama'      => $dataKu[0]['nama'],
                    'image'     => $dataKu[0]['image'],
                    'instansi'  => $dataKu[0]['nama_instansi'],
                    'jabatan'   => $dataJabatanKu[0]['nama_bidang']
                );
                $arrayFinal = $dataLama + $arrayBaru;
                $this->session->set_userdata('session_user_penerima_disposisi', $arrayFinal);
            } else {
                $dataKu = json_encode($data);
                $dataKu = json_decode($dataKu, true);
                $dataJabatanKu = json_encode($jabatan);
                $dataJabatanKu = json_decode($dataJabatanKu, true);
                $array[] = array(
                    'kode_struktur_organisasi'       => $dataKu[0]['kode_struktur_organisasi'],
                    'nama'      => $dataKu[0]['nama'],
                    'image'     => $dataKu[0]['image'],
                    'instansi'  => $dataKu[0]['nama_instansi'],
                    'jabatan'   => $dataJabatanKu[0]['nama_bidang']
                );
                $this->session->set_userdata('session_user_penerima_disposisi', $array);
            }
        } else {
            echo json_encode('tidak ada pns');
        }
    }
    public function tampilkanPenerimaDisposisi()
    {
        $output = null;
        $array = $this->session->userdata('session_user_penerima_disposisi');
        if ($array) {
            $no = count($array) - 1;
            for ($i = count($array) - 1; $i >= 0; $i--) {
                $output .= '<tr>
                    <td style="width: 5%;"><img src="' . base_url("assets/image/pns/" . $array[$i]["image"]) . '" style="width:35px; height: 35px; border-radius: 100%; margin-top: 4px;" alt=""></td>
                    <td style="font-size: 12px;"><span class="text-uppercase">' . $array[$i]['instansi'] . "</span> - <span class='text-capitalize'>" . $array[$i]['jabatan'] . ' - <span class="text-primary">' . $array[$i]['nama']. '</span>'. '</span></td>
                    <td><button type="button" class="btn btn-default btn-sm deleteData" data-id="' . $no . '"></button></td>
                </tr>';
                $no--;
            }
        } else {
            $output = null;
        }
        echo $output;
    }
    public function clearUserDataDisposisi()
    {
        $this->session->unset_userdata('session_user_penerima_disposisi');
    }
    public function hapusPenerimaDisposisi()
    {
        $param = $_POST['id'];
        $array = $this->session->userdata('session_user_penerima_disposisi');
        echo $array[$param]['nip'];
    }
    public function createSuratDisposisi()
    {
        $slug       = null;
        $count      = $this->session->userdata('session_user_penerima_disposisi');
        $pembuat    = $this->session->userdata('sisule_cms_satuan_kerja');
        $penerima   = rand();
        $sifat      = $this->security->xss_clean($_POST['sifat']);
        $catatan    = $this->security->xss_clean($_POST['catatan']);
        $harapan    = $_POST['harapan_1'] . $_POST['harapan_2'] . $_POST['harapan_3'];
        $no_surat   = $this->security->xss_clean($_POST['nomor_surat']);
        $slug_surat = $this->M_Surat->getSlugSuratMasuk($no_surat)->result();
        if ($slug_surat != null) {
            $slug = $slug_surat[0]->slug_surat;
        }
        $now        = date('m/d/Y H:i:s');
        $cek        = $this->M_Surat->cekKetersediaanDisposisi($_POST['nomor_surat'])->result();
        if ($cek != null) {
            $data = array(
                'sifat'             => $sifat,
                'harapan'           => $harapan,
                'catatan'           => $catatan,
                'waktu_disposisi'   => $now,
            );
            $penerima_update = $cek[0]->penerima;
            if ($this->M_Surat->updateSuratDisposisi($_POST['nomor_surat'], $data) > 0) {
                for ($i = count($count) - 1; $i >= 0; $i--) {
                    $data_penerima_disposisi = array(
                        'kode_struktur_organisasi'           => $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'],
                        'penerima'      => $penerima_update,
                        'nomor_surat'   => $no_surat
                    );
                    $cek_user = $this->M_Surat->cekUserTerdisposisi($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'])->result();
                    if ($cek_user == null) {
                        $this->M_Surat->updatePenerimaDisposisi($data_penerima_disposisi, $no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi']);
                    }
                }
                $this->M_Surat->trackingDisposisi($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi']);
            }
            $this->session->unset_userdata('session_user_penerima_disposisi');
        } else {
            $kode = $this->session->userdata('sisule_cms_satuan_kerja');
            // $kso = $this->M_Surat->getKodeStrukturOrganisasi()->result();
            // if ($kso != null) {
            //     $kode = $kso[0]->kode_struktur_organisasi;
            // }
            $nama_karyawan = null;
            $jabatan_karyawan = null;
            $golongan_karyawan = null;
            $karyawan = $this->M_Surat->getDataKaryawan()->result();
            if($karyawan != null){
                $nama_karyawan = $karyawan[0]->nama;
                $jabatan_karyawan = $karyawan[0]->nama_bidang;
                $golongan_karyawan = $karyawan[0]->golongan;
            }
            $insert = array(
                'pembuat_disposisi' => $pembuat,
                'penerima'          => $penerima,
                'nomor_surat'       => $no_surat,
                'slug_surat'        => $slug,
                'sifat'             => $sifat,
                'harapan'           => $harapan,
                'catatan'           => $catatan,
                'waktu_disposisi'   => $now,
                // 'nomor_agenda'      => '',
                // 'tanggal_agenda'    => '',
                // 'agendaris_surat'         => '',
                'date_produce'      => date('mm'),
                'year_produce'      => date('YY'),
                // 'kode_struktur_organisasi'  => $kode,
                'disposisi_instansi'        => $this->session->userdata('sisule_cms_instansi'),
                'nama_karyawan'             => $nama_karyawan,
                'jabatan_karyawan'          => $jabatan_karyawan,
                'golongan_karyawan'         => $golongan_karyawan
            );
            if ($this->M_Surat->createSuratDisposisi($insert, $no_surat) > 0) {
                if ($_POST['ikutundangan'] > 0) {
                    $ikut_disposisi = array(
                        'kode_struktur_organisasi' => $this->session->userdata('sisule_cms_satuan_kerja'),
                        'penerima'      => $penerima,
                        'nomor_surat'   => $no_surat
                    );
                    $cek_user = $this->M_Surat->cekUserTerdisposisi($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'])->result();
                    if ($cek_user == null) {
                        $this->M_Surat->createPenerimaDisposisi($ikut_disposisi, $no_surat, $this->session->userdata('sisule_cms_satuan_kerja'));
                    }
                }
                for ($i = count($count) - 1; $i >= 0; $i--) {
                    $data_penerima_disposisi = array(
                        'kode_struktur_organisasi'           => $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'],
                        'penerima'      => $penerima,
                        'nomor_surat'   => $no_surat
                    );
                    $cek_user = $this->M_Surat->cekUserTerdisposisi($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'])->result();
                    if ($cek_user == null) {
                        $this->M_Surat->createPenerimaDisposisi($data_penerima_disposisi, $no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi']);
                    }
                }
                $this->M_Surat->trackingDisposisi($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi']);
            }
            $this->session->unset_userdata('session_user_penerima_disposisi');
        }
    }
    public function getFileDisposisi($param)
    {
        $data['disposisi']      = $this->M_Surat->getInfoDisposisi($param)->result();
        $surat_datang           = $data['disposisi'][0]->tanggal_agenda;
        $surat_datang           = date("Y-m-d", strtotime($surat_datang));
        $data['surat_datang']   = $this->bulan($surat_datang);
        $tgl_surat              = $data['disposisi'][0]->tanggal;
        $tgl_surat              = date("Y-m-d", strtotime($tgl_surat));
        $data['tanggal']        = $this->bulan($tgl_surat);
        $data['penugas']        = $this->M_Surat->pemberiMandatDisposisi($param)->result();
        $data['penerimatugas']        = $this->M_Surat->penerimaMandatDisposisi($param)->result();
        $data['bidang']         = $this->M_Surat->bidangPenugasDisposisi($param)->result();
        $data['file']           = $this->M_Surat->getFileSuratMasuk($param)->result();
        $data['instansi']       = $this->M_Surat->getInstansiForSuratDisposisi($param)->result();
        if ($data > 0) {
            $mpdf       = new \Mpdf\Mpdf(['format' => 'Legal']);
            $html       = $this->load->view('core/mail/template-disposisi', $data, true);
            $lampiran   = $this->load->view('core/mail/file-surat-masuk', $data, true);
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="10%"></td>
                        <td width="10%" align="center"></td>
                        <td width="80%" style="text-align: right; color: grey; font-size: 12px;">&copy; Pemerintahan Kabupaten Ciamis - ' . date("Y") . '</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);
            $mpdf->SetHTMLHeader('
                <table width="100%">
                    <tr>
                        <td width="10%" style="text-align: left; color: grey; font-size: 12px;">Lampiran</td>
                        <td width="10%" align="center"></td>
                        <td width="80%" style="text-align: right; color: grey; font-size: 12px;"></td>
                    </tr>
                </table>');
            $mpdf->AddPage();
            $mpdf->WriteHTML($lampiran);
            $mpdf->Output('Disposisi - ' . $data['disposisi'][0]->nomor_surat . '.pdf', 'I');
        }
    }
    public function pengagendaanSuratDisposisi($param)
    {
        $this->form_validation->set_rules('nomor_agenda', 'nomor_agenda', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->message('danger', ' kesalahan dalam input data');
            redirect(base_url('home/containSuratDisposisi'));
        } else {
            if ($this->M_Surat->pengagendaanSuratDisposisi($param) > 0) {
                $this->message('success', ' Berhasil Mengagendakan Surat');
                redirect(base_url('home/containSuratDisposisi'));
            } else {
                $this->message('danger', 'Gagal Mengagendakan Surat');
                redirect(base_url('home/containSuratDisposisi'));
            }
        }
    }
    public function getBidang()
    {
        $output = null;
        $catch = $this->M_Surat->getBidang()->result();
        $i = 0;
        if ($catch > 0) {
            foreach ($catch as $key) {
                $output .= '
                <div class="form-check">
                        <input class="form-check-input " type="checkbox" value="' . $key->nip . '" id="' . $key->nama_bidang . '" name="tembusan' . $i . '">
                        <label class="form-check-label text-capitalize" for="' . $key->nama_bidang . '">
                            ' . $key->nama_bidang . '
                        </label>
                    </div>
            ';
                $i++;
            }
        } else {
            echo json_encode("data kosong");
        }
        echo $output;
    }
    // disposisi
    public function getSuratDisposisi()
    {
        $catch['surat'] = $this->M_Surat->getSuratDisposisi($_POST['id'])->result();
        if ($catch > 0) {
            echo json_encode($catch);
        } else {
            echo json_encode("data kosong");
        }
    }
    // nota dinas
    public function createNotaDinas()
    {
        $this->form_validation->set_rules('no_nota', 'no_nota', 'trim|required');
        $this->form_validation->set_rules('laporan', 'laporan', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->message('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            if ($this->input->post('send') == 'Perbaharui') {
                if ($this->M_Surat->updateNotaDinas() > 0) {
                    $this->message('success', 'Laporan Nota Dinas Berhasil Diperbaharui.');
                    redirect(base_url('home/suratnotadinas'));
                } else {
                    $this->message('danger', ' Laporan Nota Dinas Gagal Diperbaharui.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } elseif ($this->input->post('send') == 'Simpan') {
                $this->form_validation->set_rules('no_nota', 'Nomor Nota', 'is_unique[tbl_nota_dinas.nomor_nota_dinas]');
                if ($this->form_validation->run() === FALSE) {
                    $this->message('danger', validation_errors());
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    if ($this->M_Surat->createNotaDinas() > 0) {
                        $dataInfo   = array();
                        $files      = $_FILES;
                        $cpt        = count($_FILES['userfile']['name']);
                        $config     = array();
                        $config['upload_path']      = 'assets/file/nota-dinas';
                        $config['allowed_types']    = 'gif|jpg|png|jpeg|pdf';
                        $config['max_size']         = '2000';
                        $config['overwrite']        = TRUE;
                        for ($i = 0; $i < $cpt; $i++) {
                            $_FILES['userfile']['name']     = date('dmYhi') . str_replace(' ', '-', $this->session->userdata('sisule_cms_nip')) . $files['userfile']['name'][$i];
                            $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                            $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                            $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                            $this->upload->initialize($config);
                            $this->upload->do_upload();
                            $dataInfo[] = $this->upload->data();
                            $data = array(
                                'nomor_nota_dinas'      => $this->input->post('no_nota'),
                                'slug_nota'             => str_replace('/', '-', $this->input->post('no_nota')),
                                'nama_file'             => $dataInfo[$i]['file_name']
                            );
                            $dataInfo[$i]['file_name'];
                            $this->M_Surat->insertFileNotaDinas($data);
                        }
                        $this->message('success', 'Nota Dinas Berhasil Dilaporkan.');
                        redirect(base_url('home/suratnotadinas'));
                    } else {
                        $this->message('danger', ' Nota Dinas Gagal Dilaporkan.');
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                }
            }
        }
    }

    public function bulan($param)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $split = explode('-', $param);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }

    public function hari($param)
    {
        switch ($param) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }

        return $hari_ini;
    }
    public function getTembusanNotaDinas()
    {
        $catch['tembusan'] = $this->M_Surat->getTembusanNotaDinas($_POST['id'])->result();
        if ($catch > 0) {
            echo json_encode($catch);
        } else {
            echo json_encode('data not found');
        }
    }
    // sp
    public function getFileSuratPerintah($param)
    {
        $data['penerima']           = $this->M_Surat->CountPenerimaDisposisi($param)->result();
        $data['sp']                 = $this->M_Surat->getSuratPerintah($param)->result();
        $data['penerima_perintah']  = $this->M_Surat->getPenerimaSuratPerintah($param)->result();
        $data['pembuat_sp']         = $this->M_Surat->getInfoPembuatSuratPerintah($param)->result();
        $data['instansi']           = $this->M_Surat->getInstansiForSuratPerintah($param)->result();

        $date               = $data['sp'][0]->mulai_kegiatan;
        $new_date           = date("Y-m-d", strtotime($date));
        $hari               = date("D", strtotime($date));
        $agenda             = $data['sp'][0]->tanggal_agenda;
        $tanggal_agenda     = date("Y-m-d", strtotime($agenda));
        $tanggal_1          = $this->bulan($new_date);
        $hari_1             = $this->hari($hari);
        $tanggal_2          = $this->bulan($tanggal_agenda);

        $data['date']   = $this->hari($hari) . $this->bulan($new_date);
        $data['date']   = $hari_1 . ", " . $tanggal_1;
        $data['agenda'] = $tanggal_2;

        $mpdf           = new \Mpdf\Mpdf(['format' => 'Legal']);
        $sp1            = $this->load->view('core/mail/template-surat-perintah-1', $data, true);
        $sp2            = $this->load->view('core/mail/template-surat-perintah-2', $data, true);
        $lampiran_sp    = $this->load->view('core/mail/template-surat-perintah-lampiran', $data, true);
        $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="10%"></td>
                        <td width="10%" align="center"></td>
                        <td width="80%" style="text-align: right; color: grey; font-size: 12px;">&copy; Pemerintahan Kabupaten Ciamis - ' . date("Y") . '</td>
                    </tr>
                </table>');
        if (count($data['penerima']) <= 2) {
            $mpdf->WriteHTML($sp1);
        } else {
            $mpdf->WriteHTML($sp2);
            $mpdf->AddPage();
            $mpdf->WriteHTML($lampiran_sp);
        }
        $cek = $this->M_Surat->checkSPD($param)->result();
        if (count($cek) > 0) {
            $data['pembuat_spd']    = $this->M_Surat->getInfoPerjalananDinasForPembuat($param)->result();
            $data['penerima_spd']   = $this->M_Surat->getInfoPerjalananDinasForPenerima($param)->result();
            $keberangkatan          = $data['penerima_spd'][0]->keberangkatan;
            $keberangkatan          = date("Y-m-d", strtotime($keberangkatan));
            $kepulangan             = $data['penerima_spd'][0]->kepulangan;
            $kepulangan             = date("Y-m-d", strtotime($kepulangan));
            $data['keberangkatan']  = $this->bulan($keberangkatan);
            $data['kepulangan']     = $this->bulan($kepulangan);
            $berangkat              = new DateTime($data['penerima_spd'][0]->keberangkatan);
            $pulang                 = new DateTime($data['penerima_spd'][0]->kepulangan);
            $data['berangkat']      = $berangkat;
            $data['pulang']         = $pulang;
            $spd                    = $this->load->view('core/mail/template-spd', $data, true);
            $spd_lampiran           = $this->load->view('core/mail/template-spd-lampiran', $data, true);

            $mpdf->AddPage();
            $mpdf->WriteHTML($spd);
            $mpdf->AddPage();
            $mpdf->WriteHTML($spd_lampiran);
        }
        $mpdf->Output('Surat Perintah.pdf', 'I');
    }

    public function tanpaSuratPerintah($param)
    {
        if ($this->M_Surat->pengagendaanSuratDisposisi($param) > 0) {
            $this->message('success', 'Berhasil Mengagendakan Surat');
            redirect(base_url('home'));
        } else {
            $this->message('danger', 'Gagal Mengagendakan Surat');
            redirect(base_url('home'));
        }
    }
    public function getFileNotaDinas($param)
    {
        $data['nota']       = $this->M_Surat->getNotaDinas($param)->result();
        $data['penerima']   = $this->M_Surat->getPenerimaNotaDinas($param)->result();
        $data['tembusan']   = $this->M_Surat->getPenerimaTembusan($param)->result();
        $data['penulis']    = $this->M_Surat->getPenulisNotaDinas($param)->result();
        $data['file']       = $this->M_Surat->getFileNotaDinas($param)->result();
        $data['instansi']   = $this->M_Surat->getInstansiForNotaDinas($param)->result();
        $tanggal                    = $data['nota'][0]->tanggal_nota;
        $tanggal                    = date("Y-m-d", strtotime($data['nota'][0]->tanggal_nota));
        $data['tanggal_nota']       = $this->bulan($tanggal);
        if ($data > 0) {
            $mpdf           = new \Mpdf\Mpdf(['format' => 'Legal']);
            $html = $this->load->view('core/mail/template-nota-dinas', $data, true);
            $lampiran = $this->load->view('core/mail/file-nota-dinas', $data, true);
            $mpdf->SetHTMLFooter('
                <table width="100%">
                    <tr>
                        <td width="10%"></td>
                        <td width="10%" align="center"></td>
                        <td width="80%" style="text-align: right; color: grey; font-size: 12px;">&copy; Pemerintahan Kabupaten Ciamis - ' . date("Y") . '</td>
                    </tr>
                </table>');
            $mpdf->WriteHTML($html);
            $mpdf->AddPage();
            $mpdf->WriteHTML($lampiran);
            $mpdf->Output('Nota Dinas - ' . $data['nota'][0]->nomor_nota_dinas . '.pdf', 'I');
        }
    }

    public function createSuratPerintah()
    {
        $this->form_validation->set_rules('no_perintah', 'no_perintah', 'trim|required|is_unique[tbl_surat_perintah.no_perintah]');
        $slug = $this->input->post('slug');
        if ($this->form_validation->run() === FALSE) {
            $this->message('danger', validation_errors());
            redirect(base_url('home/formSuratPerintah/' . $slug));
        } else {
            $no_perjalanan = $this->input->post('no_perjalanan');
            if ($no_perjalanan == null) {
                if ($this->M_Surat->createSuratPerintah($slug) > 0) {
                    $this->message('success', 'Surat Perintah Berhasil Dibuat.');
                    redirect(base_url('home/Pengagendaan/' . $slug));
                } else {
                    $this->message('danger', 'Surat Perintah Gagal Dibuat.');
                    redirect(base_url('home/Pengagendaan/' . $slug));
                }
            } else {
                $this->form_validation->set_rules('no_perjalanan', 'no_perjalanan', 'trim|required');
                $this->form_validation->set_rules('keberangkatan', 'keberangkatan', 'trim|required');
                $this->form_validation->set_rules('kepulangan', 'kepulangan', 'trim|required');
                $this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
                if ($this->form_validation->run() === FALSE) {
                    $this->message('danger', validation_errors());
                    redirect(base_url('home/formSuratPerintah/' . $slug));
                } else {
                    if ($this->M_Surat->createSuratPerintahPerjalananDinas($slug) > 0) {
                        $this->message('success', 'Surat Perintah dan Surat Perjalanan Dinas Berhasil Dibuat.');
                        redirect(base_url('home/Pengagendaan'));
                    } else {
                        $this->message('danger', 'Surat Perintah dan Perjalanan Dinas Gagal Dibuat.');
                        redirect(base_url('home/Pengagendaan'));
                    }
                }
            }
        }
    }
    public function pengagendaansurat($param)
    {
        redirect(base_url('home/formSuratPerintah/' . $param));
    }
    public function trackingSuratMasuk()
    {
        $output = null;
        $data   = $this->M_Surat->trackingSuratMasuk($_POST['id']);
        $loop = $data->num_rows();
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $loop       = $data->num_rows();
            $output .= '
            <table class="table table-borderless table-sm">
                <tbody style="padding: 20px;">
            ';
            $j = 1;
            for ($i = $loop - 1; $i >= 0; $i--) {
                $output .= '
                    <tr class="text-capitalize">
                        <td ><span class="text-danger">' . $d_result[$i]["waktu"] . '</span></td>
                        <td class="text-dark" style="font-size: 14px;">
                            ' . '<span class="text-uppercase">' . $d_result[$i]["kegiatan"] . '</span><span class="font-weight-bold text-primary">
                            ' . $d_result[$i]["nama"] . '</span>
                        </td>
                    </tr>
                    ';
                $j++;
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
    public function createSuratKeluar()
    {
        $dataInfo   = array();
        $files      = $_FILES;
        $cpt        = count($_FILES['userfile']['name']);
        $config     = array();
        $config['upload_path']      = 'assets/file/surat-masuk';
        $config['allowed_types']    = 'jpg|png|jpeg|jpg';
        $config['max_size']         = 2000;
        $config['overwrite']        = FALSE;
        $this->upload->initialize($config);
        for ($i = 0; $i < $cpt; $i++) {
            $_FILES['userfile']['name']     = date('m-d-Y-H-i') . str_replace(' ', '-', $this->session->userdata('sisule_cms_nip')) . $files['userfile']['name'][$i];
            $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
            $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
            $this->upload->do_upload();
            $dataInfo[] = $this->upload->data();
            $data = array(
                'nomor_surat'   => $this->input->post('nomor_surat_keluar'),
                'slug_surat'    => $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat_keluar')),
                'nama_file'     => $dataInfo[$i]['file_name']
            );
            $this->M_Surat->insertFileSuratMasuk($data);
        }
        $this->form_validation->set_rules("nomor_surat_keluar",     "Nomor Surat Keluar",  "trim|required|min_length[5]");
        $this->form_validation->set_rules("perihal",                "perihal",      "trim|required|min_length[5]|max_length[1000]");
        $this->form_validation->set_rules("start",                  "start",        "trim|required|min_length[10]");
        $this->form_validation->set_rules("end",                    "end",          "trim|required|min_length[10]");
        $this->form_validation->set_rules("waktu_kegiatan",         "waktu_kegiatan",       "trim|required|min_length[5]");
        $this->form_validation->set_rules("tempat_pelaksanaan",     "tempat_pelaksanaan",   "trim|required");
        if ($this->form_validation->run() === FALSE) {
            $this->message('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $penerima = rand();
            if ($this->M_Surat->saveSuratKeluar($penerima)) {
                $count      = $this->session->userdata('session_user_penerima_disposisi');
                $no_surat   = $this->input->post('nomor_surat_keluar');
                for ($i = count($count) - 1; $i >= 0; $i--) {
                    // data surat keluar
                    $data_penerima_disposisi = array(
                        'kode_struktur_organisasi'           => $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'],
                        'penerima'      => $penerima,
                        'nomor_surat_keluar'   => $no_surat
                    );
                    // data surat masuk
                    $data_penerima_surat_masuk = array(
                        'kode_struktur_organisasi'           => $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'],
                        'penerima'      => $penerima,
                        'nomor_surat'   => $no_surat,
                        'agendaris_instansi' => $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi']
                    );
                    // cek user penerima surat keluar
                    $cek_user_sk = $this->M_Surat->cekUserPenerimaSuratKeluar($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'])->result();
                    // cek user penerima surat masuk
                    $cek_user_sm = $this->M_Surat->cekUserPenerimaSuratMasuk($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'])->result();
                    if ($cek_user_sk == null && $cek_user_sm == null) {
                        $this->M_Surat->createPenerimaSuratKeluar($data_penerima_disposisi);
                        $this->M_Surat->createPenerimaSuratMasuk($data_penerima_surat_masuk);
                    }
                }
                $this->session->unset_userdata('session_user_penerima_disposisi');
                $this->message('success', 'Surat keluar berhasil dibuat');
                redirect(base_url('home/suratkeluar'));
            } else {
                $this->message('danger', 'Surat keluar gagal dibuat');
                redirect(base_url('home/suratkeluar'));
            }
        }
    }
    public function hapussuratkeluar($param)
    {
        $data['file']   = $this->M_Surat->getFileName($param)->result();
        if ($data['file'] != null) {
            if ($this->M_Surat->hapussuratkeluar($param) > 0) {
                $this->message('success', 'Surat Keluar Berhasil Dihapus.');
                redirect(base_url('home/suratkeluar'));
            } else {
                $this->message('danger', 'Surat Keluar Gagal Dihapus.');
                redirect(base_url('home/suratkeluar'));
            }
        } else {
            $this->message('danger', 'Surat Masuk Tidak Ditemukan');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function updateSuratKeluar()
    {
        $this->form_validation->set_rules("nomor_surat_keluar",     "Nomor Surat Keluar",  "trim|required|min_length[5]");
        $this->form_validation->set_rules("perihal",                "perihal",      "trim|required|min_length[5]|max_length[250]");
        // $this->form_validation->set_rules("isi",                    "isi",          "trim|required|min_length[5]|max_length[10000]");
        $this->form_validation->set_rules("start",                  "start",        "trim|required|min_length[10]");
        $this->form_validation->set_rules("end",                    "end",          "trim|required|min_length[10]");
        $this->form_validation->set_rules("waktu_kegiatan",         "waktu_kegiatan",       "trim|required|min_length[5]");
        $this->form_validation->set_rules("tempat_pelaksanaan",     "tempat_pelaksanaan",   "trim|required");
        if ($this->form_validation->run() === FALSE) {
            $this->message('danger', validation_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $old_nomor_surat_keluar = $this->input->post('old_nomor_surat_keluar');
            $new_nomor_surat_keluar = $this->input->post('nomor_surat_keluar');
            if ($new_nomor_surat_keluar != $old_nomor_surat_keluar) {
                $data_update = array(
                    'nomor_surat'   => $this->input->post('nomor_surat_keluar'),
                    'slug_surat'    => $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat_keluar')),
                );
                $this->M_Surat->updateFileSuratKeluar($old_nomor_surat_keluar, $data_update)->result();

                $dataInfo   = array();
                $files      = $_FILES;
                $cpt        = count($_FILES['userfile']['name']);
                $config     = array();
                $config['upload_path']      = 'assets/file/surat-masuk';
                $config['allowed_types']    = 'jpg|png|jpeg|jpg';
                $config['max_size']         = 2000;
                $config['overwrite']        = FALSE;
                $this->upload->initialize($config);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = date('m-d-Y-H-i') . str_replace(' ', '-', $this->session->userdata('sisule_cms_nip')) . $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                    $this->upload->do_upload();
                    $dataInfo[] = $this->upload->data();
                    $data = array(
                        'nomor_surat'   => $this->input->post('nomor_surat_keluar'),
                        'slug_surat'    => $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat')),
                        'nama_file'     => $dataInfo[$i]['file_name']
                    );
                    $this->M_Surat->insertFileSuratMasuk($data);
                }
                $penerima = $this->M_Surat->getPenerimaSuratKeluar($old_nomor_surat_keluar)->result();
                if ($penerima != null) {
                    $penerima_update = $penerima[0]->penerima;
                }
                if ($this->M_Surat->updateSuratKeluar($this->input->post('id_surat_keluar'), $penerima_update)) {
                    $count      = $this->session->userdata('session_user_penerima_disposisi');
                    $no_surat   = $this->input->post('nomor_surat_keluar');

                    for ($i = count($count) - 1; $i >= 0; $i--) {
                        $data_penerima_disposisi = array(
                            'kode_struktur_organisasi'           => $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'],
                            'penerima'      => $penerima_update,
                            'nomor_surat_keluar'   => $no_surat
                        );
                        $cek_user = $this->M_Surat->cekUserPenerimaSuratKeluar($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'])->result();
                        if ($cek_user == null) {
                            $this->M_Surat->createPenerimaSuratKeluar($data_penerima_disposisi);
                        }
                    }
                    $this->session->unset_userdata('session_user_penerima_disposisi');
                    $this->message('success', 'Surat keluar berhasil dibuat');
                    $sl = null;
                    $slug = $this->M_Surat->getSlug($no_surat)->result();
                    if ($slug != null) {
                        $sl = $slug[0]->slug_surat;
                    }
                    redirect(base_url('home/prosessuratkeluar/' . $sl));
                } else {
                    $this->message('danger', 'Surat keluar gagal dibuat');
                    $sl = null;
                    $slug = $this->M_Surat->getSlug($no_surat)->result();
                    if ($slug != null) {
                        $sl = $slug[0]->slug_surat;
                    }
                    redirect(base_url('home/prosessuratkeluar/' . $sl));
                }
            } else {
                $dataInfo   = array();
                $files      = $_FILES;
                $cpt        = count($_FILES['userfile']['name']);
                $config     = array();
                $config['upload_path']      = 'assets/file/surat-masuk';
                $config['allowed_types']    = 'jpg|png|jpeg|jpg';
                $config['max_size']         = 2000;
                $config['overwrite']        = FALSE;
                $this->upload->initialize($config);
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name']     = date('m-d-Y-H-i') . str_replace(' ', '-', $this->session->userdata('sisule_cms_nip')) . $files['userfile']['name'][$i];
                    $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size']     = $files['userfile']['size'][$i];
                    $dataInfo[] = $this->upload->data();
                    $data = array(
                        'nomor_surat'   => $this->input->post('nomor_surat_keluar'),
                        'slug_surat'    => $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat')),
                        'nama_file'     => $dataInfo[$i]['file_name']
                    );
                    $this->M_Surat->insertFileSuratMasuk($data);
                }
                $penerima_update = null;
                $penerima = $this->M_Surat->getPenerimaSuratKeluar($old_nomor_surat_keluar)->result();
                if ($penerima != null) {
                    $penerima_update = $penerima[0]->penerima;
                }

                if ($this->M_Surat->updateSuratKeluar($this->input->post('id_surat_keluar'), $penerima_update)) {
                    $count      = $this->session->userdata('session_user_penerima_disposisi');
                    $no_surat   = $this->input->post('nomor_surat_keluar');

                    for ($i = count($count) - 1; $i >= 0; $i--) {
                        $data_penerima_disposisi = array(
                            'kode_struktur_organisasi'           => $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'],
                            'penerima'      => $penerima_update,
                            'nomor_surat_keluar'   => $no_surat
                        );
                        $cek_user = $this->M_Surat->cekUserPenerimaSuratKeluar($no_surat, $this->session->userdata['session_user_penerima_disposisi'][$i]['kode_struktur_organisasi'])->result();
                        if ($cek_user == null) {
                            $this->M_Surat->createPenerimaSuratKeluar($data_penerima_disposisi);
                        }
                    }
                    $this->session->unset_userdata('session_user_penerima_disposisi');
                    $this->message('success', 'Surat keluar berhasil diperbaharui');
                    $sl = null;
                    $slug = $this->M_Surat->getSlug($no_surat)->result();
                    if ($slug != null) {
                        $sl = $slug[0]->slug_surat;
                    }
                    redirect(base_url('home/prosessuratkeluar/' . $sl));
                } else {
                    $this->message('danger', 'Surat keluar gagal diperbaharui');
                    // get slug surat keluar
                    $sl = null;
                    $slug = $this->M_Surat->getSlug($no_surat)->result();
                    if ($slug != null) {
                        $sl = $slug[0]->slug_surat;
                    }
                    redirect(base_url('home/prosessuratkeluar/' . $sl));
                }
            }
        }
    }
    public function cariPenerimaDisposisi()
    {
        $data       = $this->M_Surat->cariPenerimaDisposisi($_POST['id']);
        $output     = null;
        if ($data->num_rows() > 0) {
            $result     = $data->result();
            $result     = json_encode($result);
            $d_result   = json_decode($result, true);
            $looping    = $data->num_rows();
            $output     .= '<div class="table-responsive table-sm">
                        <table class="table table bordered">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Pejabat</th>
                                <th class="text-center">Aksi</th>
                            </tr>';
            for ($i = 0; $i < $looping; $i++) {
                $output .= '<tr>
                            <td><img src="' . base_url("assets/image/pns/" . $d_result[$i]["image"]) . '" style="width:35px; border-radius: 100%;" alt=""></td>
                            <td> ' . $d_result[$i]["nama"] . ' - <span class="text-capitalize">' . $d_result[$i]["nama_bidang"] . '</span></td>
                            <td class="text-center"><button type="button" class="btn btn-light btn-sm saveOnDisposisi" data-id="' . $d_result[$i]['kode_struktur_organisasi'] . '"><i class="fa fa-plus" style="margin-left: 5px;"></i></a></button></td>
                        </tr>
                    ';
            }
        } else {
            $output = "<p class='text-center'>Data Not Found</p>";
        }
        echo $output;
    }
    public function redisposisi()
    {
        if ($this->input->post('penerima_redisposisi') != '0') {
            if ($this->M_Surat->redisposisi() > 0) {
                $this->message('success', 'Sukses Meredisposisi Surat');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->message('danger', 'Gagal Meredisposisi Surat');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->message('danger', 'Haraf memilih orang yang akan diredisposisi');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function izinkansuratkeluar($param)
    {
        $cek_user['agendaris']  = $this->M_Surat->checkStatusUser($this->session->userdata('sisule_cms_satuan_kerja'))->result();
        $cek_user['atasan']     = $this->M_Surat->checkStatusSebagaiAtasan($param)->result();
        if ($cek_user > 0) {
            if ($cek_user['agendaris'][0]->agendaris == 1) {
                $data = array(
                    'izin_agendaris' => $this->session->userdata('sisule_cms_satuan_kerja')
                );
                if ($this->M_Surat->izinkanSuratKeluar($param, $data) > 0) {
                    $this->message('success', 'Izin Surat Keluar telah diberikan.');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->message('success', 'Izin Surat Keluar gagal diberikan.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } elseif ($cek_user['atasan'][0]->atasan == $this->session->userdata('sisule_cms_satuan_kerja')) {
                $data = array(
                    'izin_atasan' => $this->session->userdata('sisule_cms_satuan_kerja')
                );
                if ($this->M_Surat->izinkanSuratKeluar($param, $data) > 0) {
                    $this->message('success', 'Izin Surat Keluar telah diberikan.');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->message('success', 'Izin Surat Keluar gagal diberikan.');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }
    }
    public function kirimsuratkeluar($param)
    {
        $data['surat_keluar']       = $this->M_Surat->getSuratKeluar($param)->result();
        if ($data['surat_keluar'][0]->izin_agendaris != null && $data['surat_keluar'][0]->izin_atasan != null) {
            if ($data['surat_keluar'][0]->pembuat == $this->session->userdata('sisule_cms_satuan_kerja')) {
                if ($this->M_Surat->CreateSuratMasuk($param) > 0) {
                    $this->message('success', 'Berhasil Mendistribusikan Surat Keluar');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    $this->message('danger', 'Gagal Mendistribusikan Surat Keluar');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->message('danger', 'Anda bukan pembuat surat');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->message('danger', 'Anda tidak memiliki izin mendistribusikan surat ke pihak terkait');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function getStatistikSuratMasuk()
    {
        $data['agendaris'] = $this->session->userdata('sisule_cms_agendaris');
        if ($data['agendaris'] != null) {
            $count_disposisi_01    = $this->M_Surat->countAllDisposisi('01')->result();
            $count_disposisi_02    = $this->M_Surat->countAllDisposisi('02')->result();
            $count_disposisi_03    = $this->M_Surat->countAllDisposisi('03')->result();
            $count_disposisi_04    = $this->M_Surat->countAllDisposisi('04')->result();
            $count_disposisi_05    = $this->M_Surat->countAllDisposisi('05')->result();
            $count_disposisi_06    = $this->M_Surat->countAllDisposisi('06')->result();
            $count_disposisi_07    = $this->M_Surat->countAllDisposisi('07')->result();
            $count_disposisi_08    = $this->M_Surat->countAllDisposisi('08')->result();
            $count_disposisi_09    = $this->M_Surat->countAllDisposisi('09')->result();
            $count_disposisi_10    = $this->M_Surat->countAllDisposisi('10')->result();
            $count_disposisi_11    = $this->M_Surat->countAllDisposisi('11')->result();
            $count_disposisi_12    = $this->M_Surat->countAllDisposisi('12')->result();

            $countSuratPerintah_01 = $this->M_Surat->countAllSuratPerintah('01')->result();
            $countSuratPerintah_02 = $this->M_Surat->countAllSuratPerintah('02')->result();
            $countSuratPerintah_03 = $this->M_Surat->countAllSuratPerintah('03')->result();
            $countSuratPerintah_04 = $this->M_Surat->countAllSuratPerintah('04')->result();
            $countSuratPerintah_05 = $this->M_Surat->countAllSuratPerintah('05')->result();
            $countSuratPerintah_06 = $this->M_Surat->countAllSuratPerintah('06')->result();
            $countSuratPerintah_07 = $this->M_Surat->countAllSuratPerintah('07')->result();
            $countSuratPerintah_08 = $this->M_Surat->countAllSuratPerintah('08')->result();
            $countSuratPerintah_09 = $this->M_Surat->countAllSuratPerintah('09')->result();
            $countSuratPerintah_10 = $this->M_Surat->countAllSuratPerintah('10')->result();
            $countSuratPerintah_11 = $this->M_Surat->countAllSuratPerintah('11')->result();
            $countSuratPerintah_12 = $this->M_Surat->countAllSuratPerintah('12')->result();
        } else {
            $countSuratPerintah_01 = $this->M_Surat->countSuratPerintah('01')->result();
            $countSuratPerintah_02 = $this->M_Surat->countSuratPerintah('02')->result();
            $countSuratPerintah_03 = $this->M_Surat->countSuratPerintah('03')->result();
            $countSuratPerintah_04 = $this->M_Surat->countSuratPerintah('04')->result();
            $countSuratPerintah_05 = $this->M_Surat->countSuratPerintah('05')->result();
            $countSuratPerintah_06 = $this->M_Surat->countSuratPerintah('06')->result();
            $countSuratPerintah_07 = $this->M_Surat->countSuratPerintah('07')->result();
            $countSuratPerintah_08 = $this->M_Surat->countSuratPerintah('08')->result();
            $countSuratPerintah_09 = $this->M_Surat->countSuratPerintah('09')->result();
            $countSuratPerintah_10 = $this->M_Surat->countSuratPerintah('10')->result();
            $countSuratPerintah_11 = $this->M_Surat->countSuratPerintah('11')->result();
            $countSuratPerintah_12 = $this->M_Surat->countSuratPerintah('12')->result();

            $count_disposisi_01    = $this->M_Surat->countDisposisi('01')->result();
            $count_disposisi_02    = $this->M_Surat->countDisposisi('02')->result();
            $count_disposisi_03    = $this->M_Surat->countDisposisi('03')->result();
            $count_disposisi_04    = $this->M_Surat->countDisposisi('04')->result();
            $count_disposisi_05    = $this->M_Surat->countDisposisi('05')->result();
            $count_disposisi_06    = $this->M_Surat->countDisposisi('06')->result();
            $count_disposisi_07    = $this->M_Surat->countDisposisi('07')->result();
            $count_disposisi_08    = $this->M_Surat->countDisposisi('08')->result();
            $count_disposisi_09    = $this->M_Surat->countDisposisi('09')->result();
            $count_disposisi_10    = $this->M_Surat->countDisposisi('10')->result();
            $count_disposisi_11    = $this->M_Surat->countDisposisi('11')->result();
            $count_disposisi_12    = $this->M_Surat->countDisposisi('12')->result();
        }
        $countSuratMasuk_01    = $this->M_Surat->countSuratMasuk('01')->result();
        $countSuratMasuk_02    = $this->M_Surat->countSuratMasuk('02')->result();
        $countSuratMasuk_03    = $this->M_Surat->countSuratMasuk('03')->result();
        $countSuratMasuk_04    = $this->M_Surat->countSuratMasuk('04')->result();
        $countSuratMasuk_05    = $this->M_Surat->countSuratMasuk('05')->result();
        $countSuratMasuk_06    = $this->M_Surat->countSuratMasuk('06')->result();
        $countSuratMasuk_07    = $this->M_Surat->countSuratMasuk('07')->result();
        $countSuratMasuk_08    = $this->M_Surat->countSuratMasuk('08')->result();
        $countSuratMasuk_09    = $this->M_Surat->countSuratMasuk('09')->result();
        $countSuratMasuk_10    = $this->M_Surat->countSuratMasuk('10')->result();
        $countSuratMasuk_11    = $this->M_Surat->countSuratMasuk('11')->result();
        $countSuratMasuk_12    = $this->M_Surat->countSuratMasuk('12')->result();

        $countNotaDinas_01     = $this->M_Surat->countNotaDinas('01')->result();
        $countNotaDinas_02     = $this->M_Surat->countNotaDinas('02')->result();
        $countNotaDinas_03     = $this->M_Surat->countNotaDinas('03')->result();
        $countNotaDinas_04     = $this->M_Surat->countNotaDinas('04')->result();
        $countNotaDinas_05     = $this->M_Surat->countNotaDinas('05')->result();
        $countNotaDinas_06     = $this->M_Surat->countNotaDinas('06')->result();
        $countNotaDinas_07     = $this->M_Surat->countNotaDinas('07')->result();
        $countNotaDinas_08     = $this->M_Surat->countNotaDinas('08')->result();
        $countNotaDinas_09     = $this->M_Surat->countNotaDinas('09')->result();
        $countNotaDinas_10     = $this->M_Surat->countNotaDinas('10')->result();
        $countNotaDinas_11     = $this->M_Surat->countNotaDinas('11')->result();
        $countNotaDinas_12     = $this->M_Surat->countNotaDinas('12')->result();

        $countSampah_01        = $this->M_Surat->countSampah('01')->result();
        $countSampah_02        = $this->M_Surat->countSampah('02')->result();
        $countSampah_03        = $this->M_Surat->countSampah('03')->result();
        $countSampah_04        = $this->M_Surat->countSampah('04')->result();
        $countSampah_05        = $this->M_Surat->countSampah('05')->result();
        $countSampah_06        = $this->M_Surat->countSampah('06')->result();
        $countSampah_07        = $this->M_Surat->countSampah('07')->result();
        $countSampah_08        = $this->M_Surat->countSampah('08')->result();
        $countSampah_09        = $this->M_Surat->countSampah('09')->result();
        $countSampah_10        = $this->M_Surat->countSampah('10')->result();
        $countSampah_11        = $this->M_Surat->countSampah('11')->result();
        $countSampah_12        = $this->M_Surat->countSampah('12')->result();

        $data['januari'] =  count($count_disposisi_01) + count($countSuratPerintah_01)+ count($countSuratMasuk_01) + count($countNotaDinas_01) + count($countSampah_01);
        $data['februari'] =  count($count_disposisi_02) + count($countSuratPerintah_02)+ count($countSuratMasuk_02) + count($countNotaDinas_02) + count($countSampah_02);
        $data['maret'] =  count($count_disposisi_03) + count($countSuratPerintah_03)+ count($countSuratMasuk_03) + count($countNotaDinas_03) + count($countSampah_03);
        $data['april'] =  count($count_disposisi_04) + count($countSuratPerintah_04)+ count($countSuratMasuk_04) + count($countNotaDinas_04) + count($countSampah_04);
        $data['mei'] =  count($count_disposisi_05) + count($countSuratPerintah_05)+ count($countSuratMasuk_05) + count($countNotaDinas_05) + count($countSampah_05);
        $data['juni'] =  count($count_disposisi_06) + count($countSuratPerintah_06)+ count($countSuratMasuk_06) + count($countNotaDinas_06) + count($countSampah_06);
        $data['juli'] =  count($count_disposisi_07) + count($countSuratPerintah_07)+ count($countSuratMasuk_07) + count($countNotaDinas_07) + count($countSampah_07);
        $data['agustus'] =  count($count_disposisi_08) + count($countSuratPerintah_08)+ count($countSuratMasuk_08) + count($countNotaDinas_08) + count($countSampah_08);
        $data['september'] =  count($count_disposisi_09) + count($countSuratPerintah_09)+ count($countSuratMasuk_09) + count($countNotaDinas_09) + count($countSampah_09);
        $data['oktober'] =  count($count_disposisi_10) + count($countSuratPerintah_10)+ count($countSuratMasuk_10) + count($countNotaDinas_10) + count($countSampah_10);
        $data['november'] =  count($count_disposisi_11) + count($countSuratPerintah_11)+ count($countSuratMasuk_11) + count($countNotaDinas_11) + count($countSampah_11);
        $data['desember'] =  count($count_disposisi_12) + count($countSuratPerintah_12)+ count($countSuratMasuk_12) + count($countNotaDinas_12) + count($countSampah_12);
        if ($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode('data not found');
        }
    }
    public function getStatistikSuratKeluar()
    {
        $sk_januari    = $this->M_Surat->getStatistikSuratKeluar('01')->result();
        $sk_februari   = $this->M_Surat->getStatistikSuratKeluar('02')->result();
        $sk_maret      = $this->M_Surat->getStatistikSuratKeluar('03')->result();
        $sk_april      = $this->M_Surat->getStatistikSuratKeluar('04')->result();
        $sk_mei        = $this->M_Surat->getStatistikSuratKeluar('05')->result();
        $sk_juni       = $this->M_Surat->getStatistikSuratKeluar('06')->result();
        $sk_juli       = $this->M_Surat->getStatistikSuratKeluar('07')->result();
        $sk_agustus    = $this->M_Surat->getStatistikSuratKeluar('08')->result();
        $sk_september  = $this->M_Surat->getStatistikSuratKeluar('09')->result();
        $sk_oktober    = $this->M_Surat->getStatistikSuratKeluar('10')->result();
        $sk_november   = $this->M_Surat->getStatistikSuratKeluar('11')->result();
        $sk_desember   = $this->M_Surat->getStatistikSuratKeluar('12')->result();

        $data['januari'] = count($sk_januari);
        $data['februari'] = count($sk_februari);
        $data['maret'] = count($sk_maret);
        $data['april'] = count($sk_april);
        $data['mei'] = count($sk_mei);
        $data['juni'] = count($sk_juni);
        $data['juli'] = count($sk_juli);
        $data['agustus'] = count($sk_agustus);
        $data['september'] = count($sk_september);
        $data['oktober'] = count($sk_oktober);
        $data['november'] = count($sk_november);
        $data['desember'] = count($sk_desember);

        if ($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode('data not found');
        }
    }
    public function kalenderKegiatan()
    {
        $data['kegiatan'] = $this->M_Surat->getKalenderKegiatan($_POST['kalender'])->result();
        if ($data != null) {
            echo json_encode($data);
        } else {
            echo json_encode('data not found');
        }
    }
    public function forwardSuratMasuk(){
        $nomor_surat = $this->security->xss_clean($_POST['no']);
        $penerima_surat = $this->security->xss_clean($_POST['penerima']);
        $data = array(
            'kode_struktur_organisasi' => $penerima_surat,
            'agendaris_instansi' => $this->session->userdata('sisule_cms_satuan_kerja')
        );
        $this->M_Surat->forwardSuratMasuk($nomor_surat, $data);
    }
    public function getInfoSuratKeluar(){
        $nomor_surat_keluar     = $this->security->xss_clean($_POST['nomor_surat']);
        $data['surat_keluar']   = $this->M_Surat->getInfoSuratKeluar($nomor_surat_keluar)->result();
        $data['penerima_surat'] = $this->M_Surat->getInfoPenerimaSuratKeluar($nomor_surat_keluar)->result();
        if($data != null){
            echo json_encode($data);
        }else{
            echo json_encode('data not found');
        }
    }
}