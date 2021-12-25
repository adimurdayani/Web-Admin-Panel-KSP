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
                </div>
                <div class="col">
                  <form action="<?= base_url('backend/modul/cari_id_pinjaman/')?>" method="GET">
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
                      <th class="text-center">No. Pinjaman</th>
                      <th class="text-center">ID Member</th>
                      <th class="text-center">Tanggal Transaksi</th>
                      <th class="text-center">Jumlah</th>
                      <th class="text-center">Tenor</th>
                      <th class="text-center">Bunga</th>
                      <th class="text-center">Angsuran</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $no = 1; foreach($get_pinjaman as $data):
                      $besar_cicilan = $data['jumlah'] / $data['tenor'];

                      $bunga = ($data['bunga'] * $data['jumlah']) / $data['tenor'];

                      $total = $besar_cicilan + $bunga;
                      ?>
                    <tr>
                      <td class="text-center"><?= $data['no_pinjaman']?></td>
                      <td class="text-center"><?= $data['member_id']?></td>
                      <td class="text-center"><?= $data['created_at']?></td>
                      <td class="text-center">Rp. <?= number_format($data['jumlah'], 0,',',',')?></td>
                      <td class="text-right"><?= $data['tenor']?></td>
                      <td class="text-right"><?= $data['bunga']?> %</td>
                      <td class="text-right">Rp. <?= number_format($besar_cicilan + $bunga, 0,',',',')?></td>
                      <td class="text-center">
                        <?php if($data['status'] != 0): ?>
                        <a href="" class="badge badge-success" data-toggle="modal"
                          data-target="#modal-updatestatus<?= $data['id']?>">
                          <i class="feather icon-check" title="Update Status"></i>
                        </a>
                        <?php else:?>
                        <a href="" class="badge badge-danger" data-toggle="modal"
                          data-target="#modal-updatestatus<?= $data['id']?>">
                          <i class="feather icon-x" title="Update Status"></i>
                        </a>
                        <?php endif;?>
                      </td>
                      <td class="text-center">
                        <a href="<?= base_url('backend/modul/cetak_id_pinjaman/') . $data['id']?>"
                          class="badge badge-primary"><i class=" feather icon-printer" title="Print Data"></i></a>
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