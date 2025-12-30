<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Rekap Absen</title>
</head>
<body>
	<?php include "menu.php"; ?>
	<!-- isi -->
	<div class="container-fluid">
		<h3>Rekap Absen</h3>
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: blue; color:white">
				<th style="width: 10px; text-align: center">No.</th>
				<th style="width: 100px; text-align: center">Nama</th>
				<th style="width: 100px; text-align: center">NPM</th>
				<th style="width: 100px; text-align: center">Tanggal</th>
				<th style="width: 100px; text-align: center">Waktu Masuk</th>
				<th style="width: 100px; text-align: center">Waktu Keluar</th>	
				</tr>
			</thead>
			<tbody>
				<?php
					include "koneksi.php";
					//baca tabel rekap dan relasikan dengan tabelmahasiswa berdasarkan nomor kartu RFID untuk tanggal hari ini
					//baca tanggal saat ini
					date_default_timezone_set('Asia/Jakarta');
					$tanggal = date('Y-m-d');
					//filter absen berdasarkan tanggal saat ini
					$sql = mysqli_query($konek, "select b.nama, 
						b.NPM, a.tanggal, a.waktu_masuk,a.waktu_keluar from absen a,
						mahasiswa b where a.nokartu=b.nokartu and a.tanggal='$tanggal'");
					$no = 0;
					while($data = mysqli_fetch_array($sql))
					{
						$no++;
				?>
				<tr> 
					<td> <?php echo $no; ?> </td>
					<td> <?php echo $data['nama']; ?> </td>
					<td> <?php echo $data['NPM']; ?> </td>
					<td> <?php echo $data['tanggal']; ?> </td>
					<td> <?php echo $data['waktu_masuk']; ?> </td>
					<td> <?php echo $data['waktu_keluar']; ?> </td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<?php include "footer.php"; ?>

</body>
</html>