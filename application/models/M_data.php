<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

  public function get_all_simpanan()
  {
    $querysimpanan = "SELECT `tb_simpan`.*, `tb_member`.`member_id`
                      FROM `tb_simpan`
                      JOIN  `tb_member` ON `tb_simpan`.`m_id` = `tb_member`.`id_m`
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function get_all_submenu()
  {
    $querysubmenu = "SELECT `tb_sub_menu`.*, `tb_menu`.`menu`
                      FROM `tb_sub_menu`
                      JOIN  `tb_menu` ON `tb_sub_menu`.`menu_id` = `tb_menu`.`id_menu`
                  ";
    return $this->db->query($querysubmenu)->result_array();
  }

  public function get_all_pinjaman()
  {
    $querysimpanan = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`,`tb_member`.`nik`,`tb_member`.`no_hp`,`tb_member`.`alamat`, `tb_member`.`nama`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function get_no_pinjaman($no_pinjaman)
  {
    $querysimpanan = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`,`tb_member`.`nik`,`tb_member`.`no_hp`,`tb_member`.`alamat`, `tb_member`.`nama`, `tb_member`.`member_id`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`no_pinjaman` = $no_pinjaman
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function get_id_pinjaman($id)
  {
    $querysimpanan = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`,`tb_member`.`nik`,`tb_member`.`no_hp`,`tb_member`.`alamat`, `tb_member`.`nama`, `tb_member`.`member_id`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`user_id` = $id
                  ";
    return $this->db->query($querysimpanan)->row_array();
  }

  public function pinjaman_id($id)
  {
    $querysimpanan = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`,`tb_member`.`nik`,`tb_member`.`no_hp`,`tb_member`.`alamat`, `tb_member`.`nama`, `tb_member`.`member_id`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`id` = $id
                  ";
    return $this->db->query($querysimpanan)->row_array();
  }

  public function get_simpanan($id)
  {
    $querysimpanan = "SELECT `tb_simpan`.*, `tb_member`.`member_id`
                      FROM `tb_simpan`
                      JOIN  `tb_member` ON `tb_simpan`.`m_id` = `tb_member`.`id_m`
                      WHERE `tb_simpan`.`id` = $id
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function get_pinjaman($id)
  {
    $querypinjaman = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`id` = $id
                  ";
    return $this->db->query($querypinjaman)->result_array();
  }

  public function get_angsuran($id)
  {
    $querysimpanan = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`,`tb_member`.`nik`,`tb_member`.`no_hp`,`tb_member`.`alamat`, `tb_member`.`nama`, `tb_member`.`member_id`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`id` = $id
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function ceknosimpanan()
  {
    $query = $this->db->query("SELECT MAX(no_simpanan) as nosimpanan FROM tb_simpan");
    $hasil = $query->row();
    return $hasil->nosimpanan;
  }

  public function ceknopinjaman()
  {
    $query = $this->db->query("SELECT MAX(no_pinjaman) as nopinjaman FROM tb_pinjaman");
    $hasil = $query->row();
    return $hasil->nopinjaman;
  }

  public function cekidmember()
  {
    $query = $this->db->query("SELECT MAX(member_id) as member_id FROM tb_member");
    $hasil = $query->row();
    return $hasil->member_id;
  }

  public function ceknoangsuran()
  {
    $query = $this->db->query("SELECT MAX(no_angsuran) as no_angsuran FROM tb_angsuran");
    $hasil = $query->row();
    return $hasil->no_angsuran;
  }

  public function cekangsuranke()
  {
    $query = $this->db->query("SELECT MAX(id_a) as id_a FROM tb_angsuran");
    $hasil = $query->row();
    return $hasil->id_a;
  }

  public function cari_data($keyword = null)
  {
    $this->db->select('*');
    $this->db->from('tb_member');

    if (!empty($keyword)) {
      $this->db->like('member_id', $keyword);
    } else {
      redirect("backend/modul/");
    }

    $data = $this->db->get()->row();
    $data->id_m;

    $querysimpanan = "SELECT `tb_simpan`.*, `tb_member`.`member_id`
                      FROM `tb_simpan`
                      JOIN  `tb_member` ON `tb_simpan`.`m_id` = `tb_member`.`id_m`
                      WHERE `tb_simpan`.`m_id` = $data->id_m
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function cari_data_pinjaman($keyword = null)
  {
    $this->db->select('*');
    $this->db->from('tb_member');

    if (!empty($keyword)) {
      $this->db->like('member_id', $keyword);
    } else {
      redirect("backend/modul/pinjam");
    }

    $data = $this->db->get()->row();
    $data->id_m;

    $querysimpanan = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`user_id` = $data->id_m
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function cari_data_angsuran($keyword = null)
  {
    $this->db->select('*');
    $this->db->from('tb_pinjaman');

    if (!empty($keyword)) {
      $this->db->like('no_pinjaman', $keyword);
    }

    $data = $this->db->get()->row();
    $querysimpanan = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`,`tb_member`.`nik`,`tb_member`.`no_hp`,`tb_member`.`alamat`, `tb_member`.`nama`, `tb_member`.`member_id`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`user_id` = $data->id
                  ";
    return $this->db->query($querysimpanan)->row_array();
  }
}

/* End of file M_data.php */