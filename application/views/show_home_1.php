<?php $img_link = base_url()."/assets/images";?>
<div class="fRight" style="margin: -35px 18px 0 0;">
<h2>
    <a href="<?=base_url();?>def/topdf/<?php echo $year ."/" .$month;?>"><?php echo img($img_link.'/pdf.png', TRUE);?></a>
    <?php echo $this->fungsi->bulan($month) .' '.$year;?>
</h2>
</div>
<table id="rounded-corner" summary="Outbox">
    <thead>
    <tr class="top">
        <th class="rounded-company">Tanggal</th>
        <th>PKS PTG</th>
        <th>PKS TS</th>
        <th>PKS CGR</th>
        <th class="rounded-q4">Jumlah</th>
    </tr>
    </thead>
    <?php if($rows == 0):?>
    <tr align="center">
        <td colspan="8"><span id="error">Data Tidak Tersedia</span></td>
    </tr>
    <?php else:?>
    <?php
    $i = 0;
    $total_ptg = 0; $total_ts = 0; $total_cgr = 0;
    $total = 0;
        
    foreach ($query as $row):
    $i++;
    $tgl = $row->tanggal;
    if($i % 2 == 0):
    ?>
    <tr>
    <?php else:?>
    <tr class="even">
    <?php endif;?>
    <?php
        $pks_ptg = $this->produksi_model->by_pks('080.08', $tgl);
        $pks_ts = $this->produksi_model->by_pks('080.07', $tgl);
        $pks_cgr = $this->produksi_model->by_pks('080.15', $tgl);


        $total_ptg += s($pks_ptg); $total_ts += s($pks_ts); $total_cgr += s($pks_cgr);
    ?>
        <td><?php echo $tgl;?></td>
        <td id="hov" kebun="080.01" tgl="<?php echo $tgl;?>"><?php echo s($pks_ptg);?></td>
        <td id="hov" kebun="080.02" tgl="<?php echo $tgl;?>"><?php echo s($pks_ts);?></td>
        <td id="hov" kebun="080.03" tgl="<?php echo $tgl;?>"><?php echo s($pks_cgr);?></td>
        <?php
            $jlh = s($pks_ptg) + s($pks_ts) + s($pks_cgr);
            $total += $jlh;
        ?>
        <td><?php echo ($jlh);?></td>
    </tr>
    <?php endforeach; ?>
    <tr class="total">
        <td>JUMLAH</td>
        <td><?php echo $total_ptg;?></td>
        <td><?php echo $total_ts;?></td>
        <td><?php echo $total_cgr;?></td>
        <td><?php echo $total;?></td>
    </tr>
    <?php endif;?>
</table>
<?php
function s($input){
        $res = 0;
        if (array_key_exists('0', $input)) {
            $res = $input['0']['diolah'] / 1000;
            return round($res, 2);
        }else{
            return 0;
        }
    }
?>