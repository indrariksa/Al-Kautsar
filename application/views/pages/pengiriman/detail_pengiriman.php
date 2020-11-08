<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--START MAP--->
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.49.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.1/mapbox-gl-geocoder.min.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.4.1/mapbox-gl-geocoder.css' type='text/css' />
<!--END MAP--->

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Detail Pengiriman</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Detail Pengiriman</a></li>
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
            <div class="tile-title-w-btn">
                    <h2 class="title mb-3 line-head text-success" style="text-align: center; width: 100%;"><u>No Faktur :</u> <span class="badge badge-info"><?php echo $no_faktur;?></span></h2>
            </div>
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Pengiriman</h3>
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>No</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Nama Penerima</th>
                            <th>Telepon Penerima</th>
                            <th>Alamat Penerima</th>
                            <th>Keterangan</th>
                            <th>Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($Kirim as $d) { 
                            $no = $no++;?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo date('d-M-Y', strtotime($d->tgl_pengiriman)); ?></td>
                            <td><?php echo $d->nama_penerima ?></td>
                            <td><?php echo $d->telp_penerima ?></td>
                            <td><?php echo $d->alamat_penerima ?></td>
                            <td><?php echo $d->keterangan_pengiriman ?></td>
                            <td><font color="blue"><?php echo strtoupper($d->nama_user) ?></font></td>
                        </tr>
                        <?php } ?>
                    </tbody>  
                </table>
                </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Map Pengiriman</h3>
                  </div>
                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Map</label>
                  <div class="col-sm-12">
                     <div id="map" class="" style="height: 240px;margin-bottom: 23px;"></div>
                  </div>
              </div>
                </div>
            </div>
          </div>
        </div>
      </div> -->

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Pemesanan</h3>
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>No</th>
                           <!--  <th>No Faktur</th> -->
                            <th>Nama Pemesan</th>
                            <th>Telepon Pemesan</th>
                            <th>Alamat Pemesan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pelunasan</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Type Pemesanan</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Jumlah Bayar</th>
                            <th>Sisa</th>
                            <th>Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($Dtl as $d) {
                            $get_sisa = number_format($d->total-$d->jml_bayar,0,',','.'); 
                            $no = $no++;?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <!-- <td><?php echo $d->no_faktur ?></td> -->
                            <td><?php echo $d->nama_pemesan ?></td>
                            <td><?php echo $d->telp_pemesan ?></td>
                            <td><?php echo $d->alamat_pemesan ?></td>
                            <td><?php echo date('d-M-Y H:i:s', strtotime($d->tgl_pemesanan)); ?></td>
                            <td><?php echo date('d-M-Y', strtotime($d->tgl_pelunasan)); ?></td>
                            <td><?php echo date('d-M-Y', strtotime($d->tgl_pengiriman)); ?></td>
                            <td><?php echo $d->deskripsi ?></td>
                            <td><?php
                                if($d->keterangan == 'dikirim'){
                                    echo "Dikirim";
                                }elseif($d->keterangan == 'ambil'){
                                    echo "Ambil Sendiri";
                                }else{
                                    echo "P2HQ";
                                }
                            ?>
                            </td>
                            <td>Rp <?= number_format($d->total,0,',','.') ?></td>
                            <td>Rp <?= number_format($d->jml_bayar,0,',','.') ?></td>
                            <td><b><?php
                                if($get_sisa == 0){
                                    echo "<span class='badge badge-info'>Lunas</span>";
                                     echo "<br/ ><font color='#ff0000'>Rp <strong>$get_sisa</strong></font>";
                                }else{
                                    echo "<span class='badge badge-danger'>Belum Lunas</span>";
                                    echo "<br/ ><font color='#ff0000'>Rp -<strong>$get_sisa</strong></font>";
                                }
                                ?></b>
                            </td>
                            <td><font color="blue"><?php echo strtoupper($d->nama_user) ?></font></td>
                        </tr>
                        <?php } ?>
                    </tbody>  
                </table>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Detail Hewan</h3>
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>No</th>
                            <!-- <th>No Faktur</th> -->
                            <th>Hewan</th>
                            <th>No Reg Hewan</th>
                            <th>Kelas</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($Pesan_dtl as $d) { 
                            $no = $no++;?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <!-- <td><?php echo $d->no_faktur_d ?></td> -->
                            <td><?php
                                if($d->hewan_jenis == 'sapi'){
                                    echo "Sapi";
                                }else{
                                    echo "Domba";
                                }
                            ?></td>
                            <td><?php echo $d->hewan_no_reg ?></td>
                            <td><?php echo $d->hewan_deskripsi ?></td>
                            <td>Rp <?= number_format($d->hewan_harga,0,',','.') ?></td>
                            <td><?php echo $d->hewan_jumlah ?> ekor</td>
                            <td>Rp <?= number_format($d->hewan_total,0,',','.') ?></td>
                          </tr>
                        <?php } ?>
                    </tbody>  
                </table>
                <a href="<?php echo base_url('Pengiriman/view_table')?>" class="btn btn-success btn-rounded waves-effect waves-light m-b-40">Kembali</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  </body>
</html>

 <!--START MAP--->
  <script type="text/javascript">
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

        $(document).on("click",".edit",function(e){
      e.preventDefault();
        var id = $(this).attr("data-id");
        $.ajax({
        url : "<?= site_url('Pengiriman/detail_table')?>",
        data : {id:id},
        type: 'POST',
        success : function(e){
          var Obj = JSON.parse(e);
          $("#tempatLatitude").val(Obj.tempatLatitude);
          $("#tempatLongitude").val(Obj.tempatLongitude);
        }
      });
    });
  </script>
  <!--END MAP--->