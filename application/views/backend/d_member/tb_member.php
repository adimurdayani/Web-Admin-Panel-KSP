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
              <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add"><i class="feather icon-plus"></i> Tambah</a>

              <?= $this->session->flashdata('msg'); ?>
              <?= validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						', '</div>') ?>
              <div class="table-responsive">
                <table id="table" class="table">
                  <thead>
                    <tr>
                      <th class="text-center">Aksi</th>
                      <th class="text-center">No. Member</th>
                      <th class="text-center">NIK</th>
                      <th class="text-center">Nama</th>
                      <th class="text-center">Tempat, Tanggal Lahir</th>
                      <th class="text-center">Pekerjaan</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">No. Telp</th>
                      <th class="text-center">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $no = 1;
                    foreach ($get_member as $data) : ?>
                      <tr>
                        <td class="text-center">
                          <a href="" class="badge badge-warning" data-toggle="modal" data-target="#modal-edit<?= $data['id_m'] ?>"><i class=" feather icon-edit" title="Edit"></i></a>
                          <a href="<?= base_url('backend/user/member_detail/') . $data['id_m'] ?>" class="badge badge-success"><i class=" feather icon-eye" title="Detail"></i></a>
                          <a href="" class="badge badge-danger" data-toggle="modal" data-target="#modal-hapus<?= $data['id_m'] ?>"><i class=" feather icon-trash" title="Hapus"></i></a>
                        </td>
                        <td><?= $data['member_id'] ?></td>
                        <td><?= $data['nik'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['t_lahir'] ?>, <?= $data['tgl_lahir'] ?></td>
                        <td><?= $data['pekerjaan'] ?></td>
                        <td><?= $data['email'] ?></td>
                        <td><?= $data['no_hp'] ?></td>
                        <td class="text-center">
                          <?php if ($data['status'] != 0) : ?>
                            <div class="badge badge-success"><i class="feather icon-check"></i></div>
                          <?php else : ?>
                            <div class="badge badge-danger"><i class="feather icon-x"></i></div>
                          <?php endif; ?>
                        </td>
                      </tr>
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
      <form action="<?= base_url('backend/user/member') ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label class="floating-label" for="member_id">ID Member</label>
            <input type="text" class="form-control" id="member_id" name="member_id" value="M-<?= sprintf("%04s", $member_id) ?>" readonly>
            <?= form_error('member_id', '<small class="text-danger">', '</small>') ?>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="nik">NIK</label>
                <input type="number" class="form-control" id="nik" name="nik" value="<?= set_value('nik') ?>">
                <?= form_error('nik', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="nama">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama') ?>">
                <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="floating-label" for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
            <?= form_error('email', '<small class="text-danger">', '</small>') ?>
          </div>

          <label class="floating-label" for="t_lahir">Tempat dan Tanggal Lahir</label>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control" id="t_lahir" name="t_lahir" value="<?= set_value('t_lahir') ?>">
                <?= form_error('t_lahir', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir') ?>">
                <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="no_hp">No. Telp</label>
                <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= set_value('no_hp') ?>">
                <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="kelamin">Jenis Kelamin</label>
                <select name="kelamin" id="kelamin" class="form-control">
                  <option value="Perempuan">Perempuan</option>
                  <option value="Laki-laki">Laki-laki</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="floating-label" for="gol_darah">Golongan Darah</label>
            <select name="gol_darah" id="gol_darah" class="form-control">
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="AB">AB</option>
              <option value="O">O</option>
            </select>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="agama">Agama</label>
                <select name="agama" id="agama" class="form-control">
                  <option value="Islam">Islam</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Buda">Buda</option>
                  <option value="Kristen">Kristen</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="floating-label" for="pekerjaan">Pekerjaan</label>
                <input type="pekerjaan" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= set_value('pekerjaan') ?>">
                <?= form_error('pekerjaan', '<small class="text-danger">', '</small>') ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="floating-label" for="pekerjaan">Alamat</label>
            <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"></textarea>
            <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
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


<?php foreach ($get_member as $edit) : ?>
  <div id="modal-edit<?= $edit['id_m'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?= base_url('backend/user/member_edit') ?>" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Edit Status Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">

            <input type="hidden" name="id_m" value="<?= $edit['id_m'] ?>" id="id_m">

            <div class="form-group">
              <label class="floating-label" for="status">Aktivasi Status</label>
              <select name="status" id="status" class="form-control">
                <option value="0">Tidak Aktif</option>
                <option value="1">Aktif</option>
              </select>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn  btn-warning">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php foreach ($get_member as $hapus) : ?>
  <div id="modal-hapus<?= $hapus['id_m'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLiveLabel">Hapus Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

          <p>
            Apakah anda yakin ingin menghapus data <b><?= $hapus['nama'] ?></b>?
          </p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
          <a href="<?= base_url('backend/user/hapus_member/') . $hapus['id_m'] ?>" class="btn  btn-danger">Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>