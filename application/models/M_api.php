<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_api extends CI_Model
{

  public function get_all_simpanan()
  {
    $querysimpanan = "SELECT `tb_simpan`.*, `tb_member`.`member_id`
                      FROM `tb_simpan`
                      JOIN  `tb_member` ON `tb_simpan`.`m_id` = `tb_member`.`id_m`
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function get_all_pinjaman()
  {
    $querypinjaman = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`, `tb_member`.`nama`, `tb_member`.`nik`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                  ";
    return $this->db->query($querypinjaman)->result_array();
  }

  public function get_id_simpanan($id)
  {
    $querysimpanan = "SELECT `tb_simpan`.*, `tb_member`.`member_id`
                      FROM `tb_simpan`
                      JOIN  `tb_member` ON `tb_simpan`.`m_id` = `tb_member`.`id_m`
                      WHERE `tb_simpan`.`m_id` = $id
                  ";
    return $this->db->query($querysimpanan)->result_array();
  }

  public function id_simpanan($id)
  {
    $querysimpanan = "SELECT `tb_simpan`.*, `tb_member`.`member_id`
                      FROM `tb_simpan`
                      JOIN  `tb_member` ON `tb_simpan`.`m_id` = `tb_member`.`id_m`
                      WHERE `tb_simpan`.`id` = $id
                  ";
    return $this->db->query($querysimpanan)->row();
  }

  public function get_id_pinjaman($id)
  {
    $querypinjaman = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`, `tb_member`.`nama`, `tb_member`.`nik`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`user_id` = $id
                  ";
    return $this->db->query($querypinjaman)->result_array();
  }

  public function id_pinjaman($id)
  {
    $querypinjaman = "SELECT `tb_pinjaman`.*, `tb_member`.`member_id`, `tb_member`.`nama`, `tb_member`.`nik`
                      FROM `tb_pinjaman`
                      JOIN  `tb_member` ON `tb_pinjaman`.`user_id` = `tb_member`.`id_m`
                      WHERE `tb_pinjaman`.`id` = $id
                  ";
    return $this->db->query($querypinjaman)->row();
  }

  public function get_id_angsuran($id)
  {
    $queryangsuran = "SELECT `tb_angsuran`.*, `tb_member`.`member_id`, `tb_member`.`nama`, `tb_member`.`nik`
                      FROM `tb_angsuran`
                      JOIN  `tb_member` ON `tb_angsuran`.`member` = `tb_member`.`id_m`
                      WHERE `tb_angsuran`.`id_a` = $id
                  ";
    return $this->db->query($queryangsuran)->row();
  }

  public function id_angsuran($id)
  {
    $querypinjaman = "SELECT `tb_angsuran`.*, `tb_member`.`member_id`, `tb_member`.`nama`, `tb_member`.`nik`
                      FROM `tb_angsuran`
                      JOIN  `tb_member` ON `tb_angsuran`.`member` = `tb_member`.`id_m`
                      WHERE `tb_angsuran`.`member` = $id
                  ";
    return $this->db->query($querypinjaman)->result_array();
  }

  public function jumlah_simpanan($id)
  {
    $sql = "SELECT sum(jumlah) as jumlah FROM tb_simpan WHERE m_id = $id";
    $result = $this->db->query($sql);
    return $result->row();
  }

  public function jumlah_pinjaman($id)
  {
    $sql = "SELECT sum(jumlah) as jumlah, tenor FROM tb_pinjaman WHERE user_id = $id";
    $result = $this->db->query($sql);
    return $result->row();
  }

  public function jumlah_angsuran($id)
  {
    $sql = "SELECT sum(angsuran) as angsuran, tenor FROM tb_pinjaman WHERE user_id = $id";
    $result = $this->db->query($sql);
    return $result->row();
  }

  public function total_simpanan($id)
  {
    $result = $this->db->get_where('tb_simpan', ['m_id' => $id]);
    return $result->num_rows();
  }

  public function total_angsuran($id)
  {
    $result = $this->db->get_where('tb_angsuran', ['member' => $id]);
    return $result->num_rows();
  }

  public function total_pinjam($id)
  {
    $result = $this->db->get_where('tb_pinjaman', ['user_id' => $id]);
    return $result->num_rows();
  }

  public function deletesimpanan($id)
  {
    $this->db->delete('tb_simpan', ['id' => $id]);
    return $this->db->affected_rows();
  }
}

/* End of file M_api.php */