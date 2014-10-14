<?php
$base = base_url();
$img = $base . 'assets/images/';
?>
<style>
    img{
        width: 100%;
    }
    div#desc{
        text-align: center;
        position: absolute;
        top:675px;
        padding: 15px 0 15px 0;
        display: block;
        background: #000;

        /* Fallback for web browsers that doesn't support RGBa */
        background: rgb(0, 0, 0);
        /* RGBa with 0.6 opacity */
        background: rgba(0, 0, 0, 0.6);
        /* For IE 5.5 - 7*/
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
        /* For IE 8*/
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
    }
    p{
        color:#fff;
        font-family: arial;
        font-size: 35px;
    }
    body {
        overflow-x: hidden;
        overflow-y: hidden;

    }
</style>
<div id="photo">
    <img src="<?php echo $img . $query->id; ?>.jpg" class="img-polaroid">
</div>
<div id="desc">
    <p><?php echo $query->desc; ?></p>
</div>


