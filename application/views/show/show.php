
<?php $img_link = base_url() . "/assets/images"; ?>
<?php
$date = date("d M Y", time() - (60 * 60 * 24));
?>

<table id="monitor-view" summary="View">
    <thead>
        <tr>
            <th style="text-align: left;" colspan="7" width="70%">
                <img style="position: absolute; margin: -11px 0 0 -10px;" src="<?php echo $img_link; ?>/n1.png" width="70" height="57"/>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Produksi Kelapa Sawit (ton)
            </th>
            <th style="text-align: right;" colspan="4" width="30%" style="font-size: 23px;"><blink><?php echo $date; ?></blink></th>
</tr>
</thead>
<tbody>
    <tr>
        <td width="9.09%" rowspan="2"><p id="header-table">Kebun</p></td>
        <td colspan="2"><p id="header-table">REAL</p></td>
        <td colspan="2"><p id="header-table">RKAP</p></td>
        <td colspan="2"><p id="header-table">RKO</p></td>
        <td colspan="2"><p id="header-table">%Pencapaian</p></td>      
    </tr>
    <tr>
        <td width="9.09%"><p id="header-monitor">HI</p></td>
        <td width="9.09%"><p id="header-monitor">SD&nbsp;HI</p></td>
        <td width="9.09%"><p id="header-monitor">HI</p></td>
        <td width="9.09%"><p id="header-monitor">SD&nbsp;HI</p></td>
        <td width="9.09%"><p id="header-monitor">HI</p></td>      
        <td width="9.09%"><p id="header-monitor">SD&nbsp;HI</p></td>
        <td width="9.09%"><p id="header-monitor">RKAP</p></td>      
        <td width="9.09%"><p id="header-monitor">RKO</p></td>
    </tr>
    <?php
    $rek = array("080.01", "080.02", "080.03", "080.04", "080.08", "080.13");
    $name = array("PTG", "KLM", "KBR", "TSW", "JRU", "CGR");

    $real_daily = 0;
    $real_monthly = 0;
    $rkap_daily = 0;
    $rkap_monthly = 0;
    $rko_daily = 0;
    $rko_monthly = 0;
    $treal_daily = 0;
    $treal_monthly = 0;
    $trkap_daily = 0;
    $trkap_monthly = 0;
    $trko_daily = 0;
    $trko_monthly = 0;
    ?>
    <?php for ($i = 0; $i < 6; $i++): ?>
        <?php
        $d = $this->show_model->get_real_daily($rek[$i]);
        $m = $this->show_model->get_real_monthly($rek[$i]);

        $drkap = $this->show_model->get_rkap($rek[$i]);
        $hk = $this->show_model->get_hk($rek[$i]);
        $date = date("d");
        $date = adjust($date);

        if (isset($d->realisasi))
            $real_daily = $d->realisasi;
        if (isset($m->realisasi))
            $real_monthly = $m->realisasi;
        if (isset($drkap->rkap) AND isset($hk->jlh_hari))
            $rkap_daily = ceil($drkap->rkap / $hk->jlh_hari);
        if (isset($drkap->rkap) AND isset($hk->jlh_hari))
            $rkap_monthly = ceil($drkap->rkap / $hk->jlh_hari * $date);
        if (isset($drkap->rko) AND isset($hk->jlh_hari))
            $rko_daily = ceil($drkap->rko / $hk->jlh_hari);
        if (isset($drkap->rko) AND isset($hk->jlh_hari))
            $rko_monthly = ceil($drkap->rko / $hk->jlh_hari * $date);

        $persen_daily = persentase($rkap_monthly, $m->realisasi);
        $persen_monthly = persentase($rko_monthly, $m->realisasi);

        if (isset($d->realisasi))
            $treal_daily += $d->realisasi;
        if (isset($m->realisasi))
            $treal_monthly += $m->realisasi;
        if (isset($drkap->rkap) AND isset($hk->jlh_hari))
            $trkap_daily += $rkap_daily;
        if (isset($drkap->rkap) AND isset($hk->jlh_hari))
            $trkap_monthly += $rkap_monthly;
        if (isset($drkap->rko) AND isset($hk->jlh_hari))
            $trko_daily += $rko_daily;
        if (isset($drkap->rko) AND isset($hk->jlh_hari))
            $trko_monthly += $rko_monthly;

        $tpersen_daily = persentase($trkap_monthly, $treal_monthly);
        $tpersen_monthly = persentase($trko_monthly, $treal_monthly);
        ?>
        <tr>
            <td><b style="color: #2693ac;"><?php echo $name[$i]; ?></b></td>
            <td><b><?php echo $real_daily; ?></b></td>
            <td><b style="color: #2693ac;"><?php echo $real_monthly; ?></b></td>
            <td><b><?php echo $rkap_daily; ?></b></td>                     
            <td><b style="color: #2693ac;"><?php echo $rkap_monthly; ?></b></td>
            <td><b><?php echo $rko_daily; ?></b></td>  
            <td><b style="color: #2693ac;"><?php echo $rko_monthly; ?></b></td>
            <td><b><?php echo $persen_daily; ?></b></td>
            <td><b><?php echo $persen_monthly; ?></b></td>		
        <tr>
<?php endfor; ?>
        <td><b style="color: #000000;">Total</b></td>
        <td><b style="color: #000000;"><?php echo setNum($treal_daily); ?></b></td>
        <td><b style="color: #000000;"><?php echo setNum($treal_monthly); ?></b></td>
        <td><b style="color: #000000;"><?php echo setNum($trkap_daily); ?></b></td>       
        <td><b style="color: #000000;"><?php echo setNum($trkap_monthly); ?></b></td>      
        <td><b style="color: #000000;"><?php echo setNum($trko_daily); ?></b></td>
        <td><b style="color: #000000;"><?php echo setNum($trko_monthly); ?></b></td>
        <td><b style="color: #000000;"><?php echo $tpersen_daily; ?></b></td>
        <td><b style="color: #000000;"><?php echo $tpersen_monthly; ?></b></td>
</tbody>
<?php //endforeach; ?>
</table>

<?php

function persentase($a, $b) {
    $res = 0;
    if (isset($b) AND $b != 0) {
        if (isset($a) AND $a != 0) {
            $res = ($b / $a) * 100;
        }
    }
    return round($res, 2);
}

function setNum($str) {
    return number_format($str, 0, ',', '.');
}
function adjust($date) {
    if($date > 0 && $date < 8) $date = $date - 1;
    if($date > 7 && $date < 15) $date = $date - 2;
    if($date > 14 && $date < 22) $date = $date - 3;
    if($date > 21 && $date < 32) $date = $date - 4;
    return $date;
}
?>