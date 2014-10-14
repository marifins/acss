<script type="text/javascript">
    $(function() {
        $(".tahun").change(function(){
            var tahun = $(".tahun").val();
            load('rkap/index_ajax/'+tahun, '#show');
        });
        
        var a, b;
        $("a#delete_rkap").click(function(){
            a = $(this).attr('thn_rkap');
            b = $(this).attr('bln_rkap');
        });
        
        $("button#remove_rkap").click(function(){
            $.ajax({
                url: site+'rkap/delete/'+a+'/'+b,
                success: function(response){
                    window.location = "";
                }
            });      
        });
    });
    
</script>
<style>
    #pilih_tahun{
        margin: 0 0 0 5px;
    }
    select.tahun{
        width: 100px;
        margin: 0 0 0 5px;
        font-size: 17px;
        font-weight: bold;
    }
</style>
<?php $base = base_url(); ?>
<ul class="breadcrumb">
    <li><a href="">Home</a> <span class="divider">/</span></li>
    <li class="active">Kategori Bidang</li>
</ul>

<div class="container-fluid">
    <div class="row-fluid">
        <?php if (isset($_GET['s'])): ?>
            <?php if ($_GET['s'] == 'success'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>System:</strong> Success. RKAP telah diupdate!
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="btn-toolbar">
            <a href="<?php echo $base; ?>bidang/add_kategori" class="btn btn-primary"><i class="icon-plus"></i> Tambah Kategori</a>
            <a href="<?php echo $base; ?>bidang/add_sub_bidang" class="btn btn-primary"><i class="icon-plus"></i> Tambah Sub Bidang</a>
            <div class="btn-group">
            </div>
        </div>
        <div id="show">
            <?php $this->load->view('bidang/show_bidang'); ?>
        </div>

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
                <button id="remove_rkap" class="btn btn-danger" data-dismiss="modal">Delete</button>              
            </div>
        </div>

