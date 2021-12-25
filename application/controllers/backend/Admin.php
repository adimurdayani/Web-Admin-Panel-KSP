<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_data');    
    is_logged_in();
  }
  
  public function index()
  {
    $data['judul'] = 'Dashboard';
    $data['jml_menu'] = $this->db->get('tb_menu')->num_rows();
    $data['jml_sub_menu'] = $this->db->get('tb_sub_menu')->num_rows();
    $data['jml_user'] = $this->db->get('tb_user')->num_rows();
    $data['jml_grup'] = $this->db->get('tb_grup')->num_rows();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
    $this->load->view('backend/layout/head', $data, FALSE);
    $this->load->view('backend/layout/sidebar', $data, FALSE);
    $this->load->view('backend/layout/header', $data, FALSE);
    $this->load->view('backend/dashboard', $data, FALSE);
    $this->load->view('backend/layout/footer', $data, FALSE);
    
  }

}

/* End of file Dashboard.php */