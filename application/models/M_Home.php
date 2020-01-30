<?php

class M_Home extends CI_Model
{
    public function checkSessionLogin($data)
    {
        $this->db->where('nomor_session', $data);
        return $this->db->get('tbl_session_login');
    }
    // count
    public function countSuratMasuk()
    {
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
    public function countDisposisi()
    {
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
    public function countAllDisposisi()
    {
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        // $this->db->where('tbl_surat_masuk.surat_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_disposisi.disposisi_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->or_where('tbl_disposisi.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi');
    }
    public function countNotaDinas()
    {
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
    public function countAgenda()
    {
        $this->db->where('nomor_agenda', '');
        return $this->db->get('tbl_disposisi');
    }
    public function countSuratPerintah()
    {
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
    public function countAllSuratPerintah()
    {
        $this->db->where('tbl_surat_perintah.perintah_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.detail_penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->group_by('tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_disposisi');
    }
    public function countSampah()
    {
        $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->where('tbl_surat_masuk.penangguhan', '1');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_masuk.agendaris_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        return $this->db->get('tbl_surat_masuk');
    }
    public function countArsip(){
        $this->db->where('arsip_instansi', $this->session->userdata('sisule_cms_instansi'));
        return $this->db->get('tbl_arsip');
    }
    public function countMailSampah($param)
    {
        $cek = $this->db->get_where('tbl_login', array('nip' => $param))->result();
        if ($cek != null) {
            $cek = $cek[0]->id_instansi;
            return $this->db->get_where('tbl_sampah', array('id_instansi' => $cek, 'agendaris_surat' => $param));
        } else {
            return 0;
        }
    }
    public function countPejabatStruktural()
    {
        $this->db->select('count(tbl_karyawan.nip) as tonip');
        $this->db->from('tbl_karyawan');
        $this->db->where('tipe', 'struktural');
        $this->db->join('tbl_bidang', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get();
    }
    public function countPejabatPelaksana()
    {
        $this->db->select('count(tbl_karyawan.nip) as tonip');
        $this->db->from('tbl_karyawan');
        $this->db->where('tipe', 'pelaksana');
        $this->db->join('tbl_bidang', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get();
    }
    // baris
    public function getBarisSuratMasuk()
    {
        $this->db->where('tbl_surat_masuk.penangguhan !=', '1');
        $this->db->where('tbl_surat_masuk.bukan_penerima_surat !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        array(
            $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja')),
            $this->db->or_where('tbl_daftar_penerima_surat_masuk.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'))
        );
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_masuk.agendaris_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_daftar_penerima_surat_masuk', 'tbl_daftar_penerima_surat_masuk.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        $this->db->group_by('tbl_surat_masuk.nomor_surat');
        return $this->db->get('tbl_surat_masuk')->num_rows();
    }
    public function getBarisDisposisi()
    {
        $this->db->select('*');
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
        return $this->db->get('tbl_disposisi')->num_rows();
    }
    public function getBarisNotaDinas()
    {
        $this->db->select('*');
        $this->db->from('tbl_nota_dinas');
        $this->db->where('tbl_nota_dinas.penerima_nota', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_nota_dinas.penulis', $this->session->userdata('sisuel_cms_satuan_kerja'));
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
        return $this->db->get()->num_rows();
    }
    public function getBarisKaryawan()
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_bidang', 'tbl_bidang.id_instansi = tbl_karyawan.id_instansi');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_karyawan.id_instansi');
        $this->db->order_by('golongan', 'desc');
        $this->db->group_by('tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan')->num_rows();
    }
    public function getBarisBidang()
    {
        $this->db->select('*');
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->from('tbl_karyawan');
        $this->db->join('tbl_bidang', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get()->num_rows();
    }
    public function getBarisSuratPerintah()
    {
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_nip'));
        $this->db->or_where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_nip'));
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.detail_penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->order_by('tbl_surat_perintah.id', 'desc');
        $this->db->group_by('tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_disposisi')->num_rows();
    }
    // surat masuk
    public function getSuratMasuk($param)
    {
        return $this->db->get_where('tbl_surat_masuk', array('slug_surat' => $param));
    }

    public function getAllSuratMasuk($perPage, $start)
    {
        $this->db->where('tbl_surat_masuk.penangguhan !=', '1');
        $this->db->where('tbl_surat_masuk.bukan_penerima_surat !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        array(
            $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja')),
            $this->db->or_where('tbl_daftar_penerima_surat_masuk.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'))
        );
        $this->db->join('tbl_daftar_penerima_surat_masuk', 'tbl_daftar_penerima_surat_masuk.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_masuk.agendaris_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        $this->db->group_by('tbl_surat_masuk.nomor_surat');
        return $this->db->get('tbl_surat_masuk', $perPage, $start);
    }
    public function getPembuatSuratMasuk()
    {
        $this->db->where('tbl_surat_masuk.penangguhan !=', '1');
        $this->db->join('tbl_daftar_penerima_surat_masuk', 'tbl_daftar_penerima_surat_masuk.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_masuk.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        $this->db->group_by('tbl_surat_masuk.nomor_surat');
        return $this->db->get('tbl_surat_masuk');
    }
    public function getAgendarisSuratMasuk()
    {
        $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_masuk.agendaris_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_daftar_penerima_surat_masuk', 'tbl_daftar_penerima_surat_masuk.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        $this->db->group_by('tbl_surat_masuk.nomor_surat');
        return $this->db->get('tbl_surat_masuk');
    }
    public function getPenerimaSuratMasuk()
    {
        $this->db->where('tbl_surat_masuk.penangguhan !=', '1');
        $this->db->where('tbl_surat_masuk.bukan_penerima_surat !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        array(
            $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja')),
            $this->db->or_where('tbl_daftar_penerima_surat_masuk.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'))
        );
        $this->db->join('tbl_daftar_penerima_surat_masuk', 'tbl_daftar_penerima_surat_masuk.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_daftar_penerima_surat_masuk.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        $this->db->group_by('tbl_surat_masuk.nomor_surat');
        return $this->db->get('tbl_surat_masuk');
    }
    public function listPenerimaSuratMasuk()
    {
        $this->db->select('*');
        $this->db->from('tbl_karyawan');
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.tipe', 'struktural');
        $this->db->where('tbl_bidang.top', '1');
        $this->db->where('tbl_karyawan.nip !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_bidang', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_karyawan.golongan', 'desc');
        return $this->db->get();
    }
    // disposisi
    public function infoPembuatDisposisi()
    {
        $this->db->select('*');
        $this->db->from('tbl_karyawan');
        $this->db->where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_disposisi', 'tbl_karyawan.nip = tbl_disposisi.pembuat_disposisi');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        return $this->db->get();
    }
    public function getAllSuratDisposisiForPembuat($perPage, $start)
    {
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi', $perPage, $start);
    }

    public function getAllSuratDisposisiForAgendaris($perPage, $start)
    {
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_disposisi.disposisi_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->or_where('tbl_disposisi.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi', $perPage, $start);
    }
    public function getDisposisiAgendaris($perPage, $start)
    {
        $this->db->select('*');
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_surat_masuk.surat_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi', $perPage, $start);
    }
    public function getPenerimaDisposisi()
    {
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_detail_penerima_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi');
    }
    public function getStatusPenerimaSuratDisposisi()
    {
        $this->db->select('*');
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi');
    }

    public function getPembuatDisposisi()
    {
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_disposisi.disposisi_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi');
    }
    public function getAllPembuatDisposisi()
    {
        $this->db->select('*');
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_disposisi.disposisi_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->or_where('tbl_disposisi.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_disposisi');
    }

    public function getAllSuratDisposisiForPenerima()
    {
        $this->db->select('*');
        $this->db->from('tbl_disposisi');
        $this->db->where('tbl_disposisi.nomor_agenda != ', '');
        $this->db->where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_disposisi.penerima = tbl_detail_penerima_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_disposisi.id', 'desc');
        $this->db->order_by('tbl_karyawan.golongan', 'DESC');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get();
    }
    public function getAllSuratDisposisiNeededAgenda()
    {
        $this->db->select('*');
        $this->db->from('tbl_disposisi');
        $this->db->where('nomor_agenda', '');
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->distinct();
        return $this->db->get();
    }
    public function getBidangForNotaDinas($param)
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.nip !=', '0');
        $this->db->where('tbl_bidang.top', '1');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $this->db->order_by('kode_bidang', 'asc');
        $this->db->group_by('tbl_bidang.id');
        return $this->db->get('tbl_bidang');
    }
    public function getBidangPenerimaNotaDinas($param){
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_surat_masuk.slug_surat', $param);
        $this->db->where('tbl_bidang.nip !=', '0');
        $this->db->where('tbl_bidang.top', '1');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $this->db->join('tbl_nota_dinas', 'tbl_nota_dinas.nota_dinas_instansi = tbl_instansi.id_instansi');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->order_by('kode_bidang', 'asc');
        $this->db->group_by('tbl_bidang.id');
        return $this->db->get('tbl_bidang');
    }
    public function getInfoFileDisposisi($param)
    {
        $this->db->where('slug_surat',  $param);
        return $this->db->get('tbl_disposisi');
    }
    // surat perintah
    public function getSuratPerintah($perPage, $start)
    {
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_perintah.detail_penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_perintah.id', 'desc');
        $this->db->group_by('tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_disposisi', $perPage, $start);
    }
    public function getAllSuratPerintah($perPage, $start)
    {
        $this->db->where('tbl_surat_perintah.perintah_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_disposisi', 'tbl_disposisi.penerima = tbl_surat_perintah.detail_penerima');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_perintah.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_perintah.id', 'desc');
        $this->db->group_by('tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_surat_perintah', $perPage, $start);
    }
    public function getPembuatSuratPerintah()
    {
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_perintah.id', 'desc');
        $this->db->group_by('tbl_surat_perintah.no_perintah');
        return $this->db->get('tbl_disposisi');
    }
    public function getAllPembuatSuratPerintah()
    {
        $this->db->where('tbl_disposisi.pembuat_disposisi !=', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_disposisi.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_surat_perintah', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_disposisi.pembuat_disposisi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_perintah.id', 'desc');
        return $this->db->get('tbl_disposisi');
    }
    public function getPenerimaSuratPerintah()
    {
        $this->db->where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_disposisi.pembuat_disposisi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_perintah.nomor_surat');
        $this->db->join('tbl_disposisi', 'tbl_surat_perintah.detail_penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_detail_penerima_disposisi.id', 'desc');
        return $this->db->get('tbl_surat_perintah');
    }
    // nota dinas
    public function getNotaDinas($perPage, $start)
    {
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
        $this->db->group_by('tbl_nota_dinas.nomor_nota_dinas');
        return $this->db->get('tbl_nota_dinas', $perPage, $start);
    }
    public function getInfoNotaDinas($param)
    {
        $this->db->where('tbl_disposisi.slug_surat', $param);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        return $this->db->get('tbl_nota_dinas');
    }
    public function getPenulisNotaDinas()
    {
        $this->db->where('tbl_nota_dinas.penerima_nota', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_nota_dinas.penulis', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_tembusan.penerima_tembusan', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_detail_tembusan', 'tbl_detail_tembusan.tembusan = tbl_nota_dinas.tembusan');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_detail_penerima_disposisi.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->order_by('tbl_detail_tembusan.id', 'DESC');
        $this->db->group_by('tbl_nota_dinas.nomor_nota_dinas');
        return $this->db->get('tbl_nota_dinas');
    }
    public function getPembuatNotaDinas()
    {
        $this->db->where('tbl_nota_dinas.penerima_nota', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_nota_dinas.pembuat_nota', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_tembusan.penerima_tembusan', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->or_where('tbl_detail_penerima_disposisi.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_detail_tembusan', 'tbl_detail_tembusan.tembusan = tbl_nota_dinas.tembusan');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_detail_penerima_disposisi', 'tbl_detail_penerima_disposisi.penerima = tbl_disposisi.penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_nota_dinas.pembuat_nota');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->order_by('tbl_detail_tembusan.id', 'DESC');
        $this->db->group_by('tbl_nota_dinas.nomor_nota_dinas');
        return $this->db->get('tbl_nota_dinas');
    }
    public function getLampiranNotaDinas($param)
    {
        // get slug nota
        $nomor_agenda = $this->db->get_where('tbl_disposisi', array('slug_surat' => $param))->result();
        $nomor = null;
        if ($nomor_agenda != null) {
            $nomor = $nomor_agenda[0]->nomor_agenda;
        }
        $this->db->where('tbl_nota_dinas.nomor_agenda', $nomor);
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_file_nota_dinas', 'tbl_nota_dinas.nomor_nota_dinas = tbl_file_nota_dinas.nomor_nota_dinas');
        return $this->db->get_where('tbl_nota_dinas');
    }
    // sampah
    public function getSuratMasukDitangguhkan()
    {
        $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->where('tbl_surat_masuk.penangguhan', '1');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_masuk.agendaris_surat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        return $this->db->get('tbl_surat_masuk');
    }
    public function getPenerimaSuratMasukDitangguhkan()
    {
        $this->db->where('tbl_surat_masuk.agendaris_surat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->where('tbl_surat_masuk.penangguhan', '1');
        $this->db->join('tbl_daftar_penerima_surat_masuk', 'tbl_daftar_penerima_surat_masuk.nomor_surat = tbl_surat_masuk.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_daftar_penerima_surat_masuk.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_surat_masuk.id', 'desc');
        return $this->db->get('tbl_surat_masuk');
    }
    //pengagendaan surat
    public function getAgendaSurat($param)
    {
        $this->db->where('slug_surat', $param);
        return $this->db->get('tbl_disposisi');
    }
    // pejabat
    public function getProfilPejabat($param)
    {
        $this->db->where('tbl_karyawan.nip', $param);
        $this->db->join('tbl_login', 'tbl_login.nip = tbl_karyawan.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_login.id_instansi');
        return $this->db->get('tbl_karyawan');
    }
    public function getBidangKaryawan($param)
    {
        $this->db->where('tbl_karyawan.nip', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan');
    }
    public function getInfoAgendaris($param)
    {
        $this->db->where('kode_struktur_organisasi', $param);
        $this->db->where('agendaris', '1');
        return $this->db->get('tbl_bidang');
    }
    // organisasi
    public function getInstansi($perPage, $start)
    {
        $this->db->order_by('id_instansi', 'desc');
        return $this->db->get('tbl_instansi', $perPage, $start);
    }
    public function getInstansiProfilKaryawan($param)
    {
        $this->db->where('tbl_login.nip', $param);
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_login.id_instansi');
        return $this->db->get('tbl_login');
    }
    public function countInstansi()
    {
        return $this->db->get('tbl_instansi');
    }
    public function getDetailInstansi()
    {
        $this->db->where('tbl_login.nip', $this->session->userdata('sisule_cms_nip'));
        $this->db->join('tbl_login', 'tbl_login.id_instansi = tbl_instansi.id_instansi');
        return $this->db->get('tbl_instansi');
    }
    // bidang
    public function getBidangAsAdmin($perPage, $start)
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->order_by('tbl_bidang.kode_bidang', 'ASC');
        $this->db->order_by('tbl_bidang.jumlah_atasan   ', 'ASC');
        return $this->db->get('tbl_bidang', $perPage, $start);
    }
    public function countBidang()
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $this->db->group_by('tbl_bidang.kode_struktur_organisasi');
        return $this->db->get('tbl_bidang');
    }
    public function getStatusUserAsAgendaris()
    {
        return $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $this->session->userdata('sisule_cms_satuan_kerja'), 'agendaris' => '1'));
    }
    // karyawan
    public function getKaryawan($perPage, $start)
    {
        $this->db->select('tbl_karyawan.nama, tbl_karyawan.nip, tbl_karyawan.image, tbl_karyawan.pangkat, tbl_karyawan.golongan, tbl_instansi.singkatan, tbl_karyawan.slug, tbl_karyawan.aktifasi_app');
        $this->db->where('tbl_login.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_karyawan.id_instansi');
        $this->db->join('tbl_login', 'tbl_login.id_instansi = tbl_instansi.id_instansi');
        $this->db->order_by('tbl_karyawan.golongan', 'desc');
        $this->db->order_by('tbl_karyawan.nama', 'asc');
        $this->db->group_by('tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan', $perPage, $start);
    }
    public function countKaryawan()
    {
        $this->db->where('tbl_login.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_login', 'tbl_login.id_instansi = tbl_karyawan.id_instansi');
        $this->db->group_by('tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan');
    }
    public function getUser($perPage, $start)
    {
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_login.nip');
        $this->db->join('tbl_karyawan', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        return $this->db->get('tbl_login', $perPage, $start);
    }
    public function getDetailUser($param)
    {
        $this->db->where('user_id', $param);
        return $this->db->get('tbl_login');
    }
    public function getDetailUserTanpaInstansi($param)
    {
        $this->db->where('user_id', $param);
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_login.id_instansi');
        return $this->db->get('tbl_login');
    }
    public function getKaryawanPengangguran()
    {
        $query = $this->db->query('SELECT *
        FROM tbl_karyawan
        WHERE id_instansi = ' . $this->session->userdata('sisule_cms_instansi') . ' AND
        nip NOT IN (SELECT nip FROM tbl_bidang)  
        ORDER BY `tbl_karyawan`.`golongan` DESC,
        `tbl_karyawan`.`nama` ASC
        ');
        return $query;
    }
    public function getPejabatStruktural()
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.tipe', 'struktural');
        array(
            $this->db->where('tbl_bidang.jumlah_atasan', '1'),
            $this->db->or_where('tbl_bidang.jumlah_atasan', '0')   
        );
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_karyawan.id_instansi');
        $this->db->order_by('tbl_bidang.kode_bidang', 'ASC');
        $this->db->group_by('tbl_bidang.kode_struktur_organisasi');
        return $this->db->get('tbl_bidang');
    }
    public function getStatusNullBidangKerja()
    {
        $this->db->where('id_instansi', $this->session->userdata('sisule_cms_instansi'));
        return $this->db->get('tbl_bidang');
    }
    public function getPejabatStrukturalAvailable()
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.tipe', 'struktural');
        array(
            $this->db->where('tbl_bidang.jumlah_atasan', '1'),
            $this->db->or_where('tbl_bidang.jumlah_atasan', '0')
        );
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_karyawan.id_instansi');
        $this->db->order_by('tbl_bidang.kode_bidang', 'ASC');
        $this->db->group_by('tbl_bidang.kode_struktur_organisasi');
        return $this->db->get('tbl_bidang');
    }
    // user app
    public function getCountUser()
    {
        return $this->db->get('tbl_login');
    }

    public function getInforLogin($param)
    {
        $this->db->where('nip', $param);
        return $this->db->get('tbl_login');
    }
    // logout
    public function sess_destroy($param)
    {
        $data = array(
            'status' => '0'
        );
        $this->db->where('nomor_session', $param);
        return $this->db->update('tbl_session_login', $data);
    }
    public function getBidangKosong()
    {
        $this->db->where('tbl_login.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_bidang.nip', '0');
        $this->db->join('tbl_login', 'tbl_bidang.id_instansi = tbl_login.id_instansi');
        $this->db->order_by('tbl_bidang.nama_bidang', 'ASC');
        $this->db->group_by('tbl_bidang.kode_struktur_organisasi');
        return $this->db->get('tbl_bidang');
    }
    public function getInstansiTanpaUser()
    {
        $query = $this->db->query('SELECT *
        FROM tbl_instansi
        WHERE id_instansi NOT IN (SELECT id_instansi FROM tbl_login)  
        ORDER BY `tbl_instansi`.`id_instansi` ASC');
        return $query;
    }
    public function infoInstansi($param)
    {
        return $this->db->get_where('tbl_instansi', array('id_instansi' => $param));
    }
    public function getInfoInstansi()
    {
        return $this->db->get_where('tbl_instansi', array('id_instansi' => $this->session->userdata('sisule_cms_instansi')));
    }
    public function unregisteredUser()
    {
        $this->db->select('tbl_login.username, tbl_login.nip, tbl_login.hak, tbl_login.user_id');
        $this->db->where('tbl_karyawan.nip', null);
        $this->db->join('tbl_login', 'tbl_login.nip = tbl_karyawan.nip', 'right');
        $this->db->group_by('tbl_login.user_id');
        $this->db->order_by('tbl_login.no', 'asc');
        return $this->db->get('tbl_karyawan');
    }

    public function getSuratKeluarForPembuat($param)
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_daftar_penerima_surat_keluar', 'tbl_daftar_penerima_surat_keluar.penerima = tbl_surat_keluar.daftar_penerima');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_daftar_penerima_surat_keluar.nip');
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_instansi.id_instansi');
        $this->db->group_by('tbl_surat_keluar.nomor_surat_keluar');
        $this->db->order_by('tbl_surat_keluar.id_surat_keluar', 'DESC');
        return $this->db->get('tbl_surat_keluar');
    }
    public function getSuratKeluar($param)
    {
        return $this->db->get_where('tbl_surat_keluar', array('slug_surat' => $param));
    }
    public function getPenerimaSuratKeluar($param)
    {
        $penerima = $this->db->get_where('tbl_surat_keluar', array('slug_surat' => $param))->result();
        $penerima_surat = null;
        if ($penerima != null) {
            $penerima_surat = $penerima[0]->daftar_penerima;
        }
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_daftar_penerima_surat_keluar.kode_struktur_organisasi');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        return $this->db->get_where('tbl_daftar_penerima_surat_keluar', array('penerima' => $penerima_surat));
    }
    public function getPembuatSuratKeluar($param)
    {
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_surat_keluar.pembuat');
        return $this->db->get_where('tbl_surat_keluar', array('slug_surat' => $param));
    }
    public function getSuratKeluarForStakeholder()
    {
        $this->db->where('tbl_bidang.agendaris', '1');
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->join('tbl_surat_keluar', 'tbl_surat_keluar.pembuat = tbl_karyawan.nip');
        $this->db->group_by('tbl_bidang.nip');
        return $this->db->get('tbl_karyawan');
    }
    public function getAtasanPembuatSuratKeluar()
    {
        $this->db->$this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        $this->db->group_by('tbl_bidang.nip');
        return $this->db->get('tbl_karyawan');
    }
    public function getcreatorsuratkeluar()
    {
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_instansi.id_instansi');
        $this->db->group_by('tbl_surat_keluar.nomor_surat_keluar');
        $this->db->order_by('tbl_surat_keluar.id_surat_keluar', 'DESC');
        return $this->db->get('tbl_surat_keluar');
    }
    public function getAllSuratKeluar()
    {
        // atasan
        $this->db->where('tbl_surat_keluar.pembuat', $this->session->userdata('sisule_cms_satuan_kerja'));
        // $this->db->join('tbl_daftar_penerima_surat_keluar', 'tbl_daftar_penerima_surat_keluar.penerima = tbl_surat_keluar.daftar_penerima');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_surat_keluar.id_instansi');
        $this->db->group_by('tbl_surat_keluar.nomor_surat_keluar');
        $this->db->order_by('tbl_surat_keluar.id_surat_keluar', 'DESC');
        return $this->db->get('tbl_surat_keluar');
    }
    public function getPembuatSurat()
    {
        $this->db->where('tbl_karyawan.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->where('tbl_surat_keluar.pembuat', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_karyawan.id_instansi');
        return $this->db->get('tbl_surat_keluar');
    }
    public function getAgendaris()
    {
        $this->db->where('tbl_bidang.kode_struktur_organisasi', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->where('tbl_bidang.agendaris', '1');
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan');
    }
    public function getInfoPembuatSuratKeluar()
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_instansi.id_instansi');
        $this->db->group_by('tbl_surat_keluar.nomor_surat_keluar');
        $this->db->order_by('tbl_surat_keluar.id_surat_keluar', 'DESC');
        return $this->db->get('tbl_surat_keluar');
    }
    public function getInfoAtasanPembuatSuratKeluar()
    {
        $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_surat_keluar.pembuat');
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
        $this->db->group_by('tbl_surat_keluar.nomor_surat_keluar');
        $this->db->order_by('tbl_surat_keluar.id_surat_keluar', 'DESC');
        return $this->db->get('tbl_surat_keluar');
    }
    public function getJumlahMaxAtasan()
    {

        $kode = $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $this->session->userdata('sisule_cms_satuan_kerja')))->result();
        $kode_bidang = null;
        if ($kode != null) {
            $kode_bidang = $kode[0]->kode_bidang;
        }
        $this->db->where('kode_bidang', $kode_bidang);
        $this->db->limit(1);
        $this->db->order_by('tbl_bidang.jumlah_atasan', 'DESC');
        return $this->db->get_where('tbl_bidang', array('id_instansi' => $this->session->userdata('sisule_cms_instansi')));
    }
    public function cariPenerimaDisposisi()
    {
        $atasan =  $this->db->get_where('tbl_bidang', array('kode_struktur_organisasi' => $this->session->userdata('sisule_cms_satuan_kerja')))->result();
        $kode_bidang = 0;
        $jumlah_atasan = 0;
        if ($atasan > 0) {
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
    public function getInfoDetailAtasanPembuatSuratKeluar($param)
    {
        $this->db->where('tbl_surat_keluar.slug_surat', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_surat_keluar.pembuat');
        return $this->db->get('tbl_surat_keluar');
    }
    public function getInfoAgendarisUser($param)
    {
        return $this->db->get_where('tbl_bidang', array('nip' => $param));
    }
    public function checkStatusKaryawan()
    {
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        return $this->db->get_where('tbl_karyawan', array('tbl_karyawan.nip' => $this->session->userdata('sisule_cms_nip')));
    }
    public function getSuratKeluarMasuk($param)
    {
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_surat_keluar.nomor_surat_keluar');
        return $this->db->get_where('tbl_surat_keluar', array('tbl_surat_keluar.slug_surat' => $param));
    }
    public function getArsip($perPage, $start){
        $this->db->where('arsip_instansi', $this->session->userdata('sisule_cms_instansi'));
        $this->db->join('tbl_nota_dinas', 'tbl_nota_dinas.nomor_nota_dinas = tbl_arsip.nomor_nota_dinas');
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->join('tbl_bidang', 'tbl_bidang.kode_struktur_organisasi = tbl_nota_dinas.pembuat_nota');
        return $this->db->get('tbl_arsip', $perPage, $start);
    }
    public function getUnArsipNotaDinas(){
        $this->db->where('tbl_nota_dinas.arsip', 0);
        $this->db->where('tbl_nota_dinas.pembuat_nota', $this->session->userdata('sisule_cms_satuan_kerja'));
        $this->db->join('tbl_disposisi', 'tbl_disposisi.nomor_agenda = tbl_nota_dinas.nomor_agenda');
        $this->db->join('tbl_surat_masuk', 'tbl_surat_masuk.nomor_surat = tbl_disposisi.nomor_surat');
        $this->db->group_by('tbl_disposisi.nomor_agenda');
        return $this->db->get('tbl_nota_dinas');
    }
}