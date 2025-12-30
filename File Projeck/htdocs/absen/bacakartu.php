<?php

	include "koneksi.php";
	//baca tabel status untuk mode absen
	$sql = mysqli_query($konek, "select * from status");
	$data = mysqli_fetch_array($sql);
	$mode_absen = $data['mode'];

	//uji mode absen
	$mode = "";
	if($mode_absen==1)
		$mode = "masuk";
	else if($mode_absen==2)
		$mode = "keluar";
	//baca tabel tmprfid
	$baca_kartu = mysqli_query($konek, "select * from tmprfid");
	$data_kartu = mysqli_fetch_array($baca_kartu);
	$nokartu	= $data_kartu['nokartu'];
?>
<div class="container-fluid" style="text-align: center;">
	<?php if($nokartu=="") { ?>

	<h3>Absen : <?php echo $mode; ?> </h3>
	<h3>Silahkan Tempelkan Kartu RFID Anda</h3>
	<img src="images/animasi3.gif" style="width: 350px"> <br>
	<h4>Scanning....</h4>
	

	<?php } else {
		//cek apakah kartu RFID tersebut terdaftar di tabel mahasiswa
		$cari_mahasiswa = mysqli_query($konek, "select * from mahasiswa
			where nokartu='$nokartu'");
		$jumlah_data = mysqli_num_rows($cari_mahasiswa);
		if ($jumlah_data==0)
			echo "<h1>Maaf! Kartu Tidak Dikenali<h1>";
		else
		{
			//ambil nama mahsiswa
			$data_mahasiswa = mysqli_fetch_array($cari_mahasiswa);
			$nama = $data_mahasiswa['nama'];

			//tanggal dan jam hari ini
			date_default_timezone_set('Asia/Jakarta');
			$tanggal = date('Y-m-d');
			$jam     = date('H:i:s');


			//cek di tabel absen, apakah nomor kartu tersebut sudah ada sesuai tanggal saat ini. apabilah belum ada, maka dianggap absen masuk, tapi kalau sudah ada, maka update data sesuai mode absen.
			$cari_absen = mysqli_query($konek, "select  * from absen 
				where nokartu='$nokartu' and tanggal='$tanggal'");
			//hitung jumlah datanya
			$jumlah_absen = mysqli_num_rows($cari_absen);
			if($jumlah_absen == 0)
			{
				echo "<h1>Selamat Datang <br> $nama<h1> ";
				mysqli_query($konek, "insert into absen(nokartu, tanggal, waktu_masuk)values('$nokartu', 
					'$tanggal', '$jam')");
			}
			else
			{
				//update sesuai pilihan mode absen
				if($mode_absen == 2)
				{
					echo "<h1>Selamat Jalan <br> $nama</h1>";
					mysqli_query($konek, "update absen set waktu_keluar='$jam' where nokartu='$nokartu' and tanggal='$tanggal'");
				}
			}
		}
		//kosongkan tabel tmprfid
		mysqli_query($konek, "delete from tmprfid");
	} ?>

</div>