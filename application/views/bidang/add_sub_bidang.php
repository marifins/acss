<script type="text/javascript">
    var base = window.location.protocol + "//" + window.location.host +"/rekanan/";
    $(function() { 
        $( "#bidang" ).change(function(){
            var bidang = $( this ).val();
            var link = base+"bidang/get_kategori_bidang/"+bidang;
            $.ajax({
                url: link,
                success: function(response){
                    $("#load_kategori").html(response);
                }
            });
        });
        
        $( "#save_sub_bidang" ).click(function(){
            var s = 1;
            var sub_bidang = $( "#sub_bidang" ).val();
            var bidang = $( "#bidang" ).val();
            var kategori = $( "#kategori" ).val();
            
            if(sub_bidang == "") s = 0;
            else if(bidang == 0) s = 0;
            else if(kategori == 0) s = 0;
                     
            if(s == 0){
                alert("Error. Lengkapi seluruh form!");
            }else{
                $( "form.add_sub_bidang" ).submit();
            }
        });
    });
</script>
<style>
    input#kategori{
        width: 450px;
    }
</style>

<?php $base = base_url(); ?>
<ul class="breadcrumb">
    <li><a href="<?php echo $base; ?>">Home</a> <span class="divider">/</span></li>
    <li><a href="<?php echo $base; ?>setting">Setting</a> <span class="divider">/</span></li>
    <li class="active">Add Kategori</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if (isset($_GET['s'])): ?>
            <?php if ($_GET['s'] == 'success'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>System:</strong> Success. Sub Bidang telah ditambahkan pada Database.
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="btn-toolbar">
            <button id="save_sub_bidang" class="btn btn-primary"><i class="icon-save"></i> Save</button>
            <a href="<?php echo $base; ?>bidang" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <form id="tab" class="add_sub_bidang" method="POST" action="<?php echo $base; ?>bidang/insert_sub_bidang">
                        <div style="float:left;">
                            <label>Nama Sub Bidang<span>:</span></label><input type="text" name="sub_bidang"  id="sub_bidang" value="" />

                            <label>Bidang:</label>
                            <select name="bidang" id="bidang">
                                <option value="0">-- Pilih Bidang --</option>
                                <?php foreach ($query as $d): ?>
                                    <option value="<?php echo $d->id_bidang; ?>"><?php echo $d->nama_bidang; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div id="load_kategori"></div>
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>

        </div>
