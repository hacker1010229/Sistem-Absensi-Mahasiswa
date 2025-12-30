<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Data Mahasiswa</title>
</head>
<body>

	<?php include "menu.php"; ?>
	
	<!-- isi -->
	<div class="container-fluid">
		<h3>Data Mahasiswa</h3>
		<table class="table table-bordered">
			<thead>
				<tr style="background-color: blue; color: white;">
				<th style="width: 10px; text-align: center">No.</th>
				<th style="width: 100px; text-align: center">No Kartu
				</th>
				<th style="width: 100px; text-align: center">Nama</th>
				<th style="width: 100px; text-align: center">NPM</th>
				<th style="width: 100px; text-align: center">Prodi</th>
				<th style="width: 50px; text-align: center">Aksi</th>
			</tr>
			</thead>
			<tbody>

				<?php
					//koneksi ke database
					include "koneksi.php";

					//baca data mahasiswa
					$sql = mysqli_query($konek, "select * from mahasiswa");
					$no = 0;
					while($data = mysqli_fetch_array($sql)) 
					{
						$no++;
				
				?>

				<tr>
					<td> <?php echo $no; ?> </td>
					<td> <?php echo $data['nokartu']; ?></td>
					<td> <?php echo $data['nama']; ?></td>
					<td> <?php echo $data['NPM']; ?></td>
					<td> <?php echo $data['Prodi']; ?></td>
					<td>
						<a href="edit.php?id=<?php echo $data['id']; ?>">
						Edit</a> | <a href="hapus.php?id=<?php echo $data[
							'id']; ?>">Hapus</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>

	<!-- tombol tambah data mahasiswa -->
	<a href="tambah.php"> <button class="btn btn-primary">Tambah Data Mahasiswa</button></a>

	<?php include "footer.php"; ?>

</body>
</html>