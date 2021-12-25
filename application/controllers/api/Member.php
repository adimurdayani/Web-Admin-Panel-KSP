<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Member extends BD_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_data');

    $this->methods['member_post']['limit'] = 500; // 500 requests per hour per user/key

  }

  public function member_post()
  {

    $this->form_validation->set_rules('nik', 'nik', 'trim|required');
    $this->form_validation->set_rules('t_lahir', 't_lahir', 'trim|required');
    $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
    $this->form_validation->set_rules('no_hp', 'nomor telp', 'trim|required');

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
      $id = $this->input->post('id_m');

      $data = [
        'nik' => $this->input->post('nik'),
        'tgl_lahir' => $this->input->post('tgl_lahir'),
        'kelamin' => $this->input->post('kelamin'),
        'gol_darah' => $this->input->post('gol_darah'),
        'agama' => $this->input->post('agama'),
        'pekerjaan' => $this->input->post('pekerjaan'),
        'alamat' => $this->input->post('alamat'),
        'no_hp' => $this->input->post('no_hp'),
        't_lahir' => $this->input->post('t_lahir'),
        'created_at' => date("d M Y")
      ];
      $this->db->where('id_m', $id);
      $output = $this->db->update('tb_member', $data);

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

  public function namamember_post()
  {

    $this->form_validation->set_rules('nama', 'nama', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');

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
      $id = $this->input->post('id_m');

      $data = [
        'nama' => $this->input->post('nama'),
        'email' => $this->input->post('email'),
        'username' => $this->input->post('username'),
        'created_at' => date("d M Y")
      ];

      $this->db->where('id_m', $id);
      $output = $this->db->update('tb_member', $data);

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

  public function password_post()
  {
    $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]');
    $this->form_validation->set_rules('konfirmasi_password', 'konfirmasi password', 'trim|required|min_length[5]|matches[password]');

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
        'password' => sha1($this->input->post('password')),
        'created_at' => date("d M Y H:i")
      ];
      $this->db->where('id', $id);
      $output = $this->db->update('tb_user', $data);

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

/* End of file User.php */