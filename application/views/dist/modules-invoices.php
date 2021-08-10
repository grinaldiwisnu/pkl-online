<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1><?= $transaction->TRANSACTION_CODE; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Transaksi</a></div>
              <div class="breadcrumb-item">Detail</div>
            </div>
          </div>

          <div class="section-body">
            <div class="invoice">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="invoice-title">
                      <h3><div class="badge badge-info"><?php 
                                  if ($transaction->TRANSACTION_STATUS == 1) {
                                    echo 'Menunggu Pembayaran';
                                  } else if ($transaction->TRANSACTION_STATUS == 2) {
                                    echo 'Menunggu Konfirmasi';
                                  } else if ($transaction->TRANSACTION_STATUS == 3) {
                                    echo 'Menunggu Barang Diproses';
                                  } else if ($transaction->TRANSACTION_STATUS == 4) {
                                    echo 'Barang Dikirim';
                                  } else if ($transaction->TRANSACTION_STATUS == 5) {
                                    echo 'Transaksi Berhasil';
                                  } else {
                                    echo 'Transaksi Gagal';
                                  }
                                ?></div></h3>
                      <div class="invoice-number"><?= $transaction->TRANSACTION_CODE; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                          <strong>Billed To:</strong><br>
                            <?= $transaction->USER_FULLNAME; ?><br><br>
                            <strong>Tanggal Transaksi:</strong><br>
                          <?= date("d F Y h:i:s", strtotime($transaction->TRANSACTION_DATE)); ?><br><br>
                        </address>
                      </div>
                      <div class="offset-md-3 col-md-3 col-6 text-md-right">
                        <address>
                          <strong>Dikirim Kepada:</strong><br>
                          <?= $transaction->TRANSACTION_NAME; ?><br>
                          <?= $transaction->TRANSACTION_ADDRESS; ?>
                        </address>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <p class="section-lead">All items here cannot be deleted.</p>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                          <th data-width="40">#</th>
                          <th>Produk</th>
                          <th class="text-center">Harga</th>
                          <th class="text-center">Jumlah</th>
                          <th class="text-right">Total</th>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td><?= $transaction->PRODUCT_NAME; ?></td>
                          <td class="text-center"><?= number_format($transaction->PRODUCT_PRICE); ?></td>
                          <td class="text-center"><?= $transaction->TRANSACTION_QTY; ?></td>
                          <td class="text-right"><?= number_format($transaction->PAYMENT_TOTAL); ?></td>
                        </tr>
                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <div class="section-title">Payment Method</div>
                        <div class="alert alert-info">
                            Anda dapat melakukan pembayaran melalui rekening berikut:<br>
                            <h6>BRI 0585-01-000755-30-4 a.n LIBMI Education Center </h6>
                            Sejumlah <b>Rp<?= number_format($transaction->PAYMENT_TOTAL); ?></b>
                        </div>
                      </div>
                      <div class="col-lg-4 text-right">
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total</div>
                          <div class="invoice-detail-value invoice-detail-value-lg">Rp<?= number_format($transaction->PAYMENT_TOTAL); ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  <?php if(!$this->session->userdata('admin') && $transaction->TRANSACTION_STATUS == 1): ?>
                    <button class="btn btn-primary btn-icon icon-left" data-toggle="modal" data-target="#confirmModal"><i class="fas fa-credit-card"></i> Process Payment</button>
                  <?php elseif($this->session->userdata('admin') && $transaction->TRANSACTION_STATUS > 1): ?>
                    <a class="btn btn-primary btn-icon icon-left" href="<?= base_url(); ?>upload/proof/<?= $transaction->PAYMENT_PROOF; ?>" target="_new"><i class="fas fa-credit-card"></i> Payment Detail</a>
                  <?php endif; ?>
                </div>
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" id="confirmModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="payment-method" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Pengirim</label>
                    <input type="hidden" name="id" id="id" value="<?= $transaction->PAYMENT_ID; ?>">
                    <input type="hidden" name="trans_id" id="trans_id" value="<?= $transaction->TRANSACTION_ID; ?>">
                    <input type="text" class="form-control" name="name" id="name">
                  </div>
                  <div class="form-group">
                    <label>Nomor Rekening Pengirim</label>
                    <input type="text" class="form-control" name="norek" id="norek">
                  </div>
                  <div class="form-group">
                    <label>Bukti Pembayaran</label>
                    <input type="file" class="form-control" name="proof" id="proof">
                  </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Konfirmasi Pembayaran</button>
                </div>
              </form>
            </div>
          </div>
        </div>
<?php $this->load->view('dist/_partials/footer'); ?>