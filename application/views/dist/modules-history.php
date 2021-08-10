<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Riwayat Transaksi</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
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
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Pembelian</th>
                            <th>Total Pembelian</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php $no = 1; foreach ($transactions as $key): ?>                                         
                          <tr>
                            <td>
                              <?= $no; ?>
                            </td>
                            <td><?= $key->USER_FULLNAME; ?></td>
                            <td><?= date("d F Y h:i:s", strtotime($key->TRANSACTION_DATE)); ?></td>
                            <td><?= $key->PAYMENT_TOTAL; ?></td>
                            <td><?= $key->PAYMENT_METHOD; ?></td>
                            <td>
                              <div class="badge badge-info">
                                <?php 
                                  if ($key->TRANSACTION_STATUS == 1) {
                                    echo 'Menunggu Pembayaran';
                                  } else if ($key->TRANSACTION_STATUS == 2) {
                                    echo 'Menunggu Konfirmasi';
                                  } else if ($key->TRANSACTION_STATUS == 3) {
                                    echo 'Menunggu Barang Diproses';
                                  } else if ($key->TRANSACTION_STATUS == 4) {
                                    echo 'Barang Dikirim';
                                  } else if ($key->TRANSACTION_STATUS == 5) {
                                    echo 'Transaksi Berhasil';
                                  } else {
                                    echo 'Transaksi Gagal';
                                  }
                                ?>
                              </div>
                            </td>
                            <td><a href="<?= base_url(); ?>transaction/detail/<?= $key->TRANSACTION_ID; ?>" class="btn btn-info btn-sm">Detail</a></td>
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