<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> Pemesanan Hewan Kurban</h1>
          <p>Input Pemesanan</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Form Pemesanan</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Input Pemesanan</h3>
            <div class="form-group">
                <form action="<?php echo base_url('Pemesanan/add_to_cart'); ?>" method="post">
                <table>
                  <tr>
                      <th>Kode Hewan</th>
                  </tr>
                  <tr>
                      <th><input type="text" name="hewan_id" id="hewan_id" class="form-control input-sm" autocomplete="off"></th>                     
                  </tr>
                  <tr>
                      <td><div id="detail_domba">
                      <!-- <td><div id="detail_domba" style = "position:absolute"> -->
                      </div></td>
                  </tr>
                </table>
                </form>
              </div>
              <div class="form-group">
                <table class="table table-hover table-bordered" style="font-size:11px;margin-top:10px;">
                <thead>
                    <tr>
                        <th>Kode Hewan</th>
                        <th>Kelas</th>
                        <th style="text-align:center;">Deskripsi</th>
                        <th style="text-align:center;">Harga(Rp)</th>
                        <th style="text-align:center;">No Reg Hewan</th>
                        <th style="text-align:center;">Qty</th>
                        <th style="text-align:center;">Sub Total</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($this->cart->contents() as $items): ?>
                    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                    <tr>
                         <td><?=$items['id'];?></td>
                         <td><?=$items['name'];?></td>
                         <td style="text-align:center;"><?=$items['deskripsi'];?></td>
                         <td style="text-align:right;"><?php echo number_format($items['amount']);?></td>
                         <td style="text-align:right;"><?=$items['no_reg'];?></td>
                         <td style="text-align:center;"><?php echo number_format($items['qty']);?></td>
                         <td style="text-align:right;"><?php echo number_format($items['subtotal']);?></td>
                        
                         <td style="text-align:center;"><a href="<?php echo base_url().'Pemesanan/remove/'.$items['rowid'];?>" class="btn btn-warning btn-sm"><span class="fa fa-close"></span> Batal</a></td>
                    </tr>
                    
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
                </table>
                </div>
            <form action="<?php echo base_url('Pemesanan'); ?>" enctype="multipart/form-data" method="post">
            <div class="tile-body">
                <div class="form-group">
                  <label class="control-label">No. Faktur</label>
                  <input class="form-control" type="text" name="no_faktur" value="<?php echo $get_faktur; ?>" readonly>
                </div>
               <!--  <div class="form-group">
                  <label class="control-label">No Reg Hewan</label>
                  <input class="form-control" type="text" name="no_reg_hewan" placeholder="Masukan No Reg Hewan" required oninvalid="this.setCustomValidity('Kolom pemesan harus diisi')" oninput="setCustomValidity('')">
                </div> -->
                <div class="form-group">
                  <label class="control-label">Nama Pemesan</label>
                  <input class="form-control" type="text" name="nama_pemesan" placeholder="Masukan Nama Pemesan" required autocomplete="off" oninvalid="this.setCustomValidity('Kolom pemesan harus diisi')" oninput="setCustomValidity('')">
                </div>
                <div class="form-group">
                  <label class="control-label">No. Telepon Pemesan</label>
                  <input class="form-control" type="number" name="telp_pemesan" placeholder="Masukan No. Telepon Pemesan" required autocomplete="off" oninvalid="this.setCustomValidity('Kolom telepon harus diisi')" oninput="setCustomValidity('')">
                </div>
                <div class="form-group">
                  <label class="control-label">Alamat Pemesan</label>
                  <textarea class="form-control" rows="4" name="alamat_pemesan" placeholder="Alamat Pemesan" required oninvalid="this.setCustomValidity('Kolom alamat harus diisi')" oninput="setCustomValidity('')"></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Tanggal Pengiriman</label>
                  <input class="form-control" id="demoDate" type="text" name="tgl_pengiriman" placeholder="Pilih tanggal pengiriman" autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="control-label">Tanggal Pelunasan</label>
                  <input class="form-control" id="demoDate2" type="text" name="tgl_pelunasan" placeholder="Pilih tanggal pelunasan" autocomplete="off">
                </div>
                 <div class="form-group">
                    <label>Type Pemesanan</label>
                    <select class="form-control" id="demoSelect" name="id_type_pemesanan">
                        <?php
                            if(@$dd_type_pemesanan) :
                                foreach ($dd_type_pemesanan as $jp) :    
                        ?>
                        <option value="<?= $jp->id_type_pemesanan ?>" <?php if($this->input->post('id_type_pemesanan') == $jp->id_type_pemesanan) {echo "selected";} ?>> <?= $jp->nama_type ?>
                        </option>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                  </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <!-- <div class="col-md-9"> -->
                            <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="keterangan" value="dikirim" <?php if($this->input->post('keterangan') == 'dikirim') {echo 'checked';} ?> ><span class="label-text">Dikirimkan</span>
                              </label>
                            </div>
                             <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="keterangan" value="ambil" <?php if($this->input->post('keterangan') == 'ambil') {echo 'checked';} ?> ><span class="label-text">Ambil Sendiri</span>
                              </label>
                            </div>
                            <div class="animated-radio-button">
                              <label>
                                <input type="radio" name="keterangan" value="p2hq" <?php if($this->input->post('keterangan') == 'p2hq') {echo 'checked';} ?> ><span class="label-text">P2HQ</span>
                              </label>
                            </div>
                        <!-- </div> -->
                  </div>
                <table>
                <tr>
                    <td style="width:760px;" rowspan="2"></td>
                    <th style="width:140px;">Total Belanja(Rp)</th>
                    <th style="text-align:right;width:190px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total());?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                    <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total();?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                </tr>
                <tr>
                    <th>Tunai(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required autocomplete="off"></th>
                    <input type="hidden" id="jml_bayar" name="jml_bayar" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                </tr>
                <tr>
                    <td></td>
                    <th>Sisa Kekurangan(Rp)</th>
                    <th style="text-align:right;"><input type="text" id="sisa" name="sisa" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required autocomplete="off"></th>
                </tr>
                </table>
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-check-circle"></i>Submit</button>
              <!-- <a href="<?php echo base_url('Pemesanan') ?>" class="btn btn-danger"><i class="fa fa-times-circle"></i>Cancel</a> -->
            </div>
            </form>
          </div>
        </div>
        <div class="col-md-4">
          <div class="tile">
            <h3 class="tile-title">Info Hewan Kurban</h3>
            <div class="tile-body">
              <form class="form-horizontal">
                <center><label class="badge badge-primary"><h6>Info Domba</h6></label></center>
                <div class="form-group row">
                  <table class="table">
                    <tr>
                     <!-- <th>No.</th> -->
                     <th>Kode Domba</th>
                     <th>Domba</th>
                     <th>Deskiprsi</th>
                    </tr>
                    <?php 
                    $no=1; 
                    foreach ($domba as $db): 
                    ?>
                     <tr>
                      <!-- <td><?php echo $no++; ?></td> -->
                      <td><?php echo $db->hewan_id ?></td>
                      <td><?php echo $db->hewan_kelas ?></td>
                      <td><?php echo $db->hewan_deskripsi ?></td>
                     </tr>
                    <?php endforeach ?>
                   </table>
                </div>
                <center><label class="badge badge-primary"><h6>Info Sapi</h6></label></center>
                <div class="form-group row">
                  <table class="table">
                    <tr>
                     <!-- <th>No.</th> -->
                     <th>Kode Sapi</th>
                     <th>Sapi</th>
                     <th>Deskripsi</th>
                    </tr>
                    <?php 
                    $no=1; 
                    foreach ($sapi as $sp): 
                    ?>
                     <tr>
                      <!-- <td><?php echo $no++; ?></td> -->
                      <td><?php echo $sp->hewan_id ?></td>
                      <td><?php echo $sp->hewan_kelas ?></td>
                      <td><?php echo $sp->hewan_deskripsi ?></td>
                     </tr>
                    <?php endforeach ?>
                   </table>
                </div>
                <center><label class="badge badge-primary"><h6>Info Tipe Pemesanan</h6></label></center>
                <div class="form-group row">
                  <table class="table">
                    <tr>
                     <!-- <th>No.</th> -->
                     <th>Type</th>
                     <th>Deskripsi</th>
                    </tr>
                    <?php 
                    $no=1; 
                    foreach ($type_pemesanan as $typ): 
                    ?>
                     <tr>
                      <!-- <td><?php echo $no++; ?></td> -->
                      <td><?php echo $typ->nama_type ?></td>
                      <td><?php echo $typ->deskripsi ?></td>
                     </tr>
                    <?php endforeach ?>
                   </table>
                </div>
          </div>
        </div>
      </div>
    </main>
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

  <script type="text/javascript">
        $(document).ready(function(){
            //Ajax kabupaten/kota insert
            $("#hewan_id").focus();
            $("#hewan_id").on("input",function(){
                var kobar = {hewan_id:$(this).val()};
                   $.ajax({
               type: "POST",
               url : "<?php echo base_url().'Pemesanan/get_hewan';?>",
               data: kobar,
               success: function(msg){
               $('#detail_domba').html(msg);
               }
            });
            }); 

            $("#hewan_id").keypress(function(e){
                if(e.which==13){
                    $("#jumlah").focus();
                }
            });
        });
    </script>

    <script type="text/javascript">
        $(function(){
            $('#jml_uang').on("input",function(){
                var total=$('#total').val();
                var jumuang=$('#jml_uang').val();
                var hsl=jumuang.replace(/[^\d]/g,"");
                $('#jml_bayar').val(hsl);
                $('#sisa').val(total-hsl);
            })
            
        });
    </script>

    <script type="text/javascript">
        $(function(){
            $('.domba_harga').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.jml_uang').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('#jml_bayar').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ''
            });
            $('#sisa').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
        });
    </script>

    <script type="text/javascript">
      var today = new Date();

      $("#demoDate").datepicker({
          changeMonth: true,
          changeYear: true,
          minDate: 0 // set the minDate to the today's date
          // you can add other options here
      });
    </script>