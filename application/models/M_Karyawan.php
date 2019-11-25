<?php

class M_Karyawan extends CI_Model
{
    public function checkImagePejabat($param)
    {
        return $this->db->get_where('tbl_karyawan', array('nip' => $param));
    }
    public function addKaryawan()
    {
        $nip    = $this->input->post('nip');
        $nip    = str_replace(" ", "", $nip);
        $nip1   = substr($nip, 0, 8);
        $nip2   = substr($nip, 8, 6);
        $nip3   = substr($nip, 14, 1);
        $nip4   = substr($nip, 15, 3);

        $nip_final  = $nip1 . " " . $nip2 . " " . $nip3 . " " . $nip4;
        $nama       = $this->input->post('nama');
        $pangkat    = $this->input->post('pangkat');
        $golongan   = $this->input->post('golongan');
        $image      = $this->input->post('image');
        $slug       = url_title($nip_final, 'dash', true);

        $this->db->select('id_instansi');
        $this->db->where('nip', $this->session->userdata('sisule_cms_nip'));

        $id_instansi    = $this->db->get('tbl_login')->result();
        $id_instansi    = $id_instansi[0]->id_instansi;
        $l_nip          = preg_replace('/\s+/', '', $nip);

        if (strlen($l_nip) > 15) {
            $status = 'asn';
        } else {
            $status = 'non asn';
        }

        $aktifasi_app   = 0;
        $cek            = $this->db->get_where('tbl_login', array('nip' => $nip_final))->result();

        if ($cek != null) {
            $aktifasi_app = 1;
        }
        $data = array(
            'nip'                   => $nip_final,
            'nama'                  => $nama,
            'pangkat'               => $pangkat,
            'golongan'              => $golongan,
            'image'                 => str_replace(" ", "_", $this->session->userdata('sisule_cms_nip')) . $image,
            'id_instansi'           => $id_instansi,
            'status_kepegawaian'    => $status,
            'slug'                  => $slug,
            'aktifasi_app'          => $aktifasi_app
        );
        return $this->db->insert('tbl_karyawan', $data);
    }
    public function deleteKaryawan($param)
    {
        $data = $this->db->get_where('tbl_karyawan', array('slug' => $param))->result();
        $data = $data[0]->nip;
        $this->db->delete('tbl_login', array('nip' => $param));
        return $this->db->delete('tbl_karyawan', array('slug' => $param));
    }
    public function getKaryawan($param)
    {
        $this->db->where('nip', $param);
        return $this->db->get('tbl_karyawan');
    }
    public function updateKaryawan()
    {
        $nip        = $this->input->post('nip');
        $nama       = $this->input->post('nama');
        $pangkat    = $this->input->post('pangkat');
        $golongan   = $this->input->post('golongan');
        $image      = $this->input->post('image');
        $nip        = str_replace(" ", "", $nip);
        $nip1       = substr($nip, 0, 8);
        $nip2       = substr($nip, 8, 6);
        $nip3       = substr($nip, 14, 1);
        $nip4       = substr($nip, 15, 3);

        $nip_final  = $nip1 . " " . $nip2 . " " . $nip3 . " " . $nip4;
        $slug       = url_title($nip_final, 'dash', true);
        $cek_nip    = $this->db->get_where('tbl_karyawan', array('no' => $this->input->post('id')))->result();
        $cek_image  = $this->db->get_where('tbl_karyawan', array('no' => $this->input->post('id')))->result();

        if ($cek_nip != null) {
            $cek_nip    = $cek_nip[0]->nip;
        }
        if ($cek_image != null) {
            $cek_image  = $cek_image[0]->image;
        }

        if ($cek_nip == $nip_final) {
            $image_name = "./assets/image/pns/" . $image;
            if (!file_exists($image_name)) {
                $data = array(
                    'nama'                  => $nama,
                    'pangkat'               => $pangkat,
                    'golongan'              => $golongan,
                    'image'                 => str_replace(" ", "_", $this->session->userdata('sisule_cms_nip')) . $image,
                    'status_kepegawaian'    => 'asn',
                    'slug'                  => $slug
                );
            } else {
                $data = array(
                    'nama'                  => $nama,
                    'pangkat'               => $pangkat,
                    'golongan'              => $golongan,
                    'status_kepegawaian'    => 'asn',
                    'slug'                  => $slug
                );
            }
        } elseif ($cek_nip != $nip_final) {
            $cek_nip_lain = $this->db->get_where('tbl_karyawan', array('nip' => $nip_final))->result();
            if ($cek_nip_lain != null) {
                return null;
            } else {
                if ($cek_image != str_replace(" ", "_", $this->session->userdata('sisule_cms_nip')) . $image) {
                    $data = array(
                        'nama'                  => $nama,
                        'pangkat'               => $pangkat,
                        'golongan'              => $golongan,
                        'image'                 => str_replace(" ", "_", $this->session->userdata('sisule_cms_nip')) . $image,
                        'status_kepegawaian'    => 'asn',
                        'slug'                  => $slug
                    );
                } else {
                    $data = array(
                        'nama'                  => $nama,
                        'pangkat'               => $pangkat,
                        'golongan'              => $golongan,
                        'status_kepegawaian'    => 'asn',
                        'slug'                  => $slug
                    );
                }
            }
        }
        $this->db->where('nip', $nip_final);
        return $this->db->update('tbl_karyawan', $data);
    }
    public function getDetailKaryawan($param)
    {
        $this->db->where('nip', $param);
        return $this->db->get('tbl_karyawan');
    }
    public function getAccountKaryawan($param)
    {
        $this->db->where('nip', $param);
        return $this->db->get('tbl_login');
    }
    public function createAccount()
    {
        $userid     = rand();
        $nip        = $this->input->post('nip');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $hak        = 'staf';

        $id_instansi = $this->db->get_where('tbl_login', array('nip' => $this->session->userdata('sisule_cms_nip')))->result();
        $id_instansi = $id_instansi[0]->id_instansi;

        $check = $this->db->get_where('tbl_login', array('nip' => $nip))->result();
        if (count($check) > 0) {
            $data = array(
                'user_id'       => $userid,
                'username'      => $username,
                'password'      => md5($password),
                'no_telp'       => '-',
                'id_instansi'   => $id_instansi,
                'nip'           => $nip
            );
            $this->db->where('nip', $nip);
            $result = $this->db->update('tbl_login', $data);
        } else {
            $data = array(
                'user_id'       => $userid,
                'username'      => $username,
                'password'      => md5($password),
                'hak'           => $hak,
                'no_telp'       => '-',
                'id_instansi'   => $id_instansi,
                'nip'           => $nip
            );
            $result = $this->db->insert('tbl_login', $data);
        }
        $this->db->where('nip', $nip);
        $this->db->update('tbl_karyawan', array('aktifasi_app' => 1));
        return $result;
    }
    public function getImageName($param)
    {
        return $this->db->get_where('tbl_karyawan', array('slug' => $param));
    }

    public function cekRegisteredNip($tabel, $param)
    {
        return $this->db->get_where($tabel, array('nip' => $param));
    }
}
