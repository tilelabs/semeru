<?php
$error_msg = "";
$hasil = false;
$conn = mysqli_connect("localhost","root","", "dfs_semeru");

$daftar_pos = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM pos ORDER BY nama_pos"), MYSQLI_ASSOC);
$daftar_rute = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM rute"), MYSQLI_ASSOC);

function getPos($id) {
    global $daftar_pos;

    $result = array_values(array_filter($daftar_pos, function($item) use ($id) {
        return $item['id'] == $id;
    }));

    return $result[0];
}

$petunjuk_rute = []; 
foreach ($daftar_rute as $rute) {
    $array_rute = explode(',', $rute['data_pos']);
    $str_rute = "";
    foreach ($array_rute as $id) {
        $pos = getPos($id);
        $str_rute.= $pos['nama_pos'] . "<br>";
    }
    $petunjuk_rute[] = $str_rute;
}

if (!empty($_POST)) {
    $dari = $_POST['dari'];
    $tujuan = $_POST['tujuan'];

    if ($dari != $tujuan) {
        $rute = "";
        foreach ($daftar_rute as $key => $item) {
            if (in_array($dari, explode(',', $item['data_pos']))) {
                $rute = $key;
            }
        }
        $pilihan_rute = explode(',', $daftar_rute[$rute]['data_pos']);

        if (in_array($tujuan, $pilihan_rute)) {
            $total = 0;
            $min_key = 0;
            $min = 999999;
            $rute_hitung = [];
            foreach ($pilihan_rute as $key => $item) {
                $pos = getPos($item);
                $rute_hitung[] = $pos;
                $total += $pos['jarak'];
                if ($pos['jarak'] < $min && $pos['jarak'] > 0) {
                    $min = $pos['jarak'];
                    $min_key = $key;
                } 
                if ($item == $tujuan) break;
            }

            $prev_min_pos = getPos($pilihan_rute[$min_key-1]);
            $min_pos = getPos($pilihan_rute[$min_key]);
            $hasil = true;
        } else {
            $error_msg = 'Maaf, tujuan di luar rute!';
        }
    } else {
        $error_msg = 'Maaf, tujuan sama!';
    }
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
    <div class="container">
        <h2 align="center">Pencarian Rute Terpendek</h2>
        <div class="row">
            <div class="col-sm-6">
                <?php if (!empty($error_msg)) { ?>
                <div class="alert alert-warning" role="alert"><?php echo $error_msg; ?></div>
                <?php } ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="dari">Dari</label>
                        <select class="form-control" id="dari" name="dari">
                        <?php foreach ($daftar_pos as $item) { ?>
                            <option value="<?php echo $item['id'] ?>" <?= ($_POST['dari'] == $item['id'])?'selected':'' ?>><?php echo $item['nama_pos'] ?></option>	
                        <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tujuan">Tujuan</label>
                        <select class="form-control" id="tujuan" name="tujuan">
                            <?php foreach ($daftar_pos as $item) { ?>
                            <option value="<?php echo $item['id'] ?>" <?= ($_POST['tujuan'] == $item['id'])?'selected':'' ?>><?php echo $item['nama_pos'] ?></option>	
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cari Rute</button>
                </form>
            </div>
            <div class="col-sm-6">
                <h5>Rute Pendakian</h5>
                <table class="table table-sm table-bordered">
                    <thead class="thead-dark">
                        <tr align="center">
                            <th scope="col">Pasuruan</th>
                            <th scope="col">Malang</th>
                            <th scope="col">Probolinggo</th>
                            <th scope="col">Tongas</th>
                            <th scope="col">Lumajang</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                            foreach ($petunjuk_rute as $rute) {
                                echo '<td>'. $rute .'</td>';
                            }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <br>
        
        <?php if ($hasil) { ?> 
        <div class="row">
            <div class="col-sm-6">
                <table class="table table-hover">
                    <thead class="table-active">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pos</th>
                            <th scope="col">Jarak</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($rute_hitung as $key => $item) {
                    ?>
                        <tr>
                            <td><?php echo $key+1 ?></td>
                            <td><?php echo $item['nama_pos'] ?></td>
                            <td><?php echo $item['jarak'] ?> km</td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                    <tfoot>
                       <tr>
                           <td colspan="2">Total jarak yang ditempuh</td>
                           <td><?= $total; ?> km</td>
                       </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-sm-6">
                <div class="alert alert-success" role="alert">
                  <h4 class="alert-heading">Well done!</h4>
                  <p>Jarak terdekat:</p>
                    <hr>
                    
                  <p><?= $prev_min_pos['nama_pos'] .' ke '. $min_pos['nama_pos'] . ' (' . $min_pos['jarak'] . " km)" ?></p>
                </div>
            </div>
        </div>
        <?php } ?> 
    </div>

</body>
</html>
