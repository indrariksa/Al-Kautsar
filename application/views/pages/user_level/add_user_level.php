<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-plus"></i> Add Data User Level</h1>
          <p>Form User Level</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('User_level');?>">User Level</a></li>
          <li class="breadcrumb-item">Add User Level</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <form action="<?php echo base_url('User_level/insert_user_level'); ?>" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Level</label>
                     <input class="form-control" name="nama_level" placeholder="Masukkan level" required oninvalid="this.setCustomValidity('Kolom level harus diisi')" oninput="setCustomValidity('')">
                     <?= form_error('nama_level', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <input class="form-control" name="deskripsi_level" placeholder="Masukkan deskripsi" required oninvalid="this.setCustomValidity('Kolom deskripsi harus diisi')" oninput="setCustomValidity('')">
                    <?= form_error('deskripsi_level', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <a href="<?php echo base_url('User_level') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </main>