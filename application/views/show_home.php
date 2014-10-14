<?php $img_link = base_url()."/assets/images";?>
<div class="fRight" style="margin: -35px 18px 0 0;">
<h2>
    <a href="<?=base_url();?>def/pdfDetails/<?php echo $year ."/" .$month;?>" target="_blank"><?php echo img($img_link.'/pdf.png', TRUE);?></a>
    <?php echo $this->fungsi->bulan($month) .' '.$year;?>
</h2>
</div>
<table style="width: 999px;" id="daily" summary="Home">
    <thead>
    <tr class="top">
        <th rowspan="2" class="rounded-company">Tanggal</th>
        <th rowspan="2">TBS Sisa Kemarin</th>
        <th colspan="4">TBS Diterima</th>
        <th rowspan="2">TBS Diolah</th>
        <th rowspan="2">TBS Sisa HI</th>
        <th colspan="4">Rendemen MS</th>
        <th colspan="4" class="rounded-q4">Rendemen IS</th>
    </tr>
    <tr>
        <th>Kebun</th>
        <th>Pembelian</th>
        <th>Titip Olah</th>
        <th>Jumlah</th>
        <th>Kebun</th>
        <th>Pembelian</th>
        <th>Titip Olah</th>
        <th>PKS</th>
        <th>Kebun</th>
        <th>Pembelian</th>
        <th>Titip Olah</th>
        <th>PKS</th>
    </tr>
    </thead>
    <?php if($rows == 0):?>
    <tr align="center">
        <td colspan="16"><span id="error">Data Tidak Tersedia</span></td>
    </tr>
    <?php else:?>
    <?php
    $i = 0;
    $sisa = 0;
    $sisa_kemarin = 0;
    $pembelian = 0;
    $titip_olah = 0;

    $rend_ms_kebun = 0;
    $rend_is_kebun = 0;

    $rend_ms_pembelian = 0;
    $rend_is_pembelian = 0;
    
    $rend_ms_tolah = 0;
    $rend_is_tolah = 0;

    $rend_ms = 0;
    $rend_is = 0;

    $total_sisa_kemarin = 0;
    $total_diterima = 0;
    $total_kebun = 0;
    $total_pembelian = 0;
    $total_tolah = 0;
    $total_diolah = 0;
    $total_sisa = 0;
    $total_ms_in = 0;
    $total_is_in = 0;
    
    $ms_in_kebun = 0;
    $ms_in_pembelian = 0;
    $ms_in_tolah = 0;
        
    $is_in_kebun = 0;
    $is_in_pembelian = 0;
    $is_in_tolah = 0;
        
    $diolah_kebun = 0;
    $diolah_pembelian = 0;
    $diolah_tolah = 0;
    
    $rend_total_ms_kebun = 0;
    $rend_total_is_kebun = 0;
        
    $rend_total_ms_pembelian = 0;
    $rend_total_is_pembelian = 0;
        
    $rend_total_ms_tolah = 0;
    $rend_total_is_tolah = 0;
             
    $rend_total_ms = 0;
    $rend_total_is = 0;
        
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
        
        $data = $this->produksi_model->get_data_from_date($tgl);
        $kemarin = $this->produksi_model->get_sisa_kemarin_from_date($tgl);
        $data2 = $this->produksi_model->get_data_kebun_sendiri($tgl);
        $data3 = $this->produksi_model->get_data_pembelian($tgl);
        $data4 = $this->produksi_model->get_data_tolah($tgl);

        if(isset($kemarin->sisa)) $sisa_kemarin = $kemarin->sisa;
        $diterima = $data->diterima;
        $diolah = $data->diolah;
        $kebun = $data2->diterima;
        if(isset($data3->diterima)) $pembelian = $data3->diterima;
        if(isset($data4->diterima)) $titip_olah = $data4->diterima;
        if(isset($data->sisa))$sisa = $data->sisa;
        
        if(isset($data2->diolah)){
            $rend_ms_kebun = round($data2->ms_in / $data2->diolah * 100,2);
            $rend_is_kebun = round($data2->is_in / $data2->diolah * 100,2);
        }

        if(isset($data3->diolah)){
            $rend_ms_pembelian = round($data3->ms_in / $data3->diolah * 100,2);
            $rend_is_pembelian = round($data3->is_in / $data3->diolah * 100,2);
        }
        
        if(isset($data4->diolah)){
            $rend_ms_tolah = round($data4->ms_in / $data4->diolah * 100,2);
            $rend_is_tolah = round($data4->is_in / $data4->diolah * 100,2);
        }

        $rend_ms = round($data->ms_in / $diolah * 100,2);
        $rend_is = round($data->is_in / $diolah * 100,2);
        
        $total_sisa_kemarin += $sisa_kemarin;
        $total_diterima += $diterima;
        $total_kebun += $kebun;
        $total_pembelian += $pembelian;
        $total_tolah += $titip_olah;
        $total_diolah += $diolah;
        $total_sisa += $sisa;
        $total_ms_in += $data->ms_in;
        $total_is_in += $data->is_in;
        
        $ms_in_kebun += $data2->ms_in;
        $ms_in_pembelian += $data3->ms_in;
        $ms_in_tolah += $data4->ms_in;
        
        $is_in_kebun += $data2->is_in;
        $is_in_pembelian += $data3->is_in;
        $is_in_tolah += $data4->is_in;
        
        $diolah_kebun += $data2->diolah;
        $diolah_pembelian += $data3->diolah;
        $diolah_tolah += $data4->diolah;
                
    ?>
        <td>
            <center>
                <a href="<?=base_url();?>def/topdf/<?php echo $tgl;?>" target="_blank"><?php echo img($img_link.'/pdf.png', TRUE);?></a>
                <?php echo $tgl;?>
            </center>
        </td>
        <td><?php echo setNum($sisa_kemarin);?></td>
        <td><?php echo setNum($kebun);?></td>
        <td><?php echo setNum($pembelian);?></td>
        <td><?php echo setNum($titip_olah);?></td>
        <td><p class="total"><?php echo setNum($diterima);?></p></td>
        <td><?php echo setNum($diolah);?></td>
        <td><?php echo setNum($sisa);?></td>
        <td><?php echo $rend_ms_kebun;?></td>
        <td><?php echo $rend_ms_pembelian;?></td>
        <td><?php echo $rend_ms_tolah;?></td>
        <td><p class="total"><?php echo $rend_ms;?></p></td>
        <td><?php echo $rend_is_kebun;?></td>
        <td><?php echo $rend_is_pembelian;?></td>
        <td><?php echo $rend_is_tolah;?></td>
        <td><p class="total"><?php echo $rend_is;?></p></td>
    </tr>
    <?php endforeach; ?>
    <?php
        if($diolah_kebun != 0) $rend_total_ms_kebun = round($ms_in_kebun / $diolah_kebun * 100,2);
        if($diolah_kebun != 0) $rend_total_is_kebun = round($is_in_kebun / $diolah_kebun * 100,2);
        
        if($diolah_pembelian != 0) $rend_total_ms_pembelian = round($ms_in_pembelian / $diolah_pembelian * 100,2);
        if($diolah_pembelian != 0) $rend_total_is_pembelian = round($is_in_pembelian / $diolah_pembelian * 100,2);
        
        if($diolah_tolah != 0) $rend_total_ms_tolah = round($ms_in_tolah / $diolah_tolah * 100,2);
        if($diolah_tolah != 0) $rend_total_is_tolah = round($is_in_tolah / $diolah_tolah * 100,2);
             
        if($total_diolah != 0) $rend_total_ms = round($total_ms_in / $total_diolah * 100,2);
        if($total_diolah != 0) $rend_total_is = round($total_is_in / $total_diolah * 100,2);
    ?>
    <tr class="total">
        <td>JUMLAH</td>
        <td><?php echo setNum($total_sisa_kemarin);?></td>
        <td><?php echo setNum($total_kebun);?></td>
        <td><?php echo setNum($total_pembelian);?></td>
        <td><?php echo setNum($total_tolah);?></td>
        <td><?php echo setNum($total_diterima);?></td>
        <td><?php echo setNum($total_diolah);?></td>
        <td><?php echo setNum($total_sisa);?></td>
        <td><?php echo $rend_total_ms_kebun;?></td>
        <td><?php echo $rend_total_ms_pembelian;?></td>
        <td><?php echo $rend_total_ms_tolah;?></td>
        <td><?php echo $rend_total_ms;?></td>
        <td><?php echo $rend_total_is_kebun;?></td>
        <td><?php echo $rend_total_is_pembelian;?></td>
        <td><?php echo $rend_total_is_tolah;?></td>
        <td><?php echo $rend_total_is;?></td>
    </tr>
    <?php endif;?>
</table>
<?php
function setNum($str) {
        return number_format($str, 0, ',', '.');
    }
?>