<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>PRODUK SAYA</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Produk</a></div>
            </div>
          </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-grip-horizontal"></i>
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
          </div>

          <div class="section-body">
            <h2 class="section-title">Daftar Produk Saya 
            <?php if ($isAvailable == true) : ?><a href="<?= base_url(); ?>product/add" class="btn btn-primary float-right"><i class="fas fa-plus"></i>&nbsp; Pilih Produk Saya</a><?php endif; ?>
            </h2>
            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <?php if ($isAvailable == true) : ?>
                      <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>                                 
                            <tr>
                              <th class="text-center">
                                #
                              </th>
                              <th>Kode Referral</th>
                              <th>Nama Produk</th>
                              <th>Harga per Produk</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody> 

                            <?php $no = 1; foreach ($products as $key): ?>                          
                            <tr>
                              <td>
                                <?= $no; ?>
                              </td>
                              <td><?= $key->REFF_ID; ?></td>
                              <td><?= $key->PRODUCT[0]->PRODUCT_NAME; ?></td>
                              <td>Rp<?= number_format($key->PRODUCT[0]->PRODUCT_PRICE); ?></td>
                              <td><?= $key->REFF_STATUS; ?></td>
                              <td>
                              <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-company" onclick="deleteProductSelect(<?= $key->REFF_ID; ?>)"><i class="fas fa-trash"></i></a>
                              <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-company" onclick="editProductSelect(<?= $key->REFF_ID; ?>)"><i class="fas fa-edit"></i></a>
                              <a href="javascript:void(0)" class="btn btn-info btn-sm edit-company" onclick="infoProductSelect(<?= $key->REFF_ID; ?>)"><i class="fas fa-info"></i></a>
                              </td>
                            </tr>
                            <?php $no++; endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <div class="alert alert-info">
                        <h5 class="text-center">
                          Anda Belum Didaftarkan Ke Perusahaan Oleh Admin, Silahkan Menunggu atau Anda Dapat Menghubungi Call Center Kami
                        </h5>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

<?php $this->load->view('dist/_partials/footer'); ?>