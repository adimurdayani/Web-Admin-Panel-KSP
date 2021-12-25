<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10"><?= $judul;?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url()?>"><i class="feather icon-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#!"><?= $judul;?></a></li>
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
            <h5>Tabel <?=$judul;?></h5>
            <div class="card-header-right">
              <div class="btn-group card-option">
                <button type="button" class="btn dropdown-toggle btn-icon" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
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
              <div class="row mb-2">
                <div class="col-md-9">
                  <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal-add"><i
                      class="feather icon-plus"></i> Tambah</a>
                  <a href="<?= base_url('backend/modul/cetak_semua')?>" class="btn btn-warning mb-2"><i
                      class="feather icon-printer"></i> Print</a>
                </div>
                <div class="col">
                  <form action="<?= base_url('backend/modul/cari_data_simpanan/')?>" method="GET">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="cari" id="cari" placeholder="Input ID Member"
                        aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn  btn-secondary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <?= $this->session->flashdata('msg');?>
              <?= validation_errors( '<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						','</div>')?>
              <div class="table-responsive">
                <table id="table" class="table">
                  <thead>
                    <tr>
                      <th class="text-center">No. Simpanan</th>
                      <th class="text-center">Id Member</th>
                      <th class="text-center">Tanggal Transaksi</th>
                      <th class="text-center">Jumlah</th>
                      <th class="text-center">Jenis Simpanan</th>
                      <th class="text-center">Catatan</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $no = 1; foreach($get_simpanan as $data):?>
                    <tr>
                      <td class="text-center"><?= $data['no_simpanan']?></td>
                      <td class="text-center"><?= $data['member_id']?></td>
                      <td class="text-center"><?= $data['created_at']?></td>
                      <td class="text-right">Rp. <?= number_format($data['jumlah'], 0,',',',')?></td>
                      <td class="text-center"><?= $data['j_simpanan']?></td>
                      <td class="text-center"><?= $data['catatan']?></td>
                      <td class="text-center">
                        <a href="" class="badge badge-warning" data-toggle="modal"
                          data-target="#modal-edit<?= $data['id']?>"><i class=" feather icon-edit" title="Edit"></i></a>
                        <a href="" class="badge badge-danger" data-toggle="modal"
                          data-target="#modal-hapus<?= $data['id']?>"><i class=" feather icon-trash"
                            title="Hapus"></i></a>
                      </td>
                    </tr>
                    <?php endforeach;?>
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

<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('backend/modul/')?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Simpanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label class="floating-label" for="no_simpanan">No. Simpanan</label>
            <input type="no_simpanan" class="form-control" id="no_simpanan" name="no_simpanan"
              value="S-<?= sprintf("%04s", $no_simpanan)?>" readonly>
            <?= form_error('no_simpanan', '<small class="text-danger">', '</small>')?>
          </div>

          <div class="form-group">
            <label class="label" for="m_id">Member</label>
            <select name="m_id" id="m_id" class="form-control">
              <?php foreach($get_member as $member):?>
              <option value="<?= $member['id_m']?>"><?= $member['nik']?> - <?= $member['nama']?></option>
              <?php endforeach;?>
            </select>
          </div>

          <div class="form-group">
            <label class="floating-label" for="jumlah">Jumlah Simpanan</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= set_value('jumlah')?>">
            <?= form_error('jumlah', '<small class="text-danger">', '</small>')?>
          </div>

          <div class="form-group">
            <label class="label" for="j_simpanan">Jenis Simpanan</label>
            <select name="j_simpanan" id="j_simpanan" class="form-control">
              <option value="Pokok">Pokok</option>
              <option value="Mudarabah">Mudarabah</option>
              <option value="Kurban">Kurban</option>
            </select>
          </div>

          <div class="form-group">
            <label class="floating-label" for="catatan">Catatan</label>
            <textarea name="catatan" id="catatan" cols="10" class="form-control" rows="5"></textarea>
            <?= form_error('catatan', '<small class="text-danger">', '</small>')?>
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

<?php foreach($get_simpanan as $edit):?>
<div id="modal-edit<?= $edit['id']?>" class="modal fade" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?= base_url('backend/modul/simpanan_edit')?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLiveLabel">Tambah Simpanan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id" value="<?= $edit['id']?>">

          <div class="form-group">
            <label class="floating-label" for="no_simpanan">No. Simpanan</label>
            <input type="no_simpanan" class="form-control" id="no_simpanan" name="no_simpanan"
              value="<?= $edit['no_simpanan']?>" readonly>
            <?= form_error('no_simpanan', '<small class="text-danger">', '</small>')?>
          </div>

          <div class="form-group">
            <label class="label" for="m_id">Member</label>
            <select name="m_id" id="m_id" class="form-control">
              <?php foreach($get_member as $member):?>
              <option value="<?= $member['id_m']?>" <?php if($edit['m_id'] != $member['id_m']):?> <?php else:?> selected
                <?php endif;?>><?= $member['nik']?> - <?= $member['nama']?></option>
              <?php endforeach;?>
            </select>
          </div>

          <div class="form-group">
            <label class="floating-label" for="jumlah">Jumlah Simpanan</label>
            <input type="jumlah" class="form-control" id="jumlah" name="jumlah" value="<?= $edit['jumlah']?>">
            <?= form_error('jumlah', '<small class="text-danger">', '</small>')?>
          </div>

          <div class="form-group">
            <label class="label" for="j_simpanan">Jenis Simpanan</label>
            <select name="j_simpanan" id="j_simpanan" class="form-control">
              <option value="Pokok" <?php if($edit['j_simpanan'] != "Pokok"):?> <?php else:?> selected <?php endif;?>>
                Pokok</option>
              <option value="Mudarabah" <?php if($edit['j_simpanan'] != "Mudarabah"):?> <?php else:?> selected
                <?php endif;?>>Mudarabah</option>
              <option value="Kurban" <?php if($edit['j_simpanan'] != "Kurban"):?> <?php else:?> selected <?php endif;?>>
                Kurban</option>
            </select>
          </div>

          <div class="form-group">
            <label class="floating-label" for="catatan">Jumlah Simpanan</label>
            <textarea name="catatan" id="catatan" cols="10" class="form-control"
              rows="5"><?= $edit['catatan']?></textarea>
            <?= form_error('catatan', '<small class="text-danger">', '</small>')?>
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
<?php endforeach;?>

<?php foreach($get_simpanan as $hapus):?>
<div id="modal-hapus<?= $hapus['id']?>" class="modal fade" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLiveLabel">Hapus Data Simpanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <input type="hidden" name="id" value="">

        <p>
          Apakah anda yakin ingin menghapus data <b><?= $hapus['no_simpanan']?></b>?
        </p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
        <a href="<?= base_url('backend/modul/hapus_simpanan/').$hapus['id']?>" class="btn  btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>
<?php endforeach;?>