<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>   -->

<script>
  var baseurl = "<?php echo base_url("index.php/"); ?>"; // Buat variabel baseurl untuk nanti di akses pada file config.js
</script>
<!-- <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script> --> <!-- Load library jquery -->
<script src="<?php echo base_url("assets/js/cari_faktur.js"); ?>"></script> <!-- Load file process.js -->
<script>  
 $(document).ready(function(){  
      $('#id').change(function(){  
           var no_faktur = $('#id').val();  
           if(no_faktur != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>Pengiriman/check_id_avalibility",  
                     method:"POST",  
                     data:{no_faktur:no_faktur},  
                     success:function(data){  
                          $('#id_result').html(data);  
                     }  
                });  
           }  
      });  
 });  
 </script> 

<script type="text/javascript">
$(document).ready(function() {
  $("#id").focus();
});
</script>

<script>
  var BASE_URL = "<?php echo base_url(); ?>";
 
 $(document).ready(function() {
    $( "#id" ).autocomplete({
 
        source: function(request, response) {
            $.ajax({
            url: BASE_URL + "Kirim/cari",
            data: {
                    term : request.term
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                    return obj.no_faktur;
               }); 
 
               response(resp);
            }
        });
    },
    minLength: 1
 });
});
 
</script>   

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Pengiriman Hewan Kurban</h1>
          <p>Input Pengiriman</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Form Pengiriman</a></li>
        </ul>
      </div>
      <?php
        $success = $this->session->flashdata('success');
        if ($success) {
            echo '<div class="alert alert-success text-center"><button class="close" data-dismiss="alert">×</button><strong>Success!</strong> '.$success.'</div>';
      } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Input Pengiriman</h3>
            <form action="<?php echo base_url('Pengiriman'); ?>" enctype="multipart/form-data" method="post">
            <div class="tile-body">
                <div class="form-group">
                  <label>Cari NO FAKTUR</label>
                  <input class="form-control" type="text" name="no_faktur" id="id" autocomplete="off" required>
                  <button type="button" id="btn-search" class="btn btn-danger"><span class="fa fa-search"></span> Search</button> <span id="loading">LOADING...</span>
                  <span id="id_result"></span><span><?= form_error('no_faktur', '<big class="text-danger pl-2">', '</big>'); ?><span>
                </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Nama Pemesan</label>
                  <input class="form-control" name="nama_pemesan" id="nama_pemesan" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">No. Telepon Pemesan</label>
                  <input class="form-control" name="telp_pemesan" id="telp_pemesan" readonly>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Alamat Pemesan</label>
                  <textarea class="form-control" rows="4" name="alamat_pemesan" id="alamat_pemesan" readonly></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Tanggal Pemesanan</label>
                  <input class="form-control"  name="tgl_pemesanan" id="tgl_pemesanan" readonly>
                </div>
              </div>
              <div class="col-lg-6">
              <div class="form-group">
                  <label class="control-label">Nama Penerima</label>
                  <input class="form-control" type="text" name="nama_penerima" placeholder="Masukan Nama Penerima" required oninvalid="this.setCustomValidity('Kolom penerima harus diisi')" oninput="setCustomValidity('')">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">No. Telepon Penerima</label>
                  <input class="form-control" type="number" name="telp_penerima" placeholder="Masukan No. Telepon Penerima" required oninvalid="this.setCustomValidity('Kolom telepon harus diisi')" oninput="setCustomValidity('')">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Alamat Penerima</label>
                  <textarea class="form-control" rows="3" name="alamat_penerima" placeholder="Masukan Alamat Penerima" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="keterangan_pengiriman" placeholder="Masukan Keterangan" required oninvalid="this.setCustomValidity('Kolom keterangan harus diisi')" oninput="setCustomValidity('')"></textarea>
                </div>
              </div>
              </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
            </div>
            </form>
          </div>
        </div>
    </main>