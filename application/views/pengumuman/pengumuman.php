<?php $base = base_url(); ?>
<style>
    body{
        font-family: arial;
    }
    span.judul{
        font-size: 55px; 
        color:#ffffff; 
        font-weight: bold;
    }

    p.isi{
        font-size: 45px; 
        color:#666666; 
        font-weight:bold; 
        margin: 25px 25px 0 25px;
    }

    p.ttd{
        font-size: 25px; 
        color:#666666; 
        font-weight: bold; 
        margin: 0px 45px 0 0;
    }

    .ft{
        position:fixed;
        left:0px;
        bottom:0px;
        height:10px;
        width:100%;
        background:#48b748;
    }
</style>
<body>
    <div align="center">
        <div style="background-color:#48b748; padding: 10px 0 10px 0;">
            <span class="judul"><?php echo $query->judul; ?></span>
        </div>
        <p class="isi">
            <?php echo $query->isi; ?>
        </p>
    </div>
    <br /><br />
    <div align="right">
        <p class="ttd">
            <?php echo $query->tanggal; ?>
            <br /><br />
            <?php echo $query->pejabat; ?><br />
            <?php echo $query->jabatan; ?>
        </p>
    </div>
    <div class="ft">
        &nbsp;
    </div>
</body>