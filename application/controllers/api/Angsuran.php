<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Angsuran extends BD_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_data');
    $this->load->model('m_api');

    $this->methods['pinjaman_post']['limit'] = 500; // 500 requests per hour per user/key

  }

  public function jumlahangsuran_get()
  {
    $id = $this->get('user_id');

    $data_jumlahangsuran = $this->m_api->jumlah_angsuran($id);

    if ($data_jumlahangsuran) {
      # response laporan jika data laporan ada, dan menampilkan semua data laporan
      $this->response([
        'status'  => true,
        'data'    => $data_jumlahangsuran,
        'message' => 'sukses'
      ], REST_Controller::HTTP_OK);
    } else {
      # response laporan jika laporan tidak ada
      $this->response([
        'status'  => false,
        'message' => 'data tidak di temukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function angsuran_get()
  {
    // mengambil data yang di kirim
    $id = $this->get('id_a');
    $id_pinjaman = $this->get('member');

    // mengambil data dengan id yang di kirim
    if ($id != null) {

      $data_pinjaman = $this->m_api->get_id_angsuran($id);
    } else if ($id_pinjaman != null) {

      $data_pinjaman = $this->m_api->id_angsuran($id_pinjaman);
    } else {
      $this->response([
        'status'  => false,
        'message' => 'data tidak di temukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    }

    if ($data_pinjaman) {
      # response laporan jika data laporan ada, dan menampilkan semua data laporan
      $this->response([
        'status'  => true,
        'data'    => $data_pinjaman,
        'message' => 'sukses'
      ], REST_Controller::HTTP_OK);
    } else {
      # response laporan jika laporan tidak ada
      $this->response([
        'status'  => false,
        'message' => 'data tidak di temukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function totaldata_get()
  {
    // mengambil data yang di kirim
    $id_angsuran = $this->get('member');

    // mengambil data dengan id yang di kirim
    if ($id_angsuran === null) {

      # response laporan jika laporan tidak ada
      $this->response([
        'status'  => false,
        'message' => 'data tidak di temukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    } else {

      $data_angsuran = $this->m_api->total_angsuran($id_angsuran);
    }

    if ($data_angsuran) {
      # response laporan jika data laporan ada, dan menampilkan semua data laporan
      $this->response([
        'status'  => true,
        'data'    => $data_angsuran,
        'message' => 'sukses'
      ], REST_Controller::HTTP_OK);
    } else {
      # response laporan jika laporan tidak ada
      $this->response([
        'status'  => false,
        'message' => 'data tidak di temukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function angsuran_post()
  {
    $getnoangsuran = $this->m_data->ceknoangsuran();
    $nourut = substr($getnoangsuran, 3, 4);
    $noangsuran = $nourut + 1;

    $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      if (validation_errors() == true) {
        # response ketika username sudah digunakan 
        $this->response([
          'status' => false,
          'message' => 'data yang diinput salah'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    } else {
      # inisial data yang akan di input kedalam database
      $id = $this->input->post('id');
      $pinjam = $this->db->get_where('tb_pinjaman', ['id' => $id])->result_array();

      foreach ($pinjam as $get_pinjam) {
        $data = [
          'jumlah' => $get_pinjam['jumlah'] - $this->input->post('jumlah'),
          'tenor' => $get_pinjam['tenor'] - 1,
          'angsuran_ke' => sprintf("%01s", $noangsuran)
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_pinjaman', $data);
      }

      $data = [
        'member' => $this->input->post('member'),
        'angsuran_ke' => sprintf("%01s", $noangsuran),
        'jumlah' => $this->input->post('jumlah'),
        'created_at' => date("d M Y"),
        'no_angsuran' => "A-" . sprintf("%04s", $noangsuran),
        'ket' => $this->input->post('ket')
      ];

      $output = $this->db->insert('tb_angsuran', $data);

      if ($output == 0) {
        // response ketika data gagal di simpan
        $this->response([
          'status' => false,
          'message' => 'Data gagal di simpan'
        ], REST_Controller::HTTP_NOT_FOUND);
      } else {
        // response ketika data berhasil disimpan
        $this->response([
          'status' => true,
          'message' => 'Data berhasil di simpan',
          'data' => $data
        ], REST_Controller::HTTP_OK);
      }
    }
  }
}

/* End of file Angsuran.php */