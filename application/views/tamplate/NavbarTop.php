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
      <b><a class="nav-link" href="/ta" style="border:thin solid red; color:#e60000;" title="Menampilkan Data pada Tahun Aanggaran TEST">TA. : TEST</a></b>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-cog"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="/pengguna/detail/aqdmin" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Admin
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