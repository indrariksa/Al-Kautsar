<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Data P2HQ</h1>
          <p>Table to display analytical data effectively</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="<?php echo base_url('Welcome');?>"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item active">Data P2HQ</a></li>
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
                    <h3 class="title">Tabel P2HQ</h3>
                    <!-- <p><a class="btn btn-primary icon-btn" href="<?php echo base_url('Hewan/insert_hewan');?>"><i class="fa fa-plus"></i>Tambah Data </a></p> -->
                  </div>
                  <thead>
                        <tr align="center" >
                            <th>No</th>
                            <th>Tanggal Pemesanan</th>
                            <th>No Faktur</th>
<!--                             <th>No Reg Hewan</th> -->
                            <th>Nama Pemesan</th>
                            <th>Telepon Pemesan</th>
                            <th>Alamat Pemesan</th>
                            <th>Total</th>
                            <th>Jumlah Bayar</th>
                            <th>Sisa</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($Pemesanan as $d) {
                            $get_sisa = number_format($d->total-$d->jml_bayar,0,',','.');
                            $no = $no++;?>

                        


                        <tr>
                            <td><?php echo $no++ ?></td>

                            <td><?php echo date('d M Y H:i:s', strtotime($d->tgl_pemesanan)); ?></td>
                            <td><a href="<?php echo base_url();?>Pemesanan/detail_table/<?php echo $d->no_faktur;?>"><?php echo $d->no_faktur ?></a></td>
                            <!-- <td><?php echo $d->no_reg_hewan ?></td> -->
                            <td><?php echo $d->nama_pemesan ?></td>
                            <td><?php echo $d->telp_pemesan ?></td>
                            <td><?php echo $d->alamat_pemesan ?></td>
                            <td>Rp <?= number_format($d->total,0,',','.') ?></td>
                            <td>Rp <?= number_format($d->jml_bayar,0,',','.') ?></td>
                            <td><b><?php
                                if($get_sisa == 0){
                                    echo "<span class='badge badge-info'>Lunas</span>";
                                }else{
                                    echo "<span class='badge badge-danger'>Belum Lunas</span>";
                                    echo "<br/ ><font color='#ff0000'>Rp -<strong>$get_sisa</strong></font>";
                                }
                                ?></b>
                            </td>
                            <td><b><?php
                                if($d->status_kirim == 'sudah'){
                                    echo "<span class='badge badge-success'>Sudah Dikirim</span>";
                                }elseif($d->status_kirim == 'p2hq'){
                                    echo "<span class='badge badge-primary'>P2HQ</span>";
                                }else{
                                    echo "<span class='badge badge-warning'>Belum Dikirim</span>";
                                }
                                ?></b>
                            </td>

                            <td>
                              <div class="btn-group">
                              <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilihan</button>
                              <div class="dropdown-menu">
                                <!-- <a class="dropdown-item btn btn-sm" href="<?php echo site_url('Pemesanan/detail_table/'.$d->no_faktur) ?>"><i class="fa fa-info"></i><span>Detail</span></a> -->
                                <a class="dropdown-item btn btn-sm" href="<?php echo site_url('Pemesanan/cetak_pemesanan/'.$d->no_faktur) ?>"><i class="fa fa-print"></i><span>Cetak</span></a>
                                <a class="dropdown-item btn btn-sm" href="<?php echo site_url('Pemesanan/delete_pemesanan/'.$d->no_faktur) ?>" onclick="return confirm('Apakah Anda yakin ?');"><i class="fa fa-trash"></i><span>Hapus</span></a>
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
