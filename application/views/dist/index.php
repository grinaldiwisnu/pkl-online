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
                        <?= $total_product; ?>/<?= $user->TARGET; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h4>Produk Rekomendasi <?= ucwords(strtolower($user->COMPANY_NAME)); ?></h4>
                </div>
                <div class="card-body">
                  <div class="owl-carousel owl-theme" id="products-carousel">
                    <div>
                      <div class="product-item pb-3">
                        <div class="product-image">
                          <img alt="image" src="<?= base_url(); ?>/assets/img/products/product-4-50.png" class="img-fluid">
                        </div>
                        <div class="product-details">
                          <div class="product-name">iBook Pro 2018</div>
                          <div class="product-review">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                          </div>
                          <div class="text-muted text-small">67 Sales</div>
                          <div class="product-cta">
                            <a href="#" class="btn btn-primary">Detail</a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div>
                      <div class="product-item">
                        <div class="product-image">
                          <img alt="image" src="<?= base_url(); ?>/assets/img/products/product-3-50.png" class="img-fluid">
                        </div>
                        <div class="product-details">
                          <div class="product-name">oPhone S9 Limited</div>
                          <div class="product-review">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                          </div>
                          <div class="text-muted text-small">86 Sales</div>
                          <div class="product-cta">
                            <a href="#" class="btn btn-primary">Detail</a>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div>
                      <div class="product-item">
                        <div class="product-image">
                          <img alt="image" src="<?= base_url(); ?>/assets/img/products/product-1-50.png" class="img-fluid">
                        </div>
                        <div class="product-details">
                          <div class="product-name">Headphone Blitz</div>
                          <div class="product-review">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                          </div>
                          <div class="text-muted text-small">63 Sales</div>
                          <div class="product-cta">
                            <a href="#" class="btn btn-primary">Detail</a>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>Backend Engineer</h4>
                      </div>
                      <div class="ticket-info">
                        <div>PT Majoo Teknologi Indonesia</div>
                      </div>
                    </a>
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>Backend Engineer</h4>
                      </div>
                      <div class="ticket-info">
                        <div>PT Majoo Teknologi Indonesia</div>
                      </div>
                    </a>
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>Backend Engineer</h4>
                      </div>
                      <div class="ticket-info">
                        <div>PT Majoo Teknologi Indonesia</div>
                      </div>
                    </a>
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>Backend Engineer</h4>
                      </div>
                      <div class="ticket-info">
                        <div>PT Majoo Teknologi Indonesia</div>
                      </div>
                    </a>
                    <a href="#" class="ticket-item">
                      <div class="ticket-title">
                        <h4>Backend Engineer</h4>
                      </div>
                      <div class="ticket-info">
                        <div>PT Majoo Teknologi Indonesia</div>
                      </div>
                    </a>
                    <a href="<?php echo base_url(); ?>dist/features_tickets" class="ticket-item ticket-more">
                      Lihat Semua <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>