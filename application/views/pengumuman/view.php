<?php $base = base_url(); ?>
<style>
    span.judul{
        font-size: 35px; 
        color:#ffffff; 
        font-weight: bold;
    }

    p.isi{
        font-size: 25px; 
        color:#666666; 
        font-weight:bold; 
        margin: 25px 25px 0 25px;
        line-height:125%;
    }

    p.ttd{
        font-size: 15px; 
        color:#666666; 
        font-weight: bold; 
        margin: 0px 45px 0 0;
    }

</style>
<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li class="active">Pengumuman</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if (isset($_GET['s'])): ?>
            <?php if ($_GET['s'] == 'success'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>System:</strong> Success. Pengumuman telah diupdate!
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div align="center">
            <div style="background-color:#48b748; padding: 18px 0 10px 0;">
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
        <div style="float: right; margin: 50px 25px 0 0;">
            <a href="<?php echo $base; ?>pengumuman/edit">Edit Pengumuman <i class="icon-pencil"></i></a> &nbsp;
        </div>