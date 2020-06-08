<?php
$conn = mysqli_connect("localhost","root","", "dfs_semeru");

$daftar_pos = mysqli_query($conn, "SELECT * FROM pos");
$daftar_rute = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM rute"), MYSQLI_ASSOC);

if (!empty($_POST)) {

	$rute = "";
	foreach ($daftar_rute as $key => $item) {
	    if (in_array($_POST['dari'], explode(',', $item['data_pos']))) {
	        $rute = $key;
	    }
	}

	if (!in_array($_POST['tujuan'], explode(',', $daftar_rute[$rute]['data_pos']))) {
	    echo 'Maaf, tujuan di luar rute!';
	}

	$pilihan_rute = $daftar_rute[$rute];

	$total = 0;
	$min_key = 0;
	$min = (getPos($pilihan_rute[0]))['jarak'];
	foreach ($pilihan_rute as $key => $item) {
	    $pos = getPos($item);
	    $total += $pos['jarak'];
	    if ($pos['jarak'] < $min) {
	        $min = $pos['jarak'];
	        $min_key = $key;
	    } 
	    print_r($pos). "\n";
	    if ($item == $end) break;
	}

	echo 'Jarak terdekat: ' . $min_key . "\n";
	echo 'Total jarak yg ditempuh: ' . $total;
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="./css/bootstrap.min.css" ">
	<script src="./js/bootstrap.min.js"></script>
	<title>DFS Semeru</title>
</head>
<body>
	<form method="POST">
		<div class="form-group">
		    <label for="dari">Dari</label>
		    <select class="form-control" id="dari" name="dari">
		    <?php foreach ($daftar_pos as $item) { ?>
		    	<option value="<?php echo $item['id'] ?>"><?php echo $item['nama_pos'] ?></option>	
		    <?php } ?>
		    </select>
		</div>

		<div class="form-group">
		    <label for="tujuan">Tujuan</label>
		    <select class="form-control" id="tujuan" name="tujuan">
		    	<?php foreach ($daftar_pos as $item) { ?>
		    	<option value="<?php echo $item['id'] ?>"><?php echo $item['nama_pos'] ?></option>	
		    	<?php } ?>
		    </select>
		</div>
		<button type="submit" class="btn btn-primary">Cari Rute</button>
	</form>

</body>
</html>