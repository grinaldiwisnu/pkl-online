<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
              <div class="row">
                <div class="col-md-8">
                <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Produk Saya</h4>
                      </div>
                      <div class="card-body">
                        <?= $total_product; ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Sales</h4>
                      </div>
                      <div class="card-body">
                        <?= $total_selling; ?>/<?= !empty($user->TARGET) ? $user->TARGET : "0"; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php if (!empty($user->COMPANY_ID)): ?>
              <div class="card">
                <div class="card-header">
                  <h4>Produk Rekomendasi <?= ucwords(strtolower($user->COMPANY_NAME)); ?></h4>
                </div>
                <div class="card-body">
                  <div class="owl-carousel owl-theme" id="products-carousel">
                    <?php foreach ($products as $key): ?>
                      <div>
                        <div class="product-item pb-3">
                          <div class="product-image">
                            <img alt="image" src="<?= $key->IMAGE == null ? base_url().'assets/img/news/img07.jpg' : base_url().'upload/products/'.$key->IMAGE->PRODUCT_IMAGE_NAME; ?>" class="img-fluid">
                          </div>
                          <div class="product-details">
                            <div class="product-name"><?= $key->PRODUCT_NAME; ?></div>
                            <div class="text-muted text-small">Rp<?= number_format($key->PRODUCT_PRICE); ?></div>
                            <div class="product-cta">
                              <a href="#" class="btn btn-primary">Pilih Produk</a>
                            </div>
                          </div>  
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <div class="card">
                <div class="card-header">
                  <h4>Transaksi</h4>
                  <div class="card-header-action">
                    <a href="#" class="btn btn-danger">Lihat lainnya <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped table-hover">
                      <tr>
                        <th>ID Transaksi</th>
                        <th>Nama Produk</th>
                        <th>Status</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Action</th>
                      </tr>
                      <tr>
                        <td colspan="5" style="text-align:center">Belum ada transaksi berlangsung</td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-description">Job Vacancies</div>
                </div>
                <div class="card-body p-0">
                  <div class="tickets-list">
                    <?php foreach($jobs as $job): ?>
                      <a class="ticket-item">
                        <div class="ticket-title">
                          <h4><?= $job->JOB_POSITION; ?></h4>
                        </div>
                        <div><?= $job->JOB_COMPANY; ?></div>
                        <div class="ticket-info">
                          <div class="text-primary text-small"><?= date('d F Y', strtotime($job->JOB_START)); ?> - <?= date('d F Y', strtotime($job->JOB_END)); ?></div>
                        </div>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>