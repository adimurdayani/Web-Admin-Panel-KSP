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
              <?= $this->session->flashdata('msg');
              ?>
            </div>
            <div class="card-body">
              <div class="card-body table-border-style">

                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">No. Pinjaman</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Angsuran #</th>
                        <th class="text-center">Tenor Angsuran</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center"><?= $get_pinjaman['no_pinjaman'] ?></td>
                        <td><?= $get_pinjaman['nama'] ?></td>
                        <td class="text-center">IDR. <?= number_format($get_pinjaman['angsuran'], 0, ',', ',') ?>,00,-</td>
                        <td class="text-center"><?= $get_pinjaman['tenor'] ?> Bulan
                        </td>
                        <td class="text-center">
                          <?php if ($get_pinjaman['tenor'] == 0) : ?>
                            <div class="badge badge-success">Lunas</div>
                          <?php else : ?>
                            <div class="badge badge-danger">Belum Lunas</div>
                          <?php endif; ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="col-md-4">
                    <table class="table">
                      <tr>
                        <th>Angsuran Ke</th>
                        <th>: <?= sprintf("%0s", $no_angsuran) ?></th>
                      </tr>

                      <tr>
                        <th>Jumlah Angsuran</th>
                        <th>: IDR. <?= number_format($get_pinjaman['angsuran'], 0, ',', ',') ?>,00,-</th>
                      </tr>
                      <form action="" method="post">
                        <tr>
                          <td>Keterangan</td>
                          <td>
                            <input type="hidden" name="no_angsuran" id="no_angsuran" value="A-<?= sprintf("%04s", $no_angsuran) ?>">
                            <input type="hidden" name="id_pinjam" id="id_pinjam" value="<?= $get_pinjaman['id'] ?>">
                            <input type="hidden" name="member" id="member" value="<?= $get_pinjaman['user_id'] ?>">
                            <input type="hidden" name="jumlah" id="jumlah" value="<?= $get_pinjaman['angsuran'] ?>">
                            <input type="hidden" name="angsuran_ke" id="angsuran_ke" value="<?= sprintf("%0s", $no_angsuran) ?>">
                            <textarea name="ket" id="ket" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                            <?= form_error('ket', '<small class="text-danger">', '</small>') ?>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>
                            <a href="<?= base_url('backend/modul/angsuran') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-warning"><i class="feather icon-credit-card"></i>
                              Bayar</button>
                          </td>
                        </tr>
                      </form>
                    </table>
                  </div>
                </div>
              </div>
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