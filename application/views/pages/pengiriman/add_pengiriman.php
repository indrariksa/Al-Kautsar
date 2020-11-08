<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--START MAP--->
<!-- <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.1/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.1/mapbox-gl-geocoder.css' type='text/css' /> -->
<!--END MAP--->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>   -->

<script>
    var baseurl = "<?php echo base_url("index.php/"); ?>"; // Buat variabel baseurl untuk nanti di akses pada file config.js
    </script>
<!--     <script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script> --> <!-- Load library jquery -->
    <script src="<?php echo base_url("assets/js/cari_faktur.js"); ?>"></script> <!-- Load file process.js -->
<script>  
 $(document).ready(function(){  
  // $("#btn-search").click(function(){ 
      // $('#id').change(function(){ 
      $("#btn-search").click(function(){ 
          // $("#id_result").hide();
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
    // });
 });  

 // $(document).ready(function(){
 //  $("#id_result").hide();
 //  });
 </script> 

<script type="text/javascript">
$(document).ready(function() {
  $("#id").focus();
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
      <?= form_error('no_faktur', '<div class="alert alert-danger text-center"><button class="close" data-dismiss="alert">×</button><strong>Error!</strong> ', '</div>'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Input Pengiriman</h3>
            <form action="<?php echo base_url('Pengiriman'); ?>" enctype="multipart/form-data" method="post">
            <div class="tile-body">
                <!-- <div class="form-group">
                  <label>Cari NO FAKTUR</label>
                  <input class="form-control" type="text" name="no_faktur" id="id" autocomplete="off" required>
                  <button type="button" id="btn-search" class="btn btn-danger"><span class="fa fa-search"></span> Search</button> <span id="loading">LOADING...</span>
                  <span id="id_result"></span><span><?= form_error('no_faktur', '<big class="text-danger pl-2">', '</big>'); ?><span>
                </div> -->
                <div class="form-group">
                    <label>Cari NO FAKTUR</label>
                    <select class="form-control" id="id" name="no_faktur" required>
                      <option value="">Cari  Faktur</option>
                        <?php
                            if(@$d_faktur) :
                                foreach ($d_faktur as $fk) :    
                        ?>
                        <option value="<?= $fk->no_faktur ?>" <?php if($this->input->post('no_faktur') == $fk->no_faktur) {echo "selected";} ?>> <?= $fk->no_faktur ?>
                        </option>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                    <button type="button" id="btn-search" class="btn btn-danger"><span class="fa fa-search"></span> Search</button> <span id="loading">LOADING...</span>
                  <span id="id_result"></span><!-- <span><?= form_error('no_faktur', '<big class="text-danger pl-2">', '</big>'); ?><span> -->
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
                  <input class="form-control" type="text" name="nama_penerima" placeholder="Masukan Nama Penerima" required autocomplete="off" oninvalid="this.setCustomValidity('Kolom penerima harus diisi')" oninput="setCustomValidity('')">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">No. Telepon Penerima</label>
                  <input class="form-control" type="number" name="telp_penerima" placeholder="Masukan No. Telepon Penerima" required autocomplete="off" oninvalid="this.setCustomValidity('Kolom telepon harus diisi')" oninput="setCustomValidity('')">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Alamat Penerima</label>
                  <textarea class="form-control" rows="3" name="alamat_penerima" placeholder="Masukan Alamat Penerima" required autocomplete="off" oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="control-label">Keterangan</label>
                  <textarea class="form-control" rows="3" name="keterangan_pengiriman" placeholder="Masukan Keterangan" required  oninvalid="this.setCustomValidity('Kolom keterangan harus diisi')" oninput="setCustomValidity('')"></textarea>
                </div>
              </div>
              <!-- <div class="col-lg-12">
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Map</label>
                  <div class="col-sm-12">
                     <div id="map" class="" style="height: 240px;margin-bottom: 23px;"></div>
                  </div>
              </div>
              </div>
              <div class="col-lg-6">
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Lat</label>
                      <input type="text" class="form-control" id="tempatLatitude" name="tempatLatitude" placeholder="Latitude"> 
              </div>
              </div>
              <div class="col-lg-6">
              <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Lng</label>
                      <input type="text" class="form-control" id="tempatLongitude" name="tempatLongitude" placeholder="Longitude"> 
              </div>
              </div> -->
            </div>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
            </div>
            </form>
          </div>
        </div>
    </main>

    <script type="text/javascript">
      
      $('#id').select2();
    </script>

    <!--START MAP--->
  <!-- <script type="text/javascript">
    mapboxgl.accessToken = 'pk.eyJ1IjoiZWZoYWwiLCJhIjoiY2ptOXRiZ3k2MDh4bzNrbnljMjk5Z2d5aSJ9.8dSNgeAjpdTlZ3x-b2vsog';
        var map = new mapboxgl.Map({
            container: 'map', // container id
            style: 'mapbox://styles/mapbox/streets-v9', // stylesheet location
            center: [107.67516930965559,-6.952909269077381], // starting position [lng, lat]
            zoom: 11, // starting zoom
            logoPosition:'top-right',
        });

        var search = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl
        })
        map.addControl(search, 'bottom-left');

        var nav = new mapboxgl.NavigationControl();
        map.addControl(nav, 'bottom-right');
        
        var marker = new mapboxgl.Marker({
            draggable: true
        })
            .setLngLat([107.67516930965559,-6.952909269077381])
            .addTo(map);
        function onDragEnd() {
            var lngLat = marker.getLngLat();
            
            var a = lngLat.lat;
            var b = lngLat.lng;
            $("#tempatLatitude").val(a);
            $("#tempatLongitude").val(b);
        }
        
        marker.on('dragend', onDragEnd);
  </script> -->
  <!--END MAP--->