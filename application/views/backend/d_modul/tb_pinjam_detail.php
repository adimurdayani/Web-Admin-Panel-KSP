<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?= $judul; ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!"><?= $judul; ?></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-sm-12">
        <div class="card">

          <div class="card-header">
            <h5>Tabel <?= $judul; ?></h5>
            <div class="card-header-right">
              <div class="btn-group card-option">
                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="feather icon-more-horizontal"></i>
                </button>
                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                  <li class="dropdown-item full-card"><a href="#!"><span><i class="feather icon-maximize"></i>
                        maximize</span><span style="display:none"><i class="feather icon-minimize"></i>
                        Restore</span></a></li>
                  <li class="dropdown-item minimize-card"><a href="#!"><span><i class="feather icon-minus"></i>
                        collapse</span><span style="display:none"><i class="feather icon-plus"></i> expand</span></a>
                  </li>
                  <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a>
                  </li>
                  <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="card-body table-border-style">

              <div class="row mb-3">
                <div class="col-md-4">
                  <u>Koperasi:</u><br>
                  <b><?= $user_ses['nama'] ?></b>
                  <table>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><?= $user_ses['alamat'] ?></td>
                    </tr>
                    <tr>
                      <td>Phone</td>
                      <td>:</td>
                      <td><?= $user_ses['phone'] ?></td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>:</td>
                      <td><?= $user_ses['email'] ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-4">
                  <u>To:</u><br>
                  <b><?= $get_pinjaman['nama']; ?></b>
                  <table>
                    <tr>
                      <td>Phone</td>
                      <td>:</td>
                      <td><?= $get_pinjaman['no_hp']; ?></td>
                    </tr>
                    <tr>
                      <td>Alamat</td>
                      <td>:</td>
                      <td><?= $get_pinjaman['alamat']; ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col">
                  <table>
                    <tr>
                      <td><b>Transaksi No</b></td>
                      <td><b>#</b></td>
                      <td><b><?= $get_pinjaman['no_pinjaman']; ?></b></td>
                    </tr>
                    <tr>
                      <td><b>Member ID</b></td>
                      <td><b>:</b></td>
                      <td><b><?= $get_pinjaman['member_id']; ?></b></td>
                    </tr>

                    <tr>
                      <td><b>Biaya Admin</b></td>
                      <td><b>:</b></td>
                      <td><b>Rp<?= number_format($get_pinjaman['biaya_admin'], 0, '.', '.'); ?></b></td>
                    </tr>
                  </table>
                </div>
              </div>

              <?= $this->session->flashdata('msg'); ?>
              <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						', '</div>') ?>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Jumlah Pinjaman</th>
                      <th class="text-center">Tenor</th>
                      <th class="text-center">Bunga % Pertahun</th>
                      <th class="text-center">Angsuran</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php


                    ?>
                    <tr>
                      <td class="text-center">IDR <?= number_format($get_pinjaman['jumlah'], 0, ',', ',') ?>,00,-</td>
                      <td class="text-center"><?= $get_pinjaman['tenor'] ?> Bulan</td>
                      <td class="text-center"><?= $get_pinjaman['bunga'] ?> %</td>
                      <td class="text-right">IDR <?php
                                                  $besar_cicilan = @($get_pinjaman['jumlah'] / $get_pinjaman['tenor']);
                                                  $bunga = @(($get_pinjaman['bunga'] * $get_pinjaman['jumlah']) / $get_pinjaman['tenor']);

                                                  echo number_format($besar_cicilan + $bunga, 0, ',', ',') ?>,00,-
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <a href="<?= base_url('backend/modul/cetak_id_pinjaman/') . $get_pinjaman['id'] ?>" class="btn btn-warning mt-3 float-right"><i class="feather icon-printer"></i> Print</a>
            </div>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
</div>
<!-- [ Main Content ] end -->