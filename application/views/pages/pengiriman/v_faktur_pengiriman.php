<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body onload="window.print()">
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Faktur Pengiriman</h1>
          <p>A Printable Invoice Format</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <?php 
        $b=$data->row_array();
        ?>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> Al-Kautsar</h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">No Faktur: <?php echo $b['no_faktur'];?></h5>
                </div>
                <div class="col-7">
                  <h4 class="text-right">LEMBAR KHUSUS PENGIRIMAN</h4>
                </div>
              </div>
              <div class="row invoice-info">
                <!-- <div class="col-4">Nama Pemesan  : <?php echo $b['nama_pemesan'];?>
                  <address><strong>Address :</strong><br>518 Akshar Avenue<br>Gandhi Marg<br>New Delhi<br>Email: hello@vali.com</address>
                </div>
                <div class="col-4">To
                  <address><strong>John Doe</strong><br>795 Folsom Ave, Suite 600<br>San Francisco, CA 94107<br>Phone: (555) 539-1037<br>Email: john.doe@example.com</address>
                </div>
                <div class="col-4"><b>Invoice #<?php echo $b['no_faktur'];?></b><br><br><b>Order ID:</b> 4F3S8J<br><b>Payment Due:</b> 2/22/2014<br><b>Account:</b> 968-34567</div> -->
                <div class="col-4">
                <table border="0" align="center" style="width:900px;border:none;">
                <tr>
                    <th style="text-align:left;">Nama Pemesan </th>
                    <th style="text-align:left;">: <?php echo $b['nama_pemesan'];?></th>
                    <th style="text-align:left;">Tanggal Kirim </th>
                    <th style="text-align:left;">: <?php echo date('d M Y', strtotime($b['tgl_pengiriman'])); ?></th>
                </tr>
                <tr>
                <th style="text-align:left;">Alamat / Telp </th>
                    <th style="text-align:left;">: <?php echo $b['telp_pemesan'];?></th>
                    <!-- <th style="text-align:left;">No Reg Hewan</th>
                    <th style="text-align:left;">: <?php echo $b['no_reg_hewan'];?></th> -->
                </tr>
                <tr align="center">
                    <th style="text-align:left;"> </th>
                    <th style="text-align:left;">: <?php echo $b['alamat_pemesan'];?></th>
                    </tr>
                </table>
                </div>
              </div>
              <br />
              <div class="row">
                <div class="col-12">
                  <h5 class="text-right">Detail Distribusi</h5>
                </div>
                <div class="col-8 table-responsive">
                  <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th colspan="3"><center><b>Detail Pengiriman</b></center></th>
                            </tr>
                            
                            <tbody>
                            <?php foreach($data2 as $row) {
                            $get_sisa = number_format($row->total-$row->jml_bayar,0,',','.');
                            ?>
                            <tr>
                                <td style="text-align:left; width:150px;"><strong>Alamat Pengiriman</strong></td>
                                <td><?php echo $row->alamat_penerima;?></td>  
                            </tr>
                            <tr>
                                <td style="text-align:left;"><strong>Nama</strong></td>
                                <td><?php echo $row->nama_penerima;?> <br />(<?php echo $row->telp_penerima;?>)</td>  
                            </td>   
                            </tr>
                            <?php } ?>
                            </tbody>
                            </thead>
                        </table>
                </div>

                <div class="col-4 table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Hewan</th>
                        <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no=0;
                    $qtyw = 0;
                        foreach ($data->result_array() as $i) {
                            $no++;
                            
                            $kd=$i['hewan_id'];
                            $jenis=$i['hewan_jenis'];
                            $kelas='(Kelas '.$i['hewan_kelas'].')';
                            
                            $harjul=$i['hewan_harga'];
                            $noreg=$i['hewan_no_reg'];
                            $qty=$i['hewan_jumlah'];
                            $total=$i['hewan_total'];

                            $qtyw    = $qtyw + $i['hewan_jumlah'];
                    ?>
                    <tr>
                        <td style="text-align:left;"><b><?php echo ucfirst($jenis);?></b>
                            <?php echo ($kelas);?></td>
                        <td style="text-align:left;"><?php echo $qty;?> ekor</td>
                    </tr>
                    <?php }?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="1" style="text-align:center;"><b>Total</b></td>
                            <td style="text-align:left;"><b><?php echo $qtyw ;?> ekor</b></td>
                        </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <br />
            <div class="row">
                <div class="col-8 table-responsive">
                  <table height="300px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th colspan="1"><center><b>PETA LOKASI PENGIRIMAN</b></center></th>
                            </tr>
                            
                            <tbody>
                            <?php foreach($data2 as $row) {?>
                            <tr>
                                <td style="width:900px; border:1;margin-top:5px;margin-bottom:20px;"></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            </thead>
                        </table>
                </div>

                <div class="col-4 table-responsive">
                  <table height="230px" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th colspan="1"><center><b>Keterangan Pemesanan</b></center></th>
                            </tr>
                            
                            <tbody>
                            <?php foreach($data2 as $row) {?>
                            <tr>
                                <td style="width:900px; border:1;margin-top:5px;margin-bottom:20px;"><font color="blue"><b><?php echo $row->keterangan_pengiriman;?></b></font></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            </thead>
                        </table>
                </div>
            </div>

            <table align="center" style="width:900px; border:1px;margin-top:5px;margin-bottom:20px;">
                <tr>
                    <td align="left"></td>
                    <td align="right">Bandung, ......................20.........</td>
                    <!-- <td align="right">Bandung, <?php echo date('d M Y')?></td> -->
                </tr>
                <tr>
                    <td align="left">Penerima</td>
                    <td align="right">Pengirim</td>
                </tr>
               
                <tr>
                <td><br/><br/><br/><br/></td>
                </tr>    
                <tr>
                    <td align="left">(...........................................)</td>
                    <td align="right">(...........................................)</td>
                </tr>
                <tr>
                    <td align="center"></td>
                </tr>
            </table>
            <table align="center" style="width:700px; border:none;margin-top:5px;margin-bottom:20px;">
                <tr>
                    <th><br/><br/></th>
                </tr>
                <tr>
                    <th align="left"></th>
                </tr>
            </table>
              <!-- <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div> -->
            </section>
          </div>
        </div>
      </div>
    </main>