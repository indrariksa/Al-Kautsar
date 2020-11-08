<!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><font color="cyan"><b><?php echo $this->session->userdata('nama_user');?></b></font></p>
          <p class="app-sidebar__user-designation"><font color="lime"><b><?php echo $this->session->userdata('deskripsi_level');?></b></font></p>
        </div>
      </div>
      <?php 
        if($this->session->userdata('level_id') == 1 ) {?>
      <ul class="app-menu">
        <li><a class="app-menu__item <?php if($this->uri->uri_string()=="Welcome"){echo "active";}?>" href="<?php echo base_url('Welcome'); ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li class="treeview <?php if($this->uri->uri_string()=="Hewan" OR $this->uri->uri_string()=="Type_pemesanan"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-maxcdn"></i><span class="app-menu__label">Master</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Hewan"){echo "active";}?>" href="<?php echo base_url('Hewan'); ?>"><i class="icon fa fa-paw"></i> Hewan</a></li>
          </ul>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Type_pemesanan"){echo "active";}?>" href="<?php echo base_url('Type_pemesanan'); ?>"><i class="icon fa fa-tasks"></i> Type Pemesanan</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pemesanan" OR $this->uri->uri_string()=="Pengiriman" OR $this->uri->uri_string()=="Pelunasan"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-audio-description"></i><span class="app-menu__label">Administrasi</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pemesanan"){echo "active";}?>" href="<?php echo base_url('Pemesanan'); ?>"><i class="icon fa fa-tty"></i> Pemesanan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pelunasan"){echo "active";}?>" href="<?php echo base_url('Pelunasan'); ?>"><i class="icon fa fa-money"></i> Pelunasan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pengiriman"){echo "active";}?>" href="<?php echo base_url('Pengiriman'); ?>"><i class="icon fa fa-motorcycle"></i> Pengiriman</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pemesanan/view_table" OR $this->uri->uri_string()=="Pengiriman/view_table" OR $this->uri->uri_string()=="Pemesanan/view_table_p2hq"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Data Tabel</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pemesanan/view_table"){echo "active";}?>" href="<?php echo base_url('Pemesanan/view_table'); ?>"><i class="icon fa fa-table"></i> Tabel Pemesanan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pengiriman/view_table"){echo "active";}?>" href="<?php echo base_url('Pengiriman/view_table'); ?>"><i class="icon fa fa-table"></i> Tabel Pengiriman</a></li>
          <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pemesanan/view_table_p2hq"){echo "active";}?>" href="<?php echo base_url('Pemesanan/view_table_p2hq'); ?>"><i class="icon fa fa-table"></i> Tabel P2HQ</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="User" OR $this->uri->uri_string()=="User_level"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Data User</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="User"){echo "active";}?>" href="<?php echo base_url('User'); ?>"><i class="icon fa fa-user-circle-o"></i> User</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="User_level"){echo "active";}?>" href="<?php echo base_url('User_level'); ?>"><i class="icon fa fa-sign-language"></i> User Level</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pembayaran"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pembayaran"){echo "active";}?>" href="<?php echo base_url('Pembayaran'); ?>"><i class="icon fa fa-file-archive-o"></i> Pembayaran</a></li>
          </ul>
        </li>


      </ul>

    <?php } 
      else if ($this->session->userdata('level_id') == 2 ) { ?>

      <ul class="app-menu">
        <li><a class="app-menu__item <?php if($this->uri->uri_string()=="Welcome"){echo "active";}?>" href="<?php echo base_url('Welcome'); ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pemesanan" OR $this->uri->uri_string()=="Pengiriman" OR $this->uri->uri_string()=="Pelunasan"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-audio-description"></i><span class="app-menu__label">Administrasi</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pemesanan"){echo "active";}?>" href="<?php echo base_url('Pemesanan'); ?>"><i class="icon fa fa-tty"></i> Pemesanan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pelunasan"){echo "active";}?>" href="<?php echo base_url('Pelunasan'); ?>"><i class="icon fa fa-money"></i> Pelunasan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pengiriman"){echo "active";}?>" href="<?php echo base_url('Pengiriman'); ?>"><i class="icon fa fa-motorcycle"></i> Pengiriman</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pemesanan/view_table" OR $this->uri->uri_string()=="Pengiriman/view_table"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Data Tabel</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pemesanan/view_table"){echo "active";}?>" href="<?php echo base_url('Pemesanan/view_table'); ?>"><i class="icon fa fa-table"></i> Tabel Pemesanan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pengiriman/view_table"){echo "active";}?>" href="<?php echo base_url('Pengiriman/view_table'); ?>"><i class="icon fa fa-table"></i> Tabel Pengiriman</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pembayaran"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pembayaran"){echo "active";}?>" href="<?php echo base_url('Pembayaran'); ?>"><i class="icon fa fa-file-archive-o"></i> Pembayaran</a></li>
          </ul>
        </li>

      </ul>

      <?php }
        else if($this->session->userdata('level_id') == 3 ) {?>
      <ul class="app-menu">
        <li><a class="app-menu__item <?php if($this->uri->uri_string()=="Welcome"){echo "active";}?>" href="<?php echo base_url('Welcome'); ?>"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li class="treeview <?php if($this->uri->uri_string()=="Hewan"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-maxcdn"></i><span class="app-menu__label">Master</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Hewan"){echo "active";}?>" href="<?php echo base_url('Hewan'); ?>"><i class="icon fa fa-paw"></i> Hewan</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pemesanan" OR $this->uri->uri_string()=="Pengiriman" OR $this->uri->uri_string()=="Pelunasan"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-audio-description"></i><span class="app-menu__label">Administrasi</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pemesanan"){echo "active";}?>" href="<?php echo base_url('Pemesanan'); ?>"><i class="icon fa fa-tty"></i> Pemesanan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pelunasan"){echo "active";}?>" href="<?php echo base_url('Pelunasan'); ?>"><i class="icon fa fa-money"></i> Pelunasan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pengiriman"){echo "active";}?>" href="<?php echo base_url('Pengiriman'); ?>"><i class="icon fa fa-motorcycle"></i> Pengiriman</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pemesanan/view_table" OR $this->uri->uri_string()=="Pengiriman/view_table"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-database"></i><span class="app-menu__label">Data Tabel</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pemesanan/view_table"){echo "active";}?>" href="<?php echo base_url('Pemesanan/view_table'); ?>"><i class="icon fa fa-table"></i> Tabel Pemesanan</a></li>
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pengiriman/view_table"){echo "active";}?>" href="<?php echo base_url('Pengiriman/view_table'); ?>"><i class="icon fa fa-table"></i> Tabel Pengiriman</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->uri_string()=="Pembayaran"){echo "is-expanded";}?>"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item <?php if($this->uri->uri_string()=="Pembayaran"){echo "active";}?>" href="<?php echo base_url('Pembayaran'); ?>"><i class="icon fa fa-file-archive-o"></i> Pembayaran</a></li>
          </ul>
        </li>

      </ul>



    <?php } ?>
    </aside>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo base_url()?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/main.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.price_format.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/dropzone.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo base_url()?>assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/chart.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
    </script>
  </body>
</html>