<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Data Pengiriman</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Data Pengiriman</a></li>
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
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <div class="tile-title-w-btn">
                    <h3 class="title">Tabel Pengiriman</h3>
                    <!-- <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('Hewan/insert_hewan');?>"><i class="fa fa-plus"></i>Tambah Data </a></p> -->
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Jenis Pengiriman</th>
                            <th>Pemesan</th>
                            <th>Nama Penerima</th>
                            <th>Telepon Penerima</th>
                            <th>Alamat Penerima</th>
                            <th>Tanggal Input Pengiriman</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($Pengiriman as $d) { 
                            $get_sisa = number_format($d->total-$d->jml_bayar,0,',','.'); 
                            $no = $no++;?>

                        <?php if ($d->keterangan == 'p2hq'): ?>
                        <tr style="background-color: #85ff95">
                          <td><?php echo $no++ ?></td>
                          <?php else: ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                          <?php endif; ?>
                            <td><a href="<?php echo base_url();?>Pengiriman/detail_table/<?php echo $d->no_faktur_k;?>"><?php echo $d->no_faktur_k ?></a></td>
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
                            <td><?php echo $d->nama_pemesan ?><br /><font color="blue"><?php echo $d->telp_pemesan ?></font></td>
                            <td><?php echo $d->nama_penerima ?></td>
                            <td><?php echo $d->telp_penerima ?></td>
                            <td><?php echo $d->alamat_penerima ?></td>
                            <td><?php echo date('d M Y H:i:s', strtotime($d->tgl_input_pengiriman)); ?></td>
                            <td><b><?php
                                if($get_sisa == 0){
                                    echo "<span class='badge badge-info'>Lunas</span>";
                                }else{
                                    echo "<span class='badge badge-danger'>Belum Lunas</span>";
                                    echo "<br/ ><font color='#ff0000'>Rp -<strong>$get_sisa</strong></font>";
                                }
                                ?></b>
                            </td>

                            <td>
                              <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilihan</button>
                              <div class="dropdown-menu">
                                <?php
                                if($get_sisa <= 0){
                                ?>
                                <a class="dropdown-item btn btn-sm" href="<?php echo site_url('Pengiriman/cetak_pengiriman/'.$d->no_faktur_k) ?>"><i class="fa fa-print"></i><span>Cetak</span></a>
                                <?php
                                }
                                ?>
                                <a class="dropdown-item btn btn-sm" href="<?php echo site_url('Pengiriman/delete_pengiriman/'.$d->no_faktur_k) ?>" onclick="return confirm('Apakah Anda yakin ?');"><i class="fa fa-trash"></i><span>Hapus</span></a>
                              </div>
                            </div>
                            </td>
                          </tr>
                        <?php } ?>
                    </tbody>  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
  </body>
</html>
