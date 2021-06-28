<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Daftar Kategori Produk</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Produk</div>
              <div class="breadcrumb-item">Kategori</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Daftar Kategori Produk 
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>&nbsp; Tambah Kategori</button>
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
                            <th>Nama Kategori</th>
                            <th>Status Kategori</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php $no = 1; foreach ($category as $key): ?>                          
                          <tr>
                            <td><?= $no; ?></td>
                            <td><?= $key->CATEGORY_NAME; ?></td>
                            <td><?= $key->CATEGORY_STATUS == 0 ? "Tidak Aktif" : "Aktif"; ?></td>
                            <td><a href="javascript:void(0)" class="btn btn-warning btn-sm edit-category" onclick="editCategory(<?= $key->CATEGORY_ID; ?>)"><i class="fas fa-edit"></i></a></td>
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
                <h5 class="modal-title">Tambah Kategori Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="add-category">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" name="name">
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
                <h5 class="modal-title">Edit Kategori Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="update-category">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="name" id="name">
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