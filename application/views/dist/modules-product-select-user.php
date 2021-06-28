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

          <div class="section-body">
          <h2 class="section-title">Daftar Produk Perusahaan</h2>

            <div class="row">
              <?php if (count($products) > 0) : ?>
                <?php foreach ($products as $key): ?>
                  <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                    <article class="article">
                      <div class="article-header">
                        <div class="article-image" data-background="<?= $key->IMAGE == null ? base_url().'assets/img/news/img07.jpg' : base_url().'upload/products/'.$key->IMAGE->PRODUCT_IMAGE_NAME; ?>">
                        </div>
                        <div class="article-title">
                          <h2><a href="#"><?= $key->PRODUCT_NAME; ?></a></h2>
                        </div>
                      </div>
                      <div class="article-details">
                        <h4><p>Rp<?= number_format($key->PRODUCT_PRICE); ?></p></h4>
                        <div class="article-cta">
                          <button onclick="selectProduct(<?= $key->PRODUCT_ID; ?>, '<?= $key->PRODUCT_NAME; ?>')" class="btn btn-primary">Ambil Produk</button>
                        </div>
                      </div>
                    </article>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="col-12">
                  <div class="alert alert-warning">Perusahaan belum memiliki produk terdaftar, silahkan hubungi perusahaan anda untuk membuat produk.</div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
      </div>

<?php $this->load->view('dist/_partials/footer'); ?>