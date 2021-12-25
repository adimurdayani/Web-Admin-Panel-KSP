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
                <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#!"><?= $judul;?></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-lg-7 col-md-12">
          <!-- support-section start -->
          <div class="row">
            <div class="col-sm-6">
              <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                  <h2 class="m-0">TOTAL</h2>
                  <span class="text-c-blue">Menu Manajemen</span>
                  <p class="mb-3 mt-3">Total menu manajemen.</p>
                </div>
                <div class="card-footer bg-primary text-white">
                  <div class="row text-center">
                    <div class="col">
                      <h4 class="m-0 text-white"><?= $jml_menu?></h4>
                      <span>Menu</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card support-bar overflow-hidden">
                <div class="card-body pb-0">
                  <h2 class="m-0">TOTAL</h2>
                  <span class="text-c-green">Sub Menu Manajemen</span>
                  <p class="mb-3 mt-3">Total sub menu manajemen.</p>
                </div>
                <div class="card-footer bg-success text-white">
                  <div class="row text-center">
                    <div class="col">
                      <h4 class="m-0 text-white"><?= $jml_sub_menu?></h4>
                      <span>Sub Menu</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- support-section end -->
        </div>
        <div class="col-lg-5 col-md-12">
          <!-- page statustic card start -->
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-yellow">0</h4>
                      <h6 class="text-muted m-b-0">Judul Terkirim</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-bar-chart-2 f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-yellow">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">Data</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-green">0</h4>
                      <h6 class="text-muted m-b-0">Data Tema</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-file-text f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-green">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">Data</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-red"><?= $jml_user?></h4>
                      <h6 class="text-muted m-b-0">User Management</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-users f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-red">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">Data User</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-down text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="text-c-blue"><?= $jml_grup?></h4>
                      <h6 class="text-muted m-b-0">Grup User</h6>
                    </div>
                    <div class="col-4 text-right">
                      <i class="feather icon-settings f-28"></i>
                    </div>
                  </div>
                </div>
                <div class="card-footer bg-c-blue">
                  <div class="row align-items-center">
                    <div class="col-9">
                      <p class="text-white m-b-0">Data Grup</p>
                    </div>
                    <div class="col-3 text-right">
                      <i class="feather icon-trending-down text-white f-16"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- page statustic card end -->
        </div>

      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- [ Main Content ] end -->