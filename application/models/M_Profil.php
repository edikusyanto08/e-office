<?php

class M_Profil extends  CI_Model
{
    public function perbaharuiProfil()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->input->post('checkpassword') > 0) {
            $data = array(
                'username' => $username,
                'password' => md5($password)
            );
        } else {
            $data = array(
                'username' => $username
            );
        }
        $this->db->where('nip', $this->session->userdata('sisule_cms_nip'));
        return $this->db->update('tbl_login', $data);
    }
}
