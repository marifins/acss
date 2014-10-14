<script type="text/javascript">
    $(function() {
        $( "#id" ).css('display','none');
        $( "#link" ).css('display','none');
        
        $( "#update_gallery" ).click(function(){
            var photo = $( "#photo" ).val();
            var desc = $( "#desc" ).val();  
                     
            if(photo == "" || desc == ""){
                alert("Error. Lengkapi seluruh form!");
            }else{
                $( "form.update_gallery" ).submit();     
            }
        });
    });
</script>
<style>
    select.tahun, select.bulan, select.tahun, input#hk{
        font-size: 17px;
        font-weight:bold;
    }
    textarea{
        width:95%;
    }
    
    
    img{
        width: 250px;
    }
</style>
<?php
$base = base_url();
$i = $base . 'assets/images/';
?>
<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo $base; ?>gallery">Gallery</a> <span class="divider">/</span></li>
    <li class="active">Update Gallery</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">

        <div class="btn-toolbar">
            <button id="update_gallery" class="btn btn-primary"><i class="icon-save"></i> Save Change</button>
            <a href="<?php echo $base; ?>gallery" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <form enctype="multipart/form-data" class="update_gallery" id="tab" method="post" action="<?php echo $base; ?>gallery/do_upload/<?php echo $query->id; ?>">
                        <input type="text" id="id" name="id" value="<?php echo $query->id; ?>" maxlength="2">
                        <input type="text" id="link" name="link" value="<?php echo $query->link; ?>" maxlength="2">
                        <label>Current Photo</label>
                        <img src="<?php echo $i. $query->link; ?>" class="img-polaroid"><br /><br />
                        
                        <label>Ganti Photo</label>
                        <input type="file" name="userfile" id="photo" /><br /><br />
                                                
                        <label>Deskripsi</label>
                        <textarea name="desc" id="desc" maxlength="470"><?php echo $query->desc; ?></textarea>
                    </form>
                </div>
            </div>

        </div>
