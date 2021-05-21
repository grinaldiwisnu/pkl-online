<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Riwayat Semua Transaksi</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Riwayat</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Riwayat Transaksi</h2>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>                                 
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Nama Produk</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Pembelian</th>
                            <th>Total Pembelian</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php $no = 1; foreach ($selling as $key): ?>                                         
                          <tr>
                            <td>
                              <?= $no; ?>
                            </td>
                            <td><?= $key->PRODUCT_NAME; ?></td>
                            <td><?= $key->USER_FULLNAME; ?></td>
                            <td><?= $key->TRANSACTION_DATE; ?></td>
                            <td><?= $key->PAYMENT_TOTAL; ?></td>
                            <td><?= $key->PAYMENT_METHOD; ?></td>
                            <td><div class="badge badge-success"><td><?= $key->TRANSACTION_STATUS; ?></td></div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                          <?php $no++; endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>