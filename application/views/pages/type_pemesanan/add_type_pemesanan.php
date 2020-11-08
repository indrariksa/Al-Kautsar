<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-plus"></i> Add Data Tipe Pemesanan</h1>
          <p>Form Tipe Pemesanan</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Type_pemesanan');?>">Tipe Pemesanan</a></li>
          <li class="breadcrumb-item">Add Tipe Pemesanan</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <form action="<?php echo base_url('Type_pemesanan/insert_type_pemesanan'); ?>" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Nama Type</label>
                    <input class="form-control" name="nama_type" placeholder="Masukkan Tipe" required oninvalid="this.setCustomValidity('Kolom Tipe harus diisi')" oninput="setCustomValidity('')">
                    <?= form_error('nama_type', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <input class="form-control" name="deskripsi" placeholder="Masukkan deskripsi" required oninvalid="this.setCustomValidity('Kolom deskripsi harus diisi')" oninput="setCustomValidity('')">
                    <?= form_error('deskripsi', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <a href="<?php echo base_url('Type_pemesanan') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </main>