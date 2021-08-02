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
                      <h2>Invoice</h2>
                      <div class="invoice-number"><?= $transaction->TRANSACTION_CODE; ?></div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <address>
                          <strong>Billed To:</strong><br>
                            <?= $transaction->USER_FULLNAME; ?><br><br>
                            <strong>Tanggal Transaksi:</strong><br>
                          <?= $transaction->TRANSACTION_DATE; ?><br><br>
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
                          <td class="text-center"><?= $transaction->PRODUCT_PRICE; ?></td>
                          <td class="text-center"><?= $transaction->TRANSACTION_QTY; ?></td>
                          <td class="text-right"><?= $transaction->PAYMENT_TOTAL; ?></td>
                        </tr>
                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                        <div class="section-title">Payment Method</div>
                        <div class="alert alert-info">
                            Anda dapat melakukan pembayaran melalui rekening berikut:<br>
                            <h6>BCA 0182399123 a.n Grinaldi Wisnu Tri Prasetyo</h6>
                            Sejumlah <b>Rp<?= $transaction->PAYMENT_TOTAL; ?></b>
                        </div>
                      </div>
                      <div class="col-lg-4 text-right">
                        <hr class="mt-2 mb-2">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total</div>
                          <div class="invoice-detail-value invoice-detail-value-lg">Rp<?= $transaction->PAYMENT_TOTAL; ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="text-md-right">
                <div class="float-lg-left mb-lg-0 mb-3">
                  <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                  <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                </div>
                <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>