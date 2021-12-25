<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Pinjaman extends BD_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_data');
    $this->load->model('m_api');

    $this->methods['pinjaman_post']['limit'] = 500; // 500 requests per hour per user/key

  }

  public function jumlahpinjaman_get()
  {
    $id = $this->get('user_id');

    $data_jumlahsimpanan = $this->m_api->jumlah_pinjaman($id);
    // $tenor = $this->db->get_where('tb_pinjaman', ['user_id' => $id])->row();

    if ($data_jumlahsimpanan) {
      # response laporan jika data laporan ada, dan menampilkan semua data laporan
      $this->response([
        'status'  => true,
        'data'    => $data_jumlahsimpanan,
        // 'tenor' => $tenor->tenor,
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

  public function pinjaman_get()
  {
    // mengambil data yang di kirim
    $id = $this->get('user_id');
    $id_pinjaman = $this->get('id');

    // mengambil data dengan id yang di kirim
    if ($id != null) {
      $data_pinjaman = $this->m_api->get_id_pinjaman($id);
    } else if ($id_pinjaman != null) {
      $data_pinjaman = $this->m_api->id_pinjaman($id_pinjaman);
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
    $id_pinjaman = $this->get('user_id');

    // mengambil data dengan id yang di kirim
    if ($id_pinjaman === null) {

      # response laporan jika laporan tidak ada
      $this->response([
        'status'  => false,
        'message' => 'data tidak di temukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    } else {

      $data_pinjaman = $this->m_api->total_pinjam($id_pinjaman);
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


  public function pinjaman_post()
  {
    $getnopinjaman = $this->m_data->ceknopinjaman();
    $nourut = substr($getnopinjaman, 3, 4);
    $nopinjaman = $nourut + 1;

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

      $cicilan = $this->input->post('jumlah') / $this->input->post('tenor');
      $jumlah = $this->input->post('jumlah') * 0.1 / $this->input->post('tenor');
      $total = $cicilan + $jumlah;

      $data = [
        'user_id' => $this->input->post('user_id'),
        'no_pinjaman' => "P-" . sprintf("%04s", $nopinjaman),
        'jumlah' => $this->input->post('jumlah'),
        'angsuran' => $total,
        'bunga' => 0.1,
        'tenor' => $this->input->post('tenor'),
        'biaya_admin' => 2000,
        'keterangan' => $this->input->post('keterangan'),
        'created_at' => date("d M Y")
      ];

      $output = $this->db->insert('tb_pinjaman', $data);

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

/* End of file Controllername.php */