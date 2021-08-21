<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Daftar Perusahaan Partner</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Perusahaan</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Daftar Perusahaan 
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>&nbsp; Tambah Perusahaan</button>
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
                            <th>Nama Perusahaan</th>
                            <th>Alamat Perusahaan</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php $no = 1; foreach ($company as $key): ?>                          
                          <tr>
                            <td>
                              <?= $no; ?>
                            </td>
                            <td><a href="<?= base_url(); ?>master/company/detail/<?= $key->COMPANY_ID; ?>"><?= $key->COMPANY_NAME ?></a></td>
                            <td>
                            <?= $key->COMPANY_ADDRESS; ?>
                            </td>
                            <td>
                              <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-company" onclick="deleteCompany(<?= $key->COMPANY_ID; ?>)"><i class="fas fa-trash"></i></a>
                              <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-company" onclick="editCompany(<?= $key->COMPANY_ID; ?>)"><i class="fas fa-edit"></i></a>
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
                <h5 class="modal-title">Tambah Perusahaan Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="add-company">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" class="form-control" name="name">
                  </div>
                  <div class="form-group">
                    <label>Alamat Perusahaan</label>
                    <input type="text" class="form-control" name="address">
                  </div>
                  <div class="form-group">
                    <label>Pendamping Perusahaan</label>
                    <input type="text" class="form-control" name="pendamping">
                  </div>
                  <div class="form-group">
                    <label>Nomor Pendamping Perusahaan</label>
                    <input type="text" class="form-control" name="nohp">
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
                <h5 class="modal-title">Edit Perusahaan Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="update-company">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="name" id="name">
                  </div>
                  <div class="form-group">
                    <label>Alamat Perusahaan</label>
                    <input type="text" class="form-control" name="address" id="address">
                  </div>
                  <div class="form-group">
                    <label>Pendamping Perusahaan</label>
                    <input type="text" class="form-control" name="pendamping" id="pendamping">
                  </div>
                  <div class="form-group">
                    <label>Nomor Pendamping Perusahaan</label>
                    <input type="text" class="form-control" name="nohp" id="nohp">
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