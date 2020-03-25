<?php 
// Mencari Jarak Positif Manual
$a = sqrt(pow((3.7139-3.7139),2) + pow((2.98144-1.19256),2) + pow((1.29776-3.24444),2) + pow((1.8741-1.40556),2) + pow((0.78448-0.78448),2));
$b = sqrt(pow((3.7139-1.85695),2) + pow((2.98144-2.98144),2) + pow((1.29776-1.29776),2) + pow((1.8741-1.8741),2) + pow((0.78448-3.13784),2));
$c = sqrt(pow((3.7139-2.78545),2) + pow((2.98144-2.38512),2) + pow((1.29776-1.94664),2) + pow((1.8741-1.8741),2) + pow((0.78448-2.3534),2));
// Mencari Jarak Negatif Manual
$d = sqrt(pow((3.7139-1.85695),2) + pow((1.19256-1.19256),2) + pow((3.24444-3.24444),2) + pow((1.40556-1.40556),2) + pow((0.78448-3.13784),2));
$e = sqrt(pow((1.85695-1.85695),2) + pow((2.98144-1.19256),2) + pow((1.29776-3.24444),2) + pow((1.8741-1.40556),2) + pow((3.13784-3.13784),2));
$f = sqrt(pow((2.78545-1.85695),2) + pow((2.38512-1.19256),2) + pow((1.94664-3.24444),2) + pow((1.8741-1.40556),2) + pow((2.3534-3.13784),2));

