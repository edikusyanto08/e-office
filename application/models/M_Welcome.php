<?php

class M_Welcome extends CI_Model
{
    public function login()
    {
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $where = array(
            'username'  => $username,
            'password'  => md5($password)
        );
        $this->db->where($where);
        return $this->db->get('tbl_login');
    }
    public function checkCaptcha()
    {
        $userdata = $this->session->userdata('captchaword');
        $data = array(
            'captcha_time'  => $userdata['time'],
            'ip_address'    => $_SERVER['REMOTE_ADDR'],
            'word'          => $userdata['word']
        );
        return $this->db->insert('captcha', $data);
    }

    public function writeSessionLogin($param)
    {
        $nomor_session = rand();
        $bulan = date("m/d/Y");
        $bulan = substr($bulan, 1, 1);
        switch ($bulan) {
            case '1':
                $bulan = 'januari';
                break;
            case '2':
                $bulan = 'februari';
                break;
            case '3':
                $bulan = 'maret';
                break;
            case '4':
                $bulan = 'april';
                break;
            case '5':
                $bulan = 'mei';
                break;
            case '6':
                $bulan = 'juni';
                break;
            case '7':
                $bulan = 'juli';
                break;
            case '8':
                $bulan = 'agustus';
                break;
            case '9':
                $bulan = 'september';
                break;
            case '10':
                $bulan = 'oktober';
                break;
            case '11':
                $bulan = 'november';
                break;
            case '12':
                $bulan = 'desember';
                break;
        }
        $array = array(
            'nomor_session' => $nomor_session,
            'nip'           => $param,
            'bulan'         => $bulan,
            'status'        => '1'
        );
        $this->db->insert('tbl_session_login', $array);
        $this->db->where('nomor_session', $nomor_session);
        return $this->db->get('tbl_session_login');
    }
    public function resetSession($param)
    {
        $data = array(
            'status' => 0
        );
        $this->db->where('nip', $param);
        return $this->db->update('tbl_session_login',  $data);
    }
    public function getInfoOrganisasi()
    {
        return $this->db->get('tbl_organisasi');
    }
    public function checkagendaris($param){
        $this->db->where('tbl_karyawan.nip', $param);
        $this->db->join('tbl_bidang', 'tbl_bidang.nip = tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan');
    }
}