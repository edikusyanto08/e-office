<?php

class M_Bidang extends  CI_Model
{
    public function getBidang($param)
    {
        $this->db->where('id', $param);
        $check = $this->db->get_where('tbl_bidang', array('nip' => '0'))->result();
        if (count($check) > 0) {
            $this->db->where('id', $param);
            return $this->db->get('tbl_bidang');
        } else {
            $this->db->select('*');
            $this->db->from('tbl_bidang');
            $this->db->where('tbl_bidang.id', $param);
            $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.nip');
            return $this->db->get();
        }
    }
    public function getAtasan($param)
    {
        $this->db->where('id', $param);
        $check = $this->db->get_where('tbl_bidang', array('nip' => '0'))->result();
        if (count($check) > 0) {
            $this->db->select('*');
            $this->db->from('tbl_bidang');
            $this->db->where('tbl_bidang.id', $param);
            $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.atasan');
            return $this->db->get();
        } else {
            $this->db->select('*');
            $this->db->from('tbl_bidang');
            $this->db->where('tbl_bidang.id', $param);
            $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_bidang.atasan');
            return $this->db->get();
        }
    }
    public function addBidang()
    {
        $nama           = $this->input->post('nama');
        $tipe           = $this->input->post('tipe');
        $koordinator    = $this->input->post('koordinator');
        $atasan         = $this->input->post('atasan');
        $kode_instansi = $this->session->userdata('sisule_cms_instansi');
        $this->db->where('tbl_bidang.id_instansi', $kode_instansi);
        $this->db->where('tbl_bidang.kode_struktur_organisasi', $atasan);
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $this->db->order_by('tbl_bidang.id', 'desc');
        $row_tbl = $this->db->get('tbl_bidang')->result();
        if ($row_tbl > 0) {
            $kode_user = substr($row_tbl[0]->kode_struktur_organisasi, 7) + 1;
        } else {
            $kode_user = 0;
        }
        $kba = 0;
        if ($atasan != 0) {
            $this->db->select('jumlah_atasan');
            $this->db->where('tbl_bidang.kode_struktur_organisasi', $atasan);
            $someone = $this->db->get('tbl_bidang')->result();
            $someone = $someone[0]->jumlah_atasan + 1;
            if ($someone < 0) {
                $kode_bidang = 0 . 1;
            } elseif ($someone == 1) {
                $this->db->where('tbl_bidang.id_instansi', $this->session->userdata('sisule_cms_instansi'));
                $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
                $this->db->group_by('tbl_bidang.kode_bidang');
                $kode_bidang = $this->db->get('tbl_bidang')->num_rows();
                if ($kode_bidang < 9) {
                    $kode_bidang =  $kode_bidang + 1;
                    $kode_bidang = 0 . $kode_bidang;
                } else {
                    $kode_bidang += 1;
                }
            } elseif ($someone > 1) {
                $this->db->select('kode_bidang');
                $this->db->where('tbl_bidang.kode_struktur_organisasi', $atasan);
                $kode_bidang = $this->db->get('tbl_bidang')->result();
                $kode_bidang = $kode_bidang[0]->kode_bidang;
            }
        } else {
            $someone = 0;
            $kode_bidang = 0 . 1;
        }
        $kode_struktur_organisasi = $kode_instansi . '-' . $kode_bidang . '-' . $kode_user;
        $data = array(
            'nama_bidang'   => $nama,
            'tipe'          => $tipe,
            'nip'           => $koordinator,
            'atasan'        => $atasan,
            'id_instansi'   => $this->session->userdata('sisule_cms_instansi'),
            'kode_bidang'   => $kode_bidang,
            'kode_struktur_organisasi'  => $kode_struktur_organisasi,
            'jumlah_atasan'             => $someone
        );
        return $this->db->insert('tbl_bidang', $data);
    }
    public function updatePejabatBidang($id)
    {
        // get koordinator sebelumnya 
        $koordinator_lama = null
        $k_lama = $this->db->get_where('tbl_bidang', array('id' => $id))->result();
        if($k_lama != null){
            $koordinator_lama = $k_lama[0]->kode_struktur_organisasi;
        }

        $agendaris          = $this->input->post('agendaris');
        $pimpinan           = $this->input->post('pimpinan');
        $koordinator_baru   = $this->input->post('koordinator');
        $atasan             = $this->input->post('atasan');
        $kode_instansi      = $this->session->userdata('sisule_cms_instansi');

        // get kode bidang
        $ko_bid_1 = null;
        if($atasan == 0){
            $this->db->where('tbl_bidang.kode_struktur_organisasi', $koordinator_lama);
        }else{
            $this->db->where('tbl_bidang.kode_struktur_organisasi', $atasan);
        }
        $this->db->order_by('tbl_bidang.id', 'desc');
        $ko_bid = $this->db->get('tbl_bidang', 1)->result();
        if($ko_bid != null){
            $ko_bid_1 = $ko_bid[0]->kode_bidang;
        }

        $this->db->where('tbl_bidang.id_instansi', $kode_instansi);
        $this->db->where('tbl_bidang.kode_bidang', $ko_bid_1);
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
        $row_tbl = $this->db->get('tbl_bidang')->result();
        if ($row_tbl > 0) {
            $kode_user = substr($row_tbl[0]->kode_struktur_organisasi, 7) + 1;
        } else {
            $kode_user = 0;
        }
        $kba = 0;
        if ($atasan != 0) {
            $this->db->select('jumlah_atasan');
            $this->db->where('tbl_bidang.kode_struktur_organisasi', $atasan);
            $someone = $this->db->get('tbl_bidang')->result();
            $someone = $someone[0]->jumlah_atasan + 1;
            if ($someone < 0) {
                $kode_bidang = 0 . 1;
            } elseif ($someone == 1) {
                $this->db->where('tbl_bidang.id_instansi', $instansi);
                $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_bidang.id_instansi');
                $this->db->group_by('tbl_bidang.kode_bidang');
                $kode_bidang = $this->db->get('tbl_bidang')->num_rows();
                if ($kode_bidang < 9) {
                    $kode_bidang =  $kode_bidang + 1;
                    $kode_bidang = 0 . $kode_bidang;
                } else {
                    $kode_bidang += 1;
                }
            } elseif ($someone > 1) {
                $this->db->select('kode_bidang');
                $this->db->where('tbl_bidang.kode_struktur_organisasi', $atasan);
                $kode_bidang = $this->db->get('tbl_bidang')->result();
                $kode_bidang = $kode_bidang[0]->kode_bidang;
            }
            
        } else {
            $someone = 0;
            $kode_bidang = 0 . 1;
        }
        $kode_struktur_organisasi = $kode_instansi . '-' . $kode_bidang . '-' . $kode_user;
        if ($this->input->post('update_koordinator') && $this->input->post('update_atasan')) {
            $data = array(
                'nip'       => $koordinator_baru,
                'top'       => $pimpinan,
                'agendaris' => $agendaris,
                'atasan'    => $atasan,
                'jumlah_atasan' => $someone,
                'kode_bidang'   => $kode_bidang,
                'kode_struktur_organisasi' => $kode_struktur_organisasi,
            );
        } elseif ($this->input->post('update_koordinator')) {
            $data = array(
                'nip'       => $koordinator_baru,
                'top'       => $pimpinan,
                'agendaris' => $agendaris
            );
        } elseif ($this->input->post('update_atasan')) {
            $data = array(
                'atasan'    => $atasan,
                'top'       => $pimpinan,
                'agendaris' => $agendaris,
                'jumlah_atasan' => $someone,
                'kode_bidang'   => $kode_bidang,
                'kode_struktur_organisasi' => $kode_struktur_organisasi,
            );
        } else {
            $data = array(
                'top'       => $pimpinan,
                'agendaris' => $agendaris
            );
        }
        $this->db->where('id', $id);
        return $this->db->update('tbl_bidang', $data);
    }
    public function updateBidangKerja($param)
    {
        $nama           = $this->input->post('nama');
        $tipe           = $this->input->post('tipe');
        $data = array(
            'nama_bidang'   => $nama,
            'tipe'          => $tipe
        );
        $this->db->where('id', $param);
        return $this->db->update('tbl_bidang', $data);
    }
    public function deleteBidangKerja($param)
    {
        return $this->db->delete('tbl_bidang', array('id' => $param));
    }
}