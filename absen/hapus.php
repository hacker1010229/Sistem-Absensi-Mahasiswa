<?php 

	include 'koneksi.php';

	$id = $_GET['id'];

	mysqli_query($konek,"delete from mahasiswa where id='$id'");

	header("location:datamahasiswa.php");

?>