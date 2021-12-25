<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_data');
    is_logged_in();
  }

  public function index()
  {
    $data['judul'] = 'Data Profil';
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
    $this->load->view('backend/layout/head', $data, FALSE);
    $this->load->view('backend/layout/sidebar', $data, FALSE);
    $this->load->view('backend/layout/header', $data, FALSE);
    $this->load->view('backend/tb_profil/index', $data, FALSE);
    $this->load->view('backend/layout/footer', $data, FALSE);
  }

  public function member()
  {
    $getidmember = $this->m_data->cekidmember();
    $nourut = substr($getidmember, 3, 4);
    $idmember = $nourut + 1;
    $data = array('member_id' => $idmember);
    
    $data['judul'] = 'Data Member';
    $data['get_member'] = $this->db->get('tb_member')->result_array();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('nik', 'nik', 'trim|required');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');
    $this->form_validation->set_rules('t_lahir', 't_lahir', 'trim|required');
    $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
    $this->form_validation->set_rules('no_hp', 'nomor telp', 'trim|required');
    
    if ($this->form_validation->run() == FALSE) {
      # code...
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_member/tb_member', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
    } else {
      # code...
      $data= [
        
        'member_id' => $this->input->post('member_id'),
        'nik' => $this->input->post('nik'),
        'nama' => $this->input->post('nama'),
        'tgl_lahir' => $this->input->post('tgl_lahir'),
        'kelamin' => $this->input->post('kelamin'),
        'gol_darah' => $this->input->post('gol_darah'),
        'agama' => $this->input->post('agama'),
        'pekerjaan' => $this->input->post('pekerjaan'),
        'alamat' => $this->input->post('alamat'),
        'email' => $this->input->post('email'),
        'no_hp' => $this->input->post('no_hp'),
        't_lahir' => $this->input->post('t_lahir'),
        'created_at' => date("d M Y"),
        'status' => 0,
                
      ];
      
      $this->db->insert('tb_member', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah tersimpan.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
      redirect('backend/user/member');
    }
    
  }

  public function member_detail($id)
  {    
    $data['judul'] = 'Detail Member';
    $data['get_member'] = $this->db->get_where('tb_member', ['id_m' => $id])->row_array();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('nik', 'nik', 'trim|required');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');
    $this->form_validation->set_rules('t_lahir', 't_lahir', 'trim|required');
    $this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
    $this->form_validation->set_rules('no_hp', 'nomor telp', 'trim|required');
    
    if ($this->form_validation->run() == FALSE) {
      # code...
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_member/tb_member_detail', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
    } else {
      # code...   
      $id = $this->input->post('id_m');
      $data= [
        
        'nik' => $this->input->post('nik'),
        'nama' => $this->input->post('nama'),
        'tgl_lahir' => $this->input->post('tgl_lahir'),
        'kelamin' => $this->input->post('kelamin'),
        'gol_darah' => $this->input->post('gol_darah'),
        'agama' => $this->input->post('agama'),
        'pekerjaan' => $this->input->post('pekerjaan'),
        'alamat' => $this->input->post('alamat'),
        'email' => $this->input->post('email'),
        'no_hp' => $this->input->post('no_hp'),
        't_lahir' => $this->input->post('t_lahir'),
        'created_at' => date("d M Y"),
                
      ];
      $this->db->where('id_m', $id);
      
      $this->db->update('tb_member', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah tersimpan.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
      redirect('backend/user/member');
    }
    
  }

  public function member_edit()
  {    
    $data['judul'] = 'Data Member';
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('status', 'status', 'trim|required');
    
    if ($this->form_validation->run() == FALSE) {
      # code...
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_member/tb_member', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
    } else {
      # code...
      $id = $this->input->post('id_m');
      
      $data= [
        
        'created_at' => date("d M Y"),
        'status' => $this->input->post('status')
                
      ];
      
      $this->db->where('id_m', $id);
      
      $this->db->update('tb_member', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah diubah.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
      redirect('backend/user/member');
    }
    
  }

  public function hapus_member($id)
  {
    $this->db->delete('tb_member', ['id_m' => $id]);
    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> data anda telah dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>');
    redirect('backend/user/member');
  }

}

/* End of file Profil.php */