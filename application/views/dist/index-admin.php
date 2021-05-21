<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Pengguna</h4>
                  </div>
                  <div class="card-body">
                    <?= $total_user; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Penjualan</h4>
                  </div>
                  <div class="card-body">
                  <?= $total_selling; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-shopping-basket"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Produk</h4>
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
                  <i class="fas fa-hotel"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Perusahaan</h4>
                  </div>
                  <div class="card-body">
                  <?= $total_company; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- <div class="col-md-8">
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
              <div class="card card-hero">
                <div class="card-header">
                  <div class="card-icon">
                    <i class="far fa-question-circle"></i>
                  </div>
                  <h4>1</h4>
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
                    <a href="<?php echo base_url(); ?>dist/features_tickets" class="ticket-item ticket-more">
                      Lihat Semua <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>