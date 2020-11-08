<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-plus"></i> Add Data Hewan Kurban</h1>
          <p>Form Hewan Kurban</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Hewan');?>">Hewan Kurban</a></li>
          <li class="breadcrumb-item">Add Hewan Kurban</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <form action="<?php echo base_url('Hewan/insert_hewan'); ?>" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Kode Hewan</label>
                     <input class="form-control" name="hewan_id" placeholder="Masukkan id hewan" required oninvalid="this.setCustomValidity('Kolom id hewan harus diisi')" oninput="setCustomValidity('')">
                     <?= form_error('hewan_id', '<small class="text-danger pl-2">', '</small>'); ?>
                  </div>
                  <div class="form-group">
                    <label>Jenis Hewan</label>
                    <select class="form-control" id="demoSelect" name="hewan_jenis">
                        <option value="sapi" <?php if($this->input->post('hewan_jenis') == 'sapi') {echo "selected";} ?>> Sapi</option>
                        <option value="domba" <?php if($this->input->post('hewan_jenis') == 'domba') {echo "selected";} ?>> Domba</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Kelas Hewan</label>
                     <input class="form-control" name="hewan_kelas" placeholder="Masukkan kelas hewan" required oninvalid="this.setCustomValidity('Kolom kelas hewan harus diisi')" oninput="setCustomValidity('')">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi Hewan</label>
                    <input class="form-control" name="hewan_deskripsi" placeholder="Masukkan deskripsi hewan">
                  </div>
                  <div class="form-group">
                    <label>Status Hewan</label>
                    <!-- <div class="col-md-9"> -->
                            <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="hewan_status" value="1" <?php if($this->input->post('hewan_status') == 1) {echo 'checked';} ?> ><span class="label-text">Aktif</span>
                              </label>
                            </div>
                             <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="hewan_status" value="0" <?php if($this->input->post('hewan_status') == 0) {echo 'checked';} ?> ><span class="label-text">Non Aktif</span>
                              </label>
                            </div>
                        <!-- </div> -->
                  </div>
                
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <a href="<?php echo base_url('Hewan') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </main>

    <script type="text/javascript">
      
      $('#demoSelect').select2();
    </script>