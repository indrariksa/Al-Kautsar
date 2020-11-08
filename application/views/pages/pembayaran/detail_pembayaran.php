<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Detail Pemesanan</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Detail Pemesanan</a></li>
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
                            <!-- <th>Tanggal Pelunasan</th> -->
                            <th>Tanggal Pengiriman</th>
                            <th>Jenis Pegiriman</th>
                            <th>Keterangan</th>
                            <th>Total</th>
                            <th>Sudah Bayar</th>
                            <th>Sisa</th>
                            <th>Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($dtl_pesan as $d) {
                            $get_sisa = number_format($d->total-$d->jml_bayar,0,',','.'); 
                            $no = $no++;?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <!-- <td><?php echo $d->no_faktur ?></td> -->
                            <td><?php echo $d->nama_pemesan ?></td>
                            <td><?php echo $d->telp_pemesan ?></td>
                            <td><?php echo $d->alamat_pemesan ?></td>
                            <td><?php echo date('d M Y H:i:s', strtotime($d->tgl_pemesanan)); ?></td>
                            <!-- <td><?php echo date('d M Y', strtotime($d->tgl_pelunasan)); ?></td> -->
                            <td><?php echo date('d M Y', strtotime($d->tgl_pengiriman)); ?></td>
                            
                            <td><?php echo $d->deskripsi; ?>
                            <td><?php echo $d->keterangan; ?>
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

                <hr>
                
                <table class="table table-hover table-bordered">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Detail Pemesanan</h3>
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>No</th>
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
                            foreach($Pemesanan as $d) { 
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
                    <h3 class="title">Tabel Pembayaran</h3>
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($dtl_bayar as $dtb) {
                            $no = $no++;?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo date('d M Y</font> <p>(H:i:s)</p>', strtotime($dtb->tgl_pembayaran)); ?></td>
                            <td>Rp <?= number_format($dtb->dibayar,0,',','.') ?></td>
                            <td><font color="blue"><?php echo strtoupper($dtb->nama_user) ?></font></td>
                        </tr>
                        <?php } ?>
                    </tbody>  
                </table>
                </div>
            </div>
          </div>
        </div>
      </div>

      <?php foreach($dtl_kirim as $d) { ?>
      <?php
        if($d->status_kirim <= 'sudah'){
         ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Pengiriman <?php
                              if($d->status_kirim == 'sudah'){
                                  echo "<span class='badge badge-primary'>Sudah Dikirim</span>";
                              }else{
                                  echo "<center><h2><span class='badge badge-warning'>Belum Dikirim</span></h2></center>";
                              }
                              ?></b></h3>
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
                            foreach($dtl_kirim as $d) { 
                            $no = $no++;?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo date('d M Y', strtotime($d->tgl_pengiriman)); ?></td>
                            <td><?php echo $d->nama_penerima ?></td>
                            <td><?php echo $d->telp_penerima ?></td>
                            <td><?php echo $d->alamat_penerima ?></td>
                            <td><?php echo $d->keterangan_pengiriman ?></td>
                            <td><font color="blue"><?php echo strtoupper($dtb->nama_user) ?></font></td>
                        </tr>
                        <?php } ?>
                    </tbody>  
                </table>
                <a href="<?php echo base_url('Pembayaran')?>" class="btn btn-success btn-rounded waves-effect waves-light m-b-40">Kembali</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php } if($d->status_kirim <= 'belum'){ ?>
      <?php foreach($dtl_kirim2 as $d2) { ?>
        
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
              <table class="table table-hover table-bordered">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Pengiriman</h3>
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($dtl_kirim2 as $d2) { ?>
                        <tr>
                          <td><b><?php
                              if($d->status_kirim == 'sudah'){
                                  echo "<span class='badge badge-success'>Sudah Dikirim</span>";
                              }else{
                                  echo "<center><h2><span class='badge badge-warning'>Belum Dikirim</span></h2></center>";
                              }
                              ?></b>
                          </td>
                        </tr>
                        <?php } ?>
                    </tbody>  
                </table>
                <a href="<?php echo base_url('Pembayaran')?>" class="btn btn-success btn-rounded waves-effect waves-light m-b-40">Kembali</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php } ?>

    </main>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  </body>
</html>