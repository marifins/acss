<script type="text/javascript">
    $(function() { 
        $( "#save_kategori" ).click(function(){
            var s = 1;
            var bidang = $( "#bidang" ).val();
            var kategori = $( "#kategori" ).val();
            
            if(kategori == "") s = 0;
            else if(bidang == 0) s = 0;
                     
            if(s == 0){
                alert("Error. Lengkapi seluruh form!");
            }else{
                $( "form.add_kategori" ).submit();
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
                    <strong>System:</strong> Success. Kategori telah ditambahkan pada Database.
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="btn-toolbar">
            <button id="save_kategori" class="btn btn-primary"><i class="icon-save"></i> Save</button>
            <a href="<?php echo $base; ?>bidang" data-toggle="modal" class="btn">Back</a>
            <div class="btn-group">
            </div>
        </div>
        <div class="well">
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="home">
                    <form id="tab" class="add_kategori" method="POST" action="<?php echo $base; ?>bidang/insert_kategori">
                        <div style="float:left;">
                            <label>Nama Kategori<span>:</span></label><input type="text" name="kategori"  id="kategori" value="" />
                            <label>Bidang:</label>
                            <select name="bidang" id="bidang">
                                <option value="0">-- Pilih Bidang --</option>
                                <?php foreach ($query as $d): ?>
                                    <option value="<?php echo $d->id_bidang; ?>"><?php echo $d->nama_bidang; ?></option>
                                <?php endforeach; ?>
                            </select>    
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>

        </div>
