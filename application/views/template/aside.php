<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url();?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p> -->
        <!-- Status -->
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div> -->

    <!-- search form (Optional) -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form> -->
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <!-- Optionally, you can add icons to the links -->
      
      <!--Dashboard-->
      <li><a href="<?php echo base_url();?>dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

      <!--Pegawai-->
      <?php if(
        $this->session->userdata('hak_akses') == 0 ||
        $this->session->userdata('hak_akses') == 1 ||
        $this->session->userdata('hak_akses') == 2
      ):?>
      <li class="treeview">
        <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Pegawai</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php if($this->session->userdata('hak_akses') == 3):?>
          <li><a href="<?php echo base_url();?>pegawai/datapegawai/update?id=<?php echo $this->session->userdata('id_pegawai');?>"><i class="fa fa-angle-right"></i> <span>Data Pegawai</span></a></li>
          <?php else:?>
          <li><a href="<?php echo base_url();?>pegawai/datapegawai"><i class="fa fa-angle-right"></i> <span>Data Pegawai</span></a></li>
          <?php endif;?>
          <li><a href="<?php echo base_url();?>kehadiran/Kehadiran"><i class="fa fa-angle-right"></i> <span>Kehadiran</span></a></li>
        </ul>
      </li>
      <?php endif;?>

      <!--Perijinan-->
      <?php if(
        $this->session->userdata('hak_akses') == 0 ||
        $this->session->userdata('hak_akses') == 1 ||
        $this->session->userdata('hak_akses') == 2 
      ):?>
      <li class="treeview">
        <a href="#"><i class="glyphicon glyphicon-envelope"></i> <span>Perizinan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url();?>perizinan/izincuti/listdata"><i class="fa fa-angle-right"></i> <span>Izin/Cuti</span></a></li>
          <li><a href="<?php echo base_url();?>perizinan/lembur/listdata"><i class="fa fa-angle-right"></i> <span>Lembur</span></a></li>
          <li><a href="<?php echo base_url();?>resig/Resign"><i class="fa fa-angle-right"></i><span>Resign</span></a></li>
        </ul>
      </li>
      <?php endif;?>

      <!--Departemen-->
      <?php if(
        $this->session->userdata('hak_akses') == 0 ):?>
      <li class="treeview">
        <a href="#"><i class="fa fa-users"></i> <span>HRD</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url();?>hrd/departemen/listdata"><i class="fa fa-angle-right"></i> <span>Department</span></a></li>
          <li><a href="<?php echo base_url();?>hrd/penunjukan/listdata"><i class="fa fa-angle-right"></i> <span>Penunjukan</span></a></li>
          <li><a href="<?php echo base_url();?>clien/Klien"><i class="fa fa-angle-right"></i> <span>Klien</span></a></li>
          <li><a href="<?php echo base_url();?>shift/shift"><i class="fa fa-angle-right"></i> <span>Shift</span></a></li>
        </ul>
      </li>
      <?php endif;?>

      <!--Payroll-->
      <?php if(
        $this->session->userdata('hak_akses') == 0 ||
        $this->session->userdata('hak_akses') == 1 
      ):?>
      <li class="treeview">
        <a href="#"><i class="fa fa-money"></i> <span>Payroll</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><li><a href="<?php echo base_url();?>payroll/InfoGaji"><i class="fa fa-angle-right"></i> <span>Info Gaji</span></a></li>
          <li><a href="<?php echo base_url();?>bank/AkunBank"><i class="fa fa-angle-right"></i> <span>Akun</span></a></li>
        </ul>
      </li>      
      <?php endif;?>

      <!--Kelola akun-->
      <?php if(
        $this->session->userdata('hak_akses') == 0      ):?>
      <li><a href="<?php echo base_url();?>akun/listakun"><i class="fa fa-users"></i> <span>Kelola Akun</span></a></li>
      <?php endif;?>
    </ul>
  <!-- /.sidebar -->
</aside>