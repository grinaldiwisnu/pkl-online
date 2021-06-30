<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1><?= $detail->COMPANY_NAME; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Perusahaan</div>
            </div>
          </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Produk
                    </h4>
                  </div>
                  <div class="card-body">
                  <?= count($child); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Daftar Produk
            <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>&nbsp; Tambah Produk</button>
            </h2>
            
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
                            <th>Harga Produk</th>
                            <th>Stok Produk</th>
                            <th>Kategori Produk</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php $no = 1; foreach ($child as $key): ?>                          
                          <tr>
                            <td>
                              <?= $no; ?>
                            </td>
                            <td><?= $key->PRODUCT_NAME; ?></td>
                            <td><?= $key->PRODUCT_PRICE; ?></td>
                            <td><?= $key->PRODUCT_STOCK; ?></td>
                            <td><?= $key->CATEGORY_DETAIL == null ? "Belum didaftarkan" : $key->CATEGORY_DETAIL->CATEGORY_NAME; ?></td>
                            <td>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-company" onclick="deleteProduct(<?= $key->PRODUCT_ID; ?>)"><i class="fas fa-trash"></i></a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-company" onclick="editProduct(<?= $key->PRODUCT_ID; ?>)"><i class="fas fa-edit"></i></a>
                            </td>
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

      <div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="add-product" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="hidden" name="id" value="<?= $detail->COMPANY_ID; ?>">
                    <input type="text" class="form-control" name="name">
                  </div>
                  <div class="form-group">
                    <label>Harga Produk</label>
                    <input type="number" class="form-control" name="price">
                  </div>
                  <div class="form-group">
                    <label>Stok Produk</label>
                    <input type="number" class="form-control" name="stock">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi Produk</label>
                    <textarea type="text" class="form-control" name="description"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" class="form-control">
                        <option value="">Pilih kategori produk</option>
                      <?php foreach($category as $key) : ?>
                        <option value="<?= $key->CATEGORY_ID; ?>"><?= $key->CATEGORY_NAME; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="image">
                  </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="update-product" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="name" id="name">
                  </div>
                  <div class="form-group">
                    <label>Harga Produk</label>
                    <input type="number" class="form-control" name="price" id="price">
                  </div>
                  <div class="form-group">
                    <label>Stok Produk</label>
                    <input type="number" class="form-control" name="stock" id="stock">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi Produk</label>
                    <textarea type="text" class="form-control" name="description" id="desc"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Pilih kategori produk</option>
                        <?php foreach($category as $key) : ?>
                        <option value="<?= $key->CATEGORY_ID; ?>"><?= $key->CATEGORY_NAME; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="image">
                  </div>
                  <div class="gallery gallery-fw" data-item-height="350">
                    <div id="img-product" class="gallery-item" data-image="" data-title="Image 1"></div>
                  </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Ubah Data</button>
                </div>
              </form>
            </div>
          </div>
        </div>
<?php $this->load->view('dist/_partials/footer'); ?>