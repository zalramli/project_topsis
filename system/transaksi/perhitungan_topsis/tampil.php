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
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Evaluation Matrix (x<sub>ij</sub>)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM detail_transaksi_kriteria JOIN kriteria USING (id_kriteria) JOIN barang USING(id_barang)");
                $data      =array();
                $kriterias =array();
                $bobot     =array();
                $atribut     =array();
                $nilai_kuadrat =array();

                if ($query) {
                    while($row=$query->fetch_object()){
                        if(!isset($data[$row->nama_barang])){
                            $data[$row->nama_barang]=array();
                        }
                        if(!isset($data[$row->nama_barang][$row->nama_kriteria])){
                            $data[$row->nama_barang][$row->nama_kriteria]=array();
                        }
                        if(!isset($nilai_kuadrat[$row->nama_kriteria])){
                            $nilai_kuadrat[$row->nama_kriteria]=0;
                        }

                        $bobot[$row->nama_kriteria]=$row->bobot;
                        $atribut[$row->nama_kriteria]=$row->atribut;
                        $data[$row->nama_barang][$row->nama_kriteria]=$row->value_kriteria;
                        $nilai_kuadrat[$row->nama_kriteria]+=pow($row->value_kriteria,2);
                        $kriterias[]=$row->nama_kriteria;
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
                foreach($data as $nama=>$krit){
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
                            echo "<td align='center'>".number_format(($krit[$k]/sqrt($nilai_kuadrat[$k])),5)."</td>";
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
                        $y=array();
                        foreach($data as $nama=>$krit){
                            echo "<tr>
                            <td>".(++$i)."</td>
                            <th>A{$i}</th>
                            <td>{$nama}</td>";
                            foreach($kriteria as $k){
                            $y[$k][$i-1]=number_format(($krit[$k]/sqrt($nilai_kuadrat[$k])),5)*$bobot[$k];
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
                    $yplus=array();
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
                    $ymin=array();
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
                    $dplus=array();
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
                        echo "<td>".number_format(sqrt($dplus[$i-1]),13)."</td>
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
                  $dmin=array();
                  foreach($data as $nama=>$krit){
                    echo "<tr>
                      <td>".(++$i)."</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                    foreach($kriteria as $k){
                      if(!isset($dmin[$i-1]))$dmin[$i-1]=0;
                      $dmin[$i-1]+=pow($ymin[$k]-$y[$k][$i-1],2);
                    }
                    echo "<td>".number_format(sqrt($dmin[$i-1]),13)."</td>
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
                  $V=array();
                  foreach($data as $nama=>$krit){
                    echo "<tr>
                      <td>".(++$i)."</td>
                      <th>A{$i}</th>
                      <td>{$nama}</td>";
                    foreach($kriteria as $k){
                      $V[$i-1]=sqrt($dmin[$i-1])/(sqrt($dmin[$i-1])+sqrt($dplus[$i-1]));
                    }
                    echo "<td>{$V[$i-1]}</td></tr>\n";
                  }
                  ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>