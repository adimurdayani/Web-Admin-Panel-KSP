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
      <div class="col-sm-6">
        <div class="card">

          <div class="card-header">
            <h5>Data <?= $judul; ?></h5>
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

              <center>
                <h4>Detail Member</h4>
              </center>

              <form action="<?= base_url('backend/user/member_detail/') . $get_member['id_m']; ?>" method="POST">

                <input type="hidden" name="id_m" id="id_m" value="<?= $get_member['id_m'] ?>">

                <div class="form-group">
                  <label class="floating-label" for="member_id">ID Member</label>
                  <input type="text" class="form-control" id="member_id" name="member_id" value="<?= $get_member['member_id'] ?>" readonly>
                  <?= form_error('member_id', '<small class="text-danger">', '</small>') ?>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="floating-label" for="nik">NIK</label>
                      <input type="number" class="form-control" id="nik" name="nik" value="<?= $get_member['nik'] ?>">
                      <?= form_error('nik', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="floating-label" for="nama">Nama Lengkap</label>
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= $get_member['nama'] ?>">
                      <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="floating-label" for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="<?= $get_member['email'] ?>">
                  <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                </div>

                <center>
                  <b>Tempat Tanggal Lahir</b>
                </center>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="t_lahir" name="t_lahir" value="<?= $get_member['t_lahir'] ?>">
                      <?= form_error('t_lahir', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $get_member['tgl_lahir'] ?>">
                      <?= form_error('tgl_lahir', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="floating-label" for="no_hp">No. Telp</label>
                      <input type="number" class="form-control" id="no_hp" name="no_hp" value="<?= $get_member['no_hp'] ?>">
                      <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="floating-label" for="kelamin">Jenis Kelamin</label>
                      <select name="kelamin" id="kelamin" class="form-control">
                        <option value="Perempuan" <?php if ($get_member['kelamin'] != "Perempuan") : ?><?php else : ?>selected<?php endif; ?>>
                          Perempuan</option>
                        <option value="Laki-laki" <?php if ($get_member['kelamin'] != "Laki-laki") : ?><?php else : ?>selected<?php endif; ?>>
                          Laki-laki</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="floating-label" for="gol_darah">Golongan Darah</label>
                  <select name="gol_darah" id="gol_darah" class="form-control">
                    <option value="A" <?php if ($get_member['gol_darah'] != "A") : ?><?php else : ?>selected<?php endif; ?>>A
                    </option>
                    <option value="B" <?php if ($get_member['gol_darah'] != "B") : ?><?php else : ?>selected<?php endif; ?>>B
                    </option>
                    <option value="AB" <?php if ($get_member['gol_darah'] != "AB") : ?><?php else : ?>selected<?php endif; ?>>
                      AB</option>
                    <option value="O" <?php if ($get_member['gol_darah'] != "O") : ?><?php else : ?>selected<?php endif; ?>>O
                    </option>
                  </select>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="floating-label" for="agama">Agama</label>
                      <select name="agama" id="agama" class="form-control">
                        <option value="Islam" <?php if ($get_member['agama'] != "Islam") : ?><?php else : ?>selected<?php endif; ?>>Islam</option>
                        <option value="Hindu" <?php if ($get_member['agama'] != "Hindu") : ?><?php else : ?>selected<?php endif; ?>>Hindu</option>
                        <option value="Buda" <?php if ($get_member['agama'] != "Buda") : ?><?php else : ?>selected<?php endif; ?>>Buda</option>
                        <option value="Kristen" <?php if ($get_member['agama'] != "Kristen") : ?><?php else : ?>selected<?php endif; ?>>Kristen
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="floating-label" for="pekerjaan">Pekerjaan</label>
                      <input type="pekerjaan" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $get_member['pekerjaan'] ?>">
                      <?= form_error('pekerjaan', '<small class="text-danger">', '</small>') ?>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="floating-label" for="pekerjaan">Alamat</label>
                  <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"><?= $get_member['alamat'] ?></textarea>
                  <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                </div>

                <button type="submit" class="btn btn-primary">Ubah</button>
              </form>

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