?> 
<div class="container-fluid mt-3">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Evaluation Matrix (x<sub>ij</sub>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM detail_transaksi JOIN kriteria USING (id_kriteria) JOIN barang USING(id_barang)");
                $jumlah_batas = mysqli_num_rows($query);
                $data      = [];
                $kriterias = [];
                $bobot     = [];
                $atribut     = [];
                $nilai_kuadrat = [];
                $tanggal_pemesanan = "";
                $tanggal_deadline = "";
                $asd = "";
                if ($query) {
                    foreach($query as $row)
                    {

                        if(!isset($nilai_kuadrat[$row['nama_kriteria']])){
                            $nilai_kuadrat[$row['nama_kriteria']]=0;
                        }

                        $bobot[$row['nama_kriteria']]=$row['bobot'];
                        $atribut[$row['nama_kriteria']]=$row['atribut'];  

                        if($row['nama_kriteria'] == "Sisa Hari")
                        {
                            date_default_timezone_set("Asia/Jakarta");
                            $tanggal_deadline2 = date("Y-m-d",strtotime($row['value_kriteria']));
                            $today2    = new DateTime($tanggal_deadline2);
                            $booking2       = new DateTime();
                            $diff2        = $booking2->diff($today2);
                            $interval2 = $diff2->format('%d');
                            $row['value_kriteria'] = $interval2 + 1;
                        }

                        if($row['nama_kriteria'] == "Waktu Pengerjaan")
                        {
                            $tanggal_pemesanan = date("Y-m-d",strtotime($row['value_kriteria']));
                            $today    = new DateTime($tanggal_pemesanan);
                            $booking       = new DateTime($tanggal_deadline2);
                            $diff        = $booking->diff($today);
                            $interval = $diff->format('%d');
                            $row['value_kriteria'] = $interval;
                        }
                        
                        
                        $data[$row['nama_barang_detail']][$row['nama_kriteria']] = $row['value_kriteria'];
                        $nilai_kuadrat[$row['nama_kriteria']]+=pow($row['value_kriteria'],2);
                        $kriterias[]=$row['nama_kriteria'];
                    }
                    
                }
                $kriteria     =array_unique($kriterias);
                $jml_kriteria =count($kriteria);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%" rowspan="3">No</th>
                        <th class="text-center" rowspan="3">Alternatif</th>
                        <th class="text-center" rowspan="3">Nama</th>
                        <th colspan="<?php echo $jml_kriteria;?>"">Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>$k</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>K$n</th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=0;
                    foreach($data as $nama =>$krit){
                        echo "<tr>
                        <td>".(++$i)."</td>
                        <th>A$i</th>
                        <td>$nama</td>";
                        foreach($kriteria as $k){
                        echo "<td align='center'>$krit[$k]</td>";
                        }
                        echo "</tr>\n";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Ternormalisasi (r<sub>ij</sub>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%" rowspan="3">No</th>
                        <th class="text-center" rowspan="3">Alternatif</th>
                        <th class="text-center" rowspan="3">Nama</th>
                        <th colspan="<?php echo $jml_kriteria;?>"">Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>$k</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>K$n</th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=0;
                        foreach($data as $nama=>$krit){
                            echo "<tr>
                            <td>".(++$i)."</td>
                            <th>A{$i}</th>
                            <td>{$nama}</td>";
                            foreach($kriteria as $k){
                            echo "<td align='center'>".round(($krit[$k]/sqrt($nilai_kuadrat[$k])),3)."</td>";
                            }
                            echo
                            "</tr>\n";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Ternormalisasi Bobot (y<sub>ij</sub>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="text-center" width="5%" rowspan="3">No</th>
                        <th class="text-center" rowspan="3">Alternatif</th>
                        <th class="text-center" rowspan="3">Nama</th>
                        <th colspan="<?php echo $jml_kriteria;?>"">Kriteria</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($kriteria as $k)
                        echo "<th>$k</th>\n";
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for($n=1;$n<=$jml_kriteria;$n++)
                        echo "<th>K$n</th>";
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=0;
                        $y=[];
                        foreach($data as $nama=>$krit){
                            echo "<tr>
                            <td>".(++$i)."</td>
                            <th>A{$i}</th>
                            <td>{$nama}</td>";
                            foreach($kriteria as $k){
                            $y[$k][$i-1]=round(($krit[$k]/sqrt($nilai_kuadrat[$k])),3)*$bobot[$k];
                            echo "<td align='center'>".$y[$k][$i-1]."</td>";
                            }
                            echo
                            "</tr>\n";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Solusi Ideal positif (A<sup>+</sup>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                </tr>
                <tr>
                    <?php
                    foreach($kriteria as $k)
                    echo "<th>$k</th>\n";
                    ?>
                </tr>
                <tr>
                    <?php
                    for($n=1;$n<=$jml_kriteria;$n++)
                    echo "<th>y<sub>{$n}</sub><sup>+</sup></th>";
                    ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $yplus=[];
                    foreach($kriteria as $k){
                        if($atribut[$k] == "Benefit")
                        {
                            $yplus[$k]=([$k]?max($y[$k]):min($y[$k]));
                        }
                        else 
                        {
                            $yplus[$k]=([$k]?min($y[$k]):max($y[$k]));

                        }
                    echo "<th>$yplus[$k]</th>";
                    }
                    ?>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Solusi Ideal negatif (A<sup>-</sup>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th colspan='<?php echo $jml_kriteria;?>'>Kriteria</th>
                </tr>
                <tr>
                    <?php
                    foreach($kriteria as $k)
                    echo "<th>{$k}</th>\n";
                    ?>
                </tr>
                <tr>
                    <?php
                    for($n=1;$n<=$jml_kriteria;$n++)
                    echo "<th>y<sub>{$n}</sub><sup>-</sup></th>";
                    ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php
                    $ymin=[];
                    foreach($kriteria as $k){
                        if($atribut[$k] == "Cost")
                        {
                            $ymin[$k]=[$k]?max($y[$k]):min($y[$k]);
                        }
                        else 
                        {
                            $ymin[$k]=[$k]?min($y[$k]):max($y[$k]);
                        }
                    echo "<th>{$ymin[$k]}</th>";
                    }

                    ?>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jarak positif (D<sub>i</sub><sup>+</sup>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nama</th>
                    <th>D<suo>+</sup></th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $i=0;
                    $dplus=[];
                    foreach($data as $nama=>$krit){
                        echo "<tr>
                        <td>".(++$i)."</td>
                        <th>A{$i}</th>
                        <td>{$nama}</td>";
                        foreach($kriteria as $k){
                        if(!isset($dplus[$i-1])) 
                            $dplus[$i-1]=0;
                            $dplus[$i-1]+=pow($yplus[$k]-$y[$k][$i-1],2);
                        }
                        echo "<td>".round(sqrt($dplus[$i-1]),3)."</td>
                        </tr>\n";
                    }
                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jarak negatif (D<sub>i</sub><sup>-</sup>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nama</th>
                    <th>D<suo>-</sup></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                $dmin=[];
                foreach($data as $nama=>$krit){
                    echo "<tr>
                    <td>".(++$i)."</td>
                    <th>A{$i}</th>
                    <td>{$nama}</td>";
                    foreach($kriteria as $k){
                    if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
                    $dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
                    }
                    echo "<td>".round(sqrt($dmin[$i-1]),3)."</td>
                    </tr>\n";
                }
                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Nilai Preferensi(V<sub>i</sub>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <th>Nama</th>
                    <th>V<sub>i</sub></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=0;
                $V=[];
                foreach($data as $nama=>$krit){
                    echo "<tr>
                    <td>".(++$i)."</td>
                    <th>A{$i}</th>
                    <td>{$nama}</td>";
                    foreach($kriteria as $k){
                    $V[$i-1]=sqrt($dmin[$i-1])/(sqrt($dmin[$i-1])+sqrt($dplus[$i-1]));
                    }
                    $preferensi = round($V[$i-1],3);
                    echo "<td>{$preferensi}</td></tr>\n";
                }
                ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>