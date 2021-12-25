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
            <div class="badge badge-light-danger"> Belum Lunas </div>
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
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="text-center">No. Pinjaman</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Jumlah Pinjaman</th>
                      <th class="text-center">Angsuran /Bulan</th>
                      <th class="text-center">Tenor</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($get_angsuran as $data) : ?>
                      <?php if ($data['tenor'] != 0) : ?>
                        <tr>
                          <td class="text-center"><?= $data['no_pinjaman'] ?></td>
                          <td><?= $data['nama'] ?></td>
                          <td class="text-center">IDR <?= number_format($data['jumlah'], 0, ',', ',') ?>,00,-
                          </td>
                          <td class="text-center">IDR <?= number_format($data['angsuran'], 0, ',', ',') ?>,00,-
                          </td>
                          <td class="text-center"><?= $data['tenor'] ?> Bulan</td>
                          <td class="text-center">
                            <?php if ($data['tenor'] == 0) : ?>
                              <div class="badge badge-success">Lunas</div>
                            <?php else : ?>
                              <div class="badge badge-danger">Belum Lunas</div>
                            <?php endif; ?>
                          </td>
                          <td class="text-center">
                            <?php if ($data['tenor'] != 0) : ?>
                              <a href="<?= base_url('backend/modul/angsuran_detail/') . $data['id'] ?>" class="badge badge-success"><i class="feather icon-eye" title="Detail"></i> Bayar</a>
                            <?php else : ?>
                              <a href="" class="badge badge-danger"><i class="feather icon-trash" title="Detail"></i> Hapus</a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endif; ?>
                    <?php endforeach; ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ sample-page ] end -->

      <!-- [ sample-page ] start -->
      <div class="col-sm-12">
        <div class="card">

          <div class="card-header">
            <h5>Tabel <?= $judul; ?></h5>
            <div class="badge badge-light-success"> Lunas </div>
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
              <div class="table-responsive">
                <table id="table" class="table">
                  <thead>
                    <tr>
                      <th class="text-center">No. Pinjaman</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Angsuran /Bulan</th>
                      <th class="text-center">Tenor</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($get_angsuran as $get_data) : ?>
                      <?php if ($get_data['tenor'] == 0) : ?>
                        <tr>
                          <td class="text-center"><?= $get_data['no_pinjaman'] ?></td>
                          <td><?= $get_data['nama'] ?></td>
                          <td class="text-center">IDR <?= number_format($get_data['angsuran'], 0, ',', ',') ?>,00,-
                          </td>
                          <td class="text-center"><?= $get_data['tenor'] ?> Bulan</td>
                          <td class="text-center">
                            <?php if ($get_data['tenor'] == 0) : ?>
                              <div class="badge badge-success">Lunas</div>
                            <?php else : ?>
                              <div class="badge badge-danger">Belum Lunas</div>
                            <?php endif; ?>
                          </td>
                          <td class="text-center">
                            <?php if ($get_data['tenor'] != 0) : ?>
                              <a href="<?= base_url('backend/modul/angsuran_detail/') . $get_data['id'] ?>" class="badge badge-success"><i class="feather icon-eye" title="Detail"></i> Bayar</a>
                            <?php else : ?>
                              <a href="" class="badge badge-danger"><i class="feather icon-trash" title="Detail"></i> Hapus</a>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endif; ?>
                    <?php endforeach; ?>

                  </tbody>
                </table>
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