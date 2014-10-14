<?php
$base = base_url();
$img = $base . 'assets/images/';
?>
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
    <li class="active">Gallery</li>
</ul>
<?php
$num = array('1st','2nd','3rd','4th','5th');
$i = 0;
?>
<div class="container-fluid">
    <div class="row-fluid">
        <?php foreach ($query as $q):?>
        <?php $del_link = $base ."gallery/edit/" .$q->id;?>
        <div class="block">
            <p class="block-heading"><?php echo $num[$i];?> Photo</p>
            <div class="block-body gallery">
                <div style="float: right; margin: 0 0 20px 0;">
                    <a href="<?php echo $del_link;?>">Edit <i class="icon-pencil"></i></a>
                </div>
                <img src="<?php echo $img. $q->link; ?>" class="img-polaroid">
                <p><?php echo $q->desc;?></p>      
            </div>
        </div>
        <?php $i++;?>
        <?php endforeach;?>
    </div>