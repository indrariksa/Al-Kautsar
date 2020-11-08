<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-plus"></i> Add Data Domba</h1>
          <p>Form Domba</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Domba');?>">Domba</a></li>
          <li class="breadcrumb-item">Add Domba</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <form action="<?php echo base_url('Domba/insert_domba'); ?>" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Kelas Domba</label>
                     <input class="form-control" name="domba_kelas" placeholder="Masukkan kelas domba" required oninvalid="this.setCustomValidity('Kolom kelas domba harus diisi')" oninput="setCustomValidity('')">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi Domba</label>
                    <input class="form-control" name="domba_deskripsi" placeholder="Masukkan deskripsi domba">
                  </div>
                  <div class="form-group">
                    <label>Status Domba</label>
                    <!-- <div class="col-md-9"> -->
                            <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="domba_status" value="1" <?php if($this->input->post('domba_status') == 1) {echo 'checked';} ?> ><span class="label-text">Aktif</span>
                              </label>
                            </div>
                             <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="domba_status" value="0" <?php if($this->input->post('domba_status') == 0) {echo 'checked';} ?> ><span class="label-text">Non Aktif</span>
                              </label>
                            </div>
                        <!-- </div> -->
                  </div>
                
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <a href="<?php echo base_url('Domba') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </main>
