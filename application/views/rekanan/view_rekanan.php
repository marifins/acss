<script type="text/javascript">
    $(function() {
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
        
        /**var letters = new Array("A-B", "C-D", "E-F", "G-H", "I-J", "K-L", "M-N", "O-P", "Q-R", "S-T", "U-V", "W-X", "Y-X");
        for(var i=0; i<letters.length; i++){
            $( "#"+letters[i]+"" ).click(function(){
                alert(letters[1]);
            });
        }*/
    
        $( "button#letters" ).click(function(){
            var letter = $(this).val();
            var link = base+"search/get_letter/"+letter;
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
                    <strong>System:</strong> Success. Rekanan telah diupdate!
                </div>
                <?php elseif ($_GET['s'] == 'success_delete'): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>System:</strong> Success. Rekanan <?php echo isset($_GET['id']) ? $_GET['id'] :'';?> telah dihapus!
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="btn-toolbar" >
            <a href="<?php echo $base; ?>rekanan/add" class="btn btn-primary"><i class="icon-plus"></i> New Data</a>

            <?php
            $letters = array('A-B', 'C-D', 'E-F', 'G-H', 'I-J', 'K-L', 'M-N', 'O-P', 'Q-R', 'S-T', 'U-V', 'W-X', 'Y-X');
            ?>
            <div class="btn-group">
                <?php for ($i = 0; $i < 13; $i++): ?>
                    <button class="btn" id="letters" value="<?php echo $letters[$i]; ?>"><?php echo $letters[$i]; ?></button>
                <?php endfor; ?>
            </div>
        </div>
        <div id="show">
            <?php $this->load->view('rekanan/show_rekanan'); ?>
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

