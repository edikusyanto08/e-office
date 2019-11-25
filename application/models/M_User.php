<?php

class M_User extends CI_Model
{
    public function listUser()
    {
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_login.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_login.id_instansi');
        $this->db->order_by('tbl_instansi.id_instansi', 'asc');
        $this->db->order_by('tbl_karyawan.golongan', 'desc');
        return $this->db->get('tbl_login', 10);
    }
    public function listUserTanpaInstansi()
    {
        $this->db->where('tbl_karyawan.nama', null);
        $this->db->join('tbl_login', 'tbl_karyawan.nip = tbl_login.nip', 'right outer');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_login.id_instansi');
        $this->db->order_by('tbl_login.no', 'desc');
        $this->db->group_by('tbl_login.nip');
        return $this->db->get('tbl_karyawan', 10);
    }
    public function getBarisUser()
    {
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_login.nip');
        return $this->db->get('tbl_login')->num_rows();
    }
    public function getBarisUserTanpaInstansi()
    {
        $this->db->join('tbl_login', 'tbl_login.nip = tbl_karyawan.nip');
        return $this->db->get('tbl_karyawan')->num_rows();
    }
    public function buatUser()
    {
        $user_id    = rand();
        $nip        = $this->input->post('nip');
        $nip        = str_replace(" ", "", $nip);
        $nip1       = substr($nip, 0, 8);
        $nip2       = substr($nip, 8, 6);
        $nip3       = substr($nip, 14, 1);
        $nip4       = substr($nip, 15, 3);
        $nip_final  = $nip1 . " " . $nip2 . " " . $nip3 . " " . $nip4;
        $username   = $this->input->post('username');
        $username   = str_replace(" ", "_", $username);
        $password   = $this->input->post('password');
        $instansi   = $this->input->post('instansi');
        $hak        = $this->input->post('hak');
        if ($instansi == "0" || $hak == "null") {
            return null;
        } else {
            $data = array(
                'user_id'       => $user_id,
                'nip'           => $nip_final,
                'username'      => $username,
                'password'      => md5($password),
                'id_instansi'   => $instansi,
                'hak'           => $hak
            );
            return $this->db->insert('tbl_login', $data);
        }
    }
    public function updateUser($param)
    {
        $default    = $this->input->post('nip_asal');
        $nip        = $this->input->post('nip');
        $nip        = str_replace(" ", "", $nip);
        $nip1       = substr($nip, 0, 8);
        $nip2       = substr($nip, 8, 6);
        $nip3       = substr($nip, 14, 1);
        $nip4       = substr($nip, 15, 3);
        $nip_final  = $nip1 . " " . $nip2 . " " . $nip3 . " " . $nip4;
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');

        $cek = $this->db->get_where('tbl_login', array('nip' => $default))->result();
        if ($cek == null) {
            return null;
        } elseif ($nip != $default) {
            if ($this->input->post('checkpassword') > 0) {
                $data = array(
                    'nip'       => $nip_final,
                    'username'  => $username,
                    'password'  => md5($password)
                );
            } else {
                $data = array(
                    'nip'       => $nip_final,
                    'username'  => $username
                );
            }
            $this->db->where('user_id', $param);
            return $this->db->update('tbl_login', $data);
        } else {
            if ($this->input->post('checkpassword') > 0) {
                $data = array(
                    'username'  => $username,
                    'password'  => md5($password)
                );
            } else {
                $data = array(
                    'username'  => $username
                );
            }
            $this->db->where('user_id', $param);
            return $this->db->update('tbl_login', $data);
        }
    }
    public function hapusUser($param)
    {
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_login.nip');
        $cek = $this->db->get_where('tbl_login', array('tbl_login.user_id' => $param))->result();
        if ($cek != null) {
            $this->db->where('nip', $cek[0]->nip);
            $this->db->update('tbl_karyawan', array('aktifasi_app' => '0'));
        }
        $this->db->where('user_id', $param);
        return $this->db->delete('tbl_login');
    }
    public function cariuser($param)
    {
        $this->db->like('tbl_karyawan.nama', $param);
        $this->db->or_like('tbl_karyawan.nip', $param);
        $this->db->or_like('tbl_instansi.nama_instansi', $param);
        $this->db->or_like('tbl_instansi.singkatan', $param);
        $this->db->join('tbl_karyawan', 'tbl_karyawan.nip = tbl_login.nip');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_login.id_instansi');
        $this->db->order_by('tbl_instansi.id_instansi', 'asc');
        $this->db->order_by('tbl_karyawan.golongan', 'desc');
        return $this->db->get('tbl_login', 10);
    }
    public function cariuserunregistered($param)
    {
        $this->db->like('tbl_instansi.nama_instansi', $param);
        $this->db->where('tbl_karyawan.nama', null);
        $this->db->join('tbl_login', 'tbl_karyawan.nip = tbl_login.nip', 'right');
        $this->db->join('tbl_instansi', 'tbl_instansi.id_instansi = tbl_login.id_instansi');
        $this->db->order_by('tbl_login.no', 'desc');
        return $this->db->get('tbl_karyawan', 10);
    }
}