<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>"><img src="<?= base_url(); ?>assets/img/logo-po.png" alt="PO" class="rounded-circle" width="35"> PKL ONLINE</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>"><img src="<?= base_url(); ?>assets/img/logo-po.png" alt="PO" class="rounded-circle" width="35"></a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?php echo $this->uri->segment(1) == '' || $this->uri->segment(1) == 'home' || $this->uri->segment(2) == 'index_0' ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>home" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <?php if (!$this->session->userdata('admin')) : ?>
              <li class="menu-header">Menu</li>
              <li class="<?php echo $this->uri->segment(1) == 'product' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>product"><i class="fa fa-grip-horizontal"></i> <span>Produk Saya</span></a></li>
              <li class="<?php echo $this->uri->segment(1) == 'transaction' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>transaction"><i class="fa fa-shopping-cart"></i> <span>Pembelian</span></a></li>
              <li class="<?php echo $this->uri->segment(1) == 'history' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>history"><i class="fa fa-history"></i> <span>Riwayat</span></a></li>
            <?php elseif ($this->session->userdata('admin')) : ?>
              <li class="menu-header">Admin Menu</li>
              <?php if ($this->session->userdata('data')->ADMIN_ROLE == 2) : ?>
                <li class="<?php echo $this->uri->segment(2) == 'company' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('master/company'); ?>"><i class="fa fa-hotel"></i> <span>Perusahaan</span></a></li>
              <?php endif; ?>
              <li class="<?php echo $this->uri->segment(2) == 'institution' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('master/institution'); ?>"><i class="fa fa-university"></i> <span>Institusi Partner</span></a></li>
              <?php if ($this->session->userdata('data')->ADMIN_ROLE == 2) : ?>
                <li class="<?php echo $this->uri->segment(2) == 'category' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('master/category'); ?>"><i class="fa fa-tags"></i> <span>Kategori Produk</span></a></li>
                <li class="<?php echo $this->uri->segment(2) == 'job' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('master/job'); ?>"><i class="fas fa-suitcase"></i> <span>Pekerjaan</span></a></li>
                <li class="<?php echo $this->uri->segment(2) == 'buy' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('master/buy'); ?>"><i class="fa fa-shopping-cart"></i> <span>Pembelian</span></a></li>
              <?php endif; ?>
              <li class="<?php echo $this->uri->segment(2) == 'history' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url('master/history'); ?>"><i class="fa fa-history"></i> <span>Riwayat</span></a></li>
            <?php endif; ?>
          </ul>

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="<?php echo base_url(); ?>home/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fa fa-sign-out-alt"></i> Keluar
            </a>
          </div>
        </aside>
      </div>
