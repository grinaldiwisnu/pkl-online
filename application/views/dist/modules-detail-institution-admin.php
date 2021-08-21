<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1><?= $detail->INSTITUTION_NAME; ?></h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Institusi</div>
            </div>
          </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Produk</h4>
                  </div>
                  <div class="card-body">
                  <?= count($child); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Siswa/Mahasiswa</h4>
                  </div>
                  <div class="card-body">
                  <?= count($child); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Daftar Siswa/Mahasiswa 
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
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Perusahaan</th>
                            <th>Target Penjualan</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <?php $no = 1; foreach ($child as $key): ?>                          
                          <tr>
                            <td>
                              <?= $no; ?>
                            </td>
                            <td><?= $key->USER_NISN; ?></td>
                            <td><?= $key->USER_FULLNAME; ?></td>
                            <td><?= $key->USER_STATUS == 10 ? "Sedang Magang" : "Sudah Magang"; ?></td>
                            <td><?= $key->COMPANY_ID == null ? "Belum didaftarkan" : $key->COMPANY_DETAIL->COMPANY_NAME; ?></td>
                            <td><?= $key->TARGET == null ? "Belum ada target" : $key->TARGET; ?></td>
                            <td>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-company" onclick="deleteUserInstitution(<?= $key->USER_ID; ?>)"><i class="fas fa-trash"></i></a>
                            <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-company" onclick="editUserInstitution(<?= $key->USER_ID; ?>)"><i class="fas fa-edit"></i></a>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Mahasiswa <?= $detail->INSTITUTION_NAME; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="update-user-institution">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" class="form-control" name="fullname" id="fullname">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                  </div>
                  <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="number" class="form-control" name="phone" id="phone">
                  </div>
                  <div class="form-group">
                    <label>Perusahaan Magang</label>
                    <select name="company" id="company" class="form-control">
                        <option value="">Pilih perusahaan tempat magang</option>
                      <?php foreach($company as $key) : ?>
                        <option value="<?= $key->COMPANY_ID; ?>"><?= $key->COMPANY_NAME; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Target Penjualan</label>
                    <input type="number" class="form-control" name="target" id="target">
                  </div>
                  <div class="form-group">
                    <label>Status Magang</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">Pilih status magang saat ini</option>
                        <option value="10">Sedang Magang</option>
                        <option value="20">Selesai Magang</option>
                    </select>
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