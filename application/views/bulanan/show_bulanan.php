
<?php $img_link = base_url()."/assets/images";?>
<?php
$date = date("d M Y", time() - (60*60*24));

$date2 = date("M Y", time() - (60*60*24));
?>

<table id="monitor-view" summary="View">
     <thead>
        <tr>
            <th style="text-align: left;" colspan="4	" width="70%">
                <img style="position: absolute; margin: -11px 0 0 -10px;" src="<?php echo $img_link;?>/n1.png" width="70" height="57"/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Produksi Kelapa Sawit (ton)
            </th>
            <th style="text-align: right;" colspan="4" width="30%" style="font-size: 23px;"><blink><?php echo $date;?></blink></th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td width="10%" rowspan="2"><p id="header-table">Kebun</p></td>
        <td width="20%" ><p id="header-table">sd <?php echo $date;?></p></td>
        <td width="35%" colspan="2"><p id="header-table">sd <?php echo $date2;?></p></td>
        <td width="35%" colspan="2"><p id="header-table">%Pencapaian</p></td>      
    </tr>
    <tr>
        <td><p id="header-monitor">REAL</p></td>
        <td><p id="header-monitor">RKAP</p></td>
        <td><p id="header-monitor">RKO</p></td>      
        <td><p id="header-monitor">RKAP</p></td>
	<td><p id="header-monitor">RKO</p></td>
    </tr>
    <?php
        $rek = array("080.01","080.02","080.03","080.04","080.08","080.13");
        $name = array("PTG","KLM","KBR","TSW","JRU","CGR");
		
		$treal = 0; $trkap = 0; $trko = 0;
		$real = 0; $rkap = 0; $rko = 0;

    ?>
	<?php for($i = 0; $i < 6; $i++):?>
	<?php
		$yreal = $this->show_model->get_real_yearly($rek[$i]);
                $yrkap = $this->show_model->get_rkap_yearly($rek[$i]);
		$real = $yreal->realisasi;
		$rkap = $yrkap->rkap;
		$rko = $yrkap->rko;
		
		$persen_rkap = persentase($rkap, $real);
		$persen_rko = persentase($rko, $real);
		
		$treal += $real;
		$trkap += $rkap;
		$trko += $rko; 
		
		$tpersen_rkap = persentase($trkap, $treal);
		$tpersen_rko = persentase($trko, $treal);
	?>
        <tr>
            <td><b style="color: #2693ac;"><?php echo $name[$i];?></b></td>
            <td><b><?php echo setNum($real);?></b></td>
            <td><b style="color: #2693ac;"><?php echo setNum($rkap);?></b></td>
            <td><b><?php echo setNum($rko);?></b></td>
            <td><b><?php echo $persen_rkap;?></b></td>
			<td><b><?php echo $persen_rko;?></b></td>
		<tr>
	<?php endfor;?>
        <td><b style="color: #000000;">Total</b></td>
        <td><b style="color: #000000;"><?php echo setNum($treal);?></b></td>
        <td><b style="color: #000000;"><?php echo setNum($trkap);?></b></td>
        <td><b style="color: #000000;"><?php echo setNum($trko);?></b></td>
        <td><b style="color: #000000;"><?php echo $tpersen_rkap;?></b></td>
		<td><b style="color: #000000;"><?php echo $tpersen_rko;?></b></td>
    </tbody>
    <?php //endforeach;?>
</table>

<?php

function persentase($a, $b){
    $res = 0;
    if(isset($b) AND $b != 0){
        if(isset($a) AND $a != 0){
            $res = ($b / $a) * 100;
        }
    }
    return round($res, 2);
}
function setNum($str){
    return number_format($str,0,',','.');
}
?>