<script type="text/javascript">
    $(function() {
        $("#tahap_drt").attr('disabled','disabled');
        
        $("#datepicker").css('display','none');
        
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText, inst) { 
                load('produksi/index_ajax/'+dateText, '#show');
            }
        });
        
        $( "#pilih_tanggal" ).click(function(){
            $( "#datepicker" ).datepicker("show");
        });
        
        $( "button#remove" ).click(function(){
            $("form#remove").submit();
        });
        
        $( "#tahun_drt" ).change(function(){
            $("#tahap_drt").attr('disabled', false);
            var tahun = $( this ).val();
            var link = base+"rekanan/get_tahap_drt/"+tahun;
            $.ajax({
                url: link,
                success: function(response){
                    $("#tahap_drt").html(response);
                }
            });
        });
        $( "#tahap_drt" ).change(function(){
            var tahun = $( "#tahun_drt" ).val();
            var tahap = $( this ).val();
            var link = base+"rekanan/lulus_ajax/"+tahun+"/"+tahap;
            $.ajax({
                url: link,
                success: function(response){
                    $("#show").html(response);
                }
            });
        });
                    
    });
    
</script>
<style>
    #pilih_tanggal{
        margin: 0 0 0 5px;
    }
    
    #tahun_drt, #tahap_drt{
        width:125px;
        font-weight: bold;
    }
    
</style>
<?php $base = base_url(); ?>
<ul class="breadcrumb">
    <li><a href="">Home</a> <span class="divider">/</span></li>
    <li class="active">Daftar Rekanan</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if (isset($_GET['s'])): ?>
            <?php if ($_GET['s'] == 'success'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>System:</strong> Success. Produksi telah diupdate!
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="btn-toolbar" >   
            <div class="btn-group">
                <select id="tahun_drt" name="tahun_drt" style="margin:0 5px 0 0;">
                    <option value="0">-  Tahun -</option>
                    <?php foreach ($d_tahun as $d): ?>                
                        <option value="<?php echo $d->tahun; ?>" <?php echo($d->tahun == $data2->tahun) ? 'selected' : ''; ?> ><?php echo "Tahun " .$d->tahun; ?></option>
                    <?php endforeach; ?>
                </select>
                <select id="tahap_drt" name="tahap_drt" style="margin:0 5px 0 0;">
                    <option value="0">- Tahap -</option>
                    <?php $arr_tahap = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'); ?>
                    <?php for ($i = 0; $i < count($arr_tahap); $i++): ?>
                        <option value="<?php echo $arr_tahap[$i]; ?>" <?php echo($arr_tahap[$i] == $data2->tahap_drt) ? 'selected' : ''; ?> ><?php echo "Tahap ".$arr_tahap[$i]; ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>
        <div id="show">
            <?php $this->load->view('rekanan/show_rekanan_lulus'); ?>
        </div>

        <form id="remove" method="get" action="<?php echo $base; ?>produksi/delete""></form>

        <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Delete Confirmation</h3>
            </div>
            <div class="modal-body">
                <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the data?</p>
            </div>
            <div class="modal-footer">           
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button id="remove" class="btn btn-danger" data-dismiss="modal">Delete</button>              
            </div>
        </div>

