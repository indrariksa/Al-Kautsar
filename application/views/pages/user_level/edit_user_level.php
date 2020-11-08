<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-plus"></i> Edit Data Level User</h1>
          <p>Form Level User</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('User_level');?>">Level User</a></li>
          <li class="breadcrumb-item">Edit Level User</li>
        </ul>
      </div>
      <?php echo validation_errors('<div class="alert alert-danger" role="alert"><button class="close" data-dismiss="alert">×</button>','</div>') ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <?php foreach ($user_level as $ul) { ?>
            <form action="<?php echo base_url('User_level/update_user_level/'.$ul->level_id)?>" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Level</label>
                     <input class="form-control" name="nama_level" placeholder="Masukkan level" value="<?php echo $ul->nama_level; ?>" required oninvalid="this.setCustomValidity('Kolom level harus diisi')" oninput="setCustomValidity('')">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <input class="form-control" name="deskripsi_level" placeholder="Masukkan deskripsi" value="<?php echo $ul->deskripsi_level; ?>" required oninvalid="this.setCustomValidity('Kolom deskripsi harus diisi')" oninput="setCustomValidity('')">
                    <?= form_error('nama_level', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <a href="<?php echo base_url('User_level') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a>
            </div>
            </form>
            <?php } ?>
          </div>
        </div>
      </div>
    </main>

    <script type="text/javascript">
      
      $('#demoSelect').select2();
    </script>