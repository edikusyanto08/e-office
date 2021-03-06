<?php

class M_Surat extends CI_Model
{
    public function insertFileSuratMasuk($param)
    {
        return $this->db->insert('tbl_file_surat', $param);
    }
    public function insertFileNotaDinas($param)
    {
        return $this->db->insert('tbl_file_nota_dinas', $param);
    }
    public function saveSuratMasuk($param)
    {
        $kode_struktur_organisasi = $this->session->userdata('sisule_cms_satuan_kerja');
        date_default_timezone_set("Asia/Jakarta");
        $penerima       = rand();
        $pembuat        = $this->session->userdata('sisule_cms_satuan_kerja');
        $asal_surat     = $this->input->post('asal_surat');
        $no_surat       = $this->input->post('nomor_surat');
        $waktu          = date("h:i:s a");
        $tanggal        = $this->input->post('waktu');
        $tujuan         = $this->input->post('tujuan');
        $perihal        = $this->input->post('perihal');
        $start          = $this->input->post('start');
        $end            = $this->input->post('end');
        $waktu_kegiatan = $this->input->post('waktu_kegiatan');
        $tempat         = $this->input->post('tempat_pelaksanaan');
        $slug           = $param;

        $data = array(
            'asal_surat'        => $asal_surat,
            'pembuat'           => $pembuat,
            'nomor_surat'       => $no_surat,
            'waktu'             => $waktu,
            'tanggal'           => $tanggal,
            'penerima'          => $penerima,
            'perihal'           => $perihal,
            'mulai_kegiatan'    => $start,
            'akhir_kegiatan'    => $end,
            'waktu_kegiatan'    => $waktu_kegiatan,
            'tempat'            => $tempat,
            'slug_surat'        => $slug,
            'agendaris_surat'   => $pembuat,
            'surat_instansi'    => $this->session->userdata('sisule_cms_instansi'),
            'date_produce'      => date('mm'),
            'year_produce'      => date('YY'),
            'title'             => $asal_surat,
            'start'             => date('Y-m-d', strtotime($start)),
            'end'               => date('Y-m-d', strtotime($end))
        );
        $data2 = array(
            'kode_struktur_organisasi' => $tujuan,
            'penerima' => $penerima,
            'nomor_surat' => $no_surat,
            'agendaris_instansi' => $pembuat
        );
        $kegiatan1  = 'surat masuk dibuat oleh ';
        $kegiatan2  = 'surat masuk dikirimkan ke ';
        $tracking   = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => $kegiatan1,
            'kode_struktur_organisasi' => $pembuat,
            'nomor_surat'   => $no_surat,
            'slug_tracking' => $slug
        );
        $tracking2 = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => $kegiatan2,
            'kode_struktur_organisasi' => $tujuan,
            'nomor_surat'   => $no_surat,
            'slug_tracking' => $slug
        );
        $cek_nomor_surat = $this->db->get_where('tbl_surat_masuk', array('surat_instansi' => $this->session->userdata('sisule_cms_instansi') . $no_surat))->result();
        if ($cek_nomor_surat != null) {
            return 0;
        } else {
            $this->db->insert('tbl_tracking', $tracking);
            $this->db->insert('tbl_tracking', $tracking2);
            $this->db->insert('tbl_daftar_penerima_surat_masuk', $data2);
            return $this->db->insert('tbl_surat_masuk', $data);
        }
    }
    public function updateSuratMasuk()
    {
        date_default_timezone_set("Asia/Jakarta");
        $no_surat_awal  = $this->input->post('nomor_surat_awal');
        $asal_surat     = $this->input->post('asal_surat');
        $no_surat       = $this->input->post('nomor_surat');
        $tanggal        = $this->input->post('waktu');
        $perihal        = $this->input->post('perihal');
        $start          = $this->input->post('start');
        $end            = $this->input->post('end');
        $waktu_kegiatan = $this->input->post('waktu_kegiatan');
        $tempat         = $this->input->post('tempat_pelaksanaan');
        $slug           =  $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat'));
        $update_surat   = date("m/d/Y H:i:s");
        if ($no_surat_awal == $no_surat) {
            $data = array(
                'asal_surat'        => $asal_surat,
                'tanggal'           => $tanggal,
                'perihal'           => $perihal,
                'mulai_kegiatan'    => $start,
                'akhir_kegiatan'    => $end,
                'waktu_kegiatan'    => $waktu_kegiatan,
                'tempat'            => $tempat,
                'update_surat'      => $update_surat
            );
        } else {
            $avalibality_no_surat = $this->db->get_where('tbl_surat_masuk', array('surat_instansi' => $this->session->userdata('sisule_cms_instansi') . $no_surat))->result();
            if ($avalibality_no_surat != null) {
                return 0;
            } else {
                $file_surat = array(
                    'nomor_surat'   => $no_surat,
                    'slug_surat'    => $slug,
                    'surat_instansi'    => $this->session->userdata('sisule_cms_instansi') . $no_surat
                );
                $data = array(
                    'asal_surat'        => $asal_surat,
                    'nomor_surat'       => $no_surat,
                    'tanggal'           => $tanggal,
                    'perihal'           => $perihal,
                    'mulai_kegiatan'    => $start,
                    'akhir_kegiatan'    => $end,
                    'waktu_kegiatan'    => $waktu_kegiatan,
                    'tempat'            => $tempat,
                    'slug_surat'        => $slug,
                    'surat_instansi'    => $this->session->userdata('sisule_cms_instansi') . $no_surat,
                    'update_surat'      => $update_surat
                );
                $this->db->where('nomor_surat', $no_surat_awal);
                $this->db->update('tbl_file_surat', $file_surat);
            }
        }
        $pembuat    = $this->session->userdata('sisule_cms_satuan_kerja');
        $kegiatan1  = 'surat masuk diperbaharui oleh ';
        $tracking   = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => $kegiatan1,
            'kode_struktur_organisasi'           => $pembuat,
            'nomor_surat'   => $no_surat,
            'slug_tracking' => $slug
        );
        $this->db->insert('tbl_tracking', $tracking);
        $this->db->where('nomor_surat', $no_surat_awal);
        return $this->db->update('tbl_surat_masuk', $data);
    }
    public function getPenerimaSurat()
    {
        $query = $this->db->query('SELECT *
        FROM tbl_profile_pejabat
        WHERE nip NOT IN (SELECT nip FROM tbl_login)  
        ORDER BY `tbl_profile_pejabat`.`no` ASC');
        return $query;
    }
    public function getFile($param)
    {
        return $this->db->get_where('tbl_file_surat', array('nomor_surat' => $param));
    }
    public function getFileNotaDinasForDelete($param)
    {
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_file_nota_dinas', 'tbl_file_nota_dinas.nomor_nota_dinas = tbl_nota_dinas.nomor_nota_dinas');
        return $this->db->get('tbl_nota_dinas');
    }
    public function deleteSuratMasuk($param)
    {
        $nomor_surat_masuk  = "";
        $nomor_agenda       = "";
        $nomor_perintah     = "";
        $nomor_perjalanan   = "";
        $nomor_nota         = "";
        $this->db->select('nomor_surat');
        $this->db->where('slug_surat', $param);
        $nomor_surat = $this->db->get('tbl_surat_masuk')->result();
        $this->db->select('nomor_agenda');
        $this->db->where('slug_surat', $param);
        $nomor_agenda = $this->db->get('tbl_disposisi')->result();
        if ($nomor_agenda != null) {
            $nomor_agenda = $nomor_agenda[0]->nomor_agenda;
        } else {
            $nomor_agenda = 0;
        }
        $this->db->select('status');
        $this->db->where('slug_surat', $param);
        $status = $this->db->get('tbl_surat_masuk')->result();
        $this->db->where('tbl_surat_masuk.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_nota_dinas', 'tbl_nota_dinas.nomor_agenda = tbl_disposisi.nomor_agenda');
        $slug_nota = $this->db->get('tbl_surat_masuk')->result();
        if ($slug_nota != null) {
            $nota_slug  = $slug_nota[0]->slug_nota;
            $tembusan   = $slug_nota[0]->tembusan;
            $nomor_nota = $slug_nota[0]->nomor_nota_dinas;
            $this->db->delete('tbl_nota_dinas', array('slug_nota' => $nota_slug));
            $this->db->delete('tbl_file_nota_dinas', array('slug_nota' => $nota_slug));
            $this->db->delete('tbl_detail_tembusan', array('tembusan' => $tembusan));
        }
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_surat_perjalanan_dinas', 'tbl_surat_perintah.no_perintah = tbl_surat_perjalanan_dinas.no_perintah');
        $spd = $this->db->get('tbl_surat_perintah')->result();
        if ($spd != null) {
            $spd_dinas          = $spd[0]->nomor_perjalanan;
            $nomor_perjalanan   = $spd[0]->nomor_perjalanan;
            $this->db->delete('tbl_surat_perjalanan_dinas', array('nomor_perjalanan' => $spd_dinas));
        }
        if ($status >= '1') {
            $nomor_surat_masuk = $nomor_surat[0]->nomor_surat;
            $this->db->delete('tbl_disposisi', array('nomor_surat' => $nomor_surat[0]->nomor_surat));
            $this->db->delete('tbl_detail_penerima_disposisi', array('nomor_surat' => $nomor_surat[0]->nomor_surat));
        }
        $this->db->delete('tbl_file_surat', array('slug_surat' => $param));
        $this->db->delete('tbl_surat_perintah', array('slug_perintah' => $param));
        $this->db->delete('tbl_tracking', array('slug_tracking' => $param));
        $perintah = $this->db->get_where('tbl_surat_perintah', array('slug_perintah' => $param))->result();
        if ($perintah != null) {
            $perintah = $perintah[0]->no_perintah;
            $nomor_perintah = $perintah[0]->no_perintah;
            $this->db->delete('tbl_surat_perjalanan_dinas', array('no_perintah' => $perintah));
        }
        $sampah = array(
            'nomor_surat'       => $nomor_surat_masuk,
            'nomor_agenda'      => $nomor_agenda,
            'nomor_perintah'    => $nomor_perintah,
            'nomor_perjalanan'  => $nomor_perjalanan,
            'nomor_nota_dinas'  => $nomor_nota,
            'id_instansi'       => $this->session->userdata('sisule_cms_instansi'),
            'agendaris_surat'   => $this->session->userdata('sisule_cms_satuan_kerja'),
            'date_produce'      => date('mm'),
            'year_produce'      => date('YY')
        );
        $this->db->insert('tbl_sampah', $sampah);
        return $this->db->delete('tbl_surat_masuk', array('slug_surat' => $param));
    }
    public function restoreFileSampah($param)
    {
        $this->db->where('slug_surat', $param);
        return $this->db->update('tbl_surat_masuk', array('penangguhan' => '0'));
    }
    public function getFileName($param)
    {
        return $this->db->get_where('tbl_file_surat', array('slug_surat' => $param));
    }
    public function deleteSuratMasukSementara($param)
    {
        $this->db->where('slug_surat', $param);
        return $this->db->update('tbl_surat_masuk', array('penangguhan' => '1'));
    }
    public function checkFileSuratMasuk($param)
    {
        return $this->db->get_where('tbl_surat_masuk', array('slug_surat' => $param));
    }
    public function checkFileSuratKeluar($param)
    {
        return $this->db->get_where('tbl_surat_keluar', array('slug_surat' => $param));
    }
    public function getFileSuratMasukForDelete($param)
    {
        return $this->db->get_where('tbl_file_surat', array('slug_surat' => $param));
    }
    public function getFileSuratMasuk($param)
    {
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_file_surat.nomor_surat');
        return $this->db->get_where('tbl_file_surat', array('tbl_file_surat.slug_surat' => $param));
    }
    public function getFileSuratKeluar($param)
    {
        $this->db->join('tbl_surat_keluar', 'tbl_surat_keluar.nomor_surat_keluar = tbl_file_surat.nomor_surat');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_surat_keluar.id_instansi');
        return $this->db->get_where('tbl_file_surat', array('tbl_file_surat.slug_surat' => $param));
    }
    public function getsuratmasuk($param)
    {
        return $this->db->get_where('tbl_surat_masuk', array('nomor_surat' => $param));
    }
    public function getSuratMasukUntukDidownload($param)
    {
        $this->db->join('tbl_surat_keluar', 'tbl_surat_keluar.nomor_surat_keluar = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get_where('tbl_surat_masuk', array('tbl_surat_masuk.slug_surat' => $param));
    }
    public function getCountDokumen($param)
    {
        return $this->db->get_where('tbl_file_surat', array('nomor_surat' => $param));
    }
    public function searchPNS($param)
    {
        $atasan = $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $this->session->userdata('sisule_cms_satuan_kerja')))->result();
        $kode_bidang = 0;
        $jumlah_atasan = 0;
        if ($atasan != 0) {
            $kode_bidang = $atasan[0]->kode_bidang;
            $jumlah_atasan = $atasan[0]->jumlah_atasan;
        }
        if ($kode_bidang != '01') {
            $this->db->where('tbl_bidang.kode_bidang', $kode_bidang);
        }
        $this->db->where('tbl_bidang.jumlah_atasan >', $jumlah_atasan);
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.kode_struktur_organisasi !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->like('tbl_bidang.nama_bidang', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->group_by('tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan');
    }
    public function searchPNSSuratKeluar($param)
    {
        $this->db->where('tbl_instansi.id_instansi !=', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.agendaris', '1');
        $this->db->like('tbl_instansi.nama_instansi', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.id_instansi = tbl_instansi.id_instansi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->group_by('tbl_karyawan.nip');
        return $this->db->get('tbl_instansi');
    }
    public function getPenerimaDisposisi($param)
    {
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->group_by('tbl_karyawan.nip');
        return $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $param));
    }
    public function getSlugSuratMasuk($param)
    {
        return $this->db->get_where('tbl_surat_masuk', array('nomor_surat' => $param));
    }
    public function getAllPenerimaDisposisi($param)
    {
        $this->db->where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_kode_struktur_organisasi'));
        $this->db->where('tbl_disposisi.nomor_surat', $param);
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get('tbl_disposisi');
    }
    public function deletePenerimaDisposisi($param1, $param2)
    {
        $slug = str_replace('/', '-', $param2);
        $tracking = array(
            'kode_kegiatan'     => '5',
            'kegiatan'          => 'Pihak berkepentingan telah menghapus surat disposisi untuk ',
            'kode_struktur_organisasi'               => $param1,
            'nomor_surat'       => $param2,
            'slug_tracking'     => $slug
        );
        $this->db->insert('tbl_tracking', $tracking);
        $this->db->where('kode_struktur_organisasi', $param1);
        $this->db->where('nomor_surat', $param2);
        return $this->db->delete('tbl_detail_penerima_disposisi');
    }

    public function getJabatanPenerimaDisposisi($param)
    {
        return $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $param));
    }

    public function createSuratDisposisi($param, $param2)
    {
        if ($this->db->insert('tbl_disposisi', $param)) {
            $this->db->where('nomor_surat', $param2);
            return $this->db->update('tbl_surat_masuk', array('status' => '1'));
        }
    }

    public function updateSuratDisposisi($param1, $param2)
    {
        $this->db->where('nomor_surat', $param1);
        return $this->db->update('tbl_disposisi', $param2);
    }
    public function getInfoDisposisi($param)
    {
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.slug_surat = tbl_disposisi.slug_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_karyawan.golongan', 'DESC');
        return $this->db->get('tbl_disposisi');
    }

    public function pemberiMandatDisposisi($param)
    {
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get('tbl_disposisi');
    }

    public function penerimaMandatDisposisi($param)
    {
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.slug_surat = tbl_disposisi.slug_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_karyawan.golongan', 'DESC');
        return $this->db->get('tbl_disposisi');
    }

    public function bidangPenugasDisposisi($param)
    {
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        return $this->db->get('tbl_disposisi');
    }

    public function createPenerimaDisposisi($param1, $param2, $param3)
    {
        $slug = str_replace('/', '-', $param2);
        $tracking1 = array(
            'kode_kegiatan'     => '2',
            'kegiatan'          => 'telah berhasil didisposisikan ke ',
            'kode_struktur_organisasi'               => $param3,
            'nomor_surat'       => $param2,
            'slug_tracking'     => $slug
        );
        if ($this->db->insert('tbl_tracking', $tracking1)) {
            return $this->db->insert('tbl_detail_penerima_disposisi', $param1);
        }
    }

    public function updatePenerimaDisposisi($param1, $param2, $param3)
    {
        $this->db->where('nomor_surat', $param2);
        return $this->db->insert('tbl_detail_penerima_disposisi', $param1);
    }

    public function trackingDisposisi($param, $param2)
    {
        $this->db->where('nomor_surat', $param);
        $agendaris = $this->db->get('tbl_surat_masuk')->result();
        $agendaris = $agendaris[0]->agendaris_surat;

        $slug = str_replace('/', '-', $param);
        $tracking = array(
            'kode_kegiatan'     => '3',
            'kegiatan'          => 'surat disposisi diperbaharui oleh ',
            'kode_struktur_organisasi'               => $this->session->userdata('sisule_cms_satuan_kerja'),
            'nomor_surat'       => $param,
            'slug_tracking'     => $slug
        );
        return $this->db->insert('tbl_tracking', $tracking);
    }

    public function pengagendaanSuratDisposisi($param)
    {
        $this->db->where('tbl_bidang.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.agendaris_surat');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $nomor_agenda   = $this->db->get('tbl_disposisi')->result();
        if ($nomor_agenda != null) {
            $no_agenda      = $nomor_agenda[0]->nomor_agenda;
        }
        $agendaris      = $this->session->userdata('sisule_cms_satuan_kerja');
        $tanggal        = date('m/d/Y');
        $data = array(
            'nomor_agenda'      => $this->session->userdata('sisule_cms_instansi') . "-" . (substr($no_agenda, 4) + 1),
            'tanggal_agenda'    => $tanggal,
            'agendaris_surat'         => $agendaris
        );
        $nomor_surat = str_replace('-', '/', $param);
        $tracking = array(
            'kode_kegiatan'     => '4',
            'kegiatan'          => 'surat telah dikirimkan ke penerima disposisi dan telah diagendakan oleh ',
            'kode_struktur_organisasi'               => $agendaris,
            'nomor_surat'       => $nomor_surat,
            'slug_tracking'     => $param
        );
        $this->db->insert('tbl_tracking', $tracking);
        $penerima_disposisi = $this->db->get_where('tbl_tracking', array('slug_tracking' => $param, 'kode_kegiatan' => '2'))->result();
        for ($i = 0; $i < count($penerima_disposisi); $i++) {
            $tracking2 = array(
                'kode_kegiatan' => '5',
                'kegiatan'      => 'menunggu tahap pelaporan nota dinas dari penerima disposisi',
                'kode_struktur_organisasi'           => $penerima_disposisi[$i]->nip,
                'nomor_surat'   => $nomor_surat,
                'slug_tracking' => $param
            );
            $this->db->insert('tbl_tracking', $tracking2);
        }
        $this->db->where('slug_surat', $param);
        $this->db->update('tbl_surat_masuk', array('status' => '2'));
        $this->db->where('slug_surat', $param);
        return  $this->db->update('tbl_disposisi', $data);
    }

    public function getPenerimaUserTerDisposisi($param)
    {
        $this->db->where('nomor_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_detail_penerima_disposisi.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get('tbl_detail_penerima_disposisi');
    }

    public function getPreviewDisposisi($param)
    {
        $this->db->where('nomor_surat', $param);
        return $this->db->get('tbl_disposisi');
    }

    public function getInfoSuratDisposisi($param)
    {
        return $this->db->get_where('tbl_surat', array('nomor_surat' => $param));
    }

    public function getBidang()
    {
        $this->db->where('nip !=', '0');
        $this->db->where('top', '1');
        $this->db->order_by('kode_bidang', 'asc');
        return $this->db->get('tbl_bidang', 6);
    }

    public function getSuratDisposisi($param)
    {
        $this->db->from('tbl_surat_masuk');
        $this->db->where('tbl_disposisi.nomor_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get();
    }

    public function createNotaDinas()
    {
        $agenda             = $this->input->post('nomor_agenda');
        $nomor_nota_dinas   = $this->input->post('no_nota');
        $laporan            = $this->input->post('laporan');

        $this->db->from('tbl_detail_penerima_disposisi');
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->where('tbl_disposisi.nomor_agenda', $agenda);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_detail_penerima_disposisi.nomor_surat');
        $penerima_disposisi =  $this->db->get()->result();
        $pembuat            = $penerima_disposisi[0]->kode_struktur_organisasi;
        $data               = $this->db->get_where('tbl_disposisi', array('nomor_agenda' => $agenda))->result();
        $penerima           = $data[0]->pembuat_disposisi;
        $tanggal            = date("m/d/Y");
        $tembusan           = rand();
        $slug               = str_replace('/', '-', $nomor_nota_dinas);
        $penulis            = $this->session->userdata('sisule_cms_satuan_kerja');

        $this->db->where('tbl_karyawan.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.atasan', '0');
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $kadis = $this->db->get('tbl_karyawan')->result();
        if ($kadis != null) {
            $kadis = $kadis[0]->kode_struktur_organisasi;
        } else {
            $kadis = null;
        }
        $data = array(
            'nomor_nota_dinas'  => $nomor_nota_dinas,
            'penerima_nota'     => $penerima,
            'pembuat_nota'      => $pembuat,
            'laporan'           => $laporan,
            'tanggal_nota'      => $tanggal,
            'tembusan'          => $tembusan,
            'nomor_agenda'      => $agenda,
            'slug_nota'         => $slug,
            'penulis'           => $penulis,
            'date_produce'      => date('mm'),
            'year_produce'      => date('YY')
        );
        if ($this->input->post('tembusan') != null) {
            for ($i = 0; $i < count($this->input->post('tembusan')); $i++) {
                $this->db->insert('tbl_detail_tembusan', array('tembusan' => $tembusan, 'penerima_tembusan' => $this->input->post('tembusan')[$i]));
            }
        } else {
            $this->db->insert('tbl_detail_tembusan', array('tembusan' => $tembusan, 'penerima_tembusan' => $kadis));
        }

        $this->db->where('nomor_agenda', $agenda);
        $this->db->update('tbl_disposisi', array('nota' => $nomor_nota_dinas));
        $this->db->insert('tbl_nota_dinas', $data);

        $this->db->where('tbl_nota_dinas.nomor_nota_dinas', $nomor_nota_dinas);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');

        $nomor_surat    = $this->db->get('tbl_nota_dinas')->result();
        $nomor_surat    = $nomor_surat[0]->nomor_surat;
        $tracking1      = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => 'nota dinas telah dibuat oleh',
            'kode_struktur_organisasi'           => $penulis,
            'nomor_surat'   => $nomor_surat,
            'slug_tracking' => $slug
        );
        $tracking2 = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => 'nota dinas dilaporkan kepada',
            'kode_struktur_organisasi'           => $penerima,
            'nomor_surat'   => $nomor_surat,
            'slug_tracking' => $slug
        );
        $this->db->insert('tbl_tracking', $tracking1);
        return $this->db->insert('tbl_tracking', $tracking2);
    }
    public function updateNotaDinas()
    {
        $agenda             = $this->input->post('nomor_agenda');
        $nomor_nota_dinas   = $this->input->post('no_nota');
        $laporan            = $this->input->post('laporan');
        $data               = $this->db->get_where('tbl_disposisi', array('nomor_agenda' => $agenda))->result();
        $penerima           = $data[0]->pembuat_disposisi;
        $slug               = str_replace('/', '-', $nomor_nota_dinas);
        $penulis            = $this->session->userdata('sisule_cms_satuan_kerja');

        $this->db->where('nomor_agenda', $agenda);
        $this->db->update('tbl_nota_dinas', array('laporan' =>  $laporan));

        $this->db->where('tbl_nota_dinas.nomor_nota_dinas', $nomor_nota_dinas);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $nomor_surat    = $this->db->get('tbl_nota_dinas')->result();
        $nomor_surat    = $nomor_surat[0]->nomor_surat;

        $tracking1      = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => 'nota dinas telah diperbaharui oleh',
            'kode_struktur_organisasi'           => $penulis,
            'nomor_surat'   => $nomor_surat,
            'slug_tracking' => $slug
        );
        $tracking2 = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => 'nota dinas dilaporkan kepada',
            'kode_struktur_organisasi'           => $penerima,
            'nomor_surat'   => $nomor_surat,
            'slug_tracking' => $slug
        );
        $this->db->insert('tbl_tracking', $tracking1);
        return $this->db->insert('tbl_tracking', $tracking2);
    }
    public function checkNotaDinas()
    {
        $agenda = $this->input->post('nomor_agenda');
        return $this->db->get_where('tbl_nota_dinas', array('nomor_agenda' => $agenda));
    }

    public function getFileNotaDinas($param)
    {
        return $this->db->get_where('tbl_file_nota_dinas', array('slug_nota' => $param));
    }

    public function getPenerimaNotaDinas($param)
    {
        $this->db->where('tbl_nota_dinas.slug_nota', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_nota_dinas.penerima_nota');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get('tbl_nota_dinas');
    }

    public function getPenerimaTembusan($param)
    {
        $this->db->where('tbl_nota_dinas.slug_nota', $param);
        $this->db->join('tbl_detail_tembusan', 'tbl_detail_tembusan.tembusan = tbl_nota_dinas.tembusan');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_tembusan.penerima_tembusan');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $this->db->order_by('tbl_bidang.kode_bidang', 'ASC');
        return $this->db->get('tbl_nota_dinas');
    }

    public function getPenulisNotaDinas($param)
    {
        $this->db->where('tbl_nota_dinas.slug_nota', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_nota_dinas.penulis');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get('tbl_nota_dinas');
    }

    public function getNotaDinas($param)
    {
        return $this->db->get_where('tbl_nota_dinas', array('slug_nota' => $param));
    }

    public function createSuratPerintah($param)
    {
        $this->db->where('tbl_bidang.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.agendaris_surat');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $nomor_agenda   = $this->db->get('tbl_disposisi')->result();
        if ($nomor_agenda != null) {
            $no_agenda      = $nomor_agenda[0]->nomor_agenda;
        }
        $agendaris      = $this->session->userdata('sisule_cms_satuan_kerja');
        $tanggal        = date('m/d/Y');
        $data = array(
            'nomor_agenda'      => $this->session->userdata('sisule_cms_instansi') . "-" . (substr($no_agenda, 4) + 1),
            'tanggal_agenda'    => $tanggal,
            'agendaris_surat'         => $agendaris
        );
        $this->db->where('slug_surat', $param);
        $this->db->update('tbl_surat_masuk', array('status' => '2'));
        $this->db->where('slug_surat', $param);
        $this->db->update('tbl_disposisi', $data);

        $this->db->select('tbl_disposisi.penerima');
        $this->db->from('tbl_surat_masuk');
        $this->db->where('tbl_surat_masuk.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $penerima = $this->db->get()->result();

        $nomor_surat    = $this->db->get_where('tbl_surat_masuk', array('slug_surat' => $param))->result();
        $no_perintah    = $this->input->post('no_perintah');

        $atasan = 0;
        $pendisposisi = $this->db->get_where('tbl_disposisi', array('slug_surat' => $param))->result();
        if ($pendisposisi != null) {
            $atasan = $pendisposisi[0]->pembuat_disposisi;
        }

        $kba = 0;
        $kode_bidang_atasan = $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $atasan))->result();
        if ($kode_bidang_atasan != 0) {
            $kba = $kode_bidang_atasan[0]->kode_struktur_organisasi;
        }
        $nama_karyawan = null;
        $jabatan_karyawan = null;
        $golongan_karyawan = null;
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $karyawan = $this->db->get_where('tbl_bidang', array('tbl_bidang.kode_struktur_organisasi' => $atasan))->result();
        if($karyawan != null){
            $nama_karyawan = $karyawan[0]->nama;
            $jabatan_karyawan = $karyawan[0]->nama_bidang;
            $golongan_karyawan = $karyawan[0]->golongan;
        }
        $data = array(
            'no_perintah'       => $no_perintah,
            'pengadministrasi'  => $this->session->userdata('sisule_cms_satuan_kerja'),
            'detail_penerima'   => $penerima[0]->penerima,
            'nomor_surat'       => $nomor_surat[0]->nomor_surat,
            'slug_perintah'     => $nomor_surat[0]->slug_surat,
            'date_produce'      => date('mm'),
            'year_produce'      => date('YY'),
            'kode_struktur_organisasi' => $kba,
            'perintah_instansi' => $this->session->userdata('sisule_cms_instansi'),
            'nama_karyawan'     => $nama_karyawan,
            'jabatan_karyawan'  => $jabatan_karyawan,
            'golongan_karyawan' => $golongan_karyawan,
            'nip_karyawan'      => $this->session->userdata('sisule_cms_nip')
        );
        $penerima_disposisi = $this->db->get_where('tbl_tracking', array('slug_tracking' => $param, 'kode_kegiatan' => '2'))->result();
        for ($i = 0; $i < count($penerima_disposisi); $i++) {
            $tracking2 = array(
                'kode_kegiatan'  => '4',
                'kegiatan' => 'surat disposisi dan surat perintah telah dibuat oleh dinas dan diserahkan ke',
                'kode_struktur_organisasi' => $penerima_disposisi[$i]->kode_struktur_organisasi,
                'nomor_surat' => $nomor_surat[0]->nomor_surat,
                'slug_tracking' => $param
            );
            $this->db->insert('tbl_tracking', $tracking2);
        }

        return $this->db->insert('tbl_surat_perintah', $data);
    }

    public function createSuratPerintahPerjalananDinas($param)
    {
        $this->db->where('tbl_bidang.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.agendaris_surat');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $nomor_agenda   = $this->db->get('tbl_disposisi')->result();
        if ($nomor_agenda != null) {
            $no_agenda      = $nomor_agenda[0]->nomor_agenda;
        }
        $agendaris      = $this->session->userdata('sisule_cms_satuan_kerja');
        $tanggal        = date('m/d/Y');
        $data = array(
            'nomor_agenda'      => $this->session->userdata('sisule_cms_instansi') . "-" . (substr($no_agenda, 4) + 1),
            'tanggal_agenda'    => $tanggal,
            'agendaris_surat'         => $agendaris
        );
        $this->db->where('slug_surat', $param);
        $this->db->update('tbl_surat_masuk', array('status' => '2'));
        $this->db->where('slug_surat', $param);
        $this->db->update('tbl_disposisi', $data);

        $this->db->select('tbl_disposisi.penerima');
        $this->db->from('tbl_surat_masuk');
        $this->db->where('tbl_surat_masuk.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $penerima = $this->db->get()->result();

        $nomor_surat    = $this->db->get_where('tbl_surat_masuk', array('slug_surat' => $param))->result();
        $no_perintah    = $this->input->post('no_perintah');
        $slug           = str_replace('/', '-', $nomor_surat[0]->nomor_surat);
        $atasan = 0;
        $pendisposisi = $this->db->get_where('tbl_disposisi', array('slug_surat' => $param))->result();
        if ($pendisposisi != null) {
            $atasan = $pendisposisi[0]->pembuat_disposisi;
        }

        $kba = 0;
        $kode_bidang_atasan = $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $atasan))->result();
        if ($kode_bidang_atasan != 0) {
            $kba = $kode_bidang_atasan[0]->kode_struktur_organisasi;
        }
        $nama_karyawan = null;
        $jabatan_karyawan = null;
        $golongan_karyawan = null;
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $karyawan = $this->db->get_where('tbl_bidang', array('tbl_bidang.kode_struktur_organisasi' => $atasan))->result();
        if($karyawan != null){
            $nama_karyawan = $karyawan[0]->nama;
            $jabatan_karyawan = $karyawan[0]->nama_bidang;
            $golongan_karyawan = $karyawan[0]->golongan;
        }
        $data = array(
            'no_perintah'       => $no_perintah,
            'pengadministrasi'  => $this->session->userdata('sisule_cms_satuan_kerja'),
            'detail_penerima'   => $penerima[0]->penerima,
            'nomor_surat'       => $nomor_surat[0]->nomor_surat,
            'slug_perintah'     => $nomor_surat[0]->slug_surat,
            'date_produce'      => date('mm'),
            'year_produce'      => date('YY'),
            'kode_struktur_organisasi' => $kba,
            'perintah_instansi' => $this->session->userdata('sisule_cms_instansi'),
            'nama_karyawan'     => $nama_karyawan,
            'jabatan_karyawan'  => $jabatan_karyawan,
            'golongan_karyawan' => $golongan_karyawan,
            'nip_karyawan'      => $this->session->userdata('sisule_cms_nip')
        );
        $this->db->insert('tbl_surat_perintah', $data);

        $nomor_perjalanan       = $this->input->post('no_perjalanan');
        $tujuan_keberangkatan   = $this->input->post('tujuan');
        $keberangkatan          = $this->input->post('keberangkatan');
        $kepulangan             = $this->input->post('kepulangan');
        $kendaraan              = $this->input->post('kendaraan');

        $perjalanan = array(
            'nomor_perjalanan'      => $nomor_perjalanan,
            'tujuan_keberangkatan'  => $tujuan_keberangkatan,
            'keberangkatan'         => $keberangkatan,
            'kepulangan'            => $kepulangan,
            'kendaraan'             => $kendaraan,
            'no_perintah'           => $no_perintah,
            'date_produce'          => date('mm'),
            'year_produce'          => date('YY'),
            'kode_struktur_organisasi' => $kba
        );
        $penerima_disposisi = $this->db->get_where('tbl_tracking', array('slug_tracking' => $param, 'kode_kegiatan' => '2'))->result();
        for ($i = 0; $i < count($penerima_disposisi); $i++) {
            $tracking2 = array(
                'kode_kegiatan' => '4',
                'kegiatan'      => 'surat disposisi, surat perintah dan surat perjalanan dinas telah dibuat oleh dinas dan diserahkan ke',
                'kode_struktur_organisasi'           => $penerima_disposisi[$i]->kode_struktur_organisasi,
                'nomor_surat'   => $nomor_surat[0]->nomor_surat,
                'slug_tracking' => $param
            );
            $this->db->insert('tbl_tracking', $tracking2);
        }
        return $this->db->insert('tbl_surat_perjalanan_dinas', $perjalanan);
    }

    public function checkSPD($param)
    {
        $this->db->where('tbl_surat_perintah.slug_perintah', $param);
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perjalanan_dinas', 'tbl_surat_perjalanan_dinas.no_perintah = tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_surat_masuk');
    }

    public function getInfoPerjalananDinasForPembuat($param)
    {
        $this->db->where('tbl_surat_perintah.slug_perintah', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perjalanan_dinas', 'tbl_surat_perjalanan_dinas.no_perintah = tbl_surat_perintah.no_perintah');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        return $this->db->get('tbl_surat_masuk');
    }

    public function getInfoPerjalananDinasForPenerima($param)
    {
        $this->db->where('tbl_surat_perintah.slug_perintah', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perjalanan_dinas', 'tbl_surat_perjalanan_dinas.no_perintah = tbl_surat_perintah.no_perintah');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $this->db->order_by('tbl_karyawan.golongan', 'DESC');
        return $this->db->get('tbl_surat_masuk');
    }

    public function CountPenerimaDisposisi($param)
    {
        $this->db->where('tbl_surat_masuk.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        return $this->db->get('tbl_surat_masuk');
    }

    public function getSuratPerintah($param)
    {
        $this->db->where('tbl_surat_perintah.slug_perintah', $param);

        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_surat_perintah.perintah_instansi');
        return $this->db->get('tbl_surat_masuk');
    }

    public function getInfoPembuatSuratPerintah($param)
    {
        $this->db->where('tbl_surat_masuk.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        return $this->db->get('tbl_surat_masuk');
    }

    public function getPenerimaSuratPerintah($param)
    {
        $this->db->where('tbl_surat_perintah.slug_perintah', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_karyawan.golongan', 'DESC');
        return $this->db->get('tbl_surat_masuk');
    }

    public function trackingSuratMasuk($param)
    {
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_tracking.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_tracking.id', 'desc');
        return $this->db->get_where('tbl_tracking', array('tbl_tracking.nomor_surat' => $param));
    }

    public function cekKetersediaanDisposisi($param)
    {
        return $this->db->get_where('tbl_disposisi', array('nomor_surat' => $param));
    }
    public function cekUserTerdisposisi($param1, $param2)
    {
        $this->db->where('nomor_surat', $param1);
        $this->db->where('kode_struktur_organisasi', $param2);
        return $this->db->get('tbl_detail_penerima_disposisi');
    }
    public function checkNotaDinasWasCreated($param)
    {
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        return $this->db->get('tbl_nota_dinas');
    }
    public function getInstansiForNotaDinas($param)
    {
        $this->db->where('tbl_nota_dinas.slug_nota', $param);
        $this->db->join('tbl_nota_dinas', 'tbl_nota_dinas.penulis = tbl_bidang.kode_struktur_organisasi');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        return $this->db->get('tbl_bidang');
    }
    public function getInstansiForSuratKeluar($param)
    {
        $this->db->where('tbl_surat_keluar.slug_surat', $param);
        $this->db->join('tbl_surat_keluar', 'tbl_surat_keluar.pembuat = tbl_bidang.kode_struktur_organisasi');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_surat_keluar.id_instansi');
        return $this->db->get('tbl_bidang');
    }
    public function saveSuratKeluar($penerima)
    {
        date_default_timezone_set("Asia/Jakarta");

        $instansi = $this->db->get_where('tbl_instansi', array('id_instansi'=>$this->session->userdata('sisule_cms_instansi')))->result();
        $asal_surat = null;
        if($instansi != null){
            $asal_surat = $instansi[0]->nama_instansi;
        }
        $kode_struktur_organisasi = null;
        $kso = $this->db->get_where('tbl_bidang', array('nip' => $this->session->userdata('sisule_cms_nip')))->result();
        if ($kso != null) {
            $kode_struktur_organisasi = $kso[0]->kode_struktur_organisasi;
        }

        $no_surat       = $this->input->post('nomor_surat_keluar');
        $perihal        = $this->input->post('perihal');
        $start          = $this->input->post('start');
        $end            = $this->input->post('end');
        $waktu          = date("h:i:s a");
        $waktu_kegiatan = $this->input->post('waktu_kegiatan');
        $tempat         = $this->input->post('tempat_pelaksanaan');
        $slug           = $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat_keluar'));
        $pembuat        = $this->session->userdata('sisule_cms_satuan_kerja');
        $pembuatan      = date('m/d/Y H:i');
        $izin_atasan    = $this->session->userdata('sisule_cms_satuan_kerja');
        // data surat keluar
        $surat_keluar = array(
            'pembuat'               => $pembuat,
            'nomor_surat_keluar'    => $no_surat,
            'perihal'               => $perihal,
            'tanggal'               => date('m/d/Y'),
            'mulai_kegiatan'        => $start,
            'akhir_kegiatan'        => $end,
            'waktu_kegiatan'        => $waktu_kegiatan,
            'tempat'                => $tempat,
            'slug_surat'            => $slug,
            'daftar_penerima'       => $penerima,
            'waktu_membuat'         => $pembuatan,
            'id_instansi'           => $this->session->userdata('sisule_cms_instansi'),
            'date_produce'          => date('mm'),
            'year_produce'      => date('YY')
        );
        // data surat masuk
        $surat_masuk = array(
            'asal_surat'        => $asal_surat,
            'pembuat'           => $pembuat,
            'nomor_surat'       => $no_surat,
            'waktu'             => $waktu,
            'tanggal'           => date('m/d/Y'),
            'penerima'          => $penerima,
            'perihal'           => $perihal,
            'mulai_kegiatan'    => $start,
            'akhir_kegiatan'    => $end,
            'waktu_kegiatan'    => $waktu_kegiatan,
            'tempat'            => $tempat,
            'slug_surat'        => $slug,
            'agendaris_surat'         => $pembuat,
            'surat_instansi'    => $this->session->userdata('sisule_cms_instansi'),
            'date_produce'      => date('mm'),
            'year_produce'      => date('YY'),
            'keterangan_pembuatan' => '1',
            'bukan_penerima_surat' => $this->session->userdata('sisule_cms_satuan_kerja')
        );
        $this->db->insert('tbl_surat_masuk', $surat_masuk);
        return $this->db->insert('tbl_surat_keluar', $surat_keluar);
    }
    public function cekUserPenerimaSuratKeluar($param1, $param2)
    {
        $this->db->where('nomor_surat_keluar', $param1);
        $this->db->where('kode_struktur_organisasi', $param2);
        return $this->db->get('tbl_daftar_penerima_surat_keluar');
    }
      public function cekUserPenerimaSuratMasuk($param1, $param2)
    {
        $this->db->where('nomor_surat', $param1);
        $this->db->where('kode_struktur_organisasi', $param2);
        return $this->db->get('tbl_daftar_penerima_surat_masuk');
    }
    public function createPenerimaSuratKeluar($param1)
    {
        return $this->db->insert('tbl_daftar_penerima_surat_keluar', $param1);
    }
     public function createPenerimaSuratMasuk($param1)
    {
        return $this->db->insert('tbl_daftar_penerima_surat_masuk', $param1);
    }
    public function hapussuratkeluar($param)
    {
        $nomor_surat_keluar = $this->db->get_where('tbl_surat_keluar', array('slug_surat' => $param))->result();
        $nomor_surat = null;
        if ($nomor_surat_keluar != null) {
            $nomor_surat = $nomor_surat_keluar[0]->nomor_surat_keluar;
        }

        $this->db->delete('tbl_daftar_penerima_surat_keluar', array('nomor_surat_keluar' => $nomor_surat));
        $this->db->delete('tbl_file_surat', array('nomor_surat' => $nomor_surat));
        return $this->db->delete('tbl_surat_keluar', array('slug_surat' => $param));
    }
    public function getPenerimaSuratKeluar($param)
    {
        return $this->db->get_where('tbl_daftar_penerima_surat_keluar', array('nomor_surat_keluar' => $param));
    }
    public function updateFileSuratKeluar($param, $data)
    {
        $this->db->where('nomor_surat', $param);
        return $this->db->update('tbl_file_surat', $data);
    }
    public function updateSuratKeluar($param, $penerima)
    {
        $old_no_surat   = $this->input->post('old_nomor_surat_keluar');
        $no_surat       = $this->input->post('nomor_surat_keluar');
        $perihal        = $this->input->post('perihal');
        $isi            = $this->input->post('isi');
        $start          = $this->input->post('start');
        $end            = $this->input->post('end');
        $waktu_kegiatan = $this->input->post('waktu_kegiatan');
        $tempat         = $this->input->post('tempat_pelaksanaan');
        $slug           = $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat_keluar'));
        $pembuat        = $this->session->userdata('sisule_cms_satuan_kerja');
        $data = array(
            'pembuat'               => $pembuat,
            'nomor_surat_keluar'    => $no_surat,
            'perihal'               => $perihal,
            'isi'                   => $isi,
            'mulai_kegiatan'        => $start,
            'akhir_kegiatan'        => $end,
            'waktu_kegiatan'        => $waktu_kegiatan,
            'tempat'                => $tempat,
            'slug_surat'            => $slug,
            'daftar_penerima'       => $penerima,
            'waktu_memperbaharui'   => date('m/d/Y H:i')
        );

        $this->db->where('nomor_surat', $old_no_surat);
        $this->db->update('tbl_file_surat', array('slug_surat' => $slug));
        $this->db->where('id_surat_keluar', $param);
        return $this->db->update('tbl_surat_keluar', $data);
    }
    public function getSlug($param)
    {
        return $this->db->get_where('tbl_surat_keluar', array('nomor_surat_keluar' => $param));
    }
    public function getTembusanNotaDinas($param)
    {
        $this->db->join('tbl_detail_tembusan', 'tbl_detail_tembusan.tembusan = tbl_nota_dinas.tembusan');
        return $this->db->get_where('tbl_nota_dinas', array('tbl_nota_dinas.nomor_agenda' => $param));
    }
    public function cariPenerimaDisposisi()
    {
        $atasan = $this->db->get_where('tbl_bidang', array('nip' => $this->session->userdata('sisule_cms_nip')))->result();
        $kode_bidang = 0;
        $jumlah_atasan = 0;
        if ($atasan != 0) {
            $kode_bidang = $atasan[0]->kode_bidang;
            $jumlah_atasan = $atasan[0]->jumlah_atasan;
        }

        $this->db->where('tbl_bidang.kode_bidang', $kode_bidang);
        $this->db->where('tbl_bidang.jumlah_atasan >', $jumlah_atasan);
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.kode_struktur_organisasi !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->group_by('tbl_karyawan.nip');
        $this->db->order_by('tbl_karyawan.golongan', 'DESC');
        return $this->db->get('tbl_karyawan');
    }
    public function redisposisi()
    {
        $slug = $this->session->userdata('sisule_cms_instansi') . date('m-d-Y-H-i') . str_replace('/', '-', $this->input->post('nomor_surat'));
        $penerima = $this->db->get_where('tbl_disposisi', array('nomor_surat' => $this->input->post('nomor_surat')))->result();
        $penerima_disposisi = null;
        if ($penerima != null) {
            $penerima_disposisi = $penerima[0]->penerima;
        }
        $kegiatan1  = 'surat diredisposisi oleh';
        $tracking   = array(
            'kode_kegiatan' => '1',
            'kegiatan'      => $kegiatan1,
            'kode_struktur_organisasi'           => $this->session->userdata('sisule_cms_satuan_kerja'),
            'nomor_surat'   => $this->input->post('nomor_surat'),
            'slug_tracking' => $slug
        );
        $this->db->insert('tbl_tracking', $tracking);
        $this->db->where('penerima', $penerima_disposisi);
        $this->db->where('kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        return $this->db->update('tbl_detail_penerima_disposisi', array('kode_struktur_organisasi' => $this->input->post('penerima_redisposisi')));
    }
    public function checkStatusUser($param)
    {
        return $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $param));
    }
    public function checkStatusSebagaiAtasan($param)
    {
        $this->db->where('tbl_surat_keluar.slug_surat', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get('tbl_surat_keluar');
    }
    public function izinkanSuratKeluar($param, $data)
    {
        $this->db->where('slug_surat', $param);
        return $this->db->update('tbl_surat_keluar', $data);
    }
    public function getSuratKeluar($param)
    {
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get_where('tbl_surat_keluar', array('slug_surat' => $param));
    }
    public function getInstansiForSuratDisposisi($param)
    {
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_surat_masuk.surat_instansi');
        return $this->db->get_where('tbl_disposisi', array('tbl_disposisi.slug_surat' => $param));
    }
    public function getInstansiForSuratPerintah($param)
    {
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_surat_masuk.surat_instansi');
        return $this->db->get_where('tbl_surat_perintah', array('slug_perintah' => $param));
    }
    public function getDetailPenerimaSuratKeluar($param)
    {
        $this->db->join('tbl_daftar_penerima_surat_keluar', 'tbl_daftar_penerima_surat_keluar.nomor_surat_keluar = tbl_surat_keluar.nomor_surat_keluar');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_daftar_penerima_surat_keluar.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_karyawan.golongan', 'DESC');
        return $this->db->get_where('tbl_surat_keluar', array('tbl_surat_keluar.slug_surat' => $param));
    }
    public function CreateSuratMasuk($param)
    {
        $d_instansi = null;
        $instansi = $this->db->get_where('tbl_instansi', array('id_instansi' => $this->session->userdata('sisule_cms_instansi')))->result();
        if ($instansi != null) {
            $d_instansi = $instansi[0]->nama_instansi;
        }
        $this->db->join('tbl_daftar_penerima_surat_keluar', 'tbl_daftar_penerima_surat_keluar.penerima = tbl_surat_keluar.daftar_penerima');
        $data = $this->db->get_where('tbl_surat_keluar', array('tbl_surat_keluar.slug_surat' => $param))->result();
        if ($data != 0) {
            $arr = array(
                'pembuat'           => $this->session->userdata('sisule_cms_nip'),
                'asal_surat'        => $d_instansi,
                'nomor_surat'       => $data[0]->nomor_surat_keluar,
                'waktu'             => date('H.i'),
                'tanggal'           => date('mm/dd/YYYY'),
                'penerima'          => $data[0]->penerima,
                'perihal'           => $data[0]->perihal,
                'mulai_kegiatan'    => $data[0]->mulai_kegiatan,
                'akhir_kegiatan'    => $data[0]->akhir_kegiatan,
                'waktu_kegiatan'    => $data[0]->waktu_kegiatan,
                'tempat'            => $data[0]->tempat,
                'slug_surat'        => $data[0]->slug_surat,
                'agendaris_surat'         => $data[0]->izin_agendaris,
                'surat_instansi'    => $this->session->userdata('sisule_cms_instansi'),
                'date_produce'      => date('mm'),
                'year_produce'      => date('YY')
            );
            $this->db->join('tbl_daftar_penerima_surat_keluar', 'tbl_daftar_penerima_surat_keluar.nomor_surat_keluar = tbl_surat_keluar.nomor_surat_keluar');
            $penerima_surat = $this->db->get_where('tbl_surat_keluar', array('tbl_surat_keluar.slug_surat' => $param))->result();
            if ($penerima_surat != null) {
                for ($i = 0; $i < count($penerima_surat); $i++) {
                    $arr_penerima_surat = array(
                        'kode_struktur_organisasi'           => $penerima_surat[$i]->kode_struktur_organisasi,
                        'penerima'      => $penerima_surat[$i]->daftar_penerima,
                        'nomor_surat'   => $penerima_surat[$i]->nomor_surat_keluar
                    );
                    $this->db->insert('tbl_daftar_penerima_surat_masuk', $arr_penerima_surat);
                }
            }
            return $this->db->insert('tbl_surat_masuk', $arr);
        }
    }
    public function checkSuratKeluarMasuk($param)
    {
        $this->db->join('tbl_surat_keluar', 'tbl_surat_keluar.nomor_surat_keluar = tbl_surat_masuk.nomor_surat');
        return $this->db->get_where('tbl_surat_masuk', array('tbl_surat_masuk.slug_surat' => $param));
    }
    
    public function getStatistikSuratKeluar($param)
    {
        $this->db->where('date_produce', $param);
        $this->db->where('pembuat', $this->session->userdata('sisule_cms_satuan_kerja'));
        return $this->db->get('tbl_surat_keluar');
    }
    public function getKodeStrukturOrganisasi()
    {
        return $this->db->get_where('tbl_bidang', array('nip' => $this->session->userdata('sisule_cms_nip')));
    }
    public function getKalenderKegiatan($param)
    {
        $this->db->select('title, start, end, slug_surat');
        $this->db->where('surat_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('date_produce', $param);
        return $this->db->get('tbl_surat_masuk');
    }
    public function forwardSuratMasuk($param1, $param2){
        $this->db->where('nomor_surat', $param1);
        $this->db->where('kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        return $this->db->update('tbl_daftar_penerima_surat_masuk', $param2);
    }
    public function getInfoSuratKeluar($param){
        return $this->db->get_where('tbl_surat_keluar', array('nomor_surat_keluar'=>$param));
    }
    public function getInfoPenerimaSuratKeluar($param){
        $this->db->join('tbl_daftar_penerima_surat_keluar', 'tbl_daftar_penerima_surat_keluar.nomor_surat_keluar = tbl_surat_keluar.nomor_surat_keluar');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_daftar_penerima_surat_keluar.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_karyawan.id_instansi');
        $this->db->group_by('tbl_karyawan.nip');
        return $this->db->get_where('tbl_surat_keluar', array('tbl_surat_keluar.nomor_surat_keluar'=>$param));
    }
    public function getDataKaryawan(){
        $this->db->where('tbl_karyawan.nip', $this->session->userdata('sisule_cms_nip'));
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan');
    }
    public function countAllDisposisi($param)
    {
        $this->db->where('tbl_disposisi.date_produce', $param);
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        // $this->db->where('tbl_surat_masuk.surat_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_disposisi.disposisi_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->or_where('tbl_disposisi.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi');
    }
    public function countAllSuratPerintah($param)
    {
        $this->db->where('tbl_surat_perintah.date_produce', $param);
        $this->db->where('tbl_surat_perintah.perintah_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.detail_penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->group_by('tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_disposisi');
    }
     public function countSuratPerintah($param)
    {
        $this->db->where('tbl_surat_perintah.date_produce', $param);
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.detail_penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->group_by('tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_disposisi');
    }
    public function countDisposisi($param)
    {
        $this->db->where('tbl_disposisi.date_produce', $param);
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi');
    }
      public function countSuratMasuk($param)
    {
        $this->db->where('tbl_surat_masuk.date_produce', $param);
        $this->db->where('tbl_surat_masuk.penangguhan !=', '1');
        $this->db->where('tbl_surat_masuk.bukan_penerima_surat !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        array(
            $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja')),
            $this->db->or_where('tbl_daftar_penerima_surat_masuk.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'))
        );
        $this->db->join('tbl_daftar_penerima_surat_masuk', 'tbl_daftar_penerima_surat_masuk.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->group_by('tbl_surat_masuk.nomor_surat');
        return $this->db->get('tbl_surat_masuk');
    }
       public function countNotaDinas($param)
    {
        $this->db->where('tbl_nota_dinas.date_produce', $param);
        $this->db->where('tbl_nota_dinas.penerima_nota', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_nota_dinas.penulis', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_tembusan.penerima_tembusan', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_detail_tembusan', 'tbl_detail_tembusan.tembusan = tbl_nota_dinas.tembusan');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_nota_dinas.penerima_nota', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_tembusan.penerima_tembusan');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->order_by('tbl_detail_tembusan.id', 'DESC');
        $this->db->group_by('tbl_detail_tembusan.tembusan');
        return $this->db->get('tbl_nota_dinas');
    }
    public function countSampah($param)
    {
        $this->db->where('tbl_surat_masuk.date_produce', $param);
        $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->where('tbl_surat_masuk.penangguhan', '1');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_masuk.agendaris_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        return $this->db->get('tbl_surat_masuk');
    }
    public function savearsip($data, $param)
    {
        // update tabel nota dinas
        $this->db->where('slug_nota', $param);
        $this->db->update('tbl_nota_dinas', array('arsip' => '1'));

        // insert arsip
        return $this->db->insert('tbl_arsip', $data);
    }
    public function getNotaDinasForArsip($param){
        $this->db->where('nomor_nota_dinas', $param);
        $this->db->where('nota_dinas_instansi', $this->session->userdata('sisule_cms_instansi'));
        return $this->db->get('tbl_nota_dinas');
    }
    public function getStatusArsip($param){
        $this->db->where('slug_arsip', $param);
        return $this->db->get('tbl_arsip');
    }
}