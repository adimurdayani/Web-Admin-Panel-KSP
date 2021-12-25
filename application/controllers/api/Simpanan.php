<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Simpanan extends BD_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_data');
    $this->load->model('m_api');
    $this->methods['simpanan_post']['limit'] = 500; // 500 requests per hour per user/key
  }

  public function jumlahsimpanan_get()
  {
    $id = $this->get('m_id');

    $data_jumlahsimpanan = $this->m_api->jumlah_simpanan($id);

    if ($data_jumlahsimpanan) {
      # response laporan jika data laporan ada, dan menampilkan semua data laporan
      $this->response([
        'status'  => true,
        'data'    => $data_jumlahsimpanan,
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


  public function index_get()
  {
    // mengambil data yang di kirim
    $id = $this->get('m_id');
    $id_simpanan = $this->get('id');
    // kondisi jika id laporan tidak di temukan 
    // $data_simpanan = $this->m_api->get_all_simpanan();
    if ($id != null) {
      // mengambil data dari database
      $data_simpanan = $this->m_api->get_id_simpanan($id);
    } else if ($id_simpanan != null) {
      // mengambil data dengan id yang di kirim
      $data_simpanan = $this->m_api->id_simpanan($id_simpanan);
    }
    if ($data_simpanan) {
      # response laporan jika data laporan ada, dan menampilkan semua data laporan
      $this->response([
        'status'  => true,
        'data'    => $data_simpanan,
        'message' => 'sukses'
      ], REST_Controller::HTTP_OK);
    } else {
      # response laporan jika laporan tidak ada
      $this->response([
        'status'  => false,
        'message' => 'id tidak ditemukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    }
  }


  public function simpanan_post()
  {
    $getnosimpanan = $this->m_data->ceknosimpanan();
    $nourut = substr($getnosimpanan, 3, 4);
    $nosimpanan = $nourut + 1;

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

      $data = [
        'm_id' => $this->input->post('m_id'),
        'no_simpanan' => "S-" . sprintf("%04s", $nosimpanan),
        'jumlah' => $this->input->post('jumlah'),
        'j_simpanan' => $this->input->post('j_simpanan'),
        'created_at' => date("d M Y"),
        'catatan' => $this->input->post('catatan')
      ];

      $output = $this->db->insert('tb_simpan', $data);

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

  public function totaldata_get()
  {
    // mengambil data yang di kirim
    $id_simpanan = $this->get('m_id');

    // mengambil data dengan id yang di kirim
    if ($id_simpanan === null) {
      # response laporan jika laporan tidak ada
      $this->response([
        'status'  => false,
        'message' => 'data tidak di temukan'
      ], REST_Controller::HTTP_NOT_FOUND);
    } else {
      $data_simpanan = $this->m_api->total_simpanan($id_simpanan);
    }

    if ($data_simpanan) {
      # response laporan jika data laporan ada, dan menampilkan semua data laporan
      $this->response([
        'status'  => true,
        'data'    => $data_simpanan,
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


  public function editsimpanan_post()
  {
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

      $data = [
        'jumlah' => $this->input->post('jumlah'),
        'j_simpanan' => $this->input->post('j_simpanan'),
        'created_at' => date("d M Y"),
        'catatan' => $this->input->post('catatan')
      ];

      $this->db->where('id', $id);
      $output = $this->db->update('tb_simpan', $data);

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

  public function hapussimpanan_delete()
  {
    $id = $this->delete('id');
    if ($id === null) {

      $this->response([
        'status' => FALSE,
        'message' => 'Id kosong'
      ], REST_Controller::HTTP_BAD_REQUEST);
    } else {
      if ($this->m_api->deletesimpanan($id)) {

        $this->response([
          'status' => true,
          'message' => 'data berhasil dihapus'
        ], REST_Controller::HTTP_OK);
      } else {

        $this->response([
          'status' => FALSE,
          'message' => 'Id tidak ditemukan'
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    }
  }
}
