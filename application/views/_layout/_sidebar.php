<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url(); ?>assets/img/<?php echo $userdata->foto; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $userdata->nama; ?></p>
        <!-- Status -->
        <a href="<?php echo base_url(); ?>assets/#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">Daftar Menu</li>
      <!-- Optionally, you can add icons to the links -->

      <li <?php if ($page == 'beranda') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo base_url('Beranda'); ?>">
          <i class="fa fa-home"></i>
          <span>Beranda</span>
        </a>
      </li>

      <li <?php if ($page == 'pelanggan') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo base_url('Pelanggan'); ?>">
          <i class="fa fa-user"></i>
          <span>Data Pelanggan</span>
        </a>
      </li>

      <li <?php if ($page == 'pelaksana') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo base_url('Pelaksana'); ?>">
          <i class="fa fa-briefcase"></i>
          <span>Data Pelaksana</span>
        </a>
      </li>

      <li <?php if ($page == 'jasa') {
            echo 'class="active"';
          } ?>>
        <a href="<?php echo base_url('Jasa'); ?>">
          <i class="fa fa-location-arrow"></i>
          <span>Data Macam Jasa</span>
        </a>
      </li>
    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>