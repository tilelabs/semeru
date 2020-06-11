<?php
$conn = mysqli_connect("localhost","root","", "dfs_semeru");

$daftar_pos = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM pos"), MYSQLI_ASSOC);
$daftar_rute = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM rute"), MYSQLI_ASSOC);

function getPos($id) {
    global $daftar_pos;

    $result = array_values(array_filter($daftar_pos, function($item) use ($id) {
        return $item['id'] == $id;
    }));

    return $result[0];
}

if (!empty($_POST)) {
    $dari = $_POST['dari'];
    $tujuan = $_POST['tujuan'];

	$rute = "";
	foreach ($daftar_rute as $key => $item) {
	    if (in_array($dari, explode(',', $item['data_pos']))) {
	        $rute = $key;
	    }
	}
	$pilihan_rute = explode(',', $daftar_rute[$rute]['data_pos']);

	if (!in_array($tujuan, $pilihan_rute)) {
	    echo 'Maaf, tujuan di luar rute!';
	}

	$total = 0;
	$min_key = 0;
	$min = getPos($dari)['jarak'];
	foreach ($pilihan_rute as $key => $item) {
	    $pos = getPos($item);
	    $total += $pos['jarak'];
	    if ($pos['jarak'] < $min && $pos['jarak'] > 0) {
	        $min = $pos['jarak'];
	        $min_key = $key;
	    } 
	    if ($item == $tujuan) break;
         
	}

    $prev_min_pos = getPos($pilihan_rute[$min_key-1]);
    $min_pos = getPos($pilihan_rute[$min_key]);
	echo 'Jarak terdekat: ' . $prev_min_pos['nama_pos'] .' ke '. $min_pos['nama_pos'] . ' (' . $min_pos['jarak'] . " km)" . "<br>";
	echo 'Total jarak yg ditempuh: ' . $total . ' km';
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
