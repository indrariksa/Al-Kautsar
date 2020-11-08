<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-plus"></i> Edit Data User</h1>
          <p>Form User</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('User');?>">User</a></li>
          <li class="breadcrumb-item">Edit User</li>
        </ul>
      </div>
      <?php echo validation_errors('<div class="alert alert-danger" role="alert"><button class="close" data-dismiss="alert">×</button>','</div>') ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <?php foreach ($user as $u) { ?>
            <form action="<?php echo base_url('User/update_user/'.$u->id_user)?>" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Username</label>
                     <input class="form-control" name="username" placeholder="Masukkan username" value="<?php echo $u->username; ?>" required oninvalid="this.setCustomValidity('Kolom username harus diisi')" oninput="setCustomValidity('')">
                      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <!-- <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" type="password" placeholder="Masukkan password" required oninvalid="this.setCustomValidity('Kolom password harus diisi')" oninput="setCustomValidity('')">
                  </div>
                  <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input class="form-control" name="passconf" type="password" placeholder="Masukkan konfirmasi password">
                  </div> -->
                   <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control" name="nama_user" placeholder="Masukkan nama lengkap" value="<?php echo $u->nama_user; ?>" required oninvalid="this.setCustomValidity('Kolom nama harus diisi')" oninput="setCustomValidity('')">
                  </div>
                   <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" name="email_user" placeholder="Masukkan alamat email" value="<?php echo $u->email_user; ?>" required oninvalid="this.setCustomValidity('Kolom email harus diisi')" oninput="setCustomValidity('')">
                  </div>
                   <div class="form-group">
                    <label>Telepon</label>
                    <input class="form-control" name="telp_user" type="number" placeholder="Masukkan nomor telepon" value="<?php echo $u->telp_user; ?>" required oninvalid="this.setCustomValidity('Kolom telepon harus diisi')" oninput="setCustomValidity('')">
                  </div>
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" id="demoSelect" name="level_id">
                        <?php
                            if(@$data_user_lvl) :
                                foreach ($data_user_lvl as $lvl) :    
                        ?>
                        <!-- <option value="<?= $lvl->level_id ?>" <?php if($u->level_id == $lvl->level_id) {echo "selected";} ?>> <?= $lvl->deskripsi_level ?> -->
                        <option value="<?= $lvl->level_id ?>" <?php if($u->level_id == $lvl->level_id) {echo "selected";} ?>><?= $lvl->deskripsi_level ?>
                        </option>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status User</label>
                    <!-- <div class="col-md-9"> -->
                            <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="status_user" value="1" <?php if($u->status_user == 1) {echo 'checked';} ?> ><span class="label-text">Aktif</span>
                              </label>
                            </div>
                             <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="status_user" value="0" <?php if($u->status_user == 0) {echo 'checked';} ?> ><span class="label-text">Non Aktif</span>
                              </label>
                            </div>
                        <!-- </div> -->
                  </div>
                
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <a href="<?php echo base_url('User') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a>
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