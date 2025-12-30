<!-- proses penyimpanan -->

<?php
	include "koneksi.php";
//jika tombol simpan diklik
	if(isset($_POST['btnSimpan']))
	{
		//baca isi inputan form
		$nokartu = $_POST['nokartu'];
		$nama = $_POST['nama'];
		$NPM = $_POST['NPM'];
		$Prodi = $_POST['Prodi'];

		//simpan ke tabel mahasiswa
		$simpan = mysqli_query($konek, "insert into mahasiswa(NoKartu, nama, NPM, Prodi)value
			('$nokartu', '$nama', '$NPM', '$Prodi') ");
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
					location.replace('datamahasiswa.php')
					</script>
			";
					
		}
	}
	//kosongkan tabel tmprfid
	mysqli_query($konek, "delete from tmprfid");
?>


<!DOCTYPE html>
<html>
<head>
	<?php include "header.php"; ?>
	<title>Tambah Data Mahasiswa</title>

	<!--- pembacaan no kartu otomatis -->
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$("#norfid").load('nokartu.php')
			}, 0); //pembacaan file nokartu.php, sesuai keinginan
		});
	</script> 
</head>
<body>
	<?php include "menu.php"; ?>

	<!-- isi -->
	<div class="container-fluid">
		<h3>Tambah Data Mahasiswa</h3>

		<!-- form input -->
		<form method="POST">
			<div id="norfid"></div>

			<div class="form-group">
				<label>Nama Mahasiswa</label>
				<input type="text" name="nama" id="nama" placeholder="Nama Mahasiswa" class="form-control" style="width: 400px">
			</div>
			<div class="form-group">
				<label>NPM</label>
				<input type="text" name="NPM" id="NPM" placeholder
				="NPM" class="form-control" style="
					width: 200px">
			</div>
				<div class="form-group">
				<label>Prodi</label>
				<textarea class="form-control" name="Prodi" id="Prodi"
				placeholder="Prodi" style="width: 400px"></textarea>
			</div>

			<button class="btn btn-primary" name="btnSimpan" id="btnSimpan
			">simpan</button>
		</form>
	</div>
	<?php include "footer.php"; ?>

</body>
</html>