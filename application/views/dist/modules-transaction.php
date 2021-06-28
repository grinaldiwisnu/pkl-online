<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pembelian</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Pembelian</a></div>
            </div>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <?php if (count($products) > 0) : ?>
                <div class="card">
                  <div class="card-header">
                    <h4>Buat Pembelian</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pembeli</label>
                      <div class="col-sm-12 col-md-7">
                        <p class="form-control"><?= $this->session->userdata('name'); ?></p>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Produk</label>
                      <div class="col-sm-12 col-md-7">
                        <select class="form-control select2">
                          <?php foreach ($products as $key) : ?>
                            <option value="<?= $key->PRODUCT_ID; ?>"><?= $key->PRODUCT_NAME . " (Rp" . number_format($key->PRODUCT_PRICE) . ")"; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="number" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                      <div class="col-sm-12 col-md-7">
                        <textarea class="summernote-simple"></textarea>
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Referensi</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-success px-5"><i class="fa fa-shopping-cart"></i> Beli</button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php else: ?>
                  <div class="alert alert-warning">Anda belum memiliki produk terpilih, silahkan memilih produk untuk anda jual.</div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('dist/_partials/footer'); ?>