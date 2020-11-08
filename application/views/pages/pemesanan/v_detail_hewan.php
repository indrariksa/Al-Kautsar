					<?php 
						error_reporting(0);
						$b=$hewan->row_array();
					?>
					<table class="table">
						<tr>
		                    <th>Hewan Kelas</th>
		                    <th>Deskripsi</th>
		                    <th>Harga(Rp)</th>
		                   	<th>No Reg Hewan</th>
		                    <th>Jumlah</th>
		                </tr>
						<tr>
							<td><input type="text" name="hewan_kelas" value="<?php echo $b['hewan_kelas'];?>" style="width:90px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="text" name="hewan_deskripsi" value="<?php echo $b['hewan_deskripsi'];?>" style="width:170px;margin-right:5px;" class="form-control input-sm" readonly></td>
		                    <td><input type="number" name="hewan_harga" value="<?php echo $b['hewan_harga'];?>" class="hewan_harga form-control input-sm" style="width:100px;margin-right:5px;" id="hewan_harga" readonly></td>
		                    <td><input type="text" name="hewan_no_reg" id="hewan_no_reg" class="form-control input-sm" style="width:100px;margin-right:5px;" required autocomplete="off"></td>
		                    <td><input type="number" name="qty" id="qty" value="1" min="1" class="form-control input-sm" style="width:60px;margin-right:5px;" required></td>
		                    <td><button type="submit" class="btn btn-sm btn-primary">Ok</button></td>
						</tr>
					</table>
					
	<script type="text/javascript">
        $(function(){
            $('.hewan_harga').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
    </script>