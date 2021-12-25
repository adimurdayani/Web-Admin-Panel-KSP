<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {
  
  public function __construct()
  {
    parent::__construct();  
    is_logged_in();
  }

  public function index($id)
  {
    $data['judul'] = 'Print Data Simpanan';
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
    $data['get_simpanan'] = $this->db->get_where('tb_simpan', ['id' => $id]);
    $this->load->view('backend/d_modul/print_laporan', $data, FALSE);
    
    // $paper_size = 'A4';
    // $orientation = 'landscape';
    // $html = $this->output->get_output();
    // $this->dompdf->set_paper($paper_size, $orientation);

    // $this->dompdf->load_html($html);
    // $this->dompdf->render();
    // $this->dompdf->stream("data_laporan.pdf", array('Attachment' => 0));
  }

}

/* End of file Print.php */