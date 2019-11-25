<?php

class M_Instansi extends CI_Model
{
    public function buatInstansi()
    {
        $id         = $this->input->post('id_instansi');
        $nama       = $this->input->post('nama_instansi');
        $singkatan  = $this->input->post('singkatan');
        $data = array(
            'id_instansi'   => $id,
            'nama_instansi' => $nama,
            'singkatan'     => $singkatan
        );
        return $this->db->insert('tbl_instansi', $data);
    }

    public function perbaharuiinstansi()
    {
        if ($this->session->userdata('sisule_cms_hak') == 'admin') {
            $id         = $this->input->post('id_instansi');
            $nama       = $this->input->post('nama_instansi');
            $singkatan  = $this->input->post('singkatan');
            $alamat     = $this->input->post('alamat');
            $telepon    = $this->input->post('telepon');
            $email      = $this->input->post('email');
            $fax        = $this->input->post('fax');

            $data = array(
                'nama_instansi' => $nama,
                'singkatan'     => $singkatan,
                'alamat'        => $alamat,
                'telepon'       => $telepon,
                'email'         => $email,
                'fax'           => $fax
            );
        } else {
            $id         = $this->input->post('id_instansi');
            $nama       = $this->input->post('nama_instansi');
            $singkatan  = $this->input->post('singkatan');

            $data = array(
                'nama_instansi' => $nama,
                'singkatan'     => $singkatan
            );
        }
        $this->db->where('id_instansi', $id);
        return $this->db->update('tbl_instansi', $data);
    }

    public function hapusInstansi($param)
    {
        $this->db->where('id_instansi', $param);
        return $this->db->delete('tbl_instansi');
    }

    public function getInstansi($param)
    {
        $this->db->where('id_instansi', $param);
        return $this->db->get('tbl_instansi');
    }

    public function listinstansi($perPage, $start)
    {
        $this->db->order_by('id_instansi', 'desc');
        return $this->db->get('tbl_instansi', $perPage, $start);
    }

    public function cariinstansi($param)
    {
        $this->db->like('nama_instansi', $param);
        $this->db->or_like('singkatan', $param);
        $this->db->order_by('id_instansi', 'desc');
        return $this->db->get('tbl_instansi', 10);
    }

    public function getBarisInstansi()
    {
        return $this->db->get('tbl_instansi')->num_rows();
    }

    public function checkExistInstansi($param)
    {
        return $this->db->get_where('tbl_instansi', array('id_instansi' => $param));
    }
}
