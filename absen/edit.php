<!-- proses penyimpanan -->
<?php
	include "koneksi.php";
	//baca ID data yang di edit
	$id = $_GET['id'];

	//baca data karyawan berdasarkan id
	$cari = mysqli_query($konek, "select * from mahasiswa where id='$id'");
	$hasil = mysqli_fetch_array($cari);


	//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		$nokartu = $_POST['nokartu'];
		$nama = $_POST['nama'];
		$NPM = $_POST['NPM'];
		$Prodi = $_POST['Prodi'];

		//simpan ke tabel mahasiswa
		$simpan = mysqli_query($konek, "update mahasiswa set nokartu='$nokartu', nama='$nama', NPM='$NPM', Prodi='$Prodi' where id='$id'");
		//jika berhasil tersimpan, tampilkan pesan Tersimpan, 
		//kembali ke data Mahasiswa
		if($simpan)
		{
				
		//jika berhasil tersimpan, tampilkan pesan Tersimpan, 
		//kembali ke data Mahasiswa
			echo "
					<script>
					alert('Tersimpan')
					location.replace('datamahasiswa.php')
					</script>
			";			
		}
		//jika gagal tersimpan, tampilkan pesan gagal tersimpan, 
		//kembali ke data Mahasiswa
		else
		{
			echo "
					<script>
					alert('Gagal Tersimpan !!! ')
					location.replace('tambah.php')
					</script>
			";
					
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Tambah Data Mahasiswa</title>
</head>
<body>
	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>Tambah Data Mahasiswa</h3>

		<!-- form input -->
		<form method="POST">
			<div class="form-group">
				<label>No Kartu</label>
				<input type="text" name="nokartu" id="nokartu" placeholder="No Kartu" class="form-control" style="width: 200px" value="<?php echo $hasil['nokartu']; ?>">
			</div>
			<div class="form-group">
				<label>Nama Mahasiswa</label>
				<input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" class="form-control" style="width: 400px" value="<?php echo $hasil['nama']; ?>">
			</div>
			<div class="form-group">
				<label>NPM</label>
				<input type="text" name="NPM" id="NPM" placeholder
				="NPM" class="form-control" style="
					width: 200px" value="<?php echo $hasil['NPM']; ?>">
			</div>
				<div class="form-group">
				<label>Prodi</label>
				<textarea class="form-control" name="Prodi" id="Prodi"
				placeholder="Prodi" style="width: 400px"><?php echo $hasil['Prodi']; ?></textarea>
			</div>

			<button class="btn btn-primary" name="btnSimpan" id="btnSimpan
			">simpan</button>
		</form>
	</div>
	<?php include "footer.php"; ?>

</body>
</html>