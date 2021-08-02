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
                  <form id="create-transaction" method="post">
                    <div class="card-body">
                      <div id="transaction-success" class="alert alert-success" style="display:none"></div>
                      <div id="transaction-failed" class="alert alert-danger" style="display:none"></div>
                      <input type="hidden" class="form-control" name="uid" value="<?= $this->session->userdata('id'); ?>">
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Referensi</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" name="name" class="form-control" placeholder="Masukkan nama pelanggan">
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Produk<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                          <select class="form-control select2" name="reff">
                            <?php foreach ($products as $key) : ?>
                              <option value="<?= $key->REFF_ID; ?>"><?= $key->PRODUCT_NAME . " (Rp" . number_format($key->PRODUCT_PRICE) . ")"; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                          <input type="number" class="form-control" name="qty" placeholder="0">
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <div class="col-sm-12 col-md-7 offset-md-3">
                          <div class="alert alert-info">
                            <b>Note!</b> Masukkan alamat lengkap seperti:<br>
                            <i>Jalan XXXX No.XXX Kelurahan XXX Kecamatan XXX, Kabupaten XXXXX 000001</i>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Pengiriman<span class="text-danger">*</span></label>
                        <div class="col-sm-12 col-md-7">
                        <textarea class="form-control" name="address" placeholder="Jalan XXXX No.XXX Kelurahan XXX Kecamatan XXX, Kabupaten XXXXX 000001"></textarea>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Note</label>
                        <div class="col-sm-12 col-md-7">
                          <textarea class="summernote-simple" name="note"></textarea>
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Referensi</label>
                        <div class="col-sm-12 col-md-7">
                          <input type="text" name="reference" class="form-control">
                        </div>
                      </div>
                      <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                          <button type="submit" id="submit" class="btn btn-info btn-lg px-5"><i class="fa fa-shopping-cart"></i> Beli</button>
                        </div>
                      </div>
                    </div>
                  </form>
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