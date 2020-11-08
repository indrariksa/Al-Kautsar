<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Edit Data Sapi</h1>
          <p>Form Sapi</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="<?php echo base_url('Sapi');?>">Sapi</a></li>
          <li class="breadcrumb-item">Edit Sapi</li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <?php foreach ($sapi as $db) { ?>
            <form action="<?php echo base_url('Sapi/update_sapi/'.$db->sapi_id)?>" enctype="multipart/form-data" method="post">
            <div class="row">
              <div class="col-lg-6">
                  <div class="form-group">
                    <label>Kelas Sapi</label>
                     <input class="form-control" name="sapi_kelas" value="<?php echo $db->sapi_kelas; ?>" placeholder="Masukkan kelas sapi" required oninvalid="this.setCustomValidity('Kolom kelas sapi harus diisi')" oninput="setCustomValidity('')">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi Sapi</label>
                    <input class="form-control" name="sapi deskripsi" value="<?php echo $db->sapi_deskripsi; ?>" placeholder="Masukkan deskripsi sapi">
                  </div>
                  <div class="form-group">
                    <label>Status Sapi</label>
                    <!-- <div class="col-md-9"> -->
                            <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="sapi_status" value="1" <?php if($db->sapi_status == 1) {echo 'checked';} ?> ><span class="label-text">Aktif</span>
                              </label>
                            </div>
                             <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="sapi_status" value="0" <?php if($db->sapi_status == 0) {echo 'checked';} ?> ><span class="label-text">Non Aktif</span>
                              </label>
                            </div>
                        <!-- </div> -->
                  </div>
                
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <a href="<?php echo base_url('Sapi') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a>
            </div>
            </form>
            <?php } ?>
          </div>
        </div>
      </div>
    </main>

    <script type="text/javascript">
      $('#sl').on('click', function(){
        $('#tl').loadingBtn();
        $('#tb').loadingBtn({ text : "Signing In"});
      });
      
      $('#el').on('click', function(){
        $('#tl').loadingBtnComplete();
        $('#tb').loadingBtnComplete({ html : "Sign In"});
      });
      
      $('#demoDate').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true
      });
      
      $('#demoSelect').select2();
    </script>