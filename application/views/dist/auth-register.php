<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
            <img src="<?php echo base_url(); ?>assets/img/logo-po.png" alt="logo" width="120" class="shadow-light p-3 rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Mendaftar sebagai siswa</h4></div>
              
              <div class="card-body">
                <form id="form-register" method="POST">
                  <div id="register-success" class="alert alert-success" style="display:none"></div>
                  <div id="register-failed" class="alert alert-danger" style="display:none"></div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name">Nama Depan</label>
                      <input id="name" type="text" class="form-control" name="name" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="last_name">Asal Sekolah/Universitas</label>
                      <select class="form-control" id="institution" name="institution">
                        <option>Memuat ...</option>
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="email" class="form-control" name="email">
                      <div class="invalid-feedback">
                        Masukkan alamat email anda.
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="email">Nomor HP</label>
                      <input id="phone" type="number" class="form-control" name="phone">
                      <div class="invalid-feedback">
                        Masukkan nomor HP anda.
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password">
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Ulangi Password</label>
                      <input id="password2" type="password" class="form-control" name="password-confirm">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                      <label class="custom-control-label" for="agree">Saya setuju dengan terms and conditions</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" id="submit" class="btn btn-primary btn-lg btn-block">
                      Mendaftar
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="mt-5 text-muted text-center">
              Sudah punya akun? <a href="<?php echo base_url(); ?>auth">Masuk</a>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php $this->load->view('dist/_partials/js'); ?>