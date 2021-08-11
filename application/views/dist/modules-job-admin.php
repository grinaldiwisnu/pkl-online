<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Data Job Poster</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Master</a></div>
              <div class="breadcrumb-item">Jobs</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">Daftar Job Poster 
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i>&nbsp; Tambah Job</button>
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
                            <th>Posisi</th>
                            <th>Perusahaan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody> 
                        <?php $no = 1; foreach ($jobs as $key): ?>                          
                            <tr>
                              <td>
                                <?= $no; ?>
                              </td>
                              <td><?= $key->JOB_POSITION; ?></td>
                              <td><?= $key->JOB_COMPANY; ?></td>
                              <td><?= $key->JOB_START; ?></td>
                              <td><?= $key->JOB_END; ?></td>
                              <td>
                              <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-company" onclick="deleteJob(<?= $key->JOB_ID; ?>)"><i class="fas fa-trash"></i></a>
                              <a href="javascript:void(0)" class="btn btn-warning btn-sm edit-company" onclick="editJob(<?= $key->JOB_ID; ?>)"><i class="fas fa-edit"></i></a>
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
                <h5 class="modal-title">Tambah Job Poster</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="add-job" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" class="form-control" name="company">
                  </div>
                  <div class="form-group">
                    <label>Posisi Yang Dibuka</label>
                    <input type="text" class="form-control" name="position">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Mulai - Selesai</label>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="date" class="form-control" name="start">
                      </div>
                      <div class="col-md-6">
                        <input type="date" class="form-control" name="end">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Poster</label>
                    <input type="file" class="form-control" name="poster">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi Job</label>
                    <textarea class="form-control" name="description"></textarea>
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
              <form id="edit-job" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="hidden" class="form-control" name="id" id="id">
                    <input type="text" class="form-control" name="company" id="company">
                  </div>
                  <div class="form-group">
                    <label>Posisi Yang Dibuka</label>
                    <input type="text" class="form-control" name="position" id="position">
                  </div>
                  <div class="form-group">
                    <label>Tanggal Mulai - Selesai</label>
                    <div class="row">
                      <div class="col-md-6">
                        <input type="date" class="form-control" name="start" id="start">
                      </div>
                      <div class="col-md-6">
                        <input type="date" class="form-control" name="end" id="end">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Poster</label>
                    <input type="file" class="form-control" name="poster">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi Job</label>
                    <textarea class="form-control" name="description" id="description"></textarea>
                  </div>
                  <div class="gallery gallery-fw" data-item-height="350">
                    <div id="img-product" class="gallery-item" data-image="" data-title="Image 1"></div>
                  </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
              </form>
            </div>
          </div>
        </div>
<?php $this->load->view('dist/_partials/footer'); ?>