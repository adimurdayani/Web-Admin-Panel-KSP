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
              <div class="row">
                <div class="col-md-8">
                  <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add"><i class="feather icon-plus"></i> Tambah</a>
                  <a href="<?= base_url('backend/modul/cetak_semua_pinjaman') ?>" class="btn btn-warning mb-2"><i class="feather icon-printer"></i> Print</a>
                </div>
                <div class="col">
                  <form action="<?= base_url('backend/modul/cari_id_pinjaman/') ?>" method="GET">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="cari" id="cari" placeholder="Input ID Member" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn  btn-secondary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <?= $this->session->flashdata('msg'); ?>
              <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						', '</div>') ?>
              <div class="table-responsive">
                <table id="table" class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Aksi</th>
                      <th class="text-center">No. Pinjaman</th>
                      <th class="text-center">ID Member</th>
                      <th class="text-center">Tanggal Transaksi</th>
                      <th class="text-center">Jumlah</th>
                      <th class="text-center">Tenor</th>
                      <th class="text-center">Bunga</th>
                      <th class="text-center">Angsuran</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($get_pinjaman as $data) : ?>
                      <?php if ($data['tenor'] != 0) : ?>
                        <tr>
                          <td class="text-center">
                            <a href="<?= base_url('backend/modul/pinjam_detail/') . $data['id'] ?>" class="badge badge-success"><i class="feather icon-eye" title="Detail"></i> Detail</a>

                            <a href="" class="badge badge-warning" data-toggle="modal" data-target="#modal-edit<?= $data['id'] ?>"><i class=" feather icon-edit" title="Edit"></i> Edit</a>

                            <a href="" class="badge badge-danger" data-toggle="modal" data-target="#modal-hapus<?= $data['id'] ?>"><i class=" feather icon-trash" title="Hapus"></i> Hapus</a>
                          </td>
                          <td class="text-center"><?= $data['no_pinjaman'] ?></td>
                          <td class="text-center"><?= $data['member_id'] ?></td>
                          <td class="text-center"><?= $data['created_at'] ?></td>
                          <td>IDR <?= number_format($data['jumlah'], 0, '.', '.') ?>,00,-</td>
                          <td class="text-right"><?= $data['tenor'] ?> Bulan</td>
                          <td class="text-right"><?= $data['bunga'] ?> %</td>
                          <td>IDR <?= number_format($data['angsuran'], 0, '.', '.') ?></td>
                          <td>
                            <?php if ($data['tenor'] == 0) : ?>
                              <div class="badge badge-success"><i class="feather icon-check"></i> Lunas</div>
                            <?php else : ?>
                              <div class="badge badge-danger"><i class="feather icon-x"></i> Belum Lunas</div>
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

