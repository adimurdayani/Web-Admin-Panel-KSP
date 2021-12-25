<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modul extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    is_logged_in();
    $this->load->model('m_data');
  }

  public function index()
  {

    $getnosimpanan = $this->m_data->ceknosimpanan();
    $nourut = substr($getnosimpanan, 3, 4);
    $nosimpanan = $nourut + 1;
    $data = array('no_simpanan' => $nosimpanan);

    $data['judul'] = 'Data Simpanan';
    $data['get_simpanan'] = $this->m_data->get_all_simpanan();
    $data['get_member'] = $this->db->get('tb_member')->result_array();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('jumlah', 'jumlah pinjaman', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      # code...
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_modul/tb_simpan', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
    } else {
      # code...
      $data = [
        'm_id' => $this->input->post('m_id'),
        'no_simpanan' => $this->input->post('no_simpanan'),
        'jumlah' => $this->input->post('jumlah'),
        'j_simpanan' => $this->input->post('j_simpanan'),
        'created_at' => date("d M Y"),
        'catatan' => $this->input->post('catatan')
      ];

      $this->db->insert('tb_simpan', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah tersimpan.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
      redirect('backend/modul');
    }
  }

  public function cari_data_simpanan()
  {
    $getnosimpanan = $this->m_data->ceknosimpanan();
    $nourut = substr($getnosimpanan, 3, 4);
    $nosimpanan = $nourut + 1;
    $data = array('no_simpanan' => $nosimpanan);

    $keyword = $this->input->get('cari');
    $data = array(
      'm_id' => $keyword,
      'data' => $data
    );

    $data['judul'] = 'Data Simpanan';
    $data['get_simpanan'] = $this->m_data->cari_data($keyword);
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->load->view('backend/layout/head', $data, FALSE);
    $this->load->view('backend/layout/sidebar', $data, FALSE);
    $this->load->view('backend/layout/header', $data, FALSE);
    $this->load->view('backend/d_modul/tb_cari_simpan', $data, FALSE);
    $this->load->view('backend/layout/footer', $data, FALSE);
  }

  public function simpanan_edit()
  {
    $data['judul'] = 'Data Simpanan';
    $data['get_member'] = $this->db->get('tb_member')->result_array();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('jumlah', 'jumlah pinjaman', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      # code...
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_modul/tb_simpan', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
    } else {
      # code...
      $id = $this->input->post('id');

      $data = [
        'm_id' => $this->input->post('m_id'),
        'no_simpanan' => $this->input->post('no_simpanan'),
        'jumlah' => $this->input->post('jumlah'),
        'j_simpanan' => $this->input->post('j_simpanan'),
        'created_at' => date("d M Y"),
        'catatan' => $this->input->post('catatan')
      ];

      $this->db->where('id', $id);

      $this->db->update('tb_simpan', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah terubah.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
      redirect('backend/modul');
    }
  }

  public function hapus_simpanan($id)
  {
    $this->db->delete('tb_simpan', ['id' => $id]);
    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah terubah.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
    redirect('backend/modul');
  }

  public function cetak_simpanan($id)
  {
    $this->load->library('dompdf_gen');
    $data['judul'] = 'Print Data Simpanan';
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
    $data['get_simpanan'] = $this->m_data->get_simpanan($id);
    $this->load->view('backend/d_modul/print_laporan', $data, FALSE);

    $paper_size = 'A4';
    $orientation = 'landscape';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("data_laporan.pdf", array('Attachment' => 0));
  }

  public function cetak_semua()
  {
    $data['judul'] = 'Print Data Simpanan';
    $data['get_simpanan'] = $this->m_data->get_all_simpanan();
    $this->load->view('backend/d_modul/print_laporan_simpanan', $data);

    $this->load->library('dompdf_gen');
    $paper_size = 'A4';
    $orientation = 'portrait';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("data_laporan.pdf", array('Attachment' => 0));
  }

  public function pinjam()
  {
    $getnopinjaman = $this->m_data->ceknopinjaman();
    $nourut = substr($getnopinjaman, 3, 4);
    $nopinjaman = $nourut + 1;
    $data = array('no_pinjaman' => $nopinjaman);

    $data['judul'] = 'Data Pinjaman';
    $data['get_pinjaman'] = $this->m_data->get_all_pinjaman();
    $data['get_member'] = $this->db->get('tb_member')->result_array();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('jumlah', 'jumlah pinjaman', 'trim|required');
    $this->form_validation->set_rules('bunga', 'bunga pinjaman', 'trim|required');
    $this->form_validation->set_rules('biaya_admin', 'biaya admin', 'trim|required');
    $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      # code...
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_modul/tb_pinjam', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
    } else {
      # code...
      $cicilan = $this->input->post('jumlah') / $this->input->post('tenor');
      $jumlah = $this->input->post('jumlah') * $this->input->post('bunga') / $this->input->post('tenor');
      $total = $cicilan + $jumlah;

      $data = [
        'user_id' => $this->input->post('user_id'),
        'no_pinjaman' => $this->input->post('no_pinjaman'),
        'jumlah' => $this->input->post('jumlah'),
        'angsuran' => $total,
        'bunga' => $this->input->post('bunga'),
        'tenor' => $this->input->post('tenor'),
        'biaya_admin' => $this->input->post('biaya_admin'),
        'keterangan' => $this->input->post('keterangan'),
        'created_at' => date("d M Y")
      ];

      $this->db->insert('tb_pinjaman', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah tersimpan.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
      redirect('backend/modul/pinjam');
    }
  }

  public function pinjam_detail($id)
  {
    $data['judul'] = 'Data Pinjaman';
    $data['get_pinjaman'] = $this->m_data->pinjaman_id($id);
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
    $this->load->view('backend/layout/head', $data, FALSE);
    $this->load->view('backend/layout/sidebar', $data, FALSE);
    $this->load->view('backend/layout/header', $data, FALSE);
    $this->load->view('backend/d_modul/tb_pinjam_detail', $data, FALSE);
    $this->load->view('backend/layout/footer', $data, FALSE);
  }

  public function pinjam_edit()
  {
    $data['judul'] = 'Data Pinjaman';
    $data['get_pinjaman'] = $this->m_data->get_all_pinjaman();
    $data['get_member'] = $this->db->get('tb_member')->result_array();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('jumlah', 'jumlah pinjaman', 'trim|required');
    $this->form_validation->set_rules('bunga', 'bunga pinjaman', 'trim|required');
    $this->form_validation->set_rules('biaya_admin', 'biaya admin', 'trim|required');
    $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      # code...
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_modul/tb_pinjam', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
    } else {
      # code...
      $id = $this->input->post('id');

      $data = [
        'user_id' => $this->input->post('user_id'),
        'no_pinjaman' => $this->input->post('no_pinjaman'),
        'jumlah' => $this->input->post('jumlah'),
        'bunga' => $this->input->post('bunga'),
        'tenor' => $this->input->post('tenor'),
        'biaya_admin' => $this->input->post('biaya_admin'),
        'keterangan' => $this->input->post('keterangan'),
        'created_at' => date("d M Y")
      ];

      $this->db->where('id', $id);

      $this->db->update('tb_pinjaman', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah terubah.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
      redirect('backend/modul/pinjam');
    }
  }

  public function pinjaman_hapus($id)
  {
    $this->db->delete('tb_pinjaman', ['id' => $id]);
    $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<strong>Sukses!</strong> data anda telah terubah.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>');
    redirect('backend/modul/pinjam');
  }

  public function cetak_id_pinjaman($id)
  {
    $data['judul'] = 'Print Data Simpanan';
    $data['get_pinjaman'] = $this->m_data->get_pinjaman($id);
    $this->load->view('backend/d_modul/print_laporan_pinjaman', $data);

    $this->load->library('dompdf_gen');
    $paper_size = 'A4';
    $orientation = 'portrait';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("data_laporan.pdf", array('Attachment' => 0));
  }

  public function cetak_semua_pinjaman()
  {
    $data['judul'] = 'Print Data Simpanan';
    $data['get_pinjaman'] = $this->m_data->get_all_pinjaman();
    $this->load->view('backend/d_modul/print_laporan_pinjaman', $data);

    $this->load->library('dompdf_gen');
    $paper_size = 'A4';
    $orientation = 'portrait';
    $html = $this->output->get_output();
    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("data_laporan.pdf", array('Attachment' => 0));
  }

  public function cari_id_pinjaman()
  {
    $getnopinjaman = $this->m_data->ceknopinjaman();
    $nourut = substr($getnopinjaman, 3, 4);
    $nopinjaman = $nourut + 1;
    $data = array('no_pinjaman' => $nopinjaman);

    $keyword = $this->input->get('cari');
    $data = array(
      'user_id' => $keyword,
      'data' => $data
    );

    $data['judul'] = 'Data Pinjaman';
    $data['get_pinjaman'] = $this->m_data->cari_data_pinjaman($keyword);
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->load->view('backend/layout/head', $data, FALSE);
    $this->load->view('backend/layout/sidebar', $data, FALSE);
    $this->load->view('backend/layout/header', $data, FALSE);
    $this->load->view('backend/d_modul/tb_cari_pinjam', $data, FALSE);
    $this->load->view('backend/layout/footer', $data, FALSE);
  }

  public function angsuran()
  {

    $data['judul'] = 'Data Angsuran';
    $data['get_angsuran'] = $this->m_data->get_all_pinjaman();
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->load->view('backend/layout/head', $data, FALSE);
    $this->load->view('backend/layout/sidebar', $data, FALSE);
    $this->load->view('backend/layout/header', $data, FALSE);
    $this->load->view('backend/d_modul/tb_angsuran', $data, FALSE);
    $this->load->view('backend/layout/footer', $data, FALSE);
  }

  public function angsuran_detail($id)
  {
    $getno_angsuran = $this->m_data->ceknoangsuran();
    $nourut1 = substr($getno_angsuran, 3, 4);
    $no_angsuran = $nourut1 + 1;
    $data = array('no_angsuran' => $no_angsuran);

    $data['judul'] = 'Data Angsuran';
    $pinjam = $this->db->get_where('tb_pinjaman', ['id' => $id])->result_array();
    $data['get_pinjaman'] = $this->m_data->pinjaman_id($id);
    $data['user_ses'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('ket', 'ket', 'trim|required');

    if ($this->form_validation->run() == FALSE) {
      $this->load->view('backend/layout/head', $data, FALSE);
      $this->load->view('backend/layout/sidebar', $data, FALSE);
      $this->load->view('backend/layout/header', $data, FALSE);
      $this->load->view('backend/d_modul/tb_angsuran_detail', $data, FALSE);
      $this->load->view('backend/layout/footer', $data, FALSE);
      # code...
    } else {
      # code...
      foreach ($pinjam as $pinjaman) {
        $data = [
          'jumlah' => $pinjaman['jumlah'] - $this->input->post('jumlah'),
          'tenor' => $pinjaman['tenor'] - 1,
          'angsuran_ke' => sprintf("%01s", $no_angsuran)
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_pinjaman', $data);
      }
      $data = [
        'member' => $this->input->post('member'),
        'angsuran_ke' => sprintf("%01s", $no_angsuran),
        'jumlah' => $this->input->post('jumlah'),
        'created_at' => date("d M Y"),
        'no_angsuran' => $this->input->post('no_angsuran'),
        'ket' => $this->input->post('ket')
      ];

      $this->db->insert('tb_angsuran', $data);
      $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Sukses!</strong> data anda telah berhasil melakukan pembayaran angsuran.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>');
      redirect('backend/modul/angsuran');
    }
  }
}

/* End of file Modeul.php */