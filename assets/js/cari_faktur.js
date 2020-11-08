function search(){
	$("#loading").show(); // Tampilkan loadingnya
	
	$.ajax({
        type: "POST", // Method pengiriman data bisa dengan GET atau POST
        url: baseurl + "Pengiriman/search", // Isi dengan url/path file php yang dituju
        data: {no_faktur : $("#id").val()}, // data yang akan dikirim ke file proses
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
		},
		success: function(response){ // Ketika proses pengiriman berhasil
            $("#loading").hide(); // Sembunyikan loadingnya
            
            if(response.status == "success"){ // Jika isi dari array status adalah success
				$("#nama_pemesan").val(response.nama_pemesan);
				$("#telp_pemesan").val(response.telp_pemesan);
				$("#alamat_pemesan").val(response.alamat_pemesan);
				$("#tgl_pemesanan").val(response.tgl_pemesanan);
				// $("#receiver_nm").val(response.receiver_nm); // set textbox dengan id jenis kelamin
				// $("#receiver_addr").val(response.receiver_addr);
				// $("#receiver_pos").val(response.receiver_pos);
				// $("#receiver_telp").val(response.receiver_telp);
				// $("#receiver_kota").val(response.receiver_kota);
				// $("#services").val(response.services); // set textbox dengan id telepon
				// $("#barang").val(response.barang); // set textbox dengan id alamat
				// $("#harga_barang").val(response.harga_barang);
				// $("#catatan").val(response.catatan);
				// $("#tarif").val(response.tarif);
			}else{ // Jika isi dari array status adalah failed
				alert("Data Tidak Ditemukan");
			}
		},
        error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
			alert(xhr.responseText);
        }
    });
}

$(document).ready(function(){
	$("#loading").hide(); // Sembunyikan loadingnya
	
    $("#btn-search").click(function(){ // Ketika user mengklik tombol Cari
        search(); // Panggil function search
    });
    
    $("#id").keyup(function(){ // Ketika user menekan tombol di keyboard
		if(event.keyCode == 13){ // Jika user menekan tombol ENTER
			search(); // Panggil function search
		}
	});
});