<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('backend/modul/pinjam') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Pinjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label class="floating-label" for="no_pinjaman">No. Pinjaman</label>
            <input type="text" class="form-control" id="no_pinjaman" name="no_pinjaman" value="P-<?= sprintf("%04s", $no_pinjaman) ?>" readonly>
          </div>

          <div class="form-group">
            <label class="label" for="user_id">Member</label>
            <select name="user_id" id="user_id" class="form-control">
              <?php foreach ($get_member as $member) : ?>
                <option value="<?= $member['id_m'] ?>"><?= $member['nik'] ?> - <?= $member['nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="jumlah">Jumlah Pinjaman</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= set_value('jumlah') ?>">
                <?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="bunga">Bunga % Pertahun</label>
                <input type="text" class="form-control" id="bunga" name="bunga" value="0.1" readonly>
                <?= form_error('bunga', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="floating-label" for="tenor">Tenor</label>
            <select name="tenor" id="tenor" class="form-control">
              <option value="6">6 Bulan</option>
              <option value="12">12 Bulan</option>
              <option value="18">18 Bulan</option>
              <option value="24">24 Bulan</option>
              <option value="36">36 Bulan</option>
              <option value="48">48 Bulan</option>
            </select>
          </div>

          <div class="form-group">
            <label class="floating-label" for="biaya_admin">Biaya Admin</label>
            <input type="number" class="form-control" id="biaya_admin" name="biaya_admin" value="<?= set_value('biaya_admin') ?>">
            <?= form_error('biaya_admin', '<small class="text-danger">', '</small>') ?>
          </div>

          <div class="form-group">
            <label class="floating-label" for="user_active">Keterangan</label>
            <textarea name="keterangan" id="keteragnan" cols="30" rows="5" class="form-control"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn  btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($get_pinjaman as $edit) : ?>
  <div id="modal-edit<?= $edit['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?= base_url('backend/modul/pinjam_edit') ?>" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Pinjaman</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id" id="id" value="<?= $edit['id'] ?>">

            <div class="form-group">
              <label class="floating-label" for="no_pinjaman">No. Pinjaman</label>
              <input type="text" class="form-control" id="no_pinjaman" name="no_pinjaman" value="<?= $edit['no_pinjaman'] ?>" readonly>
            </div>

            <div class="form-group">
              <label class="label" for="user_id">Member</label>
              <select name="user_id" id="user_id" class="form-control">
                <?php foreach ($get_member as $member) : ?>
                  <option value="<?= $member['id_m'] ?>" <?php if ($edit['user_id'] != $member['id_m']) : ?> <?php else : ?> selected <?php endif; ?>><?= $member['nik'] ?> - <?= $member['nama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="floating-label" for="jumlah">Jumlah Pinjaman</label>
                  <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $edit['jumlah'] ?>">
                  <?= form_error('jumlah', '<small class="text-danger">', '</small>') ?>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="floating-label" for="bunga">Bunga % Pertahun</label>
                  <input type="text" class="form-control" id="bunga" name="bunga" value="0.1" readonly>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="floating-label" for="tenor">Tenor</label>
              <select name="tenor" id="tenor" class="form-control">
                <option value="6" <?php if ($edit['tenor'] != "6") : ?> <?php else : ?> selected <?php endif; ?>>6 Bulan
                </option>
                <option value="12" <?php if ($edit['tenor'] != "12") : ?> <?php else : ?> selected <?php endif; ?>>12 Bulan
                </option>
                <option value="18" <?php if ($edit['tenor'] != "18") : ?> <?php else : ?> selected <?php endif; ?>>18 Bulan
                </option>
                <option value="24" <?php if ($edit['tenor'] != "24") : ?> <?php else : ?> selected <?php endif; ?>>24 Bulan
                </option>
                <option value="36" <?php if ($edit['tenor'] != "36") : ?> <?php else : ?> selected <?php endif; ?>>36 Bulan
                </option>
                <option value="48" <?php if ($edit['tenor'] != "48") : ?> <?php else : ?> selected <?php endif; ?>>48 Bulan
                </option>
              </select>
            </div>

            <div class="form-group">
              <label class="floating-label" for="biaya_admin">Biaya Admin</label>
              <input type="number" class="form-control" id="biaya_admin" name="biaya_admin" value="<?= $edit['biaya_admin'] ?>">
              <?= form_error('biaya_admin', '<small class="text-danger">', '</small>') ?>
            </div>

            <div class="form-group">
              <label class="floating-label" for="user_active">Keterangan</label>
              <textarea name="keterangan" id="keteragnan" cols="30" rows="5" class="form-control"><?= $edit['keterangan'] ?></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn  btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php foreach ($get_pinjaman as $hapus) : ?>
  <div id="modal-hapus<?= $hapus['id'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLiveLabel">Hapus Data Pinjaman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

          <p>
            Apakah anda yakin ingin menghapus data <b><?= $hapus['no_pinjaman'] ?></b>?
          </p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
          <a href="<?= base_url('backend/modul/pinjaman_hapus/') . $hapus['id'] ?>" class="btn  btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>