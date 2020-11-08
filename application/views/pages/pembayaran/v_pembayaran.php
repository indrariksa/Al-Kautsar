<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Data Rekap Pembayaran</h1>
          <p>Rekap Pembayaran</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Data Rekap Pembayaran</a></li>
        </ul>
      </div>
      <?php
          $msg = $this->session->flashdata('success');
          $msg2 = $this->session->flashdata('successdelete');
          $msg3 = $this->session->flashdata('duplikat');
      if($msg){
          echo '<div class="alert alert-success text-center"><button class="close" data-dismiss="alert">×</button><strong>Success!</strong> '.$msg.'</div>';
          }elseif($msg2){
          echo '<div class="alert alert-success text-center"><button class="close" data-dismiss="alert">×</button><strong>Success!</strong> '.$msg2.'</div>';
          }elseif($msg3){
          echo '<div class="alert alert-danger text-center"><button class="close" data-dismiss="alert">×</button><strong>Peringatan!</strong> '.$msg3.'</div>';
          }
      ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Rekap Pembayaran</h3>
                  </div>
                  <hr>
                <form method="post" action="<?php echo base_url("Pembayaran")?>">

                <div class="row mb-3 col-md-12">

                    <!-- <div class="form-group row"> -->
                    <label class="col-lg-1 text-right control-label col-form-label">Dari</label>
                    <div class="col-lg-3 input-group">
                        <input type="text" class="form-control" id="demoDate" name="DariTgl" placeholder="mm/dd/yyyy" autocomplete="off" value="<?php echo set_value('DariTgl'); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div><!-- </div> -->

                   <!--  <div class="form-group row"> -->
                    <label class="col-lg-1 text-right control-label col-form-label">S/d</label>
                    <div class="col-lg-3 input-group">
                        <input type="text" class="form-control" id="demoDate2" name="SampaiTgl" placeholder="mm/dd/yyyy" autocomplete="off" value="<?php echo set_value('SampaiTgl'); ?>">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div><!-- </div> -->

                    <div class="col-lg-2">
                    <input type="submit" class="btn btn-info" value="Cari">&nbsp;&nbsp;
                    <a class="btn btn-danger btn-delete" href="<?php echo base_url("Pembayaran")?>">Reset</a></div>
                    </div>
                  </form>

                  <br>
                  <form method='post' target=_new action='<?php echo base_url("Pembayaran/export")?>'> 

                    <input name='DariTgl' type='hidden' value='<?php echo set_value('DariTgl'); ?>'>
                    <input name='SampaiTgl' type='hidden' value='<?php echo set_value('SampaiTgl'); ?>'>
                     
                    <button class='btn btn-sm btn-primary' type='submit'><i class="m-r-10 mdi mdi-office"></i><span> Export Excel </span></button>                 
                    </form><br />
                  <hr>

                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                        <tr align="center" >
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Pemesan</th>
                            <th>Pegawai (Input Pembayaran)</th>
                            <!-- <th>Penerima</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $grand_total = 0;
                            $no = 1;
                            foreach($periode as $d) { 
                            $get_sisa = number_format($d->total-$d->jml_bayar,0,',','.'); 
                            $no = $no++;
                            $grand_total    = $grand_total + $d->dibayar;?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><a href="<?php echo base_url();?>Pembayaran/detail_table/<?php echo $d->no_faktur;?>" target="blank_"><?php echo $d->no_faktur ?></a></td>
                            <td><?php echo date('d M Y H:i:s', strtotime($d->tgl_pembayaran)); ?></td>
                            <td>Rp <?php echo number_format($d->dibayar,0,',','.') ?></td>
                            <td><?php echo $d->nama_pemesan ?><br /><font color="blue"><?php echo $d->telp_pemesan ?><br /><font color="red"><?php echo $d->alamat_pemesan ?></font></td>
                            <td><b><?php echo strtoupper($d->nama_user) ?></b></td>
                            <!-- <td><?php echo $d->nama_penerima ?><br /><font color="blue"><?php echo $d->telp_penerima ?></font><br /><font color="red"><?php echo $d->alamat_penerima ?></font></td> -->
                          </tr>
                        <?php } ?>
                    </tbody>  
                </table>
                <br />
                <div class="bs-component">
                  <button class="btn btn-primary btn-lg" type="button">TOTAL = Rp <?php echo number_format($grand_total, 0,",","."); ?></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  </body>
</html>

  <script type="text/javascript">
    $('#demoDate').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
      });
    $('#demoDate2').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
      });
    $('#demoSelect').select2();
    $('#sampleTable').DataTable();
  </script>
