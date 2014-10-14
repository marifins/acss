<div style="margin-left: 5px;">
    <?php
        $dt = $this->unit_model->get_unit_name(from_session('unit'));
        $nama_unit = "Admin Sistem";
        if(isset($dt->nama_unit))   $nama_unit = $dt->nama_unit;
    ?>
    <p>Selamat Datang <b style="color:#b8860b;"><?php echo from_session('username');?></b>, anda terdaftar di <b style="color:#b8860b;"><?php echo $nama_unit;?></b></p>
</div>
<br />
<div style="margin-bottom: 5px;">
    &nbsp;
    <?php
    $options = "";
    $options[''] = "-- Tahun --";
    foreach($tahun as $t){
        $options[$t->tahun] = $t->tahun;
    }
    echo form_dropdown('privilege', $options, '', 'id=tahun_unit');
    echo "\r";

    $month = "";
    $month[''] = "-- Bulan --";
    for($i=1; $i<=12; $i++){
        $i = "".$i;
        if(strlen($i) == 1) $i = "0" .$i;
        $month[$i] = $this->fungsi->toStr($i);
    }
    echo form_dropdown('bulan', $month, '', 'id=bulan_unit');
    ?>
</div>
<div style="width: 999px;" id="show_unit">
    <?php $this->load->view('show_home_unit'); ?>
</div>

<script>
    
$("td#hov").live("click",
    function () {
        var tgl = $(this).attr("tgl");
        var kebun = $(this).attr("kebun");
        var link = "<?=base_url(); ?>produksi/detail_afdeling/" +kebun +"/" +tgl;
        l2(link,"");
    },
    function () {
        $(this).find("span:last").remove();
    }
);



//li with fade class
$("li.fade").hover(function(){$(this).fadeOut(100);$(this).fadeIn(500);});

</script>
