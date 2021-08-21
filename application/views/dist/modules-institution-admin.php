<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Daftar Institusi Partner</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Institusi</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Daftar Institusi 
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>&nbsp; Tambah Institusi</button>
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
                            <th>Institution Name</th>
                            <th>Address</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php $no = 1; foreach ($institution as $key): ?>                          
                          <tr>
                            <td>
                              <?= $no; ?>
                            </td>
                            <td><a href="<?= base_url(); ?>master/institution/detail/<?= $key->INSTITUTION_ID; ?>"><?= $key->INSTITUTION_NAME ?></a></td>
                            <td>
                            <?= $key->INSTITUTION_ADDRESS ?>
                            </td>
                            <td>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-company" onclick="deleteInstitution(<?= $key->INSTITUTION_ID; ?>)"><i class="fas fa-trash"></i></a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-company" onclick="editInstitution(<?= $key->INSTITUTION_ID; ?>)"><i class="fas fa-edit"></i></a>
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
                <h5 class="modal-title">Tambah Institusi Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="add-institution">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Institusi</label>
                    <input type="text" class="form-control" name="name">
                  </div>
                  <div class="form-group">
                    <label>Alamat Institusi</label>
                    <input type="text" class="form-control" name="address">
                  </div>
                  <div class="form-group">
                    <h6>Detail Penanggungjawab</h6>
                  </div>
                  <div class="form-group">
                    <label>Nama Penanggungjawab</label>
                    <input type="text" class="form-control" name="admin_name">
                  </div>
                  <div class="form-group">
                    <label>Email Penanggungjawab</label>
                    <input type="text" class="form-control" name="admin_email">
                  </div>
                  <div class="form-group">
                    <label>Nomor HP Penanggungjawab</label>
                    <input type="text" class="form-control" name="admin_nohp">
                  </div>
                  <div class="form-group">
                    <label>Password Penanggungjawab</label>
                    <input type="password" class="form-control" name="admin_password">
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
                <h5 class="modal-title">Edit Institusi Partner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="update-institution">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Institusi</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="name" id="name">
                  </div>
                  <div class="form-group">
                    <label>Alamat Institusi</label>
                    <input type="text" class="form-control" name="address" id="address">
                  </div>
                  <div class="form-group">
                    <h6>Detail Penanggungjawab</h6>
                  </div>
                  <div class="form-group">
                    <label>Nama Penanggungjawab</label>
                    <input type="hidden" class="form-control" id="id_admin" name="id_admin">
                    <input type="text" class="form-control" id="admin_name" name="admin_name">
                  </div>
                  <div class="form-group">
                    <label>Email Penanggungjawab</label>
                    <input type="text" class="form-control" id="admin_email" name="admin_email">
                  </div>
                  <div class="form-group">
                    <label>Nomor HP Penanggungjawab</label>
                    <input type="text" class="form-control" id="admin_nohp" name="admin_nohp">
                  </div>
                  <div class="form-group">
                    <label>Password Penanggungjawab</label>
                    <input type="password" class="form-control" id="admin_password" name="admin_password">
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