<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#">
        <i class="fas fa-bars"></i>
      </a>
    </li>

  </ul>

  <ul class="navbar-nav ml-auto">

    <li class="nav-item dropdown">
      <b><a class="nav-link" href="javascript:void(0)" style="border:thin solid red; color:#e60000;" title="Menampilkan Data pada Tahun Aanggaran TEST">TA. : <?= $this->session->userdata('thang'); ?></a></b>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-cog"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="<?= base_url(); ?>Profile" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> <?= $this->session->userdata('nama'); ?>
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?= base_url(); ?>Login/Logout" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Keluar
        </a>

      </div>
    </li>
  </ul>
</nav>

    <!-- /.navbar -